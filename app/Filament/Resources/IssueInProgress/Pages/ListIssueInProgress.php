<?php

namespace App\Filament\Resources\IssueInProgress\Pages;

use App\Filament\Resources\IssueInProgress\IssueInProgressResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIssueInProgress extends ListRecords
{
    protected static string $resource = IssueInProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
