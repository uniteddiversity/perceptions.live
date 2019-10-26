<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    private $target_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $target_data)
    {
        $this->data = $data;
        $this->target_data = $target_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $target_data = $this->target_data;
        return $this->view('emails.comment-update')->with(compact('target_data','data'));
    }
}
