<?php

namespace FlyingLuscas\BugNotifier\Drivers;

use Illuminate\Support\Facades\Mail;
use FlyingLuscas\BugNotifier\Message;

class MailDriver implements DriverInterface
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
        $view = $this->getMailViewLink();
        $name = $this->getMailDestinationName();
        $address = $this->getMailDestinationAddress();
        $subject = $message->getTitle();
        $body = $message->getBody();

        Mail::send($view, [
            'body' => $body,
            'subject' => $subject,
        ], function ($mail) use ($subject, $address, $name) {
            $mail->subject($subject)->to($address, $name);
        });
    }

    /**
     * Get e-mail destination name.
     *
     * @return string
     */
    protected function getMailDestinationName()
    {
        return config('bugnotifier.drivers.mail.to.name');
    }

    /**
     * Get e-mail destination address.
     *
     * @return string
     */
    protected function getMailDestinationAddress()
    {
        return config('bugnotifier.drivers.mail.to.address');
    }

    /**
     * Get the view link for the e-mail message.
     *
     * @return string
     */
    protected function getMailViewLink()
    {
        return config('bugnotifier.drivers.mail.view');
    }
}
