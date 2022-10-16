<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingNotification extends Notification
{
    use Queueable;

    public $meeting;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($meeting)
    {
        $this->meeting = $meeting;
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
        $message1 = "Reunión programada para el {$this->meeting->date->format('d/m/Y')} a las {$this->meeting->time} horas, en {$this->meeting->place}.";
        $message2 = "Partes:";
        $message3 = "Abogado: {$this->meeting->abogado->name}";
        $message4 = "Arrendador: " . $this->meeting->parts[0]->arrendador->name;
        $message5 = "Arrendatario: " . $this->meeting->parts[1]->arrendatario->name;
        $message6 = isset($this->meeting->parts[2]) ? "O. Solidario: " . $this->meeting->parts[2]->solidario->name : '';
        $message7 = isset($this->meeting->parts[3]) ? "Fiador: " . $this->meeting->parts[3]->fiador->name : '';

        return (new MailMessage)
                    ->line($message1)
                    ->line('')
                    ->line($message2)
                    ->line('')
                    ->line($message3)
                    ->line('')
                    ->line($message4)
                    ->line('')
                    ->line($message5)
                    ->line('')
                    ->line($message6)
                    ->line('')
                    ->line($message7)
                    ->line('')
                    // ->action('Notification Action', url('/'))
                    ->line("Esperamos contar con su participación");
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
