<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\Order;

class OrderConfirmationMail extends Mailable
{
    use Queueable;

    public $order;
    public $orderItems;
    public $subtotal;
    public $shipping;
    public $total;

    public function __construct(Order $order, $orderItems, $subtotal, $shipping, $total)
    {
        $this->order = $order;
        $this->orderItems = $orderItems;
        $this->subtotal = $subtotal;
        $this->shipping = $shipping;
        $this->total = $total;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation #' . $this->order->order_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-confirmation',
            with: [
                'order' => $this->order,
                'items' => $this->orderItems,
                'subtotal' => $this->subtotal,
                'shipping' => $this->shipping,
                'total' => $this->total
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}