<?php

namespace App\Livewire;

use Livewire\Component;

class RoulettePage extends Component
{
    public string $view = 'modes'; // 'modes', 'stakes', 'training'
    public ?string $selectedStakesMode = null; // '1-2', '3-plus', 'ultra'

    public array $factors = [
        'straight' => 35,
        'split' => 17,
        'street' => 11,
        'corner' => 8,
        'sixline' => 5
    ];
    protected $trainingBets;
    protected $positionsCount = 12;


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

    public function generateChips()
    {
        switch ($this->selectedStakesMode) {
            case '1-2':
                $minChips = 20;
                $maxChips = 40;
                break;
            case '3-plus':
                $minChips = 60;
                $maxChips = 120;
                break;
            case 'ultra':
                $minChips = 100;
                $maxChips = 500;
                break;
            default:
                $minChips = 0;
                $maxChips = 100;
        }

        // Защита от некорректных данных
        if ($this->positionsCount <= 0) {
            return [];
        }

        // Выбираем случайное общее количество чипов в диапазоне [minChips, maxChips]
        $totalChips = mt_rand($minChips, $maxChips);

        // Если totalChips == 0, возвращаем нули
        if ($totalChips === 0) {
            return array_fill(0, $this->positionsCount, 0);
        }

        // Генерируем случайные веса
        $randoms = [];
        for ($i = 0; $i < $this->positionsCount; $i++) {
            $randoms[] = mt_rand(1, 1000); // используем от 1, чтобы избежать нулевых весов
        }

        $totalRandom = array_sum($randoms);

        $chips = [];
        $allocated = 0;

        // Распределяем пропорционально, округляя вниз
        for ($i = 0; $i < $this->positionsCount - 1; $i++) {
            $value = floor(($randoms[$i] / $totalRandom) * $totalChips);
            $chips[] = $value;
            $allocated += $value;
        }

        // Последнему элементу достаётся остаток
        $last = max(0, $totalChips - $allocated);
        $chips[] = $last;

        // Перемешиваем для случайности порядка
        shuffle($chips);

        return $chips;
    }

    // app/Livewire/RoulettePage.php

    public function getTrainingPositions()
    {
        return [
            ['id' => 1, 'x' => 33, 'y' => 7, 'chips' => 1],   // сверху по центру (над двойной линией)
            ['id' => 2, 'x' => 50, 'y' => 7, 'chips' => 2],  // левый верхний угол
            ['id' => 3, 'x' => 66, 'y' => 7, 'chips' => 3],  // центр верхнего ряда
            ['id' => 4, 'x' => 33, 'y' => 40, 'chips' => 4],  // правый верхний угол
            ['id' => 5, 'x' => 50, 'y' => 40, 'chips' => 5],  // левый средний
            ['id' => 6, 'x' => 66, 'y' => 40, 'chips' => 6],  // центр среднего
            ['id' => 7, 'x' => 33, 'y' => 60, 'chips' => 7],  // правый средний
            ['id' => 8, 'x' => 50, 'y' => 60, 'chips' => 8],  // левый нижний
            ['id' => 9, 'x' => 66, 'y' => 60, 'chips' => 9],  // центр нижнего
            ['id' => 10, 'x' => 33, 'y' => 83, 'chips' => 10], // правый нижний
            ['id' => 11, 'x' => 50, 'y' => 83, 'chips' => 10], // правый нижний
            ['id' => 12, 'x' => 66, 'y' => 83, 'chips' => 10], // правый нижний
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
