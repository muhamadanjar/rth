@extends('app')
@section('content')


         <input type="hidden" name="_token" value="{{ csrf_token() }}">
			   <!-- START row-->
            <div class="row">
               <div class="col-lg-6">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <a href="#" data-perform="panel-dismiss" data-toggle="tooltip" title="Close Panel" class="pull-right">
                           <em class="fa fa-times"></em>
                        </a>
                        <a href="#" data-perform="panel-collapse" data-toggle="tooltip" title="Collapse Panel" class="pull-right">
                           <em class="fa fa-minus"></em>
                        </a>
                        <div class="panel-title">Ruang terbuka Hijau</div>
                     </div>
                     <div class="panel-collapse">
                        <div class="panel-body">
                           <div style="height: 250px;" data-source="{{ asset('report-rth-array') }}" class="chart-bar flot-chart"></div>
                           <div id="container-chart"></div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-lg-6">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <a href="#" data-perform="panel-dismiss" data-toggle="tooltip" title="Close Panel" class="pull-right">
                           <em class="fa fa-times"></em>
                        </a>
                        <a href="#" data-perform="panel-collapse" data-toggle="tooltip" title="Collapse Panel" class="pull-right">
                           <em class="fa fa-minus"></em>
                        </a>
                        <div class="panel-title">Ruang terbuka Hijau</div>
                     </div>
                     <div class="panel-collapse">
                        <div class="panel-body">
                           <table class="table table-striped table-hover" id="datatable2">
                                 <thead>
                                    <tr>
                                        <th>Kelompok Taman</th>
                                        <th>Jumlah</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                   
                                    
                                    @foreach(json_decode($data_request) as $key => $rk)
                                       <tr>
                                           <th>{{ $rk->kelompok_taman }}</th>
                                           <th>{{ $rk->sum }}</th>
                                       </tr>
                                    @endforeach
                                           
                                 </tbody>                  
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
            <!-- END row-->

           
@endsection
@stop