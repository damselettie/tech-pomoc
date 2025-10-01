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

   public static function getNavigationLabel(): string
    {
        return __('admin.issue.IssueTitle');
    }


        public static function getRecordTitleAttribute(): string
{
    return __('admin.issue.IssueTitle');
}

    public static function form(Schema $schema): Schema
    {
        return IssueForm::configure($schema);
    }
public static function getTableQuery(): Builder
{
    $query = parent::getTableQuery()
        ->where('status', '=', 'nowe');

    return $query;
}
    public static function getNavigationGroup(): ?string
{
    return __('admin.issue.IssueTitle'); // Nazwa grupy/menu głównego
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

// public static function getEloquentQuery(): Builder
// {
//     $user = Filament::auth()->user();

//     $query = Issue::query()->with('recipients');

//     if ($user->is_admin) {
//         return $query;
//     }

//     return $query->whereHas('recipients', function ($query) use ($user) {
//         $query->where('users.id', $user->id);
//     });
// }

}

    
