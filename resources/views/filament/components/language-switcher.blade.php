<div class="flex items-center gap-4 px-4">
    @foreach (['en' => '🇬🇧', 'pl' => '🇵🇱', 'de' => '🇩🇪'] as $locale => $flag)
        <a href="{{ route('language.switch', $locale) }}"
           class="@if(app()->getLocale() === $locale) font-bold ring-2 ring-primary-500 rounded-full @endif"
           aria-label="Switch to {{ $locale }}" style="width:20px; display: inline-block;">
            <span class="text-2xl">{{ $flag }}</span>
        </a>
    @endforeach
</div>
