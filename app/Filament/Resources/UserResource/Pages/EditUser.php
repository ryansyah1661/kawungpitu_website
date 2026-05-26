<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function afterSave(): void
    {
        /** @var \App\Models\User $user */
        $user = $this->getRecord();

        if ($user->id === Auth::id()) {
            // 1. Refresh status login user saat ini
            Auth::login($user);

            // 2. Ambil nama guard secara aman via Facade agar VS Code tidak memicu garis kuning
            $guard = Auth::getDefaultDriver();

            // 3. Kunci hash session baru agar tidak ditendang keluar oleh sistem keamanan Laravel
            session()->put([
                'password_hash_' . $guard => $user->getAuthPassword(),
            ]);
        }
    }
}
