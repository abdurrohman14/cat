@extends('partials.admin.main')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Hasil Ujian</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Hasil Ujian</li>
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
                        {{-- <button class="btn btn-primary btn-sm ml-auto"><a href="{{ route('setting-create') }}"
                                class="text-decoration-none text-white">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                        </button> --}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasilUjian as $key => $hasil)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $hasil->user->name }}</td>
                                        <td class="{{ $hasil->status == 'Lulus' ? 'text-success' : 'text-danger'}}">{{ $hasil->status }}</td>
                                        <td>{{ $hasil->skor }}</td>
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