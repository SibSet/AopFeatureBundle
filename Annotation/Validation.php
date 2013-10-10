<?php

namespace SibSet\Bundle\AopFeatureBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 */
class Validation
{
    public $groups;

    public static function getClass()
    {
        return __CLASS__;
    }
}
