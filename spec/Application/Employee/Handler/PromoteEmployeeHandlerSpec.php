<?php

namespace spec\Al\Application\Employee\Handler;

use Al\Application\Employee\Handler\PromoteEmployeeHandler;
use Al\Application\Employee\Command\PromoteEmployee;
use Al\Component\Employee\Employee;
use Al\Component\Employee\EmployeeInterface;
use Al\Component\Employee\EmployeeRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class PromoteEmployeeHandlerSpec extends ObjectBehavior
{
    function let(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->beConstructedWith($employeeRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PromoteEmployeeHandler::class);
    }

    function it_handles_a_fire_employee_command($employeeRepository, EmployeeInterface $employee)
    {
        $command = new PromoteEmployee('03a368d5-85b2-46cf-a860-ab22101827d8');
        $command->setPosition('position');
        $command->setSalaryScale(1);

        $employeeRepository->get(Argument::type(Uuid::class))->willReturn($employee);
        $employee->promote('position', 1)->shouldBeCalled();
        $employeeRepository->add($employee)->shouldBeCalled();

        $this->handle($command)->shouldReturn(null);
    }
}
