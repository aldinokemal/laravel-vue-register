<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="baseurl" content="{{ url('/') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration</title>
	<link rel="stylesheet" href="/css/semantic.min.css">
</head>
<body>
	<div id="app">
		<registration></registration>	
	</div>

	<script src="js/app.js"></script>
	<script src="js/semantic.min.js"></script>
</body>
</html>