<x-filament::page>
    <form wire:submit.prevent="changePassword" class="space-y-6 max-w-md">
        {{ $this->form }}
        <x-filament::button type="submit">
            Zmień hasło
        </x-filament::button>
    </form>
</x-filament::page>