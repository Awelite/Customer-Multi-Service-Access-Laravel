<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Notifications\NewServiceRequestNotification;


class NewServiceRequestNotification extends Notification
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Service Request Received')
            ->greeting('Hello ' . $notifiable->name)
            ->line('You have received a new service request for: ' . $this->request->service->name)
            ->action('View Request', url('/provider/requests'))
            ->line('Thank you for using our platform!');
    }
}
