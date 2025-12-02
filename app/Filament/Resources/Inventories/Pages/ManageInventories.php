<?php

namespace App\Filament\Resources\Inventories\Pages;

use App\Filament\Resources\Inventories\InventoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ManageInventories extends ManageRecords
{
    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ExportAction::make()->exports([
                ExcelExport::make('form')->fromForm(),
            ])
        ];
    }
}
