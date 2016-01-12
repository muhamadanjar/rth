@extends('app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">             
        <div class="row">
            <div class="col-md-2"><a href="user-new-user"><button class="btn btn-sm btn-primary">Tambah</button></a></div>
        </div>
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
        </div>
		<div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover" id="datatable2">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level User</th>
              
                        </tr>
                    </thead>
                    <tbody>
                   
                        @foreach ($users as $key => $value)
                        <tr>
                            <td><a href="user/edit/{!! $value->id !!}">Edit</a> || <a href="user/delete/{!! $value->id !!}">Hapus</a></td>
                            <td> {{ $value->username }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->leveluser }}</td>
                          
                        </tr>
                        @endforeach              
                    </tbody>                  
                </table>
            </div>
        </div>
    </div>
</div>

@stop