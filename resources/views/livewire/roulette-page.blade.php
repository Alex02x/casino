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

    @elseif ($view === 'training_test')
        @if ($showingResult)
            <!-- Отображение результата -->
            <div class="flex-1 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gray-900 p-6 text-white">
                <h2 class="text-2xl font-bold mb-6 text-center">Результат тренировки</h2>

                <div class="space-y-4 mb-8">
                    @foreach ($positionsCounts as $type => $data)
                        @if ($data['chips'] > 0 || $data['sum'] > 0)
                            <div class="flex justify-between items-center p-3 bg-gray-800 rounded">
                        <span class="font-medium capitalize">
                            {{ match($type) {
                                'straight' => 'Прямая ставка',
                                'split' => 'Сплит',
                                'street' => 'Стрит',
                                'corner' => 'Корнер',
                                'sixline' => 'Сикслайн',
                                default => $type
                            } }}
                        </span>
                                <div class="text-right">
                                    <div class="text-sm text-gray-300">{{ number_format($data['chips'], 0, '', ' ') }} фишек</div>
                                    <div class="text-emerald-400 font-bold">{{ number_format($data['sum'], 0, '', ' ') }} выплата</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="text-center text-xl font-semibold mb-6">
                    Общая выплата: <span class="text-yellow-400">{{ number_format($fullSum, 0, '', ' ') }}</span> фишек
                </div>

                <div class="flex justify-center gap-4">
                    <button
                        wire:click="goBack"
                        class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-md text-lg"
                    >
                        ← Назад к выбору режима
                    </button>
                    <button
                        wire:click="continueTraining"
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-md text-lg"
                    >
                        Новая тренировка
                    </button>
                </div>
            </div>
        @else
            <!-- Сетка тренировки (как было) -->
            <div class="flex-1 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gray-900 p-4 relative overflow-hidden">
                <h2 class="text-xl font-bold text-white mb-4">
                    Тренировка: {{ match($selectedStakesMode) {
                    '1-2' => '1–2 стэка',
                    '3-plus' => '3+ стэков',
                    'ultra' => 'Ultra Mode (20+ стэков)',
                    default => 'Неизвестный режим'
                } }}
                </h2>

                <div class="relative w-full h-[60vh] bg-gray-950 rounded-lg overflow-hidden">
                    <!-- Линии сетки -->
                    <div class="absolute top-15 left-0 right-0 h-1 bg-yellow-400"></div>
                    <div class="absolute top-20 left-0 right-0 h-1 bg-yellow-400"></div>
                    <div class="absolute top-[40%] left-0 right-0 h-1 bg-yellow-400"></div>
                    <div class="absolute top-[83%] left-0 right-0 h-1 bg-yellow-400"></div>
                    <div class="absolute left-[33%] top-0 bottom-0 w-1 bg-yellow-400"></div>
                    <div class="absolute left-[66%] top-0 bottom-0 w-1 bg-yellow-400"></div>

                    <!-- Ставки -->
                    @foreach ($this->getTrainingPositions() as $bet)
                        @if($bet['chips'] != 0)
                            <div
                                class="absolute flex items-center justify-center text-4xl font-bold text-white"
                                style="
                                left: {{ $bet['x'] }}%;
                                top: {{ $bet['y'] }}%;
                                transform: translate(-50%, -50%);
                                width: 96px;
                                height: 96px;
                            "
                            >
                                <div class="w-full h-full rounded-full bg-blue-600 flex items-center justify-center shadow-md">
                                    {{ $bet['chips'] }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Кнопки -->
                <div class="mt-6 flex justify-center gap-4">
                    <button
                        wire:click="goBack"
                        class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-md text-lg"
                    >
                        ← Назад
                    </button>
                    <button
                        wire:click="showResult"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-lg"
                    >
                        Проверить
                    </button>
                </div>
            </div>
        @endif
    @endif
</div>
