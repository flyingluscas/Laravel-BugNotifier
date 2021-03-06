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
        $addresses = $this->getEmailAddresses();
        $subject = $message->getTitle();
        $body = $message->getBody();

        Mail::queue($view, [
            'body' => $body,
            'subject' => $subject,
        ], function ($mail) use ($subject, $addresses) {
            $mail->subject($subject)->to($addresses);
        });
    }

    /**
     * Get e-mail address list.
     *
     * @return array
     */
    private function getEmailAddresses()
    {
        $address = $this->config('to.address');

        if ($address) {
            return [$address];
        }

        return $this->config('to');
    }
}
