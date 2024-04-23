<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('no-reply@techyourtalentamsterdam.nl')
            ->subject('Wachtwoord verandering')
            ->line('U krijgt deze mail omdat er een account aangemaakt is met dit mail adress of iemand heeft een account gemaakt met dit mail adress.')
            ->action('Reset wachtwoord', route('filament.password.reset', ['token' => $this->token]))
            ->line('Als u geen wijziging aangevraagd heeft is geen actie nodig.')
            ->line('Als iemand een account voor u aangemaakt heeft krijgt deze mail ook vanwegen AVG wetgeving.');
    }
}
