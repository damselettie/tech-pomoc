<?php

namespace App\Filament\Resources\IssueDones;

use App\Filament\Resources\IssueDones\Pages\CreateIssueDone;
use App\Filament\Resources\IssueDones\Pages\EditIssueDone;
use App\Filament\Resources\IssueDones\Pages\ListIssueDones;
use App\Filament\Resources\IssueDones\Schemas\IssueDoneForm;
use App\Filament\Resources\IssueDones\Tables\IssueDonesTable;
use App\Models\Issue;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class IssueDoneResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;
    public static function form(Schema $schema): Schema
    {
        return IssueDoneForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IssueDonesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->where('status', 'done');
}


    public static function getNavigationLabel(): string
    {
        return __('admin.issue.DoneTitle');
    }

        public static function getNavigationGroup(): ?string
{
    return __('admin.issue.IssueTitle'); // Nazwa grupy/menu głównego
}

   

    public static function getPages(): array
    {
        return [
            'index' => ListIssueDones::route('/'),
            'create' => CreateIssueDone::route('/create'),
            'edit' => EditIssueDone::route('/{record}/edit'),
        ];
    }
}
