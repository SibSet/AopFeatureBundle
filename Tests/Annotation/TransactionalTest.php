<?php

namespace SibSet\Bundle\AopFeatureBundle\Tests\Annotation;

use SibSet\Bundle\AopFeatureBundle\Annotation\Transactional;

class TransactionalTest extends BaseAnnotationTest
{
    public function testClassMethod()
    {
        $this->assertEquals('SibSet\Bundle\AopFeatureBundle\Annotation\Transactional', Transactional::getClass());
    }

    public function testAnnotation()
    {
        $this->assertClassHasAnnotation('@Annotation', Transactional::getClass());
    }
}
