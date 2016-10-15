<?php

namespace FlyingLuscas\BugNotifier\Drivers;

use Illuminate\Support\Facades\Mail;
use FlyingLuscas\BugNotifier\Message;

class MailDriver extends Driver implements DriverInterface
{
    /**
     * Send e-mail message.
     *
     * @param \FlyingLuscas\BugNotifier\Message $message
     *
     * @return void
     */
    public function handle(Message $message)
    {
        $view = $this->config('view');
        $address = $this->config('to.address');
        $subject = $message->getTitle();
        $body = $message->getBody();

        Mail::send($view, [
            'body' => $body,
            'subject' => $subject,
        ], function ($mail) use ($subject, $address) {
            $mail->subject($subject)->to($address);
        });
    }
}
