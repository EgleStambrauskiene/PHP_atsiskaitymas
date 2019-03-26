<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ __(config('college.title', __('PHP_final_project'))) }}</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/college.css') }}" rel="stylesheet">
	</head>

	<body>
		<nav class="navbar navbar-expand-md sticky-top navbar-light navbar-laravel mb-4 text-white bg-success" id="nav-affix">
			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}"><span style="color:white">{{ __(config('college.title', __('PHP_final_project'))) }}</span></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">

					{{-- Left Side Of Navbar --}}
					<ul class="navbar-nav mr-auto">
						@guest
						@else
						<li class="nav-item"><a class="nav-link" href="{{ route('students.list') }}">{{ __('Students') }}</a></li>
						<li class="nav-item"><a class="nav-link" href="{{ route('lectures.list') }}">{{ __('Lectures') }}</a></li>
						{{-- <li class="nav-item"><a class="nav-link" href="{{ route('grades.edit') }}">{{ __('Grades') }}</a></li> --}}
						{{-- <li class="nav-item"><a class="nav-link" href="{{ route('grades.edit', ['id' => $student->id]) }}">{{ __('Grades') }}</a></li> --}}
						{{-- @if (Auth::user()->role == 'admin') --}}
							{{-- <li class="nav-item"><a class="nav-link" href="#">{{ __('Users') }}</a></li> --}}
							{{-- @endif --}}
						@endguest
					</ul>

					{{-- Authentication Links --}}
					<ul class="navbar-nav ml-auto">
						@guest
						<li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><span style="color:white">{{ __('Login') }}</span></a></li>
						@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->loginname }}, {{ __(Auth::user()->role) }} <span class="caret"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
								</form>
							</div>
						</li>
						@endguest
						<li class="nav-item">
							<form action="{{ route('lang') }}" method="POST" id="lang-switcher-form">
								<select class="form-control" name="lang" onchange="event.preventDefault;document.getElementById('lang-switcher-form').submit();">
									<option value="lt" {{ (session('lang') == 'lt') ? ' selected' : ''}}>Lt</option>
									<option value="en" {{ (session('lang') == 'en') ? ' selected' : ''}}>En</option>
								</select>
								@csrf
							</form>
						</li>
					</ul>
				</div>
			</div>
		</nav>


		<div class="mb-4">
		@yield('content')
		</div>

		<div class="mb-4">
		@yield('content_lectures')
		</div>

		<footer id="footer">
		@yield('footer')
		</footer>
		<script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
		@yield('scripts')
		@yield('modals')
	</body>
</html>
