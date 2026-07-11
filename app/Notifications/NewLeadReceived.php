<?php

namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLeadReceived extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Lead $lead
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Lead Received - ' . $this->lead->name)
                    ->line('A new lead has been submitted on your website.')
                    ->line('**Name:** ' . $this->lead->name)
                    ->line('**Email:** ' . $this->lead->email)
                    ->when($this->lead->phone, function ($mail) {
                        return $mail->line('**Phone:** ' . $this->lead->phone);
                    })
                    ->line('**Message:**')
                    ->line($this->lead->message)
                    ->when($this->lead->page, function ($mail) {
                        return $mail->line('**Page:** ' . $this->lead->page);
                    })
                    ->action('View Lead in Admin Panel', route('admin.leads.show', $this->lead))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'lead_id' => $this->lead->id,
            'lead_name' => $this->lead->name,
            'lead_email' => $this->lead->email,
        ];
    }
}
