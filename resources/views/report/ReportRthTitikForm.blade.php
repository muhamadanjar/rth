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
                            Error Memproses, Hubungi Administrator
                        </div>
                    @else
                        <div class="alert alert-dismissible alert-info">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                           
                        </div>
                    @endif
                    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                        
                        
                       
                        <div class="form-group">
                            <label for="jenis_rth" class="col-md-1 control-label">Jenis Taman</label>
                            <div class="col-md-5">
                                <select name="jenis_rth" id="jenis_rth" class="form-control">
                                <option value="">---------------</option>
                               	@foreach($jenis_rth as $key => $tnm)
                                     	<option value="{{ $tnm->jenis_rth }}">{{ $tnm->jenis_rth}}</option>
                                @endforeach
                                </select>
                                
                            </div>
                        </div>

                        
                        
                        <div class="form-group">
                            <label for="kelurahan" class="col-md-1 control-label">Kelurahan</label>
                            <div class="col-md-5">
                                 <select name="kelurahan" class="form-control">
                                     <option value="">------</option>
                                     @foreach($kelurahan as $key => $kel)
                                     	<option value="{{ $kel->kelurahan }}">{{ $kel->kelurahan}}</option>
                                     @endforeach
                                 </select>
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label for="kelompok_rth" class="col-md-1 control-label">Kelompok Taman</label>
                            <div class="col-md-3">
                                <select name="kelompok_rth" class="form-control">
                                    <option value="">------</option>
                                    @foreach($kelompok_rth as $key => $klptmn)
                                     	<option value="{{ $klptmn->kelompok_rth }}">{{ $klptmn->kelompok_rth}}</option>
                                	@endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rth" class="col-md-1 control-label">RTH</label>
                            <div class="col-md-3">
                                <select name="rth" class="form-control">                
                                    <option value="publik">Publik</option>
                                    <option value="privat">Privat</option>  
                                </select>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-11 col-md-offset-1">
                                <button type="reset" class="btn btn-default">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                 

                    
                    
            </div>
        </div>
    </div>
</div>
@stop