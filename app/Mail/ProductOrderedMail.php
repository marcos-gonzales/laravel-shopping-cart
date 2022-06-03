<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductOrderedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($data)
    {
        $this->user = auth()->user();
        $this->order = $data;
    }

    public function build()
    {
        $address = 'marcos@shopsrus.com';
        $subject = 'Thanks for your order' . $this->user['name'];
        $name = $this->user['name'];

        return $this->view('emails.product-ordered')
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with([ 'user' => $this->user, 'order' => $this->order ]);
    }
}
