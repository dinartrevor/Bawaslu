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
          <table id="example1" class="table table-bordered table-hover table-responsive text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Mulai Dari</th>
                <th>Sampai Dengan</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Jabatan</th>

                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($letters as $data)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td style="width: 20%;">{{ showDateTime($data->start_date, 'd F Y') }}</td>
                <td style="width: 20%;">{{ showDateTime($data->end_date, 'd F Y') }}</td>
                <td><a href="#" data-toggle="modal" data-target="#keterangan_{{$data->id}}">Surat
                    {{ $data->category }}</a>
                </td>
                <td>
                  <ul>
                    @foreach($data->employee as $h)
                    <li> {{ $h->name }} </li>
                    @endforeach
                  </ul>
                </td>
                <td>
                  <ul>
                    @foreach($data->employee as $h)
                    <li> {{ $h->position }} </li>
                    @endforeach
                  </ul>
                </td>
                <td style="width: 30% !important;">
                  <a href="{{ route('surat.edit', $data->id)}}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                  <a href="{{ route('cetak_surat', $data->id)}}" class="btn btn-primary" target="_blank"><i
                      class="fas fa-upload"></i></a>
                  <div class="btn-group btn-group-sm">
                    <form action="{{ route('surat.destroy' , $data->id)}}" method="POST">
                      <input name="_method" type="hidden" value="DELETE">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Apakah Anda yakin untuk menghapus')"><i
                          class="fas fa-trash"></i></button>
                    </form>
                  </div>
                </td>
                <div class="modal fade" id="keterangan_{{$data->id}}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Keterangan Surat {{$data->category}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        @if($data->category === 'Coklit')
                        <strong>Keterangan Poin A</strong>
                        <p>{{$data->information_a}}</p>
                        <strong>Keterangan Poin B</strong>
                        <p>{{$data->information_b}}</p>
                        @elseif($data->category === 'Faktual')
                        <strong>Keterangan Poin A</strong>
                        <p>{{$data->information_a}}</p>
                        <strong>Keterangan Poin B</strong>
                        <p>{{$data->information_b}}</p>
                        @else
                        <strong>Keterangan Poin A</strong>
                        <p>{{$data->information_a}}</p>
                        <strong>Keterangan Poin B</strong>
                        <p>{{$data->information_b}}</p>
                        @endif
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                      </div>
                    </div>
                  </div>
                </div>
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