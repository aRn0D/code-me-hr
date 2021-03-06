<?php

namespace spec\Al\ResourceManagement\Infrastructure\UserInterface\Web;

use Al\ResourceManagement\Infrastructure\UserInterface\Web\EmployeeType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Test\FormBuilderInterface;

class EmployeeTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EmployeeType::class);
    }

    function it_is_a_form_type()
    {
        $this->shouldHaveType(AbstractType::class);
    }

    function it_build_a_form(FormBuilderInterface $builder)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, Argument::any())->shouldBeCalled();

        $this->buildForm($builder, [])->shouldReturn(null);
    }
}
