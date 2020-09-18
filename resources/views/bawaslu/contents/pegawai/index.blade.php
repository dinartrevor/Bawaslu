@extends('bawaslu.layouts.master')

@section('title')
Pegawai
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Pegawai</h1>
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
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">DataTable Pegawai</h3>
          <a href="{{route('pegawai.create')}}" class="btn btn-primary float-right">Tambah</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if ($message = Session::get('sukses'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div>
          @endif
          <table id="example1" class="table table-bordered table-hover text-center">
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
                <td>
                  <a href="{{ route('pegawai.edit', $data->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                  <div class="btn-group btn-group-sm">
                    <form action="{{ route('pegawai.destroy' , $data->id)}}" method="POST">
                      <input name="_method" type="hidden" value="DELETE">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Apakah Anda yakin untuk menghapus')"><i
                          class="fas fa-trash"></i></button>
                    </form>
                  </div>
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
</section>
<!-- /.content -->
@endsection