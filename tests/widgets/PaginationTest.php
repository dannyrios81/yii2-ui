<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\navigation\Pagination;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    public function testSinglePageReturnsEmpty()
    {
        $html = Pagination::widget([
            'totalPages' => 1,
            'currentPage' => 1,
        ]);

        $this->assertEmpty($html);
    }

    public function testMultiplePagesRendered()
    {
        $html = Pagination::widget([
            'totalPages' => 5,
            'currentPage' => 3,
        ]);

        $this->assertStringContainsString('pagination', $html);
        $this->assertStringContainsString('active', $html);
    }

    public function testPrevNextButtons()
    {
        $html = Pagination::widget([
            'totalPages' => 10,
            'currentPage' => 5,
            'showPrevNext' => true,
        ]);

        $this->assertStringContainsString('Previous', $html);
        $this->assertStringContainsString('Next', $html);
    }

    public function testFirstLastButtons()
    {
        $html = Pagination::widget([
            'totalPages' => 10,
            'currentPage' => 5,
            'showFirstLast' => true,
        ]);

        $this->assertStringContainsString('First', $html);
        $this->assertStringContainsString('Last', $html);
    }

    public function testSmallSize()
    {
        $html = Pagination::widget([
            'totalPages' => 5,
            'currentPage' => 1,
            'size' => 'sm',
        ]);

        $this->assertStringContainsString('pagination-sm', $html);
    }
}
