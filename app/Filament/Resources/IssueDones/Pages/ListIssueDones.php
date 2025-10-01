<?php

namespace App\Filament\Resources\IssueDones\Pages;

use App\Filament\Resources\IssueDones\IssueDoneResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIssueDones extends ListRecords
{
    protected static string $resource = IssueDoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
