<?php

namespace App\Filament\Resources\LbkMaterialResource\Pages;

use App\Filament\Resources\LbkMaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLbkMaterial extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = LbkMaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['view_count'] = (int) ($data['view_count'] ?? 0);

        return $data;
    }
}