<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Hash;

class EditSecurity extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    public static function getNavigationLabel(): string
    {
        return __('Account Security Manager');
    }

    public function getTitle(): string | Htmlable
    {
        return __('Account Security Manager');
    }

    public function getSubheading(): string | Htmlable | null
    {
        return __('Here you can change your password and or login email address.');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('E-mail')
                ->relationship('user')
                ->description('This section is used to manage your account e-mail. This affects your login e-mail next time you login.')
                ->icon('heroicon-o-lock-closed')
                ->schema([
                    TextInput::make('email')
                        ->email()
                        ->confirmed()
                        ->regex('/^\S+$/')
                        ->validationMessages([
                            'confirmed' => 'The e-mail confirmation does not match.',
                            'regex'     => 'The e-mail must not contain any whitespace.',
                        ])
                        ->label('E-mail')
                        ->minLength(3)
                        ->maxLength(50)
                        ->helperText('E-mail must be at least 3 characters long and no more than 50 characters long.'),
                    TextInput::make('email_confirmation')
                        ->label('Confirm E-mail')
                        ->helperText('Please confirm your e-mail')
                        ->minLength(3)
                        ->maxLength(50),
                ])->columns(2),
            Section::make('Password')
                ->relationship('user')
                ->description('This section is used to manage your account password. This affects your login password after reload the page.')
                ->icon('heroicon-o-lock-closed')
                ->schema([
                    TextInput::make('password')
                        ->password()
                        ->confirmed()
                        ->regex('/^\S+$/')
                        ->validationMessages([
                            'confirmed' => 'The password confirmation does not match.',
                            'regex'     => 'The password must not contain any whitespace.',
                        ])
                        ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->label('Password')
                        ->minLength(6)
                        ->maxLength(15)
                        ->revealable()
                        ->helperText('Password must be at least 6 characters long and no more than 15 characters long.'),
                    TextInput::make('password_confirmation')
                        ->password()
                        ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->label('Confirm Password')
                        ->revealable()
                        ->helperText('Please confirm your password.')
                        ->minLength(6)
                        ->maxLength(15),
                ])->columns(2),
        ]);
    }
}
