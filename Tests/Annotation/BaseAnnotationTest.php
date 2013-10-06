<?php

namespace SibSet\Bundle\AopBundle\Tests\Annotation;

abstract class BaseAnnotationTest extends \PHPUnit_Framework_TestCase
{
    protected function assertClassHasAnnotation($annotation, $class)
    {
        $reflection = new \ReflectionClass($class);
        $doc = $reflection->getDocComment();

        $this->assertTrue(false !== strpos($doc, $annotation));
    }
}
