<?php

namespace App\Filament\Resources\IssueInProgress\Pages;

use App\Filament\Resources\IssueInProgress\IssueInProgressResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIssueInProgress extends EditRecord
{
    protected static string $resource = IssueInProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
