<?php

namespace FlyingLuscas\BugNotifier\Drivers;

use FlyingLuscas\BugNotifier\Mail\BugMail;
use FlyingLuscas\BugNotifier\Message;
use Illuminate\Support\Facades\Mail;

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

        Mail::to($addresses)
            ->queue(new BugMail($view, $subject, $body));
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
