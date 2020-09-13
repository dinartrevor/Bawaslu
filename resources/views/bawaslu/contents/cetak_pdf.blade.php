<!DOCTYPE html>
<html>

<head>
  <title>Cetak Surat</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <h5>Bawaslu Export</h5>
  <p>Mulai dari {{$letters->start_date}}</p>
  <p>Sampai dengan {{$letters->end_date}}</p>
  <p>Surat {{$letters->category}}</p>
  <p>Nama {{$letters->employee_name}}</p>
  <p>Jabatan {{$letters->employee_position}}</p>
  @if($letters->category === 'Coklit')
  <strong>Keterangan Poin B</strong>
  <p>{{$letters->information_b}}</p>
  @elseif($letters->category === 'Faktual')
  <strong>Keterangan Poin B</strong>
  <p>{{$letters->information_b}}</p>
  @else
  <strong>Keterangan Poin A</strong>
  <p>{{$letters->information_a}}</p>
  <strong>Keterangan Poin B</strong>
  <p>{{$letters->information_b}}</p>
  @endif
  <p>Bulan Ini {{$letters->month}} </p>
  <p>Tahun Ini{{$letters->year}} </p>

</body>

</html>