<!DOCTYPE html>
<html>
<head>
	<title>Data KTP</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
 
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<div class="container">
		<center>
			<h4>Data KTP</h4>
		</center>
		<br/>
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>NIK</th>
                    <th>Nama</th>
                    <th>TTL</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Agama</th>
                    <th>Status</th>
                    <th>Pekerjaan</th>
                    <th>Kewarganegaraan</th>
                    <th>Berlaku Sampai</th>
                    <th>Foto KTP</th>
				</tr>
			</thead>
			<tbody> 
				@php $i=1 @endphp
				@foreach($data as $dt)
                <?php
                    $awal  = date_create($dt->tanggal_lahir);
                    $akhir = date_create(); // waktu sekarang
                    $diff  = date_diff( $awal, $akhir );
                ?>
				<tr>
					<td>{{ $i++ }}</td>
                    <td>{{$dt->nik}}</td>
                    <td>{{$dt->nama}}</td>
                    <td>{{$dt->tempat}}, {{ date("j F Y", strtotime($dt->tanggal_lahir)); }}</td>
                    <td>{{ $diff->y }}</td>
                    <td>{{$dt->jenis_kelamin}}</td>
                    <td>{{$dt->alamat}}</td>
                    <td>{{$dt->agama}}</td>
                    <td>{{$dt->status}}</td>
                    <td>{{$dt->pekerjaan}}</td>
                    <td>{{$dt->kewarganegaraan}}</td>
                    <td>{{$dt->berlaku}}</td>
                    <td>{{$dt->foto}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
 
	</div>
 
</body>
</html>