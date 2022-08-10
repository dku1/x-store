<?php

namespace App\Mail;

use App\Models\Position;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionMessage extends Mailable
{
    use Queueable, SerializesModels;

    public Position $position;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->view('mail.subscription');
    }
}
