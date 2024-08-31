<?php

namespace App\Filament\Pages;

use App\Settings\IntegrationSettings;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class Integrations extends SettingsPage
{
    protected static ?string $navigationGroup = 'Configuration';

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $settings = IntegrationSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Tabs::make('Integrations')
                    ->tabs([
                        Tabs\Tab::make('Springshare')
                            ->schema([
                                TextInput::make('options.springshare_client_id')
                                    ->label('Client ID')
                                    ->placeholder('Enter your Springshare Client ID')
                                    ->required(),
                                TextInput::make('options.springshare_client_secret')
                                    ->label('Client Secret')
                                    ->placeholder('Enter your Springshare Client Secret')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }
}
