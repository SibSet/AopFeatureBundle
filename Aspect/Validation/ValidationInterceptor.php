<?php

namespace SibSet\Bundle\AopFeatureBundle\Aspect\Validation;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Doctrine\Common\Annotations\Reader;
use SibSet\Bundle\AopFeatureBundle\Annotation\Validation;
use Symfony\Component\Validator\ValidatorInterface;

class ValidationInterceptor implements MethodInterceptorInterface
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(Reader $reader, ValidatorInterface $validator)
    {
        $this->reader = $reader;
        $this->validator = $validator;
    }

    /**
     * @inheritdoc
     */
    public function intercept(MethodInvocation $invocation)
    {
        /* @var Validation $annotation */
        $annotation = $this->reader->getMethodAnnotation($invocation->reflection, Validation::getClass());

        $groups = $annotation->groups && !is_array($annotation->groups)
            ? array($annotation->groups)
            : $annotation->groups;

        foreach ($invocation->arguments as $argument) {
            $violations = $this->validator->validate($argument, $groups);

            if ($violations->count() > 0) {
                throw new ConstraintViolationException($violations, 'Validation failed');
            }
        }

        return $invocation->proceed();
    }
}
