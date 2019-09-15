<?php

use App\Model\Form;
use PHPUnit\Framework\TestCase;

class FormTest extends TestCase
{
    public function testBeginStep()
    {
        $context = new Form(null, null, null, null, null);
        $this->assertTrue($context->isBeginStep());
        $this->assertFalse($context->isAgeStep());
        $this->assertFalse($context->isColorStep());
        $this->assertFalse($context->isSwimStep());
    }

    public function testAgeStep()
    {
        $context = new Form('Foo', 1, null, null, null);
        $this->assertFalse($context->isBeginStep());
        $this->assertTrue($context->isAgeStep());
        $this->assertFalse($context->isColorStep());
        $this->assertFalse($context->isSwimStep());
    }

    public function testColorStep()
    {
        $context = new Form('Foo', 2, null, null, null);
        $this->assertFalse($context->isBeginStep());
        $this->assertFalse($context->isAgeStep());
        $this->assertTrue($context->isColorStep());
        $this->assertFalse($context->isSwimStep());
    }

    public function testSwimStepWithMen()
    {
        $context = new Form('Foo', 2, 20, null, null);
        $this->assertFalse($context->isBeginStep());
        $this->assertFalse($context->isAgeStep());
        $this->assertTrue($context->isSwimStep());
        $this->assertFalse($context->isColorStep());
    }

    public function testSwimStepWithWomen()
    {
        $context = new Form('Foo', 2, null, 'red', null);
        $this->assertFalse($context->isBeginStep());
        $this->assertFalse($context->isAgeStep());
        $this->assertTrue($context->isSwimStep());
        $this->assertFalse($context->isColorStep());
    }
}
