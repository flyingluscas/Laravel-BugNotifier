<?php

namespace FlyingLuscas\BugNotifier;

use FlyingLuscas\BugNotifier\Drivers\MailDriver;
use FlyingLuscas\BugNotifier\Drivers\DriverContract;
use FlyingLuscas\BugNotifier\Exceptions\InvalidDriverNameException;

class BugNotifier
{
    /**
     * Notification drivers.
     *
     * @var array
     */
    protected $drivers = [
        'mail' => MailDriver::class,
    ];

    /**
     * Fire a notification for the given exception.
     *
     * @param \Exception $e
     *
     * @return mixed
     */
    public function exception(\Exception $e)
    {
        if (! $this->shouldBeReported($e) || ! $this->shouldRunOnThisEnvironment()) {
            return;
        }

        $message = new Message($e);
        $driverClass = $this->getNotificationDriver();

        return $this->sendNotification($message, new $driver);
    }

    /**
     * Send notificaiton using the given driver.
     *
     * @param \FlyingLuscas\BugNotifier\Message                $message
     * @param \FlyingLuscas\BugNotifier\Drivers\DriverContract $driver
     *
     * @return mixed
     */
    private function sendNotification(Message $message, DriverContract $driver)
    {
        return $driver->handle($message);
    }

    /**
     * Get the notification driver that should be used.
     *
     * @return string
     */
    private function getNotificationDriver()
    {
        $use = config('bugnotifier.driver');

        if (! array_key_exists($use, $this->drivers)) {
            throw new InvalidDriverNameException(sprintf('Driver "%s" not supported.', $use));
        }

        return $this->drivers[$use];
    }

    /**
     * Check if the package should run on the current environment.
     *
     * @return bool
     */
    private function shouldRunOnThisEnvironment()
    {
        return in_array(app()->environment(), config('bugnotifier.environments'));
    }

    /**
     * Check if a given exception should be reported.
     *
     * @param \Exception $e
     *
     * @return bool
     */
    private function shouldBeReported(\Exception $e)
    {
        return ! in_array(get_class($e), config('bugnotifier.ignore', []));
    }
}
