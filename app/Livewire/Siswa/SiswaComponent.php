<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaComponent extends Component
{
    use WithPagination;

    public $nama, $nis, $jenis_kelamin, $alamat, $kelas_id;
    public $siswa_id;
    public $isEdit = false;

    public $search = '';
    public $sort = 'asc';
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $dataSiswa = Siswa::with('kelas')
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nama', $this->sort)
            ->paginate(10);

        return view('livewire.siswa.siswa-component', [
            'dataSiswa' => $dataSiswa,
            'dataKelas' => Kelas::all(),
        ])->layout('layouts.app', ['header' => 'Manajemen Siswa']);
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
            'nis' => 'required|numeric|unique:siswas',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Siswa::create([
            'nama' => $this->nama,
            'nis' => $this->nis,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'kelas_id' => $this->kelas_id,
        ]);

        session()->flash('message', 'Data siswa berhasil ditambahkan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $this->siswa_id = $siswa->id;
        $this->nama = $siswa->nama;
        $this->nis = $siswa->nis;
        $this->jenis_kelamin = $siswa->jenis_kelamin;
        $this->alamat = $siswa->alamat;
        $this->kelas_id = $siswa->kelas_id;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|numeric|unique:siswas,nis,' . $this->siswa_id,
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa = Siswa::findOrFail($this->siswa_id);
        $siswa->update([
            'nama' => $this->nama,
            'nis' => $this->nis,
            'jenis_kelamin' => $this->jenis_kelamin,
            'alamat' => $this->alamat,
            'kelas_id' => $this->kelas_id,
        ]);

        session()->flash('message', 'Data siswa berhasil diperbarui.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Siswa::destroy($id);
        session()->flash('message', 'Data siswa berhasil dihapus.');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->nama = '';
        $this->nis = '';
        $this->jenis_kelamin = '';
        $this->alamat = '';
        $this->kelas_id = '';
        $this->siswa_id = null;
        $this->isEdit = false;
    }
}
