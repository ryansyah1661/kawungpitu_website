<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class CustomDashboard extends BaseDashboard
{
    public function getTitle(): string
    {
        return 'Dashboard Admin';
    }

    public function getHeading(): string
    {
        return ''; 
    }

    public static function getNavigationLabel(): string
    {
        return 'Dashboard';
    }
}