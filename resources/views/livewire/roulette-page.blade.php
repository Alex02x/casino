{{-- resources/views/livewire/roulette-page.blade.php --}}
<div class="flex h-full w-full flex-col gap-6 p-4 md:p-6">
    <!-- Заголовок и кнопка назад -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            @if ($view === 'modes')
                Рулетка — Тренировочный режим
            @elseif ($view === 'stakes')
                Выберите режим заставок
            @elseif ($view === 'training')
                Тренировка: {{ match($selectedStakesMode) {
                    '1-2' => '1–2 стэка',
                    '3-plus' => '3+ стэков',
                    'ultra' => 'Ultra Mode (20+ стэков)',
                    default => 'Неизвестный режим'
                    }
                }}
            @endif
        </h1>

        @if ($view !== 'modes')
            <button
                wire:click="goBack"
                class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 flex items-center"
            >
                ← Назад
            </button>
        @else
            <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
                ← На Dashboard
            </a>
        @endif
    </div>

    <!-- Основной контент -->
    @if ($view === 'modes')
        <!-- 5 основных режимов -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <!-- 1. Заставки -->
            <div
                class="relative aspect-[4/3] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-red-900 to-black flex flex-col items-center justify-center p-4 text-center text-white cursor-pointer hover:opacity-90 transition-opacity"
                wire:click="showStakesModes"
            >
                <div class="text-3xl mb-2">🎯</div>
                <h3 class="text-base font-semibold mb-1">Заставки</h3>
                <p class="text-xs text-gray-300">1–2 стэка, 3+ стэков</p>
            </div>

            <!-- Остальные 4 — заглушки -->
            @foreach ([
                'Прямое попадание комплитов',
                'Пересечения комплитов',
                'Выплата с трэка',
                'Сдача с трэка'
            ] as $title)
                <div class="relative aspect-[4/3] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-gray-800 to-gray-900 flex flex-col items-center justify-center p-4 text-center text-gray-500">
                    <div class="text-3xl mb-2">🔒</div>
                    <h3 class="text-base font-semibold mb-1">{{ $title }}</h3>
                    <p class="text-xs">Скоро</p>
                </div>
            @endforeach
        </div>

    @elseif ($view === 'stakes')
        <!-- 3 подрежима заставок -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div
                class="relative aspect-[4/3] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-emerald-800 to-emerald-900 flex flex-col items-center justify-center p-4 text-center text-white cursor-pointer hover:opacity-90 transition-opacity"
                wire:click="startTraining('1-2')"
            >
                <div class="text-3xl mb-2">🧱</div>
                <h3 class="text-base font-semibold mb-1">1–2 стэка</h3>
                <p class="text-xs text-emerald-200">Простые заставки</p>
            </div>

            <div
                class="relative aspect-[4/3] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-amber-800 to-amber-900 flex flex-col items-center justify-center p-4 text-center text-white cursor-pointer hover:opacity-90 transition-opacity"
                wire:click="startTraining('3-plus')"
            >
                <div class="text-3xl mb-2">🧱🧱</div>
                <h3 class="text-base font-semibold mb-1">3+ стэков</h3>
                <p class="text-xs text-amber-200">Сложные заставки</p>
            </div>

            <div
                class="relative aspect-[4/3] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-red-800 to-red-900 flex flex-col items-center justify-center p-4 text-center text-white cursor-pointer hover:opacity-90 transition-opacity"
                wire:click="startTraining('ultra')"
            >
                <div class="text-3xl mb-2">🔥</div>
                <h3 class="text-base font-semibold mb-1">Ultra Mode</h3>
                <p class="text-xs text-red-200">20+ стэков</p>
            </div>
        </div>

    @elseif ($view === 'training')
        <!-- Интерфейс тренировки (заглушка) -->
        <div class="flex-1 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-gray-900 to-black flex flex-col items-center justify-center p-6 text-white">
            <div class="text-center max-w-2xl">
                <div class="text-5xl mb-4">🎯</div>
                <h2 class="text-xl font-semibold mb-3">
                    Тренировка: {{ match($selectedStakesMode) {
                        '1-2' => '1–2 стэка',
                        '3-plus' => '3+ стэков',
                        'ultra' => 'Ultra Mode',
                        default => 'Неизвестный режим'
                        }
                    }}
                </h2>
                <p class="text-gray-300 mb-6">
                    Здесь будет интерактивный тренажёр заставок.
                </p>
                <button
                    wire:click="goBack"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 rounded-md font-medium transition-colors"
                >
                    Вернуться к выбору
                </button>
            </div>
        </div>
    @endif
</div>
