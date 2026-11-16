<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\data\DataTable;
use iguazoft\ui\widgets\ProductTable;
use PHPUnit\Framework\TestCase;
use yii\data\ArrayDataProvider;

class DataProviderTest extends TestCase
{
    private function provider(): ArrayDataProvider
    {
        $rows = [];
        for ($i = 1; $i <= 25; $i++) {
            $rows[] = ['id' => $i, 'name' => 'Item ' . $i];
        }

        return new ArrayDataProvider(['allModels' => $rows, 'pagination' => ['pageSize' => 10]]);
    }

    public function testProductTableRendersModelsOfTheCurrentPage()
    {
        $html = ProductTable::widget([
            'dataProvider' => $this->provider(),
            'actionColumn' => false,
            'columns' => [['label' => 'Name', 'attribute' => 'name']],
        ]);

        $this->assertStringContainsString('Item 1<', $html);
        $this->assertStringContainsString('Item 10<', $html);
        $this->assertStringNotContainsString('Item 11<', $html);
        $this->assertStringContainsString('25', $html, 'Total count comes from the provider');
    }

    public function testDataTableAcceptsProvider()
    {
        $html = DataTable::widget([
            'dataProvider' => $this->provider(),
            'columns' => [['label' => 'Name', 'attribute' => 'name']],
        ]);

        $this->assertSame(10, substr_count($html, '<tr>') - 1);
    }
}
