<?php

namespace App\Filament\Resources\Issues\InProgress;

use App\Filament\Resources\Issues\IssueResource;
use Illuminate\Database\Eloquent\Builder;
use BackedEnum;
use Filament\Support\Icons\Heroicon; 
class InProgressIssueResource extends IssueResource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;
    public static function getNavigationLabel(): string
    {
        return 'W trakcie';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Issues';
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $query = $query->with('recipients');

        return $query->where('status', 'nowe'); // albo 'in_progress' lub inny status
    }
}
