<?php

namespace App\Filament\Resources\IssueDones\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms;

class IssueDoneForm
{
    public static function configure(Schema $schema): Schema
    {
   return $schema->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->label('Nazwa'),

            Forms\Components\Textarea::make('description')
                ->required()
                ->label('Opis'),


    Forms\Components\Select::make('status')
    ->options([
        'nowe' => 'Nowe',
        'done' => 'Zrobione',
    ])
    ->required()
    ->label('Status'),

            Forms\Components\TextInput::make('reporter_name')
    ->required()
    ->label('Imię zgłaszającego'),
        ]);
    }
}
