<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h4>{{ $isEdit ? 'Edit Kelas' : 'Tambah Kelas' }}</h4>
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">Nama Kelas</label>
                    <input type="text" wire:model="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror">
                    @error('nama_kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Update' : 'Simpan' }}</button>
                @if ($isEdit)
                    <button type="button" wire:click="cancelEdit" class="btn btn-secondary">Batal</button>
                @endif
            </form>
        </div>
    </div>

    <hr>

    <!-- Pencarian -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Cari nama kelas...">
        </div>
        <div class="col-md-3">
            <select wire:model="sort" class="form-select">
                <option value="asc">Urut A-Z</option>
                <option value="desc">Urut Z-A</option>
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-secondary" wire:click="resetSearch">Reset</button>
        </div>
    </div>

    <!-- ✅ Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataKelas as $index => $kelas)
                    <tr>
                        <td>{{ $dataKelas->firstItem() + $index }}</td>
                        <td>{{ $kelas->nama_kelas }}</td>
                        <td>
                            <button wire:click="edit({{ $kelas->id }})" class="btn btn-sm btn-warning">Edit</button>
                            <button wire:click="delete({{ $kelas->id }})" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                            <button wire:click="showGuru({{ $kelas->id }})" class="btn btn-sm btn-info">Lihat Guru</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data kelas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ✅ Pagination -->
    <div class="mt-3">
        {{ $dataKelas->links() }}
    </div>

    <!-- ✅ Modal Lihat Guru -->
    <div class="modal fade @if($showModal) show d-block @endif" tabindex="-1" style="background: rgba(0,0,0,0.5);" @if($showModal) aria-modal="true" role="dialog" @endif>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Guru di Kelas: {{ $selectedKelasName }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    @if($guruList && count($guruList) > 0)
                        <ul>
                            @foreach($guruList as $guru)
                                <li>{{ $guru->nama }} - {{ $guru->mapel }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Belum ada guru di kelas ini.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
