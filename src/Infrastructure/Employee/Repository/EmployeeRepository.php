<?php
declare(strict_types=1);

/*
 * This file is part of the AL labs package
 *
 * (c) Arnaud Langlade
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\Infrastructure\Employee\Repository;

use Al\Component\Employee\Employee;
use Al\Component\Employee\Exception\NotExistingEmployee;
use Doctrine\ORM\EntityManager;
use Al\Component\Employee\EmployeeInterface;
use Al\Component\Employee\EmployeeRepositoryInterface;
use Ramsey\Uuid\Uuid;

final class EmployeeRepository implements EmployeeRepositoryInterface
{
    /** @var EntityManager */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function get(Uuid $identifier)
    {
        if (null === $employee = $this->entityManager->find(Employee::class, (string) $identifier->toString())) {
            throw new NotExistingEmployee((string) $identifier->toString());
        }

        return $employee;
    }

    /**
     * {@inheritdoc}
     */
    public function add(EmployeeInterface $employee)
    {
        $this->entityManager->persist($employee);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function remove(EmployeeInterface $employee)
    {
        $this->entityManager->remove($employee);
        $this->entityManager->flush();
    }
}
