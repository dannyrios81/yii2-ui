<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\Card;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testBasicRendering()
    {
        $html = Card::widget([
            'title' => 'My Card',
            'content' => '<p>Card content</p>',
        ]);

        $this->assertStringContainsString('My Card', $html);
        $this->assertStringContainsString('Card content', $html);
        $this->assertStringContainsString('card', $html);
    }

    public function testWithSubtitle()
    {
        $html = Card::widget([
            'title' => 'Title',
            'subtitle' => 'Subtitle text',
            'content' => 'Body',
        ]);

        $this->assertStringContainsString('Subtitle text', $html);
        $this->assertStringContainsString('card-subtitle', $html);
    }

    public function testWithFooter()
    {
        $html = Card::widget([
            'title' => 'Card',
            'content' => 'Content',
            'footer' => 'Footer text',
        ]);

        $this->assertStringContainsString('Footer text', $html);
        $this->assertStringContainsString('card-footer', $html);
    }

    public function testShadowDisabled()
    {
        $html = Card::widget([
            'title' => 'Card',
            'content' => 'Content',
            'shadow' => false,
        ]);

        $this->assertStringNotContainsString('shadow-sm', $html);
    }

    public function testRoundedDisabled()
    {
        $html = Card::widget([
            'title' => 'Card',
            'content' => 'Content',
            'rounded' => false,
        ]);

        $this->assertStringNotContainsString('rounded-3', $html);
    }

    public function testDashboardWidgetClass()
    {
        $html = Card::widget([
            'title' => 'Card',
            'content' => 'Content',
        ]);

        $this->assertStringContainsString('dashboard-widget', $html);
    }
}
