<?php

namespace App\Filament\Exports\Subscriptions;

use App\Models\Subscriptions\Subscription;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SubscriptionExporter extends Exporter
{
    protected static ?string $model = Subscription::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('deleted_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('type'),
            ExportColumn::make('is_public'),
            ExportColumn::make('is_featured'),
            ExportColumn::make('name'),
            ExportColumn::make('slug'),
            ExportColumn::make('custom_slug'),
            ExportColumn::make('alternate_names'),
            ExportColumn::make('url'),
            ExportColumn::make('vendor.name'),
            ExportColumn::make('proxy.name'),
            ExportColumn::make('description'),
            ExportColumn::make('authenticated_description'),
            ExportColumn::make('internal_notes'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            ExportColumn::make('deleted_by'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your subscription export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
