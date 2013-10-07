<?php

namespace SibSet\Bundle\AopFeatureBundle\Aspect\Logging;

use Psr\Log\LoggerInterface;

abstract class AbstractWriter
{
    abstract public function before(LoggerInterface $logger, array $arguments = array());

    abstract public function after(LoggerInterface $logger, array $arguments = array());

    abstract public function error(LoggerInterface $logger, \Exception $exception, array $arguments = array());
}
