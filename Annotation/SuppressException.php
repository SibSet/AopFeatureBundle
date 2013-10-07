<?php

namespace SibSet\Bundle\AopFeatureBundle\Annotation;

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
