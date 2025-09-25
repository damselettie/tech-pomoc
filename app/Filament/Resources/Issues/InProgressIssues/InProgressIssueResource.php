<?php

namespace App\Filament\Resources\Issues\InProgress;

use App\Filament\Resources\Issues\IssueResource;
use App\Models\Issue;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Tables\Table;
class InProgressIssueResource extends IssueResource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;

    public static function table(Table $table): Table
{
    $user = Filament::auth()->user();

    return parent::table($table)
        ->query(function ($query) use ($user) {
            $query->where('status', 'nowe');

            if (! $user->is_admin) {
                $query->whereHas('recipients', function ($q) use ($user) {
                    $q->where('users.id', $user->id);
                });
            }

            return $query;
            
        });
}


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

    $query->where('status', 'nowe');

    $user = Filament::auth()->user();

    if (! $user->is_admin) {
        $query->whereHas('recipients', function ($q) use ($user) {
            $q->where('users.id', $user->id);
        });
    }

    return $query;
    }
}
