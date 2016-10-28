<?php

namespace FlyingLuscas\BugNotifier;

class Message
{
    /**
     * The title of the message.
     *
     * @var string
     */
    protected $title;

    /**
     * The body of the message.
     *
     * @var string
     */
    protected $body;

    /**
     * Create a new class instance.
     *
     * @param \Exception $e
     */
    public function __construct(\Exception $e)
    {
        $this->setTitle($e)->setBody($e);
    }

    /**
     * Set the title of the message.
     *
     * @param \Exception $e
     *
     * @return self
     */
    private function setTitle(\Exception $e)
    {
        $classname = class_basename(get_class($e));
        $filename = basename($e->getFile());
        $line = $e->getLine();

        $this->title = sprintf('%s in %s line %d', $classname, $filename, $line);

        return $this;
    }

    /**
     * Set the body of the message.
     *
     * @param \Exception $e
     *
     * @return self
     */
    private function setBody(\Exception $e)
    {
        $classname = get_class($e);
        $filename = $e->getFile();
        $line = $e->getLine();
        $message = $e->getMessage();
        $trace = $e->getTraceAsString();
        $at = new \DateTime(null, new \DateTimeZone( \Config::get('app.timezone') ));

        $this->body = sprintf("[%s] %s in %s line %d\n\n%s\n\n%s", $at->format( 'Y-m-d H:i:s' ), $classname, $filename, $line, $message, $trace);

        return $this;
    }

    /**
     * Get the body of the message.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Get the title of the message.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
