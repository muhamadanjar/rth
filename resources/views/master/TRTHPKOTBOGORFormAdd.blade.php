@extends('app')
@section('content')
                    @if ($errors->any())
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            Semua data harus di isi
                        </div>
                    @else
                        <div class="alert alert-dismissible alert-info">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            
                        </div>
                    @endif
{!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data','data-parsley-validate' => '' ,'novalidate'=>'' ]) !!}
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
    <input name="url_feature" id="url_feature" type="hidden" value="http://localhost:6080/arcgis/rest/services/Point/FeatureServer/0"> 
    <input name="objectid" id="objectid" value="{{ $objectid }}" type="hidden">
    <div class="form-group">
        {!! Form::label('nama_taman', 'Nama Taman', ['class' => 'col-md-1 control-label']) !!}
        <div class="col-md-3">
            {!! Form::text('nama_taman', null, ['id' => 'nama_taman','class' => 'form-control', 'placeholder' => "Nama taman "]) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="kelompok_taman" class="col-md-1 control-label">Layer Name</label>
        <div class="col-md-2">
                
                <select name="kelompok_taman" id="kelompok_taman" class="form-control">
                    <option>-------------</option>
                    <option value="P">P</option>
                    <option value="A">A</option>
                </select>
        </div>
    </div>
    <div class="form-group">
        <label for="kelurahan" class="col-md-1 control-label">kelurahan</label>
        <div class="col-md-8">
                {!! Form::text('kelurahan', null, ['id' =>'kelurahan', 'class' => 'form-control', 'placeholder' => "Kelurahan"]) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="luas_m2" class="col-md-1 control-label">Luas</label>
        <div class="col-md-3">
                {!! Form::text('luas_m2', null, ['id' =>'luas_m2','class' => 'form-control', 'placeholder' => "Luas", 'data-parsley-type' =>"number"]) !!}
        </div>
    </div>
    
   
                        
    <div class="form-group">
        <label for="koordinat_x" class="col-md-1 control-label">Kordinat X</label>
        <div class="col-md-4">
                {!! Form::text('koordinat_x', null, ['id' =>'koordinat_x', 'class' => 'form-control', 'placeholder' => "Koordinat X"]) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="koordinat_y" class="col-md-1 control-label">Kordinat Y</label>
        <div class="col-md-4">
                {!! Form::text('koordinat_y', null, ['id' =>'koordinat_y', 'class' => 'form-control', 'placeholder' => "Kordinat Y"]) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="jenis_taman" class="col-md-1 control-label">Jenis Taman</label>
        <div class="col-md-8">
                {!! Form::text('jenis_taman', null, ['id' =>'jenis_taman', 'class' => 'form-control', 'placeholder' => "Jenis Taman"]) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="image_link" class="col-md-1 control-label">Image</label>
        <div class="col-md-8">
                {!! Form::text('image_link', null, ['id' =>'image_link', 'class' => 'form-control', 'placeholder' => "Image"]) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-11 col-md-offset-1">
            <button type="button" class="btn btn-default btn-clear">Reset</button>
            <button type="button" class="btn btn-primary btn-simpan">Submit</button>
        </div>
    </div>


                        
{!! Form::close() !!}
@stop