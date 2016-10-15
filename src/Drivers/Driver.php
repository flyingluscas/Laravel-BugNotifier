<?php

namespace FlyingLuscas\BugNotifier\Drivers;

use FlyingLuscas\BugNotifier\Exceptions\DriverConfigPathNotFoundException;

abstract class Driver
{
    /**
     * Get the driver configurations.
     *
     * @param  string $name
     *
     * @return mixed
     */
    protected function config($name = null)
    {
        if (is_null($name)) {
            return config($this->getConfigPath());
        }

        return config(sprintf('%s.%s', $this->getConfigPath(), $name));
    }

    /**
     * Get the driver configuration path.
     *
     * @return string|null
     */
    private function getConfigPath()
    {
        $classname = class_basename(get_called_class());
        $config = strtolower(preg_replace('/driver$/i', null, $classname));
        $path = sprintf('bugnotifier.%s', $config);

        if (config($path, false) === false) {
            throw new DriverConfigPathNotFoundException;
        }

        return $path;
    }
}
