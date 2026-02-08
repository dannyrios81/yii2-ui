<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\Badge;
use PHPUnit\Framework\TestCase;

class BadgeTest extends TestCase
{
    public function testBasicRendering()
    {
        $html = Badge::widget([
            'label' => 'New',
            'type' => 'primary',
        ]);

        $this->assertStringContainsString('New', $html);
        $this->assertStringContainsString('bg-primary', $html);
        $this->assertStringContainsString('badge', $html);
    }

    public function testPillBadge()
    {
        $html = Badge::widget([
            'label' => 'Pill',
            'pill' => true,
        ]);

        $this->assertStringContainsString('rounded-pill', $html);
    }

    public function testOutlineBadge()
    {
        $html = Badge::widget([
            'label' => 'Outline',
            'type' => 'danger',
            'outline' => true,
        ]);

        $this->assertStringContainsString('border-danger', $html);
        $this->assertStringContainsString('text-danger', $html);
        $this->assertStringNotContainsString('bg-danger', $html);
    }

    public function testAllTypes()
    {
        foreach (['primary', 'secondary', 'success', 'danger', 'warning', 'info'] as $type) {
            $html = Badge::widget([
                'label' => 'Test',
                'type' => $type,
            ]);
            $this->assertStringContainsString('bg-' . $type, $html);
        }
    }
}
