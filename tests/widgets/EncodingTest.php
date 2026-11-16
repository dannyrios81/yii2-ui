<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\data\DataTable;
use iguazoft\ui\widgets\data\DetailView;
use iguazoft\ui\widgets\ProductTable;
use PHPUnit\Framework\TestCase;
use yii\base\DynamicModel;

/**
 * Cell values come from the database: they must be HTML-encoded unless the column opts out.
 */
class EncodingTest extends TestCase
{
    private const PAYLOAD = '<script>alert(1)</script>';

    public function testProductTableEncodesByDefault()
    {
        $html = ProductTable::widget([
            'dataProvider' => [['id' => 1, 'name' => self::PAYLOAD]],
            'actionColumn' => false,
            'columns' => [['label' => 'Name', 'attribute' => 'name']],
        ]);

        $this->assertStringNotContainsString(self::PAYLOAD, $html);
        $this->assertStringContainsString('&lt;script&gt;', $html);
    }

    public function testProductTableBadgeIsEncoded()
    {
        $html = ProductTable::widget([
            'dataProvider' => [['id' => 1, 'name' => self::PAYLOAD]],
            'actionColumn' => false,
            'columns' => [['label' => 'Name', 'attribute' => 'name', 'format' => 'badge']],
        ]);

        $this->assertStringNotContainsString(self::PAYLOAD, $html);
    }

    public function testDataTableEncodesByDefaultAndRawOptsOut()
    {
        $data = [['name' => self::PAYLOAD, 'link' => '<a href="/x">x</a>']];

        $html = DataTable::widget([
            'dataProvider' => $data,
            'columns' => [
                ['label' => 'Name', 'attribute' => 'name'],
                ['label' => 'Link', 'attribute' => 'link', 'format' => 'raw'],
            ],
        ]);

        $this->assertStringNotContainsString(self::PAYLOAD, $html);
        $this->assertStringContainsString('<a href="/x">x</a>', $html);
    }

    public function testDetailViewEncodesByDefault()
    {
        $model = new DynamicModel(['name' => self::PAYLOAD]);

        $html = DetailView::widget([
            'model' => $model,
            'attributes' => ['name'],
        ]);

        $this->assertStringNotContainsString(self::PAYLOAD, $html);
    }
}
