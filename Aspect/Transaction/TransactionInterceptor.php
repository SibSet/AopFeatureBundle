<?php

namespace SibSet\Bundle\AopFeatureBundle\Aspect\Transaction;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Doctrine\Bundle\DoctrineBundle\Registry;

class TransactionInterceptor implements MethodInterceptorInterface
{
    /**
     * @var Registry
     */
    private $doctrine;

    private $connection;

    public function __construct(Registry $doctrine, $connection = null)
    {
        $this->doctrine = $doctrine;
        $this->connection = $connection;
    }

    public function intercept(MethodInvocation $invocation)
    {
        /* @var \Doctrine\ORM\EntityManagerInterface $manager */
        $manager = $this->doctrine->getManager($this->connection);

        try {
            $manager->beginTransaction();

            $result =  $invocation->proceed();

            $manager->commit();

            return $result;
        } catch (\Exception $e) {

            $manager->rollback();

            throw $e;
        }

    }
}
