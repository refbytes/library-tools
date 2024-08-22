<?php

namespace App\Filament\Pages;

use App\Settings\ThemeSettings;
use Filament\Forms\Components\Section;
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
            ->schema([
                Section::make()
                    ->schema([
                        CodeEditor::make('meta')
                            ->label('Meta'),
                        CodeEditor::make('css')
                            ->label('CSS'),
                        CodeEditor::make('header')
                            ->label('Header'),
                        CodeEditor::make('footer')
                            ->label('Footer'),
                        CodeEditor::make('js')
                            ->label('JavaScript'),
                    ]),
            ]);
    }
}
