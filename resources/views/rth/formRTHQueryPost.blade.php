@extends('app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">RTH</div>
        <div class="panel-body">
        <div class="row">
            <div class="col-md-2"></div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover" id="datatable2">
                    <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-4">Nama RTH</th>
                            <th class="col-md-1">Kelompok RTH</th>
                            <th class="col-md-4">Kelurahan</th>
                            <th class="col-md-1">Luas</th>
                            <th class="col-md-4">Jenis RTH</th>
                            <th class="col-md-4">Image</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($kotbogor as $key => $rth)
                        <tr>
                            <td data-toggle="notify" data-message="Kordinat X,Y <br>{{ $rth->koordinat_x }} , {{ $rth->koordinat_x }}  ..">#</td>
                            <td> {{ $rth->nama_rth }}</td>
                            <td> {{ $rth->kelompok_rth }}</td>
                            <td> {{ $rth->kelurahan }}</td> 
                            <td> {{ $rth->luas_m2 }}</td>
                            <td> {{ $rth->jenis_rth }}</td>
                            <td><img src="{{ $rth->image_link }}" width="100"></td>  
                                   
                        </tr>
                        @endforeach              
                    </tbody>                  
                </table>
            </div>
        </div>
        </div>
    </div>
@stop