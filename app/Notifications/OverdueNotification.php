<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OverdueNotification extends Notification
{
    use Queueable;

    protected $borrow;

    /**
     * Create a new notification instance.
     */
    public function __construct($borrow)
    {
        $this->borrow = $borrow;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function messages(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Overdue Book Notice')
            ->line('The book "' . $this->borrow->book->title . '" was due on ' . $this->borrow->due_date . '.')
            ->line('Please return it as soon as possible to avoid further fines.')
            ->action('View My Borrows', url('/dashboard'))
            ->line('Thank you for using our library service!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'borrow_id' => $this->borrow->id,
            'book_title' => $this->borrow->book->title,
            'due_date' => $this->borrow->due_date,
            'message' => 'Book "' . $this->borrow->book->title . '" is overdue.',
        ];
    }
}
