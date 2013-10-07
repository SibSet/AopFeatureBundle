<?php

namespace SibSet\Bundle\AopFeatureBundle\Aspect\Validation;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Symfony\Component\Validator\ValidatorInterface;

class ValidationInterceptor implements MethodInterceptorInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @inheritdoc
     */
    public function intercept(MethodInvocation $invocation)
    {
        foreach ($invocation->arguments as $argument) {
            $violations = $this->validator->validate($argument);

            if ($violations->count() > 0) {
                throw new ConstraintViolationException($violations, 'Validation failed');
            }
        }

        return $invocation->proceed();
    }
}
