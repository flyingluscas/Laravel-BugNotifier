<?php

namespace FlyingLuscas\BugNotifier;

use Mockery;
use MailThief\Testing\InteractsWithMail;

class MailDriverTest extends TestCase
{
    use InteractsWithMail;

    public function testSendNotificationEmail()
    {
        $driver = new Drivers\MailDriver;

        $title = 'Some dummy title';
        $body = 'Some dummy message';

        $message = Mockery::mock(Message::class, function ($mock) use ($title, $body) {
            $mock->shouldReceive('getTitle')->andReturn($title);
            $mock->shouldReceive('getBody')->andReturn($body);
        });

        $excpectedMailTo = config('bugnotifier.drivers.mail.to.address');

        $driver->handle($message);

        $this->seeMessageFor($excpectedMailTo);
        $this->seeMessageWithSubject($title);
        $this->assertTrue($this->lastMessage()->contains($body));
    }
}
