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
                                @php
                                    $pilihan = ['a', 'b', 'c', 'd', 'e'];
                                @endphp
                                @foreach ($pilihan as $item)
                                <div class="form-group">
                                    <label for="pilihan_{{ $item }}">Pilihan {{ strtoupper($item) }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="jawaban_benar" value="{{ $item }}"
                                                    {{ $soal->{'pilihan_' . $item} === $soal->jawaban_benar ? 'checked' : '' }} required>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="pilihan_{{ $item }}"
                                            value="{{ $soal->{'pilihan_' . $item} }}" id="pilihan_{{ $item }}">
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="submit" class="btn btn-danger"><a href="{{ route('index.soal') }}" class="text-decoration-none text-white">Kembali</a></button>
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
