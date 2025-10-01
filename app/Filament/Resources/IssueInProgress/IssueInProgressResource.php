<?php

namespace App\Filament\Resources\IssueInProgress;

use App\Filament\Resources\IssueInProgress\Pages\CreateIssueInProgress;
use App\Filament\Resources\IssueInProgress\Pages\EditIssueInProgress;
use App\Filament\Resources\IssueInProgress\Pages\ListIssueInProgress;
use App\Filament\Resources\IssueInProgress\Schemas\IssueInProgressForm;
use App\Filament\Resources\IssueInProgress\Tables\IssueInProgressTable;
use App\Models\Issue;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Schema;


class IssueInProgressResource extends Resource
{
    protected static ?string $model = Issue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;

 public static function form(Schema $schema): Schema
{
    return IssueInProgressForm::configure($schema);
}

    public static function getNavigationGroup(): ?string
{
    return __('admin.issue.IssueTitle'); // Nazwa grupy/menu głównego
}

   

    public static function table(Table $table): Table
    {
        return IssueInProgressTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.issue.InProgressTitle');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('status', 'nowe');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIssueInProgress::route('/'),
            'create' => CreateIssueInProgress::route('/create'),
            'edit' => EditIssueInProgress::route('/{record}/edit'),
        ];
    }
}
