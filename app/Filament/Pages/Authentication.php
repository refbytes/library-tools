<?php

namespace App\Filament\Pages;

use App\Settings\AuthenticationSettings;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\SettingsPage;

class Authentication extends SettingsPage
{
    protected static ?string $navigationGroup = 'Admin';

    protected static ?string $navigationParentItem = 'Users';

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static string $settings = AuthenticationSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('SSO')
                    ->schema([
                        Select::make('sso_provider')
                            ->label('SSO Provider')
                            ->options([
                                'google' => 'Google',
                                'microsoft' => 'Microsoft',
                                'okta' => 'Okta',
                                'saml2' => 'SAML2',
                            ])
                            ->live(),
                        Fieldset::make('Google')
                            ->schema([
                                TextInput::make('options.google_client_id')
                                    ->label('Client ID')
                                    ->required(),
                                TextInput::make('options.google_client_secret')
                                    ->label('Client Secret')
                                    ->required(),
                            ])
                            ->visible(fn (Get $get) => $get('sso_provider') === 'google'),
                        Fieldset::make('Microsoft')
                            ->schema([
                                TextInput::make('options.microsoft_client_id')
                                    ->label('Client ID')
                                    ->required(),
                                TextInput::make('options.microsoft_client_secret')
                                    ->label('Client Secret')
                                    ->required(),
                            ])
                            ->visible(fn (Get $get) => $get('sso_provider') === 'microsoft'),
                        Fieldset::make('Okta')
                            ->schema([
                                TextInput::make('options.okta_client_id')
                                    ->label('Client ID')
                                    ->required(),
                                TextInput::make('options.okta_client_secret')
                                    ->label('Client Secret')
                                    ->required(),
                            ])
                            ->visible(fn (Get $get) => $get('sso_provider') === 'okta'),
                        Fieldset::make('SAML2')
                            ->schema([
                                TextInput::make('options.saml2_idp_entity_id')
                                    ->label('IDP Entity ID')
                                    ->required(),
                                TextInput::make('options.saml2_idp_sso_url')
                                    ->label('IDP SSO URL')
                                    ->required(),
                                TextInput::make('options.saml2_idp_x509')
                                    ->label('IDP x509')
                                    ->required(),
                                TextInput::make('options.saml2_sp_entity_id')
                                    ->label('SP Entity ID')
                                    ->required(),
                                TextInput::make('options.saml2_sp_sso_url')
                                    ->label('SP SSO URL')
                                    ->required(),
                                TextInput::make('options.saml2_sp_x509')
                                    ->label('SP x509')
                                    ->required(),
                            ])
                            ->visible(fn (Get $get) => $get('sso_provider') === 'saml2'),
                    ]),
            ]);
    }
}
