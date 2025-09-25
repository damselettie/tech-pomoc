<?php
namespace App\Filament\Resources\Issues\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Carbon\Carbon; // dodaj import Carbon
use Illuminate\Support\Facades\Log;
class IssuesTable
{

    
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Nazwa'),
                TextColumn::make('reporter_name')->label('Zgłaszający'),
                TextColumn::make('status')->label('Status'),

                TextColumn::make('created_at')
                    ->label('Utworzono')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->diffForHumans()),

                TextColumn::make('done_at')
                    ->label('Wykonano')
                    ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->diffForHumans() : '—'),

                TextColumn::make('recipients')
                    ->label('Odbiorcy')
                    ->formatStateUsing(function ($state, $record) {
                        $recipients = $record->recipients;

                        if ($recipients->isEmpty()) {
                            return '—';
                        }

                        return $recipients->map(fn($user) => $user->role)
                            ->unique()
                            ->implode(', ') ?: 'Brak roli';
                    })
                    ->limit(50)
                    ->wrap(),
            ])
            
            ->actions([
                Action::make('markAsDone')
    ->label('Zrobione')
   
    ->color('success')
    ->action(function ($record) {
        Log::info('MarkAsDone clicked for ID: ' . $record->id);

        if ($record->status === 'nowe') {
            $record->update([
                'status' => 'done',
                'done_at' => now(),
            ]);

            Log::info('Updated to done for ID: ' . $record->id);
        }
    })
    ->visible(fn ($record) => $record->status === 'nowe'),
                Action::make('deleteIssue')
                    ->label('Usuń')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->delete()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
            
    }
    
}
