<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;

class Profile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $slug = 'profile';
    protected static ?string $title = 'Profile';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = null;

    protected static string $view = 'filament.pages.profile';

    public ?array $data = [];

    public function mount(): void
    {
        $user = auth()->user();

        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'profile_photo' => $user->profile_photo,
        ]);
    }

    public function getMaxContentWidth(): ?string
    {
        return '7xl';
    }

    public function form(Form $form): Form
{
    return $form
        ->statePath('data')
        ->schema([

            Forms\Components\TextInput::make('name')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            Forms\Components\TextInput::make('email')
                ->label('Alamat Email')
                ->email()
                ->required()
                ->unique(
                    table: User::class,
                    ignorable: auth()->user(),
                )
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('profile_photo')
                ->label('Foto Profil')
                ->image()
                ->avatar()
                ->imageEditor()
                ->circleCropper()
                ->directory('avatars')
                ->imagePreviewHeight('80')
                ->panelLayout('compact')
                ->columnSpanFull(),

            Forms\Components\Grid::make(2)
                ->schema([

                    Forms\Components\TextInput::make('password')
                        ->label('Password Baru')
                        ->password()
                        ->revealable()
                        ->dehydrated(false),

                    Forms\Components\TextInput::make('password_confirmation')
                        ->label('Konfirmasi Password')
                        ->password()
                        ->revealable()
                        ->dehydrated(false)
                        ->same('password'),

                ]),

        ]);
}

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function save(): void
    {
        $state = $this->form->getState();

        $user = auth()->user();

        $user->name = $state['name'];
        $user->email = $state['email'];
        $user->profile_photo = $state['profile_photo'] ?? null;

        if (! empty($state['password'])) {
            $user->password = Hash::make($state['password']);
        }

        $user->save();

        Notification::make()
            ->title('Profil berhasil diperbarui')
            ->success()
            ->send();
            
        $this->redirect('/db');
    }

    public function getHeading(): string
    {
        return '';
    }
}