<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\Button;
use PHPUnit\Framework\TestCase;

class ButtonTest extends TestCase
{
    public function testButtonRendersCorrectly()
    {
        $button = Button::widget([
            'label' => 'Test Button',
            'type' => 'primary',
        ]);

        $this->assertStringContainsString('Test Button', $button);
        $this->assertStringContainsString('btn-primary', $button);
    }

    public function testButtonWithIcon()
    {
        $button = Button::widget([
            'label' => 'Export',
            'icon' => '📥',
            'iconPosition' => 'left',
        ]);

        $this->assertStringContainsString('Export', $button);
        $this->assertStringContainsString('📥', $button);
    }

    public function testButtonOutline()
    {
        $button = Button::widget([
            'label' => 'Outline Button',
            'type' => 'primary',
            'outline' => true,
        ]);

        $this->assertStringContainsString('btn-outline-primary', $button);
    }

    public function testButtonSizes()
    {
        $small = Button::widget([
            'label' => 'Small',
            'size' => 'sm',
        ]);

        $large = Button::widget([
            'label' => 'Large',
            'size' => 'lg',
        ]);

        $this->assertStringContainsString('btn-sm', $small);
        $this->assertStringContainsString('btn-lg', $large);
    }
}
