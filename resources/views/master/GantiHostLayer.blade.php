@extends('app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">             
		<div class="row">
            <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            All fields must be filled and an image must be included.
                        </div>
                    @else
                        <div class="alert alert-dismissible alert-info">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            Ganti Host
                        </div>
                    @endif
                    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {!! Form::label('Url Awal', '', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('urlawal', null, ['class' => 'form-control', 'placeholder' => "Host Lama"]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="layername" class="col-md-1 control-label">URL Baru</label>
                            <div class="col-md-3">
                                 {!! Form::text('urlbaru', null, ['class' => 'form-control', 'placeholder' => "Host Baru"]) !!}
                            </div>
                        </div>
     

                        <div class="form-group">
                            <div class="col-md-11 col-md-offset-1">
                               
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <script type="text/javascript" src="{{ asset('3.12compact/init.js')}}"></script>
                    <script type="text/javascript" src="{{ asset('js/esriGetFields.js') }}"></script>

                    
                    
            </div>
        </div>
    </div>
</div>
@stop