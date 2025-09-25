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
        <div class="flex-1 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gray-900 p-4 relative overflow-hidden">
            <!-- Сетка рулетки -->
            <div class="grid grid-cols-12 gap-1 w-full" style="aspect-ratio: 4/1;">
                @for ($col = 0; $col < 12; $col++)
                    @for ($row = 0; $row < 3; $row++)
                        <div class="aspect-square bg-gray-800 rounded flex items-center justify-center text-xs text-white border border-gray-700">
                            {{-- Можно добавить номер позже --}}
                        </div>
                    @endfor
                @endfor
            </div>

            <!-- Кружочки ставок (абсолютное позиционирование) -->
            <div class="absolute inset-0 pointer-events-none">
                @php
                    $bets = [
                        // Six-line (1-6)
                        ['x' => 0.5, 'y' => 0.5, 'stacks' => 1],
                        // Six-line (7-12)
                        ['x' => 2.5, 'y' => 0.5, 'stacks' => 2],
                        // Street (13-15)
                        ['x' => 4.5, 'y' => 2, 'stacks' => 3],
                        // Corners
                        ['x' => 5.5, 'y' => 0.5, 'stacks' => 4],
                        ['x' => 6.5, 'y' => 0.5, 'stacks' => 5],
                        ['x' => 6.5, 'y' => 1.5, 'stacks' => 6],
                        ['x' => 7.5, 'y' => 1.5, 'stacks' => 7],
                        // Splits
                        ['x' => 8.5, 'y' => 2, 'stacks' => 8],
                        ['x' => 9, 'y' => 1.5, 'stacks' => 9],
                        ['x' => 10, 'y' => 0.5, 'stacks' => 10],
                        ['x' => 11.5, 'y' => 2, 'stacks' => 11],
                        // Straight-up (36)
                        ['x' => 11.5, 'y' => 2.5, 'stacks' => 12],
                    ];
                @endphp

                @foreach ($bets as $bet)
                    <div
                        class="absolute flex items-center justify-center text-xs font-bold text-white"
                        style="
                        left: calc({{ $bet['x'] }} * (100% / 12));
                        top: calc({{ $bet['y'] }} * (100% / 3));
                        transform: translate(-50%, -50%);
                        width: 24px;
                        height: 24px;
                    "
                    >
                        <div class="w-full h-full rounded-full bg-blue-600 flex items-center justify-center">
                            {{ $bet['stacks'] }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Кнопка назад -->
            <div class="mt-4 text-center">
                <button
                    wire:click="goBack"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm"
                >
                    Вернуться к выбору
                </button>
            </div>
        </div>
    @endif
</div>
