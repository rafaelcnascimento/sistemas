<!DOCTYPE html>
<html>
<html lang="{{ app()->getLocale() }}">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">

	    <title>404</title>

	    <!-- Styles -->
	    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
	    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	    <style type="text/css">
	    	.erro404{
	    		margin-top: 20%;
	    	}
	    </style>
	</head>
<body>
	<center>
		<div class="erro404">
			<h1>Essa página não existe</h1>
		</div>	
		
	</center>
</body>
</html>
