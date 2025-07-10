<?php

namespace App\Console\Commands;

use App\Ticket;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ExpiringTicketNotification;
use Carbon\Carbon;

class SendExpiringTicketsNotification extends Command
{
    protected $signature = 'tickets:send-expiry-alerts';
    protected $description = 'Invia una mail agli utenti con ticket in scadenza';

    public function handle()
    {
        $today = Carbon::today();

        $tickets = Ticket::whereNotNull('expire_date')
                    ->whereNotNull('reminder_days')
                    ->where('reminder_days', '>', 0)
                    ->whereNotIn('status_id', [2,6,7,8,99])
                    ->whereNotNull('assigned_to_user_id')
                    ->with('assigned_to_user', 'customer')
                    ->get()
                    ->filter(function ($ticket) use ($today) {
                        return abs($today->diffInDays($ticket->expire_date, false)) <= $ticket->reminder_days;
                    })
                    ->groupBy('assigned_to_user_id');

        $this->info('Totale ticket in scadenza trovati: ' . $tickets->count());
        $this->info('Totale utenti da notificare: ' . $groupedTickets->count());
        foreach ($tickets as $userId => $userTickets) {
            $user = $userTickets->first()->assigned_to_user;
            if ($user && $user->email) {
                Notification::route('mail', $user->email)
                    ->notify(new ExpiringTicketNotification($userTickets));
            }
        }

        $this->info('Notifiche raggruppate inviate con successo.');
    }

}
