<?php

namespace App\Filament\Pages;

use App\Settings\ThemeSettings;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Wiebenieuwenhuis\FilamentCodeEditor\Components\CodeEditor;

class Theme extends SettingsPage
{
    protected static ?string $navigationGroup = 'Configuration';

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket';

    protected static string $settings = ThemeSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Tabs::make()
                    ->tabs([
                        Tabs\Tab::make('Layout')
                            ->schema([
                                Section::make()
                                    ->schema([
                                        CodeEditor::make('css')
                                            ->label('CSS'),
                                        CodeEditor::make('header')
                                            ->label('Header'),
                                        CodeEditor::make('footer')
                                            ->label('Footer'),
                                        CodeEditor::make('js')
                                            ->label('JavaScript'),
                                    ]),
                            ]),
                        Tabs\Tab::make('Colors')
                            ->columns(4)
                            ->schema([
                                ColorPicker::make('primary_color')
                                    ->label('Primary Color'),
                                ColorPicker::make('secondary_color')
                                    ->label('Secondary Color'),
                                ColorPicker::make('primary_button_color')
                                    ->label('Primary Button Color'),
                                ColorPicker::make('secondary_button_color')
                                    ->label('Secondary Button Color'),
                                ColorPicker::make('primary_link_color')
                                    ->label('Primary Link Color'),
                                ColorPicker::make('secondary_link_color')
                                    ->label('Secondary Link Color'),
                                ColorPicker::make('page_background_color')
                                    ->label('Page Background Color'),
                                ColorPicker::make('box_background_color')
                                    ->label('Box Background Color'),
                                ColorPicker::make('border_color')
                                    ->label('Border Color'),
                            ]),
                    ]),

            ]);
    }
}
