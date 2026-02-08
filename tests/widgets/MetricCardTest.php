<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\MetricCard;
use PHPUnit\Framework\TestCase;

class MetricCardTest extends TestCase
{
    public function testBasicRendering()
    {
        $html = MetricCard::widget([
            'title' => 'Total Revenue',
            'value' => '12,500',
        ]);

        $this->assertStringContainsString('Total Revenue', $html);
        $this->assertStringContainsString('12,500', $html);
        $this->assertStringContainsString('metric-card', $html);
    }

    public function testPrefixAndSuffix()
    {
        $html = MetricCard::widget([
            'title' => 'Revenue',
            'value' => '500',
            'prefix' => '$',
            'suffix' => 'K',
        ]);

        $this->assertStringContainsString('$500K', $html);
    }

    public function testTrendUp()
    {
        $html = MetricCard::widget([
            'title' => 'Sales',
            'value' => '100',
            'trend' => 'up',
            'trendValue' => '15%',
            'trendType' => 'success',
        ]);

        $this->assertStringContainsString('15%', $html);
        $this->assertStringContainsString('text-success', $html);
    }

    public function testTrendDown()
    {
        $html = MetricCard::widget([
            'title' => 'Sales',
            'value' => '100',
            'trend' => 'down',
            'trendValue' => '5%',
            'trendType' => 'danger',
        ]);

        $this->assertStringContainsString('5%', $html);
        $this->assertStringContainsString('text-danger', $html);
    }

    public function testWithTags()
    {
        $html = MetricCard::widget([
            'title' => 'Revenue',
            'value' => '100',
            'tags' => ['MacBook', 'iPhone'],
        ]);

        $this->assertStringContainsString('# MacBook', $html);
        $this->assertStringContainsString('# iPhone', $html);
        $this->assertStringContainsString('metric-tags', $html);
    }

    public function testWithIcon()
    {
        $html = MetricCard::widget([
            'title' => 'Revenue',
            'value' => '100',
            'icon' => '💰',
        ]);

        $this->assertStringContainsString('💰', $html);
        $this->assertStringContainsString('metric-icon', $html);
    }
}
