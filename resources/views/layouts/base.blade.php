<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('css-bs/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <title>
      {{-- Khac nhau giua cac trang --}}
      @yield('title')
    </title>
</head>
<body>
     {{-- Header - Giong nhau --}}
     @include('layouts.header')

    
    {{-- Main - Khac nhau --}}
    <div class="container-fluid ">
      @yield('main')
    </div>

    {{-- Footer - Giong nhau --}}
    @include('layouts.footer')

    
    <script>
		// Get the datetime input field
		var datetime = document.getElementById("datetime");
		// Set the default datetime value to the current date and time
		datetime.value = moment().format("YYYY-MM-DDTHH:mm");
	</script>
</body>
</html>