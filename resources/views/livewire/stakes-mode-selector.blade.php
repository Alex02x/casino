{{-- resources/views/livewire/stakes-mode-selector.blade.php --}}
<div class="flex h-full w-full flex-col gap-6 p-4 md:p-6">
    <!-- Заголовок -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Выберите режим тренировки</h1>
        <a href="{{ route('roulette') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
            ← Назад
        </a>
    </div>

    <!-- Виджеты режимов -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <!-- 1–2 стэка -->
        <div
            class="relative aspect-[4/3] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-emerald-800 to-emerald-900 flex flex-col items-center justify-center p-4 text-center text-white cursor-pointer hover:opacity-90 transition-opacity"
            wire:click="selectMode('1-2')"
        >
            <div class="text-3xl mb-2">🧱</div>
            <h3 class="text-base font-semibold mb-1">1–2 стэка</h3>
            <p class="text-xs text-emerald-200">Простые заставки</p>
        </div>

        <!-- 3+ стэков -->
        <div
            class="relative aspect-[4/3] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-amber-800 to-amber-900 flex flex-col items-center justify-center p-4 text-center text-white cursor-pointer hover:opacity-90 transition-opacity"
            wire:click="selectMode('3-plus')"
        >
            <div class="text-3xl mb-2">🧱🧱</div>
            <h3 class="text-base font-semibold mb-1">3+ стэков</h3>
            <p class="text-xs text-amber-200">Сложные заставки</p>
        </div>

        <!-- Ultra Mode (20+ стэков) -->
        <div
            class="relative aspect-[4/3] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-red-800 to-red-900 flex flex-col items-center justify-center p-4 text-center text-white cursor-pointer hover:opacity-90 transition-opacity"
            wire:click="selectMode('ultra')"
        >
            <div class="text-3xl mb-2">🔥</div>
            <h3 class="text-base font-semibold mb-1">Ultra Mode</h3>
            <p class="text-xs text-red-200">20+ стэков</p>
        </div>
    </div>
</div>
