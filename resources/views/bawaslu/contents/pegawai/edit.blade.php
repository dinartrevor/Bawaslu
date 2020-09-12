@extends('bawaslu.layouts.master')

@section('title')
Admin|Pegawai|Tambah
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Pegawai</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Pegawai</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Pegawai</h3>
          </div>
          <form method="POST" action="{{ route('pegawai.store') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name" class="col-form-label">Name:</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                  value="{{ old('name') }}" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                
              </div>
              <div class="form-group">
                <label for="name" class="col-form-label">Jabatan:</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="position"
                  value="{{ old('name') }}"  autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                
              </div>
              <div class="card-footer">
                <a href="{{route('pegawai.index')}}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection