<?php

namespace SibSet\Bundle\AopFeatureBundle\Aspect\Logging;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Doctrine\Common\Annotations\Reader;
use Psr\Log\LoggerInterface;
use SibSet\Bundle\AopFeatureBundle\Annotation\Logging;
use SibSet\Bundle\AopFeatureBundle\Exception\AnnotationException;
use SibSet\Bundle\AopFeatureBundle\Exception\AopFeatureException;
use Symfony\Component\DependencyInjection\ContainerAware;

class LoggingInterceptor extends ContainerAware implements MethodInterceptorInterface
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(Reader $reader, LoggerInterface $logger)
    {
        $this->reader = $reader;
        $this->logger = $logger;
    }

    public function intercept(MethodInvocation $invocation)
    {
        /* @var Logging $annotation */
        $annotation = $this->reader->getMethodAnnotation($invocation->reflection, Logging::getClass());

        if (!$annotation->value) {
            throw new AnnotationException('Not define writer service id in Logging annotation');
        }

        /* @var AbstractWriter $writer */
        $writer = $this->container->get($annotation->value);

        if (!($writer instanceof AbstractWriter)) {
            throw new AopFeatureException('Writer should be the implementation of AbstractWriter');
        }

        try {
            $writer->before($this->logger, $invocation->arguments);

            $result = $invocation->proceed();

            $writer->after($this->logger, $invocation->arguments);

            return $result;
        } catch (\Exception $e) {
            $writer->error($this->logger, $e, $invocation->arguments);

            throw $e;
        }

    }
}
