<?php

namespace App\Filament\Resources\Issues\InProgress;

use App\Filament\Resources\Issues\IssueResource;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Issue;

class InProgressIssue extends IssueResource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;

public static function getEloquentQuery(): Builder
{
    return Issue::query()->where('status', 'done');
}
    public static function getNavigationLabel(): string
    {
        return 'W trakcie';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Issues';
    }
}

