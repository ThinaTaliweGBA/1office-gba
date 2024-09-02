<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PersonStatusNotification extends Notification
{
    use Queueable;

    private $message;
    private $action;

    public function __construct($action, $message)
    {
        $this->message = $message;
        $this->action = $action;
    }

    public function via($notifiable)
    {
        return ['database'];  // You can add 'mail' or 'broadcast' if needed
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'action' => $this->action,
        ];
    }
}
