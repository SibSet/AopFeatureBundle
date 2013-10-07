<?php

namespace SibSet\Bundle\AopFeatureBundle\Aspect\Validation;

use SibSet\Bundle\AopFeatureBundle\Exception\AopFeatureException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ConstraintViolationException extends AopFeatureException
{
    private $violations;

    /**
     * @return ConstraintViolationListInterface
     */
    public function getConstraintViolations()
    {
        return $this->violations;
    }

    public function __construct(ConstraintViolationListInterface $violations, $message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->violations = $violations;
    }
}
