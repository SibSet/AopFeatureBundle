<?php

namespace SibSet\Bundle\AopBundle\Tests\Annotation;

use SibSet\Bundle\AopBundle\Annotation\SuppressException;

class SuppressExceptionTest extends BaseAnnotationTest
{
    public function testClassMethod()
    {
        $this->assertEquals('SibSet\Bundle\AopBundle\Annotation\SuppressException', SuppressException::getClass());
    }

    public function testAnnotation()
    {
        $this->assertClassHasAnnotation('@Annotation', SuppressException::getClass());
    }
}
