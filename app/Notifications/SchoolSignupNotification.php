<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

use App\SchoolSignup;

class SchoolSignupNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(SchoolSignup $signup)
    {
        $this->signup = $signup;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSlack($notifiable)
    {
        $signup = $this->signup;
        return (new SlackMessage)
                ->from('Exclamo')
                ->content('Eine Schule hat Interesse gezeigt:')
                ->attachment(function ($attachment) use ($signup) {
                    $attachment->title('Schule ' . $signup->school)
                               ->fields([
                                    'Name der Schule' => $signup->school,
                                    'E-Mail' => $signup->email,
                                    'Ansprechpartner' => $signup->contact_person,
                                ]);
                });
    }
}
