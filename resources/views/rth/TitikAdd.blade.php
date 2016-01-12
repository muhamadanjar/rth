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
                        <input type="hidden" id="objectid" name="objectid" value="{{ $objectid }}">
                        <input name="url_feature" id="url_feature" type="hidden" 
                        value="http://localhost:6080/arcgis/rest/services/Point/FeatureServer/0">
                        <div class="form-group">
                            <label for="nama_taman" class="col-md-1 control-label">Nama Taman</label>
                            <div class="col-md-3">
                                <input name="nama_taman" id="nama_taman" class="form-control" value="" />
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label for="kelompok_taman" class="col-md-1 control-label">Layer Name</label>
                            <div class="col-md-2">
                                    
                                    <select name="kelompok_taman" id="kelompok_taman" class="form-control">
                                        <option>-------------</option>
                                        <option value="Pasif">Pasif</option>
                                        <option value="Aktif">Aktif</option>
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
                            <label for="luas_m2" class="col-md-1 control-label">Luas</label>
                            <div class="col-md-3">
                                <input name="luas_m2" id="luas_m2" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_taman" class="col-md-1 control-label">Jenis Tanaman</label>
                            <div class="col-md-5">
                                <select name="jenis_taman" id="jenis_taman" class="form-control">
                                <option value="">---------------</option>
                                @foreach($jenis_taman as $key => $tnm)
                                        <option value="{{ $tnm->jenis_taman }}">{{ $tnm->jenis_taman}}</option>
                                @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kordinat" class="col-md-1 control-label">Kordinat</label>
                            <div class="col-md-3">
                                <input name="koordinat_x" id="koordinat_x" type="text" class="form-control" />
                                <input name="koordinat_y" id="koordinat_y" type="text" class="form-control" />
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
                                <input name="vegetasi" id="vegetasi" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="furniture" class="col-md-1 control-label">Furniture</label>
                            <div class="col-md-3">
                                <input name="furniture" id="furniture" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tahun_survey" class="col-md-1 control-label">Tahun</label>
                            <div class="col-md-3">
                                <input name="tahun_survey" id="tahun_survey" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kepemilikan_lahan" class="col-md-1 control-label">Status Kepemilikan</label>
                            <div class="col-md-5">
                                <input name="kepemilikan_lahan" id="kepemilikan_lahan" class="form-control" value=""/>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-11 col-md-offset-1">
                                <button type="reset" class="btn btn-default">Reset</button>
                                <button type="button" class="btn btn-primary btn-simpan">Submit</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <script type="text/javascript" src="{{ asset('3.12compact/init.js')}}"></script>
                    <script type="text/javascript" src="{{ asset('js/master.js')}}"></script>
                 

                    
                    
            </div>
        </div>
    </div>
</div>
@stop