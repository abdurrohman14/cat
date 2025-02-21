@extends('partials.admin.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Soal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Soal</li>
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
                            <button class="btn btn-primary btn-sm ml-auto"><a href="{{ route('create.soal') }}"
                                    class="text-decoration-none text-white">
                                    <i class="fa-solid fa-plus"></i> Tambah
                                </a>
                            </button>
                            <button class="btn btn-success btn-sm ml-2"><a href="{{ route('upload') }}"
                                    class="text-decoration-none text-white">
                                    <i class="fas fa-upload"></i> Upload
                                </a>
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Soal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($soal as $key => $soals)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $soals->kategori->nama }}</td>
                                            <td>{!! $soals->soal !!}</td>
                                            <td>
                                                <a href="{{ route('edit.soal', ['id' => $soals->id]) }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>edit</a>
                                                <a class="btn btn-danger btn-sm delete-button" data-id="{{ $soals->id }}"
                                                    data-toggle="modal" data-target="#modal-delete">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
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

    <!-- Modal Delete -->
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-delete-label">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus soal ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="delete-form" action="" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.delete-button', function() {
            var id = $(this).data('id');
            var form = $('#delete-form');
            form.attr('action', '/soal/' + id);
        });
    </script>
@endsection
