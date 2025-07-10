<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Collection;
use App\Ticket;

class ExpiringTicketNotification extends Notification
{
    protected Collection $tickets;

    public function __construct(Collection $tickets)
    {
        $this->tickets = $tickets;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $mail = (new MailMessage)
            ->subject('Ticket in scadenza')
            ->greeting('Buongiorno,')
            ->line('Hai uno o più ticket in scadenza:')
            ->line(new HtmlString('<ul>'));

        foreach ($this->tickets as $ticket) {
            $mail->line(new HtmlString(
                "<li><strong>{$ticket->title}</strong> (Cliente: ".($ticket->customer->name ?? 'N/A').") – Scadenza: ".$ticket->expire_date->format('d/m/Y')."</li>"
            ));
        }

        $mail->line(new HtmlString('</ul>'))
            ->line('Saluti')
            ->line(config('app.name') . ' Team')
            ->salutation(' ');

        return $mail;
    }
}
