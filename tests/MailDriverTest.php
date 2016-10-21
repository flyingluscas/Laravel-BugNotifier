<?php

namespace FlyingLuscas\BugNotifier;

use Mockery;
use MailThief\Testing\InteractsWithMail;
use FlyingLuscas\BugNotifier\Drivers\MailDriver;

class MailDriverTest extends TestCase
{
    use InteractsWithMail;

    /**
     * @test
     */
    public function it_can_send_email_to_multiple_addresses()
    {
        $driver = $this->getDriver();

        $title = 'Some dummy title';
        $body = 'Some dummy message';

        $message = $this->getMessage($title, $body);

        $addresses = config('bugnotifier.mail.to');

        $driver->handle($message);

        foreach ($addresses as $address) {
            $this->seeMessageFor($address);
        }

        $this->seeMessageWithSubject($title);
        $this->assertTrue($this->lastMessage()->contains($body));
    }

    /**
     * @test
     */
    public function it_can_send_email_to_one_address()
    {
        $driver = $this->getDriver();

        $title = 'Some dummy title';
        $body = 'Some dummy message';

        $message = $this->getMessage($title, $body);

        config([
            'bugnotifier.mail.to.address' => 'dummy@example.com',
        ]);

        $address = config('bugnotifier.mail.to.address');

        $driver->handle($message);

        $this->seeMessageFor($address);
        $this->seeMessageWithSubject($title);
        $this->assertTrue($this->lastMessage()->contains($body));
    }

    /**
     * Get message mock.
     *
     * @param  string $title
     * @param  string $body
     *
     * @return \FlyingLuscas\BugNotifier\Message
     */
    private function getMessage($title, $body)
    {
        return Mockery::mock(Message::class, function ($mock) use ($title, $body) {
            $mock->shouldReceive('getTitle')->andReturn($title);
            $mock->shouldReceive('getBody')->andReturn($body);
        });
    }

    /**
     * Get driver instance.
     *
     * @return \FlyingLuscas\BugNotifier\Drivers\MailDriver
     */
    private function getDriver()
    {
        return new MailDriver;
    }
}
