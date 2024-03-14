<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        ->subject('Redefinição de password')
        ->greeting('Ola,')
        ->line('Altere a sua password clicando neste botão.')
        ->action('Redefinir Senha', route('password.reset', $this->token))
        ->line('Se não solicitou uma redefinição de password, ignore este email.')
        ->salutation("Cumprimentos");
    }


     /**
     * Get the salutation for the notification.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    public function salutation($notifiable)
    {
        return 'Cumprimentos';
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
