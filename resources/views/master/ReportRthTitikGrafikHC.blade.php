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
                          
                        </div>
                    @endif
                    {!! Form::open(['id' => 'ReportRTHGrafikHC','class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                        
                        
                        <div class="form-group">
                            <label for="jenistanaman" class="col-md-1 control-label">Jenis Taman</label>
                            <div class="col-md-5">
                                <select name="jenislaporan" id="jenislaporan" class="form-control">
                                <option value="">---------------</option>
                                <option value="kelurahan">Kelurahan</option>
                                <option value="jenistaman">Jenis Taman</option>
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