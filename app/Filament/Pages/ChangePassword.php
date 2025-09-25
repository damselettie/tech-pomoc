<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use BackedEnum;
use Filament\Support\Enums\Icon;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;

use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\Delete;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Button;
use Filament\Notifications\Concerns\CanNotify;
use InteractsWithForms;
use Filament\Notifications\InteractsWithNotifications;




class ChangePassword extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

   protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $title = 'Zmień hasło';
    protected static ?string $navigationLabel = 'Zmień hasło';
    protected static ?int $navigationSort = 99;

    protected string $view = 'filament.pages.change-password';

    public $current_password;
    public $new_password;
    public $new_password_confirmation;

     public static function getNavigationGroup(): ?string
        {
            return __('settings'); // Nazwa grupy/menu głównego
        }

    // Definicja schematu formularza (Filament v3)
    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('current_password')
                ->label('Obecne hasło')
                ->password()
                ->required(),

            Forms\Components\TextInput::make('new_password')
                ->label('Nowe hasło')
                ->password()
                ->required()
                ->minLength(8),

            Forms\Components\TextInput::make('new_password_confirmation')
                ->label('Potwierdź nowe hasło')
                ->password()
                ->required()
                ->same('new_password'),
        ];
    }

    // Konfiguracja formularza i statePath
    public function getForm(): Form
    {
        return Forms\Form::make()
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    // Metoda wywoływana przy wysłaniu formularza
    public function changePassword(): void
    {
        $data = $this->form->getState();

        $user = Auth::user();

        if (! Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Obecne hasło jest nieprawidłowe.',
            ]);
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        Notification::make()
            ->title('Hasło pomyślnie zmienione')
            ->success()
            ->send();
        $this->form->fill(); // reset formularza
    }
}