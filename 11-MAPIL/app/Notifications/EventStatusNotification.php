<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EventStatusNotification extends Notification
{
    public function __construct(
        public Event $event,
        public string $status
    ) {}

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $statusText = match($this->status) {
            'approved'      => '✅ DISETUJUI',
            'approved_guru' => '✅ DISETUJUI GURU PEMBINA (menunggu admin)',
            'rejected'      => '❌ DITOLAK',
            default         => 'DIPERBARUI',
        };

        $mail = (new MailMessage)
            ->subject("Event Kamu [{$statusText}] - {$this->event->title}")
            ->greeting("Halo, {$notifiable->name}!")
            ->line("Status pengajuan event kamu telah diperbarui menjadi: **{$statusText}**")
            ->line("**Event:** {$this->event->title}")
            ->line("**Waktu:** {$this->event->start_datetime->format('d M Y, H:i')} WIB")
            ->line("**Ruangan:** " . ($this->event->room->name ?? 'Tanpa ruangan'))
            ->action('Lihat Detail Event', url('/events/' . $this->event->id));

        if ($this->status === 'rejected' && $this->event->rejection_reason) {
            $mail->line("**Alasan Penolakan:** {$this->event->rejection_reason}");
        }

        return $mail->line('Terima kasih, SMKN 1 Purwokerto');
    }

    public function toDatabase($notifiable): array
    {
        return [
            'event_id'   => $this->event->id,
            'event_title'=> $this->event->title,
            'status'     => $this->status,
            'message'    => "Event \"{$this->event->title}\" berstatus: {$this->status}",
        ];
    }
}