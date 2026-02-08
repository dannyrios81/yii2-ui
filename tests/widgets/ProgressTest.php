<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\feedback\Progress;
use PHPUnit\Framework\TestCase;

class ProgressTest extends TestCase
{
    public function testBasicRendering()
    {
        $html = Progress::widget([
            'value' => 75,
        ]);

        $this->assertStringContainsString('progress', $html);
        $this->assertStringContainsString('progress-bar', $html);
        $this->assertStringContainsString('75%', $html);
    }

    public function testStriped()
    {
        $html = Progress::widget([
            'value' => 50,
            'striped' => true,
        ]);

        $this->assertStringContainsString('progress-bar-striped', $html);
    }

    public function testAnimated()
    {
        $html = Progress::widget([
            'value' => 50,
            'animated' => true,
        ]);

        $this->assertStringContainsString('progress-bar-animated', $html);
    }

    public function testColorType()
    {
        $html = Progress::widget([
            'value' => 50,
            'type' => 'success',
        ]);

        $this->assertStringContainsString('bg-success', $html);
    }

    public function testShowLabel()
    {
        $html = Progress::widget([
            'value' => 60,
            'showLabel' => true,
        ]);

        $this->assertStringContainsString('60%', $html);
    }

    public function testCustomLabel()
    {
        $html = Progress::widget([
            'value' => 60,
            'showLabel' => true,
            'label' => 'Almost done',
        ]);

        $this->assertStringContainsString('Almost done', $html);
    }
}
