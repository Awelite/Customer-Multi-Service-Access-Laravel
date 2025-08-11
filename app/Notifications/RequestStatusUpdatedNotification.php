<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\ServiceRequest;
use Illuminate\Notifications\Messages\MailMessage;

class RequestStatusUpdatedNotification extends Notification
{
    use Queueable;

    public $serviceRequest;

    public function __construct(ServiceRequest $serviceRequest)
    {
        $this->serviceRequest = $serviceRequest;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Service Request Status Updated')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('The status of your service request has been updated.')
            ->line('New Status: ' . ucfirst($this->serviceRequest->status))
            ->action('View Your Requests', url('/customer/requests'))
            ->line('Thank you for using our service!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Your service request status is now ' . $this->serviceRequest->status,
            'request_id' => $this->serviceRequest->id,
        ];
    }
}
