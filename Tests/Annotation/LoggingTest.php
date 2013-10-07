<?php

namespace SibSet\Bundle\AopFeatureBundle\Tests\Annotation;

use SibSet\Bundle\AopFeatureBundle\Annotation\Logging;

class LoggingTest extends BaseAnnotationTest
{
    public function testClassMethod()
    {
        $this->assertEquals('SibSet\Bundle\AopFeatureBundle\Annotation\Logging', Logging::getClass());
    }

    public function testAnnotation()
    {
        $this->assertClassHasAnnotation('@Annotation', Logging::getClass());
    }
}
