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
        <!-- Внутри блока modes -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <!-- 1. Заставки -->
            <div
                class="relative aspect-[4/3] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-red-900 to-black flex flex-col items-center justify-center p-4 text-center text-white cursor-pointer hover:opacity-90 transition-opacity"
                wire:click="showStakesModes"
                wire:loading.class="opacity-50 cursor-not-allowed"
                wire:target="showStakesModes"
            >
                <div class="text-3xl mb-2">🎯</div>
                <h3 class="text-base font-semibold mb-1">Заставки</h3>
                <p class="text-xs text-gray-300">1–2 стэка, 3+ стэков</p>

                <!-- Прелоадер -->
                <div wire:loading wire:target="showStakesModes" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-xl">
                    <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            <!-- Остальные 4 — заглушки (без прелоадера) -->
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
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['mode' => '1-2', 'label' => '1–2 стэка', 'icon' => '🧱', 'color' => 'emerald'],
                ['mode' => '3-plus', 'label' => '3+ стэков', 'icon' => '🧱🧱', 'color' => 'amber'],
                ['mode' => 'ultra', 'label' => 'Ultra Mode', 'icon' => '🔥', 'color' => 'red'],
            ] as $item)
                <div
                    class="relative aspect-[4/3] overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-gradient-to-br from-{{ $item['color'] }}-800 to-{{ $item['color'] }}-900 flex flex-col items-center justify-center p-4 text-center text-white cursor-pointer hover:opacity-90 transition-opacity"
                    wire:click="startTraining('{{ $item['mode'] }}')"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                    wire:target="startTraining('{{ $item['mode'] }}')"
                >
                    <div class="text-3xl mb-2">{{ $item['icon'] }}</div>
                    <h3 class="text-base font-semibold mb-1">{{ $item['label'] }}</h3>
                    <p class="text-xs text-{{ $item['color'] }}-200">
                        {{ match($item['mode']) {
                            '1-2' => 'Простые заставки',
                            '3-plus' => 'Сложные заставки',
                            'ultra' => '20+ стэков',
                        } }}
                    </p>

                    <!-- Прелоадер -->
                    <div wire:loading wire:target="startTraining('{{ $item['mode'] }}')" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-xl">
                        <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            @endforeach
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
                    Общая выплата: <span class="text-yellow-400">{{ number_format($fullSum, 0, '', ' ') }}</span>
                </div>

                <div class="flex justify-center gap-4">
                    <button
                        wire:click="goBack"
                        wire:loading.attr="disabled"
                        wire:target="goBack"
                        class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-md text-lg disabled:opacity-50"
                    >
                        ← Назад к выбору режима
                        <span wire:loading wire:target="goBack" class="ml-2 inline-block animate-spin h-4 w-4 border-2 border-white rounded-full"></span>
                    </button>
                    <button
                        wire:click="continueTraining"
                        wire:loading.attr="disabled"
                        wire:target="continueTraining"
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-md text-lg disabled:opacity-50"
                    >
                        Новая тренировка
                        <span wire:loading wire:target="continueTraining" class="ml-2 inline-block animate-spin h-4 w-4 border-2 border-white rounded-full"></span>
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
                    <div class="absolute left-[20%] top-0 bottom-0 w-1 bg-yellow-400"></div>
                    <div class="absolute left-[80%] top-0 bottom-0 w-1 bg-yellow-400"></div>

                    <!-- Ставки -->
                    @foreach ($this->getTrainingPositions() as $bet)
                        @if($bet['chips'] != 0)
                            <div
                                class="absolute flex items-center justify-center text-2xl font-bold text-white"
                                style="
                                left: {{ $bet['x'] }}%;
                                top: {{ $bet['y'] }}%;
                                transform: translate(-50%, -50%);
                                width: 48px;
                                height: 48px;
                            "
                            >
                                <div class="w-full h-full rounded-full bg-blue-600 flex items-center justify-center shadow-md">
                                    {{ $bet['chips'] }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Кнопки в режиме тренировки -->
                <div class="mt-6 flex justify-center gap-4">
                    <button
                        wire:click="goBack"
                        wire:loading.attr="disabled"
                        wire:target="goBack"
                        class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-md text-lg disabled:opacity-50"
                    >
                        ← Назад
                        <span wire:loading wire:target="goBack" class="ml-2 inline-block animate-spin h-4 w-4 border-2 border-white rounded-full"></span>
                    </button>
                    <button
                        wire:click="showResult"
                        wire:loading.attr="disabled"
                        wire:target="showResult"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-lg disabled:opacity-50"
                    >
                        Проверить
                        <span wire:loading wire:target="showResult" class="ml-2 inline-block animate-spin h-4 w-4 border-2 border-white rounded-full"></span>
                    </button>
                </div>
            </div>
        @endif
    @endif
</div>
