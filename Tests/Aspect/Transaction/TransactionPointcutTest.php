<?php

namespace SibSet\Bundle\AopFeatureBundle\Tests\Aspect\Annotation;

use Doctrine\Common\Annotations\AnnotationReader;
use SibSet\Bundle\AopFeatureBundle\Aspect\Transaction\TransactionPointcut;

class TransactionPointcutTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AnnotationReader
     */
    public $reader;

    /**
     * @var TransactionPointcut
     */
    public $pointcut;

    protected function setUp()
    {
        $this->reader = new AnnotationReader();
        $this->pointcut = new TransactionPointcut($this->reader);
    }

    public function testMatchesClass()
    {
        $reflection = new \ReflectionClass('\stdClass');

        $matches = $this->pointcut->matchesClass($reflection);

        $this->assertTrue($matches);
    }
}
