<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EventReminderNotification extends Notification
{
    public function __construct(
        public Event $event,
        public int $daysBefore
    ) {}

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("⏰ Reminder: {$this->event->title} - {$this->daysBefore} Hari Lagi!")
            ->greeting("Halo, {$notifiable->name}!")
            ->line("Ini adalah pengingat bahwa event berikut akan berlangsung **{$this->daysBefore} hari lagi**:")
            ->line("**Event:** {$this->event->title}")
            ->line("**Waktu:** {$this->event->start_datetime->format('l, d F Y pukul H:i')} WIB")
            ->line("**Ruangan:** " . ($this->event->room->name ?? 'Tanpa ruangan'))
            ->action('Lihat Detail & RSVP', url('/events/' . $this->event->id))
            ->line('Jangan sampai ketinggalan! - SMKN 1 Purwokerto');
    }

    public function toDatabase($notifiable): array
    {
        return [
            'event_id'    => $this->event->id,
            'event_title' => $this->event->title,
            'days_before' => $this->daysBefore,
            'message'     => "Reminder: Event \"{$this->event->title}\" {$this->daysBefore} hari lagi!",
        ];
    }
}