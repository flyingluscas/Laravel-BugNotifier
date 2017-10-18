<?php

namespace FlyingLuscas\BugNotifier\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BugMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $view;
    public $subject;
    public $body;

    /**
     * Create a new message instance.
     *
     * @param Illuminate\View\View $view
     * @param string $subject
     * @param string $body
     *
     * @return void
     */
    public function __construct($view, $subject, $body)
    {
        $this->view = $view;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)
            ->subject($this->subject);
    }
}