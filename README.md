# AOP Features Bundle

[![Build Status](https://travis-ci.org/SibSet/AopFeaturesBundle.png?branch=master)](https://travis-ci.org/SibSet/AopFeaturesBundle)

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
        "sibset/aop-bundle": ">=1.0.0"
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
