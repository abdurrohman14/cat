@extends('partials.admin.main')
@section('content')
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">DataTable with default features</h3>
                            <button class="btn btn-primary btn-sm ml-auto"><a href="{{ route('setting-create') }}"
                                    class="text-decoration-none text-white">
                                    <i class="fa-solid fa-plus"></i> Tambah
                                </a>
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        {{-- <th>Jadwal Ujian</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th> --}}
                                        <th>Jumlah Soal</th>
                                        <th>Durasi</th>
                                        {{-- <th>Aksi</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($setting as $key => $pengaturan)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            {{-- <td>{{ Carbon\Carbon::parse($pengaturan->jadwal)->format('d F Y') }}</td>
                                            <td>{{ $pengaturan->waktu_mulai }}</td>
                                            <td>{{ $pengaturan->waktu_selesai }}</td> --}}
                                            <td>{{ $pengaturan->jumlah_soal }}</td>
                                            <td>{{ $pengaturan->durasi }}</td>
                                            {{-- <td>
                                                <a href="{{ route('setting-edit', $pengaturan->id) }}" class="btn btn-info btn-sm"><i
                                                        class="fas fa-pencil-alt"></i>edit</a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
