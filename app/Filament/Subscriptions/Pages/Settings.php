<?php

namespace App\Filament\Subscriptions\Pages;

use App\Settings\SubscriptionSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class Settings extends SettingsPage
{
    protected static ?string $navigationGroup = 'System';

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    protected static string $settings = SubscriptionSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('theme')
                            ->label('Theme')
                            ->options([
                                'default' => 'Default',
                                'rounded' => 'Rounded',
                                'square' => 'Square',
                            ])
                            ->required(),
                        Select::make('resource_layout')
                            ->label('Resource Layout')
                            ->options([
                                'default' => 'Default',
                            ])
                            ->required(),
                    ]),
            ]);
    }
}
