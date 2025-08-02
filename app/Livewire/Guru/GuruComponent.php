<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Guru;
use App\Models\Kelas;

class GuruComponent extends Component
{
    use WithPagination;

    public $nama, $nip, $mapel, $jenis_kelamin, $alamat, $kelas_id;
    public $guru_id;
    public $isEdit = false;

    public $search = '';
    public $sort = 'asc';

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $dataGuru = Guru::with('kelas')
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('mapel', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nama', $this->sort)
            ->paginate(10); // ✅ Pagination aktif lagi

        return view('livewire.guru.guru-component', [
            'dataGuru' => $dataGuru,
            'dataKelas' => Kelas::all()
        ])->layout('layouts.app');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSort()
    {
        $this->resetPage();
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->sort = 'asc';
        $this->resetPage();
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:gurus',
            'mapel' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Guru::create([
            'nama' => $this->nama,
            'nip' => $this->nip,
            'mapel' => $this->mapel,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'kelas_id' => $this->kelas_id,
        ]);

        session()->flash('message', 'Guru berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $this->guru_id = $guru->id;
        $this->nama = $guru->nama;
        $this->nip = $guru->nip;
        $this->mapel = $guru->mapel;
        $this->jenis_kelamin = $guru->jenis_kelamin;
        $this->alamat = $guru->alamat;
        $this->kelas_id = $guru->kelas_id;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:gurus,nip,' . $this->guru_id,
            'mapel' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $guru = Guru::findOrFail($this->guru_id);
        $guru->update([
            'nama' => $this->nama,
            'nip' => $this->nip,
            'mapel' => $this->mapel,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'kelas_id' => $this->kelas_id,
        ]);

        session()->flash('message', 'Guru berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Guru::destroy($id);
        session()->flash('message', 'Guru berhasil dihapus.');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->nama = '';
        $this->nip = '';
        $this->mapel = '';
        $this->jenis_kelamin = '';
        $this->alamat = '';
        $this->kelas_id = '';
        $this->guru_id = null;
        $this->isEdit = false;
    }
}
