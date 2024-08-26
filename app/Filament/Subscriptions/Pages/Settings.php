<?php

namespace App\Filament\Subscriptions\Pages;

use App\Settings\SubscriptionSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\SettingsPage;
use Illuminate\Support\HtmlString;
use Wiebenieuwenhuis\FilamentCodeEditor\Components\CodeEditor;

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
                        Select::make('corners')
                            ->label('Corners')
                            ->options([
                                'rounded' => 'Rounded',
                                'square' => 'Square',
                            ])
                            ->required(),
                        Select::make('theme')
                            ->label('Theme')
                            ->options([
                                'default' => 'Default',
                                'custom' => 'Custom',
                            ])
                            ->required(),
                        Select::make('resource_layout')
                            ->label('Resource Layout')
                            ->live()
                            ->options([
                                'default' => 'Default',
                                'custom' => 'Custom',
                            ])
                            ->required(),
                        CodeEditor::make('custom_resource_layout')
                            ->label('Custom Resource Layout')
                            ->visible(fn (Get $get) => $get('resource_layout') === 'custom')
                            ->helperText(new HtmlString(\view('components.subscriptions.templates.resource.hint')->render())),
                        Select::make('filter_order')
                            ->label('Filter Position')
                            ->options([
                                1 => 'Left',
                                2 => 'Right',
                            ])
                            ->required(),
                    ]),
            ]);
    }
}
