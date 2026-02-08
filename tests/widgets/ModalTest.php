<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\feedback\Modal;
use PHPUnit\Framework\TestCase;

class ModalTest extends TestCase
{
    public function testBasicRendering()
    {
        $html = Modal::widget([
            'title' => 'Test Modal',
            'content' => 'Modal body content',
        ]);

        $this->assertStringContainsString('Test Modal', $html);
        $this->assertStringContainsString('Modal body content', $html);
        $this->assertStringContainsString('modal', $html);
    }

    public function testWithFooter()
    {
        $html = Modal::widget([
            'title' => 'Modal',
            'content' => 'Body',
            'footer' => '<button>Save</button>',
        ]);

        $this->assertStringContainsString('modal-footer', $html);
        $this->assertStringContainsString('Save', $html);
    }

    public function testCentered()
    {
        $html = Modal::widget([
            'title' => 'Modal',
            'content' => 'Body',
            'centered' => true,
        ]);

        $this->assertStringContainsString('modal-dialog-centered', $html);
    }

    public function testLargeSize()
    {
        $html = Modal::widget([
            'title' => 'Modal',
            'content' => 'Body',
            'size' => 'lg',
        ]);

        $this->assertStringContainsString('modal-lg', $html);
    }

    public function testScrollable()
    {
        $html = Modal::widget([
            'title' => 'Modal',
            'content' => 'Body',
            'scrollable' => true,
        ]);

        $this->assertStringContainsString('modal-dialog-scrollable', $html);
    }

    public function testCloseButton()
    {
        $html = Modal::widget([
            'title' => 'Modal',
            'content' => 'Body',
            'closeButton' => true,
        ]);

        $this->assertStringContainsString('btn-close', $html);
    }

    public function testNoCloseButton()
    {
        $html = Modal::widget([
            'title' => 'Modal',
            'content' => 'Body',
            'closeButton' => false,
        ]);

        $this->assertStringNotContainsString('btn-close', $html);
    }
}
