<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\data\DataTable;
use PHPUnit\Framework\TestCase;

class DataTableTest extends TestCase
{
    public function testBasicRendering()
    {
        $html = DataTable::widget([
            'columns' => [
                ['label' => 'Name', 'attribute' => 'name'],
                ['label' => 'Email', 'attribute' => 'email'],
            ],
            'dataProvider' => [
                ['name' => 'John', 'email' => 'john@example.com'],
                ['name' => 'Jane', 'email' => 'jane@example.com'],
            ],
        ]);

        $this->assertStringContainsString('John', $html);
        $this->assertStringContainsString('jane@example.com', $html);
        $this->assertStringContainsString('<table', $html);
    }

    public function testEmptyDataProvider()
    {
        $html = DataTable::widget([
            'columns' => [
                ['label' => 'Name', 'attribute' => 'name'],
            ],
            'dataProvider' => [],
        ]);

        $this->assertStringContainsString('No data available', $html);
    }

    public function testCustomEmptyText()
    {
        $html = DataTable::widget([
            'columns' => [
                ['label' => 'Name', 'attribute' => 'name'],
            ],
            'dataProvider' => [],
            'emptyText' => 'Nothing here',
        ]);

        $this->assertStringContainsString('Nothing here', $html);
    }

    public function testStripedTable()
    {
        $html = DataTable::widget([
            'columns' => [['label' => 'Name', 'attribute' => 'name']],
            'dataProvider' => [['name' => 'Test']],
            'striped' => true,
        ]);

        $this->assertStringContainsString('table-striped', $html);
    }

    public function testBorderedTable()
    {
        $html = DataTable::widget([
            'columns' => [['label' => 'Name', 'attribute' => 'name']],
            'dataProvider' => [['name' => 'Test']],
            'bordered' => true,
        ]);

        $this->assertStringContainsString('table-bordered', $html);
    }

    public function testResponsiveWrapper()
    {
        $html = DataTable::widget([
            'columns' => [['label' => 'Name', 'attribute' => 'name']],
            'dataProvider' => [['name' => 'Test']],
            'responsive' => true,
        ]);

        $this->assertStringContainsString('table-responsive', $html);
    }

    public function testNoResponsiveWrapper()
    {
        $html = DataTable::widget([
            'columns' => [['label' => 'Name', 'attribute' => 'name']],
            'dataProvider' => [['name' => 'Test']],
            'responsive' => false,
        ]);

        $this->assertStringNotContainsString('table-responsive', $html);
    }

    public function testColumnHeaderRendering()
    {
        $html = DataTable::widget([
            'columns' => [
                ['label' => 'Full Name', 'attribute' => 'name'],
                ['label' => 'Age', 'attribute' => 'age'],
            ],
            'dataProvider' => [['name' => 'Test', 'age' => 25]],
        ]);

        $this->assertStringContainsString('Full Name', $html);
        $this->assertStringContainsString('Age', $html);
    }

    public function testFormatNumber()
    {
        $html = DataTable::widget([
            'columns' => [
                ['label' => 'Amount', 'attribute' => 'amount', 'format' => 'number'],
            ],
            'dataProvider' => [['amount' => 1234567]],
        ]);

        $this->assertStringContainsString('1,234,567', $html);
    }

    public function testFormatBoolean()
    {
        $html = DataTable::widget([
            'columns' => [
                ['label' => 'Active', 'attribute' => 'active', 'format' => 'boolean'],
            ],
            'dataProvider' => [['active' => true]],
        ]);

        $this->assertStringContainsString('Yes', $html);
    }
}
