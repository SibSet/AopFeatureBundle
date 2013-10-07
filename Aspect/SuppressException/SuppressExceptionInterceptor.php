<?php

namespace SibSet\Bundle\AopFeatureBundle\Aspect\SuppressException;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\Reader;
use SibSet\Bundle\AopFeatureBundle\Annotation\SuppressException;

class SuppressExceptionInterceptor implements MethodInterceptorInterface
{
    /**
     * @var Reader
     */
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function intercept(MethodInvocation $invocation)
    {
        try {
            $invocation->proceed();
        } catch (\Exception $e) {
            /* @var SuppressException $annotation */
            $annotation = $this->reader->getMethodAnnotation($invocation->reflection, SuppressException::getClass());
            $class = $annotation->value;

            if ($class && !($e instanceof $class)) {
                throw $e;
            }
        }
    }
}
