<?php

namespace App\Livewire;

use Livewire\Component;

class RoulettePage extends Component
{
    public string $view = 'modes'; // 'modes', 'stakes', 'training'
    public ?string $selectedStakesMode = null; // '1-2', '3-plus', 'ultra'

    public function showStakesModes()
    {
        $this->view = 'stakes';
    }



    public function goBack()
    {
        if ($this->view === 'training') {
            $this->view = 'stakes';
        } elseif ($this->view === 'stakes') {
            $this->view = 'modes';
        }
    }


    public function startTraining(string $mode)
    {
        $this->selectedStakesMode = $mode;
        $this->view = 'training_test'; // новое состояние
    }

// Метод для получения данных о ставках (позициях и количестве стэков)
    public function getTrainingBets()
    {
        return [
            // Пример из вашего скриншота: 12 кружочков с цифрами
            ['id' => 1, 'x' => 5, 'y' => 90, 'stacks' => 1],   // вверху слева
            ['id' => 2, 'x' => 30, 'y' => 90, 'stacks' => 2],  // вверху по центру
            ['id' => 3, 'x' => 40, 'y' => 30, 'stacks' => 3],  // внизу по центру
            ['id' => 4, 'x' => 55, 'y' => 90, 'stacks' => 4],  // вверху правее центра
            ['id' => 5, 'x' => 65, 'y' => 90, 'stacks' => 5],  // вверху ещё правее
            ['id' => 6, 'x' => 50, 'y' => 70, 'stacks' => 6],  // чуть ниже центра (кнопка "Вернуться")
            ['id' => 7, 'x' => 70, 'y' => 60, 'stacks' => 7],  // справа внизу
            ['id' => 8, 'x' => 75, 'y' => 40, 'stacks' => 8],  // ещё ниже справа
            ['id' => 9, 'x' => 80, 'y' => 60, 'stacks' => 9],  // рядом с 7
            ['id' => 10, 'x' => 90, 'y' => 90, 'stacks' => 10], // вверху справа
            ['id' => 11, 'x' => 95, 'y' => 40, 'stacks' => 11], // внизу справа
            ['id' => 12, 'x' => 95, 'y' => 20, 'stacks' => 12], // внизу справа ещё ниже
        ];
    }

    // app/Livewire/RoulettePage.php

    public function getTrainingPositions()
    {
        // Координаты x и y в процентах от ширины и высоты контейнера
        return [
            // Пример из вашего скриншота: 9 кружочков в сетке 3x3
            ['id' => 1, 'x' => 33, 'y' => 3, 'stacks' => 1],   // сверху по центру (над двойной линией)
            ['id' => 2, 'x' => 50, 'y' => 3, 'stacks' => 2],  // левый верхний угол
            ['id' => 3, 'x' => 66, 'y' => 3, 'stacks' => 3],  // центр верхнего ряда
            ['id' => 4, 'x' => 67, 'y' => 40, 'stacks' => 4],  // правый верхний угол
            ['id' => 5, 'x' => 33, 'y' => 60, 'stacks' => 5],  // левый средний
            ['id' => 6, 'x' => 50, 'y' => 60, 'stacks' => 6],  // центр среднего
            ['id' => 7, 'x' => 67, 'y' => 60, 'stacks' => 7],  // правый средний
            ['id' => 8, 'x' => 33, 'y' => 80, 'stacks' => 8],  // левый нижний
            ['id' => 9, 'x' => 50, 'y' => 80, 'stacks' => 9],  // центр нижнего
            ['id' => 10, 'x' => 67, 'y' => 80, 'stacks' => 10], // правый нижний
        ];
    }
    public function render()
    {
        return view('livewire.roulette-page')
            ->layout('layouts.app', [
                'title' => __('Рулетка — Тренировка'),
            ]);
    }
}
