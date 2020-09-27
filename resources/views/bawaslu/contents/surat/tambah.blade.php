@extends('bawaslu.layouts.master')

@section('title')
Admin|Surat|Tambah
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tambah Surat</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Surat</li>
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
            <h3 class="card-title">Surat</h3>
          </div>
          <form method="POST" action="{{ route('surat.store') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Mulai Dari : </label>
                  <input type="date" class="form-control" name="start_date">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Sampai Dengan :</label>
                  <input type="date" class="form-control" name="end_date">
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-form-label">Tempat Tugas:</label>
                <input id="name" type="text" class="form-control @error('place_duty') is-invalid @enderror"
                  name="place_duty" value="{{ old('place_duty') }}" autofocus>
                @error('place_duty')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="category" class="col-form-label">Pilih Surat:</label>
                <select name="category" id="category" class="form-control">
                  <option value="">Surat</option>
                  <option value="Coklit">Surat Coklit</option>
                  <option value="Biasa">Surat Biasa</option>
                  <option value="Faktual">Surat Faktual</option>
                </select>

                @error('category')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror

              </div>
              <div class="form-group" id="keterangan_a">
                <label for="comment">Ketarangan A :</label>
                <textarea class="form-control" rows="5" id="information_a" name="information_a"></textarea>
              </div>
              <div class="form-group" id="keterangan_b">
                <label for="comment">Keterangan B :</label>
                <textarea class="form-control" rows="5" id="information_b" name="information_b"></textarea>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">DataTable Pegawai</h3>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-hover text-center">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($employees as $data)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->position}}</td>
                        <td><input type="checkbox" name="employee_id[]" value="{{$data->id}}"></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="card-footer">
                <a href="{{route('surat.index')}}" class="btn btn-secondary">Kembali</a>
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