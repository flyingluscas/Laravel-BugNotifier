<?php

namespace FlyingLuscas\BugNotifier;

use FlyingLuscas\BugNotifier\Drivers\DriverInterface;
use FlyingLuscas\BugNotifier\Exceptions\InvalidDriverNameException;

class BugNotifier
{
    /**
     * Fire a notification for the given exception using the configured driver.
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

        return $this->sendNotification($message, new $driverClass);
    }

    /**
     * Send notification using the given driver.
     *
     * @param \FlyingLuscas\BugNotifier\Message                $message
     * @param \FlyingLuscas\BugNotifier\Drivers\DriverInterface $driver
     *
     * @return mixed
     */
    private function sendNotification(Message $message, DriverInterface $driver)
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
        $driver = config(sprintf('bugnotifier.%s.driver', $use));

        if (! $driver) {
            throw new InvalidDriverNameException(sprintf('Driver "%s" not supported.', $use));
        }

        return $driver;
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
