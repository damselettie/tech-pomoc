<?php

namespace App\Filament\Resources\Issues\Done;

use App\Filament\Resources\Issues\IssueResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Icons\Heroicon;
use BackedEnum;



class DoneIssue extends IssueResource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;

public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->where('status', 'done');
}


    public static function getNavigationLabel(): string
    {
        return 'Zrobione';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Issues';
    }
}
