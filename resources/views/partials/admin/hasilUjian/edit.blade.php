@extends('partials.admin.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>General Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">General Form</li>
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
                            <h3 class="card-title">Quick Example</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('update.hasil', ['id' => $hasilUjian->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Peserta</label>
                                    <input type="text" class="form-control" value="{{ $hasilUjian->user->name }}"
                                        disabled>
                                    <input type="hidden" name="user_id" value="{{ $hasilUjian->user->id }}">
                                </div>

                                <div class="form-group">
                                    <label>Skor</label>
                                    <input type="number" id="skor" name="skor" class="form-control"
                                        value="{{ $hasilUjian->skor }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" id="status" class="form-control"
                                        value="{{ $hasilUjian->status }}" disabled>
                                </div>

                                <input type="hidden" name="status" id="status_hidden" value="{{ $hasilUjian->status }}">
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="submit" class="btn btn-danger"><a href="{{ route('hasil') }}"
                                        class="text-decoration-none text-white">Kembali</a></button>
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

    <script>
        document.getElementById('skor').addEventListener('input', function() {
            let skor = parseInt(this.value);
            let statusField = document.getElementById('status');
            let statusHidden = document.getElementById('status_hidden');

            if (skor >= 61) {
                statusField.value = "Lulus";
                statusHidden.value = "Lulus";
            } else {
                statusField.value = "Tidak Lulus";
                statusHidden.value = "Tidak Lulus";
            }
        });
    </script>
@endsection
