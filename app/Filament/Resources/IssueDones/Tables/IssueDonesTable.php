<?php

namespace App\Filament\Resources\IssueDones\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Carbon\Carbon; // dodaj import Carbon
use Illuminate\Support\Facades\Log;
use Filament\Tables\Filters\SelectFilter;
class IssueDonesTable
{
    public static function configure(Table $table): Table
    {
          return $table
        ->columns([
            TextColumn::make('title')->label(__('admin.issue.title')),
            TextColumn::make('reporter_name')->label(__('admin.issue.reporter_name')),
            TextColumn::make('status')->label(__('admin.issue.status')),

            TextColumn::make('created_at')
                ->label(__('admin.issue.created_at'))
                ->formatStateUsing(fn($state) => Carbon::parse($state)->diffForHumans()),

            TextColumn::make('done_at')
                ->label(__('admin.issue.done_at'))
                ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->diffForHumans() : '—'),

            TextColumn::make('recipients')
                ->label(__('admin.issue.recipients'))
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
        ->filters([
            
        ])
        ->actions([
            Action::make('markAsDone')
                ->label(__('admin.issue.markAsDone'))
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
                ->label(__('admin.issue.deleteIssue'))
                ->color('danger')
                ->requiresConfirmation()
                ->action(fn ($record) => $record->delete()),
        ])
        ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
       
        }}
