<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Order $order)
    {

    }

    /**
     * Get the message envelope.
     * От кого отправлено сообщение и почта для ответа
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Create Order',
        );
    }

    /**
     * Get the message content definition.
     * определение используемого шаблона blade
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.createOrderEmail',
        );
    }

    /**
     * Get the attachments for the message.
     * Добавление вложений к письму
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
