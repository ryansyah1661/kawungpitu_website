<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use Filament\Resources\Pages\ListRecords;

class ListMessages extends ListRecords
{
    protected static string $resource = MessageResource::class;

    public function getBreadcrumbs(): array
    {
        // Mengembalikan array kosong akan menghilangkan breadcrumb di halaman ini Qi
        return [];
    }
}