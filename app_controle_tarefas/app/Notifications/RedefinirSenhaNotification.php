<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;
    public $token;
    public $email;
    public $name;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
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
    public function toMail($url): MailMessage
    {
        $url = 'http://localhost:8000/password/reset/' . $this->token . '?email=' . urlencode($this->email);
        $minutos = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        return (new MailMessage)
            ->greeting('Ola ' . $this->name . ',')
            ->subject('Atualização de Senha')
            ->line('Esqueceu a senha? Sem problema, vamos resolver isso!')
            ->action('Atualizar minha senha', $url)
            ->line('Este link expira em ' . $minutos . ' minutos.')
            ->salutation('Atenciosamente, equipe ' . config('app.name'))
            ->line('Caso não tenha solicitado uma alteração de senha, ignore este e-mail.');

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
