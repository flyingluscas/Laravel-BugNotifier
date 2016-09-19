<?php

namespace FlyingLuscas\BugNotifier\Drivers;

use Illuminate\Support\Facades\Mail;
use FlyingLuscas\BugNotifier\Message;

class MailDriver implements DriverContract
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
        $view = $this->getEmailView();

        $name = $this->getMailDestinationName();
        $address = $this->getMailDestinationAddress();
        $subject = $message->getTitle();

        Mail::send($view, [
            'mail' => $message,
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
    protected function getEmailView()
    {
        return config('bugnotifier.drivers.mail.view');
    }
}
