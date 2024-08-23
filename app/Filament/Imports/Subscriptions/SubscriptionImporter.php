<?php

namespace App\Filament\Imports\Subscriptions;

use App\Models\Subscriptions\Subscription;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SubscriptionImporter extends Importer
{
    protected static ?string $model = Subscription::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('type')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('is_public')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('is_featured')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('slug')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('custom_slug'),
            ImportColumn::make('alternate_names'),
            ImportColumn::make('url'),
            ImportColumn::make('vendor')
                ->relationship(),
            ImportColumn::make('proxy')
                ->relationship(),
            ImportColumn::make('description'),
            ImportColumn::make('authenticated_description'),
            ImportColumn::make('internal_notes'),
            ImportColumn::make('created_by')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('updated_by')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('deleted_by')
                ->numeric()
                ->rules(['integer']),
        ];
    }

    public function resolveRecord(): ?Subscription
    {
        // return Subscription::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Subscription();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your subscription import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
