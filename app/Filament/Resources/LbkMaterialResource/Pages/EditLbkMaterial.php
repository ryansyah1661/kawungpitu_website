<?php

namespace App\Filament\Resources\LbkMaterialResource\Pages;

use App\Filament\Resources\LbkMaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLbkMaterial extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = LbkMaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['view_count'] = (int) ($data['view_count'] ?? 0);

        return $data;
    }
}
