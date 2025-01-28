@extends('partials.admin.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Soal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Soal</li>
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
                            <h3 class="card-title">Tambah Soal</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('store.soal') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="kategori_soal" id="kategori_soal" class="select2" multiple="multiple"
                                        data-placeholder="Pilih Kategori" style="width: 100%;">
                                        @foreach ($kategori_soal as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="soal">Soal</label>
                                    <textarea id="summernote" name="soal"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_a">Pilihan A</label>
                                    <input type="text" class="form-control" name="pilihan_a" id="pilihan_a"
                                        placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_b">Pilihan B</label>
                                    <input type="text" class="form-control" name="pilihan_b" id="pilihan_b"
                                        placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_c">Pilihan C</label>
                                    <input type="text" class="form-control" name="pilihan_c" id="pilihan_c"
                                        placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_d">Pilihan D</label>
                                    <input type="text" class="form-control" name="pilihan_d" id="pilihan_d"
                                        placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_e">Pilihan E</label>
                                    <input type="text" class="form-control" name="pilihan_e" id="pilihan_e"
                                        placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="jawaban_benar">Jawaban Benar</label>
                                    <input type="text" class="form-control" name="jawaban_benar" id="jawaban_benar"
                                        placeholder="">
                                </div>
                            </div>
                            <!-- /.card-body -->
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
