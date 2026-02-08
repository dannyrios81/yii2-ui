<?php

namespace iguazoft\ui\tests\widgets;

use iguazoft\ui\widgets\Sidebar;
use PHPUnit\Framework\TestCase;

class SidebarTest extends TestCase
{
    public function testBasicRendering()
    {
        $html = Sidebar::widget([
            'mainMenu' => [
                ['label' => 'Dashboard', 'icon' => '🏠', 'url' => '/dashboard'],
            ],
        ]);

        $this->assertStringContainsString('Dashboard', $html);
        $this->assertStringContainsString('sidebar', $html);
    }

    public function testUserProfile()
    {
        $html = Sidebar::widget([
            'user' => [
                'name' => 'John Doe',
                'role' => 'Admin',
            ],
        ]);

        $this->assertStringContainsString('John Doe', $html);
        $this->assertStringContainsString('Admin', $html);
        $this->assertStringContainsString('user-profile', $html);
    }

    public function testSearchEnabled()
    {
        $html = Sidebar::widget([
            'searchEnabled' => true,
            'searchPlaceholder' => 'Find...',
        ]);

        $this->assertStringContainsString('sidebar-search', $html);
        $this->assertStringContainsString('Find...', $html);
    }

    public function testSearchDisabled()
    {
        $html = Sidebar::widget([
            'searchEnabled' => false,
        ]);

        $this->assertStringNotContainsString('sidebar-search', $html);
    }

    public function testMenuSections()
    {
        $html = Sidebar::widget([
            'mainMenu' => [
                ['label' => 'Home', 'url' => '/'],
            ],
            'accountMenu' => [
                ['label' => 'Profile', 'url' => '/profile'],
            ],
            'otherMenu' => [
                ['label' => 'Settings', 'url' => '/settings'],
            ],
        ]);

        $this->assertStringContainsString('Home', $html);
        $this->assertStringContainsString('ACCOUNT', $html);
        $this->assertStringContainsString('Profile', $html);
        $this->assertStringContainsString('OTHER MENU', $html);
        $this->assertStringContainsString('Settings', $html);
    }

    public function testActiveMenuItem()
    {
        $html = Sidebar::widget([
            'mainMenu' => [
                ['label' => 'Dashboard', 'url' => '/', 'active' => true],
                ['label' => 'Reports', 'url' => '/reports'],
            ],
        ]);

        $this->assertStringContainsString('active', $html);
    }
}
