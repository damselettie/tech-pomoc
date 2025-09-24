<?php
namespace App\Filament\Resources\Issues\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class IssuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Nazwa'),
                TextColumn::make('room_number')->label('Numer pokoju'),
                TextColumn::make('computer_number')->label('Numer komputera'),
                TextColumn::make('reporter_name')->label('Zgłaszający'),
                TextColumn::make('status')->label('Status'),
                TextColumn::make('created_at')->label('Utworzono')->dateTime('d.m.Y H:i'),
                
                TextColumn::make('recipients')
                    ->label('Odbiorcy')
                    ->formatStateUsing(function ($state, $record) {
                        // $record to pełny model Issue z eager loaded recipients
                        $recipients = $record->recipients;

                        if ($recipients->isEmpty()) {
                            return '—';
                        }

                        // Pobierz unikalne role przypisane do odbiorców, usuwając duplikaty
                        return $recipients->map(fn($user) => $user->role)  // Pobierz rolę użytkownika
                            ->unique()  // Usuwamy duplikaty
                            ->implode(', ')  // Łączymy unikalne role w ciąg tekstowy
                            ?: 'Brak roli';  // Jeśli brak ról, wyświetl "Brak roli"
                    })
                    ->limit(50)
                    ->wrap(),
            ])
            ->actions([
                Action::make('markAsDone')
                    ->label('Zrobione')
                    ->color('success')
                    ->action(fn ($record) => $record->update(['status' => 'done']))
                    ->visible(fn ($record) => $record->status !== 'done'),

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
 