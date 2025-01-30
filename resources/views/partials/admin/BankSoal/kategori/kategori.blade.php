@extends('partials.admin.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kategori</li>
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
                            <button type="button" class="btn btn-primary btn-sm ml-auto" data-toggle="modal"
                                data-target="#modal-tambah">
                                <i class="fa-solid fa-plus"></i> Tambah
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori_soal as $key => $kategori)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $kategori->nama }}</td>
                                            <td>{{ $kategori->deskripsi }}</td>
                                            <td><button class="btn btn-info btn-sm">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </button>
                                                <a class="btn btn-danger btn-sm delete-button" data-id="{{ $kategori->id }}"
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modal-tambah-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-tambah-label">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store.kategori') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-edit-label" aria-hidden="true"
        role="dialog" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-edit-label">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="form-edit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit-nama">Nama</label>
                            <input type="text" name="nama" id="edit-nama" class="form-control"
                                value="">
                        </div>
                        <div class="form-group">
                            <label for="edit-deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="edit-deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    <p>Anda yakin ingin menghapus kategori ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete">Hapus</button>
                    {{-- <form id="delete-form" action="" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.btn-info').on('click', function() {
                const id = $(this).closest('tr').find('.delete-button').data('id'); // Ambil ID dari data-id
                const nama = $(this).closest('tr').find('td:nth-child(2)').text(); // Ambil nama
                const deskripsi = $(this).closest('tr').find('td:nth-child(3)').text(); // Ambil deskripsi

                // Isi form di modal
                $('#edit-nama').val(nama);
                $('#edit-deskripsi').val(deskripsi);

                // Set action form
                $('#form-edit').attr('action', '/kategori-soal/update/' + id);

                // Tampilkan modal
                $('#modal-edit').modal('show');
            });
        });
        $(document).on('click', '.delete-button', function() {
            var id = $(this).data('id');
            var form = $('#delete-form');
            form.attr('action', '/kategori-soal/' + id);

            // Tampilkan SweetAlert untuk konfirmasi
            $('#confirm-delete').of('click').on('click', function() {
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Anda yakin ingin menghapus kategori ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if(result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>
@endsection
