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

    public function startTraining(string $mode)
    {
        $this->selectedStakesMode = $mode;
        $this->view = 'training';
    }

    public function goBack()
    {
        if ($this->view === 'training') {
            $this->view = 'stakes';
        } elseif ($this->view === 'stakes') {
            $this->view = 'modes';
        }
    }

    public function getTestBets()
    {
        return [
            // Six-line: покрывает 2 строки (6 номеров)
            ['type' => 'sixline', 'rows' => [0, 1], 'col_start' => 0], // 1-6
            ['type' => 'sixline', 'rows' => [0, 1], 'col_start' => 2], // 7-12

            // Street: 1 строка, 3 номера
            ['type' => 'street', 'row' => 2, 'col_start' => 4], // 13-15

            // Corners (4 штуки)
            ['type' => 'corner', 'top_row' => 0, 'left_col' => 5], // 16,17,19,20
            ['type' => 'corner', 'top_row' => 0, 'left_col' => 6], // 19,20,22,23
            ['type' => 'corner', 'top_row' => 1, 'left_col' => 6], // 22,23,25,26
            ['type' => 'corner', 'top_row' => 1, 'left_col' => 7], // 25,26,28,29

            // Splits (4 штуки) — вертикальные и горизонтальные
            ['type' => 'split', 'row' => 2, 'col' => 8, 'direction' => 'horizontal'], // 28/29
            ['type' => 'split', 'row' => 1, 'col' => 9, 'direction' => 'vertical'],   // 29/32
            ['type' => 'split', 'row' => 0, 'col' => 10, 'direction' => 'vertical'],  // 31/34
            ['type' => 'split', 'row' => 2, 'col' => 11, 'direction' => 'horizontal'], // 35/36

            // Straight-up
            ['type' => 'straight', 'row' => 2, 'col' => 11], // 36
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
