@extends('bawaslu.layouts.master')

@section('title')
Surat
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Surat</h1>
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
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">DataTable Surat</h3>
          <a href="{{route('surat.create')}}" class="btn btn-primary float-right">Tambah</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if ($message = Session::get('sukses'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div>
          @endif
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Tempat Tugas</th>
                <th>Kategori</th>
                <th>Mulai Dari</th>
                <th>Sampai Dengan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
           
              <tr>
                <td>1</td>
                <td>Nama</td>
                <td>Jabatan</td>
                <td>Tempat Tugas</td>
                <td>Kategori</td>
                <td>Mulai Dari</td>
                <td>Sampai Dengan</td>
                <td>Aksi</td>
                {{-- <td>{{$course->title}}</td>
                <td>{{$course->category->name}}</td>
                <td>{{$course->price}}</td>
                <td>{{auth()->user()->name}}</td>
                <td><img src="{{ asset('images/course/' .  $course->image )}}" width="50px" height="50px" alt=""></td>
                <td>
                  <a href="{{ route('pegawai.edit', $course->id)}}" class="btn btn-success"><i
                      class="fas fa-pen"></i></a>
                  <a href=" {{route('show_courses', $course->slug)}}" class="btn btn-info"><i
                      class="fas fa-eye"></i></a>
                  <a href="{{route('pegawai.destroy', $course->id)}}" class="btn btn-danger"
                    onclick="return confirm('apa anda yakin ingin menghapus ?' )"><i class="fas fa-trash"></i></a>

                </td> --}}
              </tr>
             
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
</section>
<!-- /.content -->
@endsection