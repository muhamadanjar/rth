@extends('app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">{{ $title }}</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                 @if ($errors->has())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>        
                    @endforeach
                </div>
                @endif
               
            </div>
        </div>             
        <div class="row">
            <div class="col-md-2"><a href="layer-new-layer"><button class="btn btn-sm btn-primary">Tambah</button></a></div>
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
                            <th>Nama Layer</th>
                            <th>Layer</th>
                            <th>Type</th>
                            <th>Layer URL</th>
                            <th> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($layers as $key => $value)
                        <tr>
                            <td><a href="layer/edit/{!! $value->id_layer !!}"><i class="fa fa-pencil-square-o"></i></a> 
                            <a href="layer/delete/{!! $value->id_layer !!}"><i class="fa fa-trash-o"></i></a>
                            <a href="layerinfo/{!! $value->id_layer !!}"><i class="fa fa-bars"></i></a></td>
                            <td> {{ $value->layername }}</td>
                            <td>{{ substr($value->layer,0,10) }}</td>
                            <td>{{ $value->tipelayer }}</td>
                            <td><a href="{{ $value->layerurl }}">{{ substr($value->layerurl,5,30) }}</a></td>
                            <td>{{ $value->na }}</td>
                        </tr>
                        @endforeach              
                    </tbody>                  
                </table>
            </div>
        </div>
    </div>
</div>
@stop