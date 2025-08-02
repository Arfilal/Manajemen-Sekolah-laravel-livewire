<div class="container">
    <h4>Daftar Guru di Kelas {{ $kelas->nama_kelas }}</h4>
    <a href="{{ route('guru.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama Guru</th>
                <th>Mata Pelajaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataGuru as $index => $guru)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $guru->nama }}</td>
                    <td>{{ $guru->mapel }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada guru di kelas ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
