<?php

namespace App\Filament\Resources\Journals\Pages;

use App\Filament\Resources\Journals\JournalResource;
use App\Imports\JournalImport;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use EightyNine\ExcelImport\ExcelImportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;

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
            ExportAction::make()->exports([
                ExcelExport::make('form')->fromForm(),
            ])
        ];
    }
}
