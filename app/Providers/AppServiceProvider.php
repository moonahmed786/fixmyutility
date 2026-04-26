<?php

namespace App\Providers;

use Filament\Tables\Enums\ColumnManagerLayout;
use Filament\Tables\Table;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Column manager uses a modal (avoids dropdown scope issues) with live toggles
        // Filters also apply immediately without an "Apply" button
        Table::configureUsing(function (Table $table): void {
            $table->columnManagerLayout(ColumnManagerLayout::Modal);
            $table->deferColumnManager(false);
            $table->deferFilters(false);
        });
    }
}
