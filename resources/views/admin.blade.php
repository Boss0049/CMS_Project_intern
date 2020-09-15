<!DOCTYPE html>
<html>
<head>
	<title>test title</title>
	<!-- CSRF Token -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//cdn.quilljs.com/1.2.2/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
</head>
<body>
	<div id="app">
		<admin></admin>
	</div>
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>