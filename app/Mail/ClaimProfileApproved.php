<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClaimProfileApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public $new_password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $new_password)
    {
        $this->data = $data;
        $this->new_password = $new_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Profile Claim Approved")->view('emails.claim-profile-approved');
    }
}
