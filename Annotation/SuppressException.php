<?php

namespace SibSet\Bundle\AopBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 */
class SuppressException
{
    public $value;

    public static function getClass()
    {
        return __CLASS__;
    }
}
