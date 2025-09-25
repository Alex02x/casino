{{-- resources/views/livewire/roulette-page.blade.php --}}
<div class="flex h-full w-full flex-col gap-6 p-4 md:p-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Рулетка — Тренировочный режим</h1>
        <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
            ← Назад на Dashboard
        </a>
    </div>

    <div class="flex-1 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-gray-900 to-black flex items-center justify-center">
        <div class="text-center text-white">
            <div class="text-6xl mb-4">🎡</div>
            <h2 class="text-xl font-semibold mb-2">Интерфейс рулетки</h2>
            <p class="text-gray-400">Базовая страница готова. Логика будет добавлена позже.</p>
        </div>
    </div>
</div>
