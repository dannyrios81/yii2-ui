<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\Alert;
use PHPUnit\Framework\TestCase;

class AlertTest extends TestCase
{
    public function testBasicRendering()
    {
        $html = Alert::widget([
            'message' => 'This is an alert',
            'type' => 'success',
        ]);

        $this->assertStringContainsString('This is an alert', $html);
        $this->assertStringContainsString('alert-success', $html);
    }

    public function testWithTitle()
    {
        $html = Alert::widget([
            'title' => 'Warning!',
            'message' => 'Something happened',
            'type' => 'warning',
        ]);

        $this->assertStringContainsString('Warning!', $html);
        $this->assertStringContainsString('alert-warning', $html);
    }

    public function testDismissible()
    {
        $html = Alert::widget([
            'message' => 'Closeable',
            'dismissible' => true,
        ]);

        $this->assertStringContainsString('alert-dismissible', $html);
        $this->assertStringContainsString('btn-close', $html);
    }

    public function testNotDismissible()
    {
        $html = Alert::widget([
            'message' => 'Persistent',
            'dismissible' => false,
        ]);

        $this->assertStringNotContainsString('alert-dismissible', $html);
        $this->assertStringNotContainsString('btn-close', $html);
    }

    public function testWithIcon()
    {
        $html = Alert::widget([
            'message' => 'Info message',
            'icon' => '⚠️',
        ]);

        $this->assertStringContainsString('⚠️', $html);
    }

    public function testAllTypes()
    {
        foreach (['info', 'success', 'warning', 'danger', 'primary', 'secondary'] as $type) {
            $html = Alert::widget([
                'message' => 'Test',
                'type' => $type,
            ]);
            $this->assertStringContainsString('alert-' . $type, $html);
        }
    }
}
