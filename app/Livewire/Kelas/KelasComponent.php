<?php

namespace App\Livewire\Kelas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kelas;

class KelasComponent extends Component
{
    use WithPagination;

    public $nama_kelas, $kelas_id;
    public $isEdit = false;

    public $search = '';
    public $sort = 'asc';
    protected $paginationTheme = 'bootstrap';
    public $showModal = false;
    public $guruList = [];
    public $selectedKelasName = '';


    public function render()
    {
        // ✅ Tambahkan relasi guru untuk ditampilkan
        $dataKelas = Kelas::with('guru')
            ->when($this->search, function ($query) {
                $query->where('nama_kelas', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nama_kelas', $this->sort)
            ->paginate(10);

        return view('livewire.kelas.kelas-component', [
            'dataKelas' => $dataKelas,
        ])->layout('layouts.app', ['header' => 'Manajemen Kelas']);
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
            'nama_kelas' => 'required|string|max:255',
        ]);

        Kelas::create(['nama_kelas' => $this->nama_kelas]);
        session()->flash('message', 'Data kelas berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $this->kelas_id = $kelas->id;
        $this->nama_kelas = $kelas->nama_kelas;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate(['nama_kelas' => 'required|string|max:255']);
        $kelas = Kelas::findOrFail($this->kelas_id);
        $kelas->update(['nama_kelas' => $this->nama_kelas]);
        session()->flash('message', 'Data kelas berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Kelas::destroy($id);
        session()->flash('message', 'Data kelas berhasil dihapus.');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->nama_kelas = '';
        $this->kelas_id = null;
        $this->isEdit = false;
    }

    public function showGuru($kelasId)
{
    $kelas = Kelas::with('guru')->find($kelasId);
    $this->guruList = $kelas->guru;
    $this->selectedKelasName = $kelas->nama_kelas;
    $this->showModal = true;
}

public function closeModal()
{
    $this->showModal = false;
    $this->guruList = [];
    $this->selectedKelasName = '';
}

}
