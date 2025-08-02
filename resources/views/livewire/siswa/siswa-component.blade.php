<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h4>{{ $isEdit ? 'Edit Siswa' : 'Tambah Siswa' }}</h4>
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" wire:model="nama" class="form-control @error('nama') is-invalid @enderror">
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text" wire:model="nis" class="form-control @error('nis') is-invalid @enderror">
                    @error('nis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select wire:model="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                        <option value="">Pilih</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea wire:model="alamat" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <select wire:model="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror">
                        <option value="">Pilih Kelas</option>
                        @foreach ($dataKelas as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                    @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
            <input type="text" wire:model.defer="search" class="form-control" placeholder="Cari nama siswa...">
        </div>
        <div class="col-md-3">
            <select wire:model="sort" class="form-select">
                <option value="asc">Urut A-Z</option>
                <option value="desc">Urut Z-A</option>
            </select>
        </div>
        <div class="col-md-3">
            <button wire:click="applySearch" class="btn btn-primary">Cari</button>
            <button wire:click="resetSearch" class="btn btn-secondary">Reset</button>
        </div>
    </div>

    <!-- ✅ Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataSiswa as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->nis }}</td>
                        <td>{{ $siswa->kelas->nama_kelas }}</td>
                        <td>
                            <button wire:click="edit({{ $siswa->id }})" class="btn btn-sm btn-warning">Edit</button>
                            <button wire:click="delete({{ $siswa->id }})" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data siswa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
