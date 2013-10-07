<?php

namespace SibSet\Bundle\AopFeatureBundle\Tests\Annotation;

use SibSet\Bundle\AopFeatureBundle\Annotation\SuppressException;

class SuppressExceptionTest extends BaseAnnotationTest
{
    public function testClassMethod()
    {
        $this->assertEquals('SibSet\Bundle\AopFeatureBundle\Annotation\SuppressException', SuppressException::getClass());
    }

    public function testAnnotation()
    {
        $this->assertClassHasAnnotation('@Annotation', SuppressException::getClass());
    }
}
