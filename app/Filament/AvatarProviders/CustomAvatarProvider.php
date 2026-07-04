<?php

namespace App\Filament\AvatarProviders;

use Filament\AvatarProviders\Contracts\AvatarProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class CustomAvatarProvider implements AvatarProvider
{
    public function get(Model | Authenticatable $record): string
    {
        if (method_exists($record, 'getFilamentAvatarUrl') && $record->getFilamentAvatarUrl()) {
            return $record->getFilamentAvatarUrl();
        }

        return (new \Filament\AvatarProviders\UiAvatarsProvider())->get($record);
    }
}