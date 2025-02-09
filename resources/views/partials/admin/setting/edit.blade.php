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
                        <form action="{{ route('setting-update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="jadwal">Jadwal</label>
                                    <input type="date" class="form-control" name="jadwal" id="jadwal" placeholder="" value="{{ $setting->jadwal }}">
                                </div>
                                <div class="form-group">
                                    <label for="waktu_mulai">Waktu Mulai</label>
                                    <input type="time" class="form-control" name="waktu_mulai" id="waktu_mulai" placeholder="" value="{{ $setting->waktu_mulai }}">
                                </div>
                                <div class="form-group">
                                    <label for="waktu_selesai">Waktu Selesai</label>
                                    <input type="time" class="form-control" name="waktu_selesai" id="waktu_selesai" placeholder="" value="{{ $setting->waktu_selesai }}">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_soal">Jumlah Soal</label>
                                    <input type="number" class="form-control" name="jumlah_soal" id="jumlah_soal" placeholder="" value="{{ $setting->jumlah_soal }}">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="durasi">Durasi</label>
                                    <input type="number" class="form-control" name="durasi" id="durasi"
                                        placeholder="">
                                </div> --}}
                                <!-- /.card-body -->
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
