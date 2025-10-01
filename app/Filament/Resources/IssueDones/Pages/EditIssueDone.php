<?php

namespace App\Filament\Resources\IssueDones\Pages;

use App\Filament\Resources\IssueDones\IssueDoneResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIssueDone extends EditRecord
{
    protected static string $resource = IssueDoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
