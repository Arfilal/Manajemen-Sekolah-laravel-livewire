<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Guru;
use App\Models\Kelas;

class GuruByKelas extends Component
{
    public $kelasId;
    public $kelas;

    public function mount($id)
    {
        $this->kelasId = $id;
        $this->kelas = Kelas::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.guru.guru-by-kelas', [
            'dataGuru' => Guru::where('kelas_id', $this->kelasId)->get()
        ])->layout('layouts.app', [
            'header' => 'Guru di Kelas ' . $this->kelas->nama_kelas,
        ]);
    }
}
