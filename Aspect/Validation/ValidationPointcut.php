<?php

namespace SibSet\Bundle\AopFeatureBundle\Aspect\Validation;

use Doctrine\Common\Annotations\Reader;
use JMS\AopBundle\Aop\PointcutInterface;
use SibSet\Bundle\AopFeatureBundle\Annotation\Validation;

class ValidationPointcut implements PointcutInterface
{
    /**
     * @var Reader
     */
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @inheritdoc
     */
    public function matchesClass(\ReflectionClass $class)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function matchesMethod(\ReflectionMethod $method)
    {
        return null !== $this->reader->getMethodAnnotation($method, Validation::getClass());
    }
}
