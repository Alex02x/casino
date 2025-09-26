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

    public $fullSum = 0;

    public $positionsCounts = [
        'straight' => [
            'chips' => 0,
            'sum' => 0,
        ],
        'split' => [
            'chips' => 0,
            'sum' => 0,
        ],
        'street' => [
            'chips' => 0,
            'sum' => 0,
        ],
        'corner' => [
            'chips' => 0,
            'sum' => 0,
        ],
        'sixline' => [
            'chips' => 0,
            'sum' => 0,
        ]
    ];


    // В начале класса, рядом с другими public/protected свойствами
    public bool $showingResult = false;

    public function showResult()
    {
        $this->showingResult = true;
    }

    public function continueTraining()
    {
        $this->showingResult = false;
        // Опционально: сбросить счётчики, чтобы не накапливались при новой генерации
        $this->positionsCounts = [
            'straight' => [
                'chips' => 0,
                'sum' => 0,
            ],
            'split' => [
                'chips' => 0,
                'sum' => 0,
            ],
            'street' => [
                'chips' => 0,
                'sum' => 0,
            ],
            'corner' => [
                'chips' => 0,
                'sum' => 0,
            ],
            'sixline' => [
                'chips' => 0,
                'sum' => 0,
            ]
        ];
        $this->fullSum = 0;
    }

    public function showStakesModes()
    {
        $this->view = 'stakes';
    }



    public function goBack()
    {
        if ($this->view === 'training_test') {
            $this->view = 'stakes';
        } elseif ($this->view === 'stakes') {
            $this->view = 'modes';
        } else {
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
            $randoms[] = mt_rand(0, 10000); // используем от 1, чтобы избежать нулевых весов
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
        $chips = $this->generateChips();


        $results = [];
        $yPositions = [7, 40, 60, 83]; // 4 строки
        $xPositions = [33, 50, 66];    // 3 колонки

        $betTypes = [
            1 => 'sixline',
            2 => 'street',
            3 => 'sixline',
            4 => 'corner',
            5 => 'split',
            6 => 'corner',
            7 => 'split',
            8 => 'straight',
            9 => 'split',
            10 => 'corner',
            11 => 'split',
            12 => 'corner',
        ];

        for ($i = 0; $i < $this->positionsCount; $i++) {
            $row = floor($i / 3);
            $col = $i % 3;

            // Защита от выхода за пределы доступных строк
            if ($row >= count($yPositions)) {
                break; // или throw exception, если нужно строгое соответствие
            }

            $positionName = $betTypes[$i+1];
            $sum = $chips[$i] * $this->factors[$betTypes[$i+1]];
            $results[] = [
                'id' => $i + 1,
                'x' => $xPositions[$col],
                'y' => $yPositions[$row],
                'chips' => $chips[$i],
                'positionName' => $positionName,
                'sum' => $sum,
            ];

            $this->positionsCounts[$positionName]['chips'] += $chips[$i];
            $this->positionsCounts[$positionName]['sum'] += $sum;

        }

        $this->fullSum = array_sum(array_column($results, 'sum'));
        return $results;

    }
    public function render()
    {
        return view('livewire.roulette-page')
            ->layout('layouts.app', [
                'title' => __('Рулетка — Тренировка'),
            ]);
    }


}
