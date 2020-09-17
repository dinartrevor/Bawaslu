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
          <form method="POST" action="{{ route('surat.update', $letters) }}" enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Mulai Dari : </label>
                  <input type="date" class="form-control" name="start_date" value="{{$letters->start_date}}">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Sampai Dengan :</label>
                  <input type="date" class="form-control" name="end_date" value="{{$letters->end_date}}">
                </div>
              </div>
              <div class=" form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Bulan :</label>
                  <input type="number" class="form-control" name="month" value="{{$letters->month}}" min="1" max="12">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Tahun :</label>
                  <input type="number" class="form-control" name="year" value="{{$letters->year}}">
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-form-label">Tempat Tugas:</label>
                <input id="name" type="text" class="form-control @error('place_duty') is-invalid @enderror"
                  name="place_duty" autofocus value="{{$letters->place_duty}}">

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
                  <option value="Coklit" {{$letters->category == 'Coklit' ? 'selected' : ""}}>Surat Coklit</option>
                  <option value="Biasa" {{$letters->category == 'Biasa' ? 'selected' : ""}}>Surat Biasa</option>
                  <option value="Faktual" {{$letters->category == 'Faktual' ? 'selected' : ""}}>Surat Faktual</option>
                </select>

                @error('category')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror

              </div>
              @if($letters->category == 'Coklit')
              <div class="form-group">
                <label for="comment">Ketarangan A :</label>
                <textarea class="form-control" rows="5" id="information_a" name="information_a">
                {{$letters->information_a}}
                  </textarea>
              </div>
              <div class="form-group">
                <label for="comment">Keterangan B :</label>
                <textarea class="form-control" rows="5" id="information_b" name="information_b">
                  {{$letters->information_b}}
                </textarea>
              </div>
              @elseif($letters->category === 'Faktual')
              <div class="form-group">
                <label for="comment">Ketarangan A :</label>
                <textarea class="form-control" rows="5" id="information_a" name="information_a">
                  {{$letters->information_a}}
                  </textarea>
              </div>
              <div class="form-group">
                <label for="comment">Keterangan B :</label>
                <textarea class="form-control" rows="5" id="information_b" name="information_b">
                  {{$letters->information_b}}
                </textarea>
              </div>
              @else
              <div class="form-group">
                <label for="comment">Ketarangan A :</label>
                <textarea class="form-control" rows="5" id="information_a" name="information_a">
                  {{$letters->information_a}}
                  </textarea>
              </div>
              <div class="form-group">
                <label for="comment">Keterangan B :</label>
                <textarea class="form-control" rows="5" id="information_b" name="information_b">
                  {{$letters->information_b}}
                </textarea>
              </div>
              @endif
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
                      @if($letters->id)
                      @foreach ($employees as $employee)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->position}}</td>
                        <td><input type="checkbox" name="employee_id[]" @foreach($relations as $a=>$value)
                          {{$employee->id==$value->employee_id ? 'checked':''}} @endforeach value="{{$employee->id}}">
                        </td>
                      </tr>
                      @endforeach
                      @else

                      @endif
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