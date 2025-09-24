<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public static function getPages(): array
{
    return [
        'index' => ListUsers::route('/'),
        'create' => CreateUser::route('/create'),
        'edit' => EditUser::route('/{record}/edit'), // ← MUSI BYĆ!
    ];
}

}
