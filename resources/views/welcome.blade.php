<html>
	<head>
		<title>Ruang Terbuka Hijau Kota Bogor</title>
		
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<!-- Bootstrap CSS-->
   		{!! Html::style('vendor/bootstrap/css/bootstrap.min.css') !!}
   		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
   		<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
   		<link rel="icon" href="images/kotabogor.png" />
	</head>
	<body>
		<div class="account">
		<div class="container">

			
			<div></div>
	    	
			<div class="row tengah">
				<div class="col-sm-offset-3 col-sm-6 col-md-4 col-md-offset-4">
					<div class="account-wall">
						<img src="{{ asset('images/simtaru_splash_03_00.png') }}"  class="img-responsive" alt="Kota Bogor">
						<img src="{{ asset('images/simtaru_splash_03_01.png') }}"  class="img-responsive" alt="Kota Bogor">
					</div>
					<a href="{{ action('MapController@index') }}"><button class="btn btn-lg btn-simtaru btn-block ladda-button">Mulai</button></a>
				</div>
			</div>
			
			
		</div>
		</div>
		<!-- Main vendor Scripts-->
		<script src="vendor/jquery/jquery.min.js"></script>
    	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
