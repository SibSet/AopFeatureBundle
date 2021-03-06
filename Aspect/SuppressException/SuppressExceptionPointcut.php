<?php

namespace SibSet\Bundle\AopFeatureBundle\Aspect\SuppressException;

use Doctrine\Common\Annotations\Reader;
use JMS\AopBundle\Aop\PointcutInterface;
use SibSet\Bundle\AopFeatureBundle\Annotation\SuppressException;

class SuppressExceptionPointcut implements PointcutInterface
{
    /**
     * @var Reader
     */
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function matchesClass(\ReflectionClass $class)
    {
        return true;
    }

    public function matchesMethod(\ReflectionMethod $method)
    {
        return null !== $this->reader->getMethodAnnotation($method, SuppressException::getClass());
    }
}
