@extends('app')
@section('content')


         <input type="hidden" name="_token" value="{{ csrf_token() }}">
			   <!-- START row-->
            <div class="row">
               <div class="col-lg-12">
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
                           
                           <div id="container-chart"></div>
                        </div>
                     </div>
                  </div>
               </div>

               
               
            </div>
            <!-- END row-->
            <div class="row">
               <div class="col-lg-12">
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
                                        <th>Kelompok {{ $jenislaporan }}</th>
                                        <th>Jumlah M<sup>2</sup></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 
                                    @foreach(json_decode($json) as $key => $value)
                                       <tr>
                                           <th>{{ $value->name[0] }}</th>
                                           <th>{{ number_format($value->data[0]) }}</th>
                                       </tr>
                                    @endforeach
                                    
                                           
                                 </tbody>                  
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <script type="text/javascript">
            	$(function() {
			        var options = {
			            chart: {
			                renderTo: 'container-chart',
			                type: 'column'
			            },
			            title:{
			            	text: '',
			            },
                     legend: {
                        enabled: false
                     },
			            xAxis: {
		                    categories: ['Taman']
		                },
		                yAxis: {
		                    title: {
		                        text: 'Luas M<sup>2</sup>'
		                    },
		                },
			            series: [],
			            credits: {
			                enabled: false
			            },
			        };
			        options.title.text = 'RTH Kota';
			        var json = {!! $json !!};
			        options.series = json;
			        var chart = new Highcharts.Chart(options);
			        
			       
			        
			    });
            </script>
           
@endsection
@stop