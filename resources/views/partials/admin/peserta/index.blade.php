@extends('partials.admin.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Peserta Ujian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Peserta Ujian</li>
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
                            <button class="btn btn-primary btn-sm mr-2 ml-auto"><a href="{{ route('create.peserta') }}"
                                class="text-decoration-none text-white">
                                <i class="fa-solid fa-plus"></i> Tambah
                            </a>
                        </button>
                            <!-- Tombol Kirim Notifikasi -->
                            <form action="{{ route('send-notif') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Kirim <i class="fa-brands fa-whatsapp"></i></button>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NRP</th>
                                        <th>Nama</th>
                                        <th>Tempat & Tanggal Lahir</th>
                                        <th>Whatsapp</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $key => $peserta)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $peserta->nrp }}</td>
                                            <td>{{ $peserta->name }}</td>
                                            <td>{{ $peserta->tempat_lahir }}, {{ Carbon\Carbon::parse($peserta->tanggal_lahir)->format('d-m-Y') }}</td>
                                            <td>{{ $peserta->nomor_wa }}</td>
                                            <td>
                                                <a href="{{ route('edit.peserta', $peserta->id) }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>edit</a>
                                            </td>
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
