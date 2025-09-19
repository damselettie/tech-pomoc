<?php

namespace App\Filament\Resources\Issues\DoneIssues;

use App\Filament\Resources\Issues\IssueResource;
use Illuminate\Database\Eloquent\Builder;
// Spróbuj importu Heroicon jeśli istnieje
use Filament\Support\Icons\Heroicon;  
use BackedEnum;

class DoneIssueResource extends IssueResource
{
    // Jeżeli Heroicon istnieje, to:
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;
    // Albo jeśli nie:
    // protected static string|null $navigationIcon = 'heroicon-o-check-circle';

    public static function getNavigationLabel(): string
    {
        return 'Zrobione';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Issues';
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $query = $query->with('recipients');
        return $query->where('status', 'done');
    }
}
