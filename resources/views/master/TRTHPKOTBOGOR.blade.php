@extends('app')
@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">RTH</div>
		<div class="panel-body">
		<div class="row">
            <div class="col-md-2">
            <a href="rth-titik-add"><button class="btn btn-sm btn-primary">Tambah</button></a></div>
        </div>
        <div class="row">&nbsp;</div>
		<div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover" id="datatable2">
                    <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-4">Nama Taman</th>
                            <th class="col-md-1">Kelompok Taman</th>
                            <th class="col-md-6">Kelurahan</th>
                           	
                       
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($kotbogor as $key => $rth)
                        <tr>
                            <td><a href="rth-titik-edit-{!! $rth->objectid !!}"><i class="fa fa-pencil-square-o"></i></a> 
                            <a href="rth-titik-delete-{!! $rth->objectid !!}"><i class="fa fa-trash-o"></i></a>
                            </td>
                            <td> {{ $rth->nama_taman }}</td>
                            <td> {{ $rth->kelompok_taman }}</td>
                            <td> {{ $rth->kelurahan }}</td>          
                        </tr>
                        @endforeach              
                    </tbody>                  
                </table>
            </div>
        </div>
        </div>
    </div>
@stop