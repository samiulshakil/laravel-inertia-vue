<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard', [
        'stats' => [
            [
                'name' => 'Total Revenue',
                'value' => '3,782',
                'change' => '+12%',
                'changeType' => 'increase',
                'changePercent' => '+12%'
            ],
            [
                'name' => 'Total Orders', 
                'value' => '5,359',
                'change' => '+8%',
                'changeType' => 'increase',
                'changePercent' => '+8%'
            ],
            [
                'name' => 'Active Users',
                'value' => '2,847', 
                'change' => '-3%',
                'changeType' => 'decrease',
                'changePercent' => '-3%'
            ],
            [
                'name' => 'Conversion Rate',
                'value' => '75.55%',
                'change' => '+5%', 
                'changeType' => 'increase',
                'changePercent' => '+5%'
            ]
        ],
        'recentOrders' => [
            [
                'id' => 1,
                'customer' => 'John Doe',
                'product' => 'Premium Plan',
                'amount' => '299.00',
                'status' => 'Completed'
            ],
            [
                'id' => 2,
                'customer' => 'Jane Smith', 
                'product' => 'Basic Plan',
                'amount' => '99.00',
                'status' => 'Pending'
            ],
            [
                'id' => 3,
                'customer' => 'Mike Johnson',
                'product' => 'Pro Plan', 
                'amount' => '199.00',
                'status' => 'Completed'
            ],
            [
                'id' => 4,
                'customer' => 'Sarah Wilson',
                'product' => 'Enterprise Plan',
                'amount' => '499.00', 
                'status' => 'Processing'
            ]
        ]
    ]);
})->name('dashboard');

//->middleware(['auth', 'verified'])

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
