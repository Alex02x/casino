<div class="bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 cursor-pointer"
     wire:click="$emit('navigateToRoulette')">

    <!-- Заголовок блока -->
    <h2 class="text-xl font-bold text-white mb-3">Тренировка Рулетки</h2>

    <!-- Изображение (заглушка) -->
    <div class="w-full h-32 bg-gradient-to-r from-yellow-500 to-yellow-700 flex items-center justify-center rounded-lg mb-4">
        <span class="text-black text-2xl font-bold">🎲</span>
    </div>

    <!-- Описание -->
    <p class="text-gray-300 text-sm mb-4">
        Практикуйтесь в управлении рулеткой. Идеально подходит для начинающих дилеров.
    </p>

    <!-- Кнопка -->
    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition-colors duration-200">
        Перейти к тренировке
    </button>
</div>
