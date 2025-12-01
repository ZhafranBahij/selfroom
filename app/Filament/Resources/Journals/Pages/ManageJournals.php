<?php

namespace App\Filament\Resources\Journals\Pages;

use App\Filament\Resources\Journals\JournalResource;
use App\Imports\JournalImport;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use EightyNine\ExcelImport\ExcelImportAction;

class ManageJournals extends ManageRecords
{
    protected static string $resource = JournalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ExcelImportAction::make()
                ->color("primary")
                ->use(JournalImport::class),
        ];
    }
}
