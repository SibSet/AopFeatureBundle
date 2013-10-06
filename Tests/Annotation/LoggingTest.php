<?php

namespace SibSet\Bundle\AopBundle\Tests\Annotation;

use SibSet\Bundle\AopBundle\Annotation\Logging;

class LoggingTest extends BaseAnnotationTest
{
    public function testClassMethod()
    {
        $this->assertEquals('SibSet\Bundle\AopBundle\Annotation\Logging', Logging::getClass());
    }

    public function testAnnotation()
    {
        $this->assertClassHasAnnotation('@Annotation', Logging::getClass());
    }
}
