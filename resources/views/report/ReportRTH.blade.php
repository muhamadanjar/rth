@extends('app')
@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Laporan Kondisi RTH Kota Bogor</div>
		<div class="panel-body">
		
        <div class="row">&nbsp;</div>
		<div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover" id="datatable4">
                    <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-4">Nama RTH</th>
                            <th class="col-md-1">Kelompok RTH</th>
                            <th class="col-md-2">Kelurahan</th>
                            <th class="col-md-2">Jenis RTH</th>
                            <th class="col-md-2">Luas M<sup>2</sup></th>                       
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($kotbogor as $key => $rth)
                        {{-- */$a=$key+1;/* --}}
                        <tr>
                            <td>{{ $a }}</td>
                            <td> {{ $rth->nama_rth }}</td>
                            <td> {{ $rth->kelompok_rth }}</td>
                            <td> {{ $rth->kelurahan }}</td>
                            <td> {{ $rth->jenis_rth }}</td>
                            <td> {{ number_format($rth->luas_m2) }}</td>
                                      
                        </tr>
                        
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total :</td>
                            <td>{{ number_format($total) }}</td>
                                      
                        </tr>              
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