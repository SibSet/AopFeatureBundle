# AOP Features Bundle

[![Build Status](https://travis-ci.org/SibSet/AopFeatureBundle.png?branch=master)](https://travis-ci.org/SibSet/AopFeatureBundle)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/SibSet/AopFeatureBundle/badges/quality-score.png?s=3c6ec42a309837f9a3fb8a6225478b22e06e6676)](https://scrutinizer-ci.com/g/SibSet/AopFeatureBundle/)

Расширение Symfony Framework для аспектно-ориентированного программирования.
Добавляет возможность указвывать аспекты для методов, уменьшая количество сквозного кода в приложении.

## Аспекты

Расширение поставляет ряд готовых аспектов.

### Logging

Аспект для логирования вызова метода.

```php
<?php

use SibSet\Bundle\AopFeatureBundle\Annotation as Aspect;

/**
 * @Aspect\Logging("log.message.writer.user.create")
 */
public function createUser(User $user)
{
    // ...
}
```
В аннотации требуется указать идентификатор сервиса в контейнере зависмостей.
Сервис должен быть наследником класса `SibSet\Bundle\AopFeatureBundle\Aspect\Logging\AbstractWriter`

### Transaction

Ипользование транзакции для метода

```php
<?php

use SibSet\Bundle\AopFeatureBundle\Annotation as Aspect;

/**
 * @Aspect\Transactional
 */
public function createUser(User $user)
{
    $this->getManager()->persist($user);
    $this->getManager()->flush($user);
}
```

Вызов метода будет обернут в try...catch блок с вызовом commit() в try и rollback() в catch

### SuppressException

Подавление исключений в методе, полезно использовать в связке с Logging

```php
<?php

use SibSet\Bundle\AopFeatureBundle\Annotation as Aspect;

/**
 * @Aspect\SuppressException
 */
public function createUser(User $user)
{
    throw new \Exception("All is dust!");
}
```

Возможно указать конкретный тип перехватываемого исключения

    /**
     * @Aspect\SuppressException("\RuntimeException")
     */
    public function createUser(User $user)

## Установка

### Composer

Добавте зависимости в проектный файл composer.json

    "require": {
        # ..
        "sibset/aop-feature-bundle": ">=1.0.0"
        # ..
    }

### AppKernel.php

```php
<?php
public function registerBundles()
{
    $bundles = array(
        // ...
        new JMS\AopBundle\JMSAopBundle(),
        new SibSet\Bundle\SibSetAopBundle(),
    );

    // ...

    return $bundles;
}
```
