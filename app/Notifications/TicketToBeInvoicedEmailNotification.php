<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

class TicketToBeInvoicedEmailNotification extends Notification
{
    use Queueable;

    public function __construct($data)
    {
        $this->data = $data;
        $this->ticket = $data['ticket'];
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return $this->getMessage();
    }

    public function getMessage()
    {
        return (new MailMessage)
            ->subject($this->data['action'])
            ->greeting('Buongiorno,')
            ->line(new HtmlString($this->data['action']))
            ->line(new HtmlString("Cliente: ".$this->data['customer'])) 
            ->line(new HtmlString("Ticket: ".$this->ticket->title))
            ->line(new HtmlString("Dettaglio:<br> ".$this->data['bodymail']))
            ->line('Saluti')
            ->line(config('app.name') . ' Team')
            ->salutation(' ');
    }
}
