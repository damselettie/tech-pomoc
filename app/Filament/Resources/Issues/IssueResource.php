<?php

namespace App\Filament\Resources\Issues;

use App\Filament\Resources\Issues\Pages\CreateIssue;
use App\Filament\Resources\Issues\Pages\EditIssue;
use App\Filament\Resources\Issues\Pages\ListIssues;
use App\Filament\Resources\Issues\Schemas\IssueForm;
use App\Filament\Resources\Issues\Tables\IssuesTable;
use App\Models\Issue;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Facades\Filament;


class IssueResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Issue';

    public static function form(Schema $schema): Schema
    {
        return IssueForm::configure($schema);
    }

    public static function getNavigationGroup(): ?string
{
    return 'Issues'; // Nazwa grupy/menu głównego
}

    public static function table(Table $table): Table
    {
        return IssuesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIssues::route('/'),
            'create' => CreateIssue::route('/create'),
            'edit' => EditIssue::route('/{record}/edit'),
        ];
    }
public static function getEloquentQuery(): Builder
{
    $user = Filament::auth()->user();

    // Rozpoczynamy zapytanie
    $query = parent::getEloquentQuery()->with('recipients');

    // Jeśli użytkownik jest administratorem, wyświetl wszystkie zgłoszenia
    if ($user->is_admin) {
        return $query;
    }

    // Jeśli użytkownik nie jest administratorem, filtrujemy tylko zgłoszenia, w których jest przypisany jako odbiorca
    return $query->whereHas('recipients', function ($query) use ($user) {
        $query->where('users.id', $user->id);
    });
}




    }
