<?php

namespace App\Mail;

use App\Model\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $invite;

    public function __construct(Invite $invite)
    {
        //
        $this->invite = $invite;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){

        return $this->markdown('emails.invite')->subject($this->invite->user->name . ' Invited you to join Bill Splitting');

    }
}
