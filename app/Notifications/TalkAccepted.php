<?php

namespace App\Notifications;

use App\Models\Talk;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TalkAccepted extends Notification implements ShouldQueue
{
    use Queueable;

    public Talk $talk;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Talk $talk)
    {
        $this->talk = $talk;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Podstock Einreichung akzeptiert')
                    ->greeting('Hallo '. $this->talk->user?->name)
                    ->line('deine Podstock Einreichung "'.$this->talk->name.'" wurde akzeptiert')
                    ->action('Du kannst diese nun bestätigen', url('/talks/my'))
                    ->line('Falls du noch Fragen hast oder der Termin doch nicht passt, antworte einfach auf diese E-Mail.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
