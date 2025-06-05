@extends('partials.admin.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengaturan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengaturan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Pengaturan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('setting-store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div id="setting-container">
                                    <div class="row setting-row mb-2">
                                        <div class="col-md-6">
                                            <label>Kategori Soal</label>
                                            <select name="kategori_soal_id[]" class="form-control" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jumlah Soal</label>
                                            <input type="number" name="jumlah_soal[]" class="form-control" required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger remove-row">Hapus</button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" id="add-row" class="btn btn-secondary mb-3">Tambah
                                    Kategori</button>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('setting-index') }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
    <script>
        document.getElementById('add-row').addEventListener('click', function() {
            const container = document.getElementById('setting-container');
            const row = container.querySelector('.setting-row').cloneNode(true);

            row.querySelectorAll('input').forEach(input => input.value = '');
            row.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

            container.appendChild(row);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                const container = document.getElementById('setting-container');
                if (container.querySelectorAll('.setting-row').length > 1) {
                    e.target.closest('.setting-row').remove();
                }
            }
        });
    </script>
@endpush
