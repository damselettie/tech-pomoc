<x-filament::page>
    <form wire:submit.prevent="changePassword" class="space-y-6 max-w-md">
        {{ $this->form }}
        <div  style="margin-top:10px">
        <x-filament::button type="submit">
            Zmień hasło
        </x-filament::button>
        </div>
    </form>
</x-filament::page>