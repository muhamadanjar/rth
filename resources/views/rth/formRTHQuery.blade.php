@extends('app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Form Query</div>
    <div class="panel-body">             
		<div class="row">
            <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            All fields must be filled and an image must be included.
                        </div>
                    @else
                        
                    @endif
                    {!! Form::open(['class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                        
                        
                       
                        <div class="form-group">
                            <label for="jenis_rth" class="col-md-1 control-label">Jenis RTH</label>
                            <div class="col-md-5">
                                <select name="jenis_rth" id="jenis_rth" class="form-control">
                                <option value="">---------------</option>
                               	@foreach($jenis_rth as $key => $jenis_rth)
                                     	<option value="{{ $jenis_rth->jenis_rth }}">{{ $jenis_rth->jenis_rth}}</option>
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
                            <label for="tahun" class="col-md-1 control-label">Tahun</label>
                            <div class="col-md-3">
                                <select name="tahun" class="form-control">
                                    <option value="0">------</option>
                                   	<option value="2012">2012</option>
                                   	<option value="2013">2013</option>
                                   	<option value="2014">2014</option>
                                   	<option value="2014">2014</option>
                                	
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="search" class="col-md-1 control-label">Search</label>
                            <div class="col-md-3">
                                <input name="search" id="search" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sorting" class="col-md-1 control-label">Sorting</label>
                            <div class="col-md-3">
                                <select name="sorting" class="form-control">                
                                   	<option value="kelompok_rth">kelompok taman</option>
                                   	<option value="kelurahan">kelurahan</option>
                                   	<option value="jenis_rth">jenis rth</option>	
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