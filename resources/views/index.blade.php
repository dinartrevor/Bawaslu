@extends('bawaslu.layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
<style>
    .resource {
        background: #FFFFFF;
        border: 1px solid #C4C4C4;
        box-sizing: border-box;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        padding-top: 13px;
        padding-bottom: 20px;
    }
</style>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Total Pegawai</h3>

                    <h4>{{$employee}}</h4>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('pegawai.index')}}" class="small-box-footer">Lihat Detailnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">DataTable Surat</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('sukses'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <table id="example1" class="table table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mulai Dari</th>
                                <th>Sampai Dengan</th>
                                <th>Tempat Tugas</th>
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
                                <td style="width: 20%;">{{date('d-M-Y', strtotime($data->start_date))}}</td>
                                <td style="width: 20%;">{{date('d-M-Y', strtotime($data->end_date))}}</td>
                                <td style="width: 20%;">{{ $data->place_duty }}</td>
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
                                <td>
                                    <a href="{{ route('cetak_surat', $data->id)}}" class="btn btn-primary"><i
                                            class="fas fa-upload"></i></a>
                                </td>
                                <div class="modal fade" id="keterangan_{{$data->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Keterangan Surat
                                                    {{$data->category}}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if($data->category === 'Coklit')
                                                <strong>Keterangan Poin B</strong>
                                                <p>{{$data->information_b}}</p>
                                                @elseif($data->category === 'Faktual')
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
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Kembali</button>
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