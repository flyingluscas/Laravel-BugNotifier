<?php

namespace FlyingLuscas\BugNotifier;

class MessageTest extends TestCase
{
    /**
     * @dataProvider dataExceptionProvider
     */
    public function testMessageTitleOutput($e)
    {
        $message = new Message(new $e);
        $expectedTitle = sprintf('%s in %s line %d', class_basename($e), basename(__FILE__), (__LINE__ - 1));

        $this->assertEquals($expectedTitle, $message->getTitle());
    }

    /**
     * @dataProvider dataExceptionProvider
     */
    public function testMessageBodyOutput($e)
    {
        $description = 'Some dummy message';

        $thrown = new $e($description);
        $message = new Message($thrown);
        $expectedBody = sprintf("%s in %s line %d\n\n%s\n\n%s", $e, __FILE__, (__LINE__ - 2), $description, $thrown->getTraceAsString());

        $this->assertEquals($expectedBody, $message->getBody());
    }

    public function dataExceptionProvider()
    {
        return [
            [\Exception::class],
            [\InvalidArgumentException::class],
            [\RuntimeException::class],
            [DummyException::class],
        ];
    }
}
