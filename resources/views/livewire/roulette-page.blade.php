{{-- resources/views/livewire/roulette-page.blade.php --}}
<div class="flex h-full w-full flex-col gap-6 p-4 md:p-6">
    <!-- Заголовок и кнопка назад -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Рулетка — Тренировочный режим</h1>
        <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
            ← Назад на Dashboard
        </a>
    </div>

    <!-- Меню режимов -->
    <div class="flex flex-wrap gap-2">
        <button
            wire:click="$set('mode', 'stakes')"
            class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                {{ $mode === 'stakes'
                    ? 'bg-blue-600 text-white'
                    : 'bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-neutral-700 dark:text-gray-200 dark:hover:bg-neutral-600' }}"
        >
            Заставки (1–2 стэка, 3+ стэков)
        </button>
        <button
            disabled
            class="px-4 py-2 rounded-lg text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed"
        >
            Прямое попадание комплитов
        </button>
        <button
            disabled
            class="px-4 py-2 rounded-lg text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed"
        >
            Пересечения комплитов
        </button>
        <button
            disabled
            class="px-4 py-2 rounded-lg text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed"
        >
            Выплата с трэка
        </button>
        <button
            disabled
            class="px-4 py-2 rounded-lg text-sm font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed"
        >
            Сдача с трэка
        </button>
    </div>

    <!-- Контент в зависимости от режима -->
    <div class="flex-1 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-gray-900 to-black flex flex-col items-center justify-center p-6 text-white">
        @if ($mode === 'stakes')
            <div class="text-center max-w-2xl">
                <div class="text-5xl mb-4">🎯</div>
                <h2 class="text-xl font-semibold mb-3">Тренировка заставок</h2>
                <p class="text-gray-300 mb-6">
                    Отрабатывайте объявления и расстановку фишек для:
                </p>
                <ul class="space-y-2 text-left bg-gray-800/50 p-4 rounded-lg">
                    <li class="flex items-start">
                        <span class="text-green-400 mr-2">•</span>
                        <span><strong>1–2 стэка:</strong> простые заставки (например, "17 и 20")</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-400 mr-2">•</span>
                        <span><strong>3+ стэков:</strong> сложные заставки (например, "17, 20, 23 и 26")</span>
                    </li>
                </ul>
                <div class="mt-6">
                    <button class="px-5 py-2 bg-blue-600 hover:bg-blue-700 rounded-md font-medium transition-colors">
                        Начать тренировку
                    </button>
                </div>
            </div>
        @else
            <!-- Заглушка для других режимов -->
            <div class="text-center">
                <p class="text-gray-400">Режим пока не реализован.</p>
            </div>
        @endif
    </div>
</div>
