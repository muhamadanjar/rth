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
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="objectid" value="{{ $titik->objectid }}">
                        <div class="form-group">
                            <label for="nama_taman" class="col-md-1 control-label">Nama Taman</label>
                            <div class="col-md-3">
                                <input name="nama_rth" id="nama_rth" class="form-control" value="{{ $titik->nama_rth }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kelompok_rth" class="col-md-1 control-label">Kelompok Tanaman</label>
                            <div class="col-md-3">
                                <select name="kelompok_rth" class="form-control">
                                    <option value="0">------</option>
                                    @foreach($kelompok_rth as $key => $klptmn)

                                        @if($klptmn->kelompok_rth == $titik->kelompok_rth)
                                            <option value="{{ $klptmn->kelompok_rth }}" selected="selected">{{ $klptmn->kelompok_rth}}</option>
                                        @else
                                            <option value="{{ $klptmn->kelompok_rth }}">{{ $klptmn->kelompok_rth}}</option>
                                        @endif
                                        
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
                                        @if($kel->kelurahan == $titik->kelurahan)
                                        <option value="{{ $kel->kelurahan }}" selected="selected">{{ $kel->kelurahan}}</option>
                                        @else
                                        <option value="{{ $kel->kelurahan }}">{{ $kel->kelurahan}}</option>
                                        @endif
                                     @endforeach
                                 </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="luas_m2" class="col-md-1 control-label">Luas</label>
                            <div class="col-md-3">
                                <input name="luas_m2" id="luas_m2" class="form-control" value="{{ $titik->luas_m2 }}" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="jenis_rth" class="col-md-1 control-label">Jenis Tanaman</label>
                            <div class="col-md-5">
                                <select name="jenis_rth" id="jenis_rth" class="form-control">
                                <option value="">---------------</option>
                                @foreach($jenis_rth as $key => $tnm)
                                    @if($tnm->jenis_rth == $titik->jenis_rth)
                                    <option value="{{ $tnm->jenis_rth }}" selected="selected">{{ $tnm->jenis_rth}}</option>
                                    @else
                                    <option value="{{ $tnm->jenis_rth }}">{{ $tnm->jenis_rth}}</option>
                                    @endif
                                @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image_link" class="col-md-1 control-label">Image</label>
                            <div class="col-md-3">
                                <input name="image_link" id="image_link" type="file"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vegetasi" class="col-md-1 control-label">Vegetasi</label>
                            <div class="col-md-3">
                                <input name="vegetasi" id="vegetasi" class="form-control" value="{{ $titik->vegetasi }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="furniture" class="col-md-1 control-label">Furniture</label>
                            <div class="col-md-3">
                                <input name="furniture" id="furniture" class="form-control" value="{{ $titik->furniture }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tahun_survey" class="col-md-1 control-label">Tahun</label>
                            <div class="col-md-1">
                                <input name="tahun_survey" id="tahun_survey" class="form-control" value="{{ $titik->tahun_survey }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kepemilikan_lahan" class="col-md-1 control-label">Status Kepemilikan</label>
                            <div class="col-md-3">
                                <input name="kepemilikan_lahan" id="kepemilikan_lahan" class="form-control" value="{{ $titik->kepemilikan_lahan }}"/>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-11 col-md-offset-1">
                                <a href="{{ action('RTHCtrl@TitikList') }}"><button type="submit" class="btn btn-default">Reset</button></a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                 

                    
                    
            </div>
        </div>
    </div>
</div>
@stop