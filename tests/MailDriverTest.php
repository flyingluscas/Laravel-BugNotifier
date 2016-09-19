<?php

namespace FlyingLuscas\BugNotifier;

use MailThief\Testing\InteractsWithMail;

class MailDriverTest extends TestCase
{
    use InteractsWithMail;

    public function testHandle()
    {
        $dummyMessage = 'Some dummy message';

        $driver = new Drivers\MailDriver;
        $message = new Message(new DummyException($dummyMessage));

        $excpectedMailTo = config('bugnotifier.drivers.mail.to.address');
        $excpectedMailSubject = sprintf('DummyException in %s line %d', basename(__FILE__), (__LINE__ - 3));

        $driver->handle($message);

        $this->seeMessageFor($excpectedMailTo);
        $this->seeMessageWithSubject($excpectedMailSubject);
        $this->assertTrue($this->lastMessage()->contains($dummyMessage));
    }
}
