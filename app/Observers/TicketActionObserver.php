<?php

namespace App\Observers;

use App\Notifications\DataChangeEmailNotification;
use App\Notifications\AssignedTicketNotification;
use App\Ticket;
use App\Comment;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketToBeInvoicedEmailNotification;
use App\Notifications\CancelInvoiceEmailNotification;

class TicketActionObserver
{
    public function created(Ticket $model)
    {
        $data  = ['action' => 'New ticket has been created!', 'model_name' => 'Ticket', 'ticket' => $model];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Ticket $model)
    {
        if($model->isDirty('assigned_to_user_id'))
        {
            $user = $model->assigned_to_user;
            if($user)
            {
                Notification::send($user, new AssignedTicketNotification($model));
            }
        }

        if($model->isDirty('status_id'))
        {
            $idTicket = $model->id;
            $status   = $model->status->name;
            $customer = $model->customer!== null ? $model->customer->company_name : '';
            $invoiced = $model->invoiced;

            // if ticket is invoiced, it's necessary to send mail to abort invoice
            if($invoiced == 1 && $status !== '6 - Closed' && $status !== '7 - Rejected' && $status !== '8 - Invoiced') {
                Ticket::where('id', $idTicket)->update(['invoiced' => 0]);
                $data = [
                    'action'     => 'Annullo fattura per il Ticket '.$idTicket.'',
                    'model_name' => 'Ticket',
                    'ticket'     => $model,
                    'customer'   => $customer,
                    'bodymail'   => 'Il ticket è stato annullato per la fatturazione in quanto è tornato nello stato '.$status
                ];
                $users = \App\User::whereHas('roles', function ($q) {
                    return $q->where('title', 'Admin');
                })->get();
                Notification::send($users, new CancelInvoiceEmailNotification($data));
                return ;
            }
            $comments = Comment::where('ticket_id', $idTicket)
                                ->whereNull('deleted_at')
                                ->where(function ($query) {
                                    $query->where(function ($q) {
                                        $q->where('hours_spent', '!=', '00:00')
                                          ->whereNotNull('hours_spent');
                                    })->orWhere(function ($q) {
                                        $q->where('spare_parts_text', '!=', '')
                                          ->whereNotNull('spare_parts_text');
                                    });
                                })
                                ->get();

            $totcomments = $comments->count();
            
            if ($totcomments == 0) {
                return ;
            }

            $bodyMail = '';
            $totalHours = 0;
            $spare_parts_summary = '';
            foreach ($comments as $comment) {
                $bodyMail .= '<b>Data e Ora:</b> ' . $comment->created_at->format('d/m/Y H:i') . "<br/>";
                $bodyMail .= '<b>Attività:</b> ' . nl2br(e($comment->comment_text)) . "<br/>";
                $bodyMail .= '<b>Ore impiegate:</b> ' . $comment->hours_spent . "<br/>";
                $bodyMail .= '<b>Ricambi forniti:</b> ' . ($comment->spare_parts_text ? nl2br(e($comment->spare_parts_text)) : 'Nessuno') . "<br/>";

                $bodyMail .= '<hr><br/>';

                if (preg_match('/^\d{2}:\d{2}$/', $comment->hours_spent)) {
                    $timeParts = explode(':', $comment->hours_spent);
                    $totalHours += $timeParts[0] + ($timeParts[1] / 60);
                }

                //summary spare parts
                if(($comment->spare_parts_text !== null) && ($comment->spare_parts_text !== '')){
                    $spare_parts_summary .= nl2br(e($comment->spare_parts_text)). '<br/>';
                }
            } 

            $bodyMail .= '<br/><strong>Totale ore impiegate: ' . number_format($totalHours, 2) . ' ore</strong>';
            $bodyMail .= '<br/><strong>Ricambi forniti:</strong><br>' . $spare_parts_summary;
            
            if ($status === '5 - Completed')
            {
                $data = [
                    'action'     => 'Ticket '.$idTicket.' da Fatturare',
                    'model_name' => 'Ticket',
                    'ticket'     => $model,
                    'customer'   => $customer,
                    'bodymail'   => $bodyMail
                ];
                $users = \App\User::whereHas('roles', function ($q) {
                    return $q->where('title', 'Billing Department');
                })->get();

                Ticket::where('id', $idTicket)->update(['invoiced' => 1]);

                Notification::send($users, new TicketToBeInvoicedEmailNotification($data));
            }

        }
    }
}
