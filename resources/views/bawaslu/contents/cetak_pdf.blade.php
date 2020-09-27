<!DOCTYPE html>
<html>

<head>
  <title>Cetak Surat {{$letters->category}}</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
  <style>

  </style>
  <div class="container-fluid">
    <img src="{{ public_path('/images/bawaslu.jpeg')}}" style="width: 30%; float: left;">
    <div class="row">
      <div class="col-12 mt-5">
        <br>
        <span style="font-size: 15px;">Jl. Turangga Nomer 25 Bandung 40264</span>
        <br>
        <span style="font-size: 15px;">Telp: (022) 7560358</span>
        <br>
        <span style="font-size: 15px;"> Laman: <a href="">www.bawaslu-jabarprov.go.id</a>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-12">
        <strong style="text-align:center; display: block; ">Surat Tugas</strong>
        <hr width="100px">
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <strong style="text-align:center; display: block; ">No: /BAWASLU PROV.JB/SET/VIII/2020</strong>
        <p style="text-align:center; display: block; ">Kepala Sekretariat Badan Pengawas Pemilihan Umum Provinsi Jawa
          Barat</p>
      </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-3">
        <p>Menimbang :</p>
      </div>
      <div class="col-9 float-right">
        <p>A: {{$letters->information_a}}</p>
        <p>B: {{$letters->information_b}}</p>
      </div>
      <div class="clearfix"></div>
      <div class="col-3">
        <p>Dasar :</p>
      </div>
      <div class="col-9 float-right">
        <p>A: {{$letters->description}}</p>
        <p>B: {{$letters->information_b}}</p>
      </div>
    </div>

  </div>
</body>

</html>