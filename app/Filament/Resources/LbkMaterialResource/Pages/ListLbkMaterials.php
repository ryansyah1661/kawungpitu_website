<?php

namespace App\Filament\Resources\LbkMaterialResource\Pages;

use App\Filament\Resources\LbkMaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLbkMaterials extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = LbkMaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
