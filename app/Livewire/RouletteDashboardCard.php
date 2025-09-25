<?php

namespace App\Livewire;

use Livewire\Component;

class RouletteDashboardCard extends Component
{
    public function goToRoulette()
    {
        return redirect()->route('roulette');
    }

    public function render()
    {
        return view('livewire.roulette-dashboard-card');
    }
}
