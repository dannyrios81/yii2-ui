<?php

namespace app\controllers;

use yii\web\Controller;

/**
 * Example controller. Copy it to your app together with examples/views/dashboard.
 */
class DashboardController extends Controller
{
    public function actionIndex()
    {
        $products = [
            ['id' => 1, 'name' => 'Ultrabook 14" Pro', 'first_stock' => 4159, 'sold' => 878, 'date' => 'Jul 14, 2026', 'price' => 1200, 'rating' => 4.8],
            ['id' => 2, 'name' => 'Smartphone X 256 GB', 'first_stock' => 1690, 'sold' => 981, 'date' => 'Aug 09, 2026', 'price' => 960, 'rating' => 5.0],
            ['id' => 3, 'name' => 'Smartwatch Active 2', 'first_stock' => 1090, 'sold' => 184, 'date' => 'Aug 12, 2026', 'price' => 399, 'rating' => 4.7],
            ['id' => 4, 'name' => 'Noise-cancelling headphones', 'first_stock' => 2690, 'sold' => 905, 'date' => 'Aug 24, 2026', 'price' => 349, 'rating' => 4.2],
            ['id' => 5, 'name' => '27" 4K monitor', 'first_stock' => 4100, 'sold' => 645, 'date' => 'Nov 30, 2026', 'price' => 529, 'rating' => 4.9],
        ];

        return $this->render('index', ['products' => $products]);
    }

    public function actionComponents()
    {
        return $this->render('components');
    }
}
