@extends('app')
@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Laporan Kondisi RTH Kota Bogor</div>
		<div class="panel-body">
		
        <div class="row">&nbsp;</div>
		<div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover" id="datatable2">
                    <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-4">Nama Taman</th>
                            <th class="col-md-1">Kelompok Taman</th>
                            <th class="col-md-2">Kelurahan</th>
                           	<th class="col-md-2">Luas M2</th>
                            <th class="col-md-2">Jenis Taman</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($kotbogor as $key => $rth)
                        {{-- */$a=$key+1;/* --}}
                        <tr>
                            <td>{{ $a }}</td>
                            <td> {{ $rth->nama_taman }}</td>
                            <td> {{ $rth->kelompok_taman }}</td>
                            <td> {{ $rth->kelurahan }}</td>
                            <td> {{ $rth->luas_m2 }}</td>
                            <td> {{ $rth->jenis_taman }}</td>
                                      
                        </tr>
                        @endforeach              
                    </tbody>                  
                </table>
            </div>
            <div class="col-md-12">
                <a href="report-rth-titik-excel-{{ date('YmdHis') }}"><button class="btn btn-success">Excel</button></a>
            </div>
        </div>
        </div>
    </div>
@stop