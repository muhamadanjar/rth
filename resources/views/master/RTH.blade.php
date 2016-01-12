<div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">             
		<div class="row">
            <div class="col-md-12">
                    <!-- Default table -->
                        <div>
                        <select>
                            @foreach($kelurahan as $kel)
                            <option>{!! $kel->kelurahan !!}</option>
                            @endforeach    
                        </select>
                        </div>
                        <div>
                        <select>
                            @foreach($jnstam as $jns)
                            <option>{!! $jns->jenis_taman !!}</option>
                            @endforeach    
                        </select>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading"><h6 class="panel-title"><i class="icon-table2"></i> Default table</h6></div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Taman</th>
                                            <th>Kelurahan</th>
                                            <th>Luas</th>
                                            <th>Jenis Tanaman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rthtitik as $key => $rth)
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $rth->nama_taman }}</td>
                                            <td>{{ $rth->kelurahan }}</td>
                                            <td>{{ $rth->luas_m2 }}</td>
                                            <td>{{ $rth->jenis_taman }}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- /default table -->

                    
                    
            </div>
        </div>
    </div>
</div>