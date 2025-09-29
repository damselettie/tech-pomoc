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
        $user = Filament::auth()->user();

        return static::getModel()::query()
            ->where('status', 'nowe') // <- filtruj po statusie
            ->when(! $user->is_admin, function (Builder $query) use ($user) {
                // <- filtruj po przypisanych odbiorcach jeśli nie admin
                $query->whereHas('recipients', function ($q) use ($user) {
                    $q->where('users.id', $user->id);
                });
            });
    }
}
