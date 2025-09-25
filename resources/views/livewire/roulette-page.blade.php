{{-- resources/views/livewire/roulette-page.blade.php --}}
<div class="flex h-full w-full flex-col gap-6 p-4 md:p-6">
    <!-- Заголовок и кнопка назад -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Рулетка — Тренировочный режим</h1>
        <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
            ← Назад на Dashboard
        </a>
    </div>

    <!-- Сетка виджетов (как на dashboard) -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <!-- 1. Заставки (активный) -->
        <div
            class="relative aspect-[4/3] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-red-900 to-black flex flex-col items-center justify-center p-4 text-center text-white cursor-pointer hover:opacity-90 transition-opacity"
            wire:click="goToStakesMode"
        >
            <div class="text-4xl mb-2">🎯</div>
            <h3 class="text-lg font-semibold mb-1">Заставки</h3>
            <p class="text-xs text-gray-300 mb-3">1–2 стэка, 3+ стэков</p>
            <span class="px-3 py-1 bg-blue-600 text-white text-xs rounded-full">Тренироваться</span>
        </div>

        <!-- 2. Прямое попадание комплитов (заглушка) -->
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-gray-800 to-gray-900 flex flex-col items-center justify-center p-4 text-center text-gray-500">
            <div class="text-4xl mb-2">🎯</div>
            <h3 class="text-lg font-semibold mb-1">Прямое попадание комплитов</h3>
            <p class="text-xs">Скоро</p>
        </div>

        <!-- 3. Пересечения комплитов -->
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-gray-800 to-gray-900 flex flex-col items-center justify-center p-4 text-center text-gray-500">
            <div class="text-4xl mb-2">🔄</div>
            <h3 class="text-lg font-semibold mb-1">Пересечения комплитов</h3>
            <p class="text-xs">Скоро</p>
        </div>

        <!-- 4. Выплата с трэка -->
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-gray-800 to-gray-900 flex flex-col items-center justify-center p-4 text-center text-gray-500">
            <div class="text-4xl mb-2">💰</div>
            <h3 class="text-lg font-semibold mb-1">Выплата с трэка</h3>
            <p class="text-xs">Скоро</p>
        </div>

        <!-- 5. Сдача с трэка -->
        <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-gray-800 to-gray-900 flex flex-col items-center justify-center p-4 text-center text-gray-500">
            <div class="text-4xl mb-2">📤</div>
            <h3 class="text-lg font-semibold mb-1">Сдача с трэка</h3>
            <p class="text-xs">Скоро</p>
        </div>
    </div>
</div>
