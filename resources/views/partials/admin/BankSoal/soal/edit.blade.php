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
                        <form action="{{ route('update.soal', ['id' => $soal->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="kategori_soal" id="kategori_soal" class="select2" multiple="multiple"
                                        data-placeholder="Select a State" style="width: 100%;">
                                        @foreach ($kategori_soal as $kategori)
                                            <option value="{{ $kategori->id }}"
                                                {{ $kategori->id == $soal->kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="soal">Soal</label>
                                    <textarea id="summernote" name="soal">{{ old('soal', $soal->soal) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_a">Pilihan A</label>
                                    <input type="text" class="form-control" name="pilihan_a" id="pilihan_a"
                                        value="{{ old('pilihan_a', $soal->pilihan_a) }}">
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_b">Pilihan B</label>
                                    <input type="text" class="form-control" name="pilihan_b" id="pilihan_b"
                                        value="{{ old('pilihan_b', $soal->pilihan_b) }}">
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_c">Pilihan C</label>
                                    <input type="text" class="form-control" name="pilihan_c" id="pilihan_c"
                                        value="{{ old('pilihan_c', $soal->pilihan_c) }}">
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_d">Pilihan D</label>
                                    <input type="text" class="form-control" name="pilihan_d" id="pilihan_d"
                                        value="{{ old('pilihan_d', $soal->pilihan_d) }}">
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_e">Pilihan E</label>
                                    <input type="text" class="form-control" name="pilihan_e" id="pilihan_e"
                                        value="{{ old('pilihan_e', $soal->pilihan_e) }}">
                                </div>
                                <div class="form-group">
                                    <label for="jawaban_benar">Jawaban Benar</label>
                                    <input type="text" class="form-control" name="jawaban_benar" id="jawaban_benar"
                                        value="{{ old('jawaban_benar', $soal->jawaban_benar) }}">
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
