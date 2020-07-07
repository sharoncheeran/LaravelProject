@yield('header2')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Twin Cities')</title>
	
  <!-- W3 css -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<!-- Bootstrap css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- Our Own css -->
	<link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
	<!-- Bootstrap js -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <!-- Our Own js -->
  <link href ="{{ asset('js/general_functions.js') }}" rel="stylesheet"/>
	<!-- Google's mapping api -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsdrtDALJtCTV0_d15ibpSQroK9HV8ydk"></script>
</head>

<body>

<header>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <a class="navbar-brand" href="#">Twin Cities</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/index">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/twinCity">Twin City</a>
        </li>
      </ul>
    </div>
  </nav>
</header>
    <div class="container">
  <div class="row">
    <div class="col-12 col-sm-12" style="text-align:center;">
      <h1> Student 1 - Martyn Fitzgerald - 16025948</h1>
      <h1> Student 2 - Sharon Cheeran - 17012330</h1>
      <h1> Student 3 - Sharmin J Rony - 16025948</h1>
      <h1> Student 4 - Josh Boyce - 16025948</h1>
    </div>
  </div>
</div>
<!-- Footer -->
<footer>
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 text-muted">
	<span>© 2018 Copyright<a href="/group"> Group: C</a></span>
  </div>
</footer>
</body>
</html>
