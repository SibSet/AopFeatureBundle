<?php

namespace SibSet\Bundle\AopBundle\Tests\Annotation;

use SibSet\Bundle\AopBundle\Annotation\Transactional;

class TransactionalTest extends BaseAnnotationTest
{
    public function testClassMethod()
    {
        $this->assertEquals('SibSet\Bundle\AopBundle\Annotation\Transactional', Transactional::getClass());
    }

    public function testAnnotation()
    {
        $this->assertClassHasAnnotation('@Annotation', Transactional::getClass());
    }
}
