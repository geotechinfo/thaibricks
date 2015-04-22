@extends('layouts.default')
@section('content')

	<div class="container">
		<div class="gap30"></div>
		<div class="panel">
			<div class="panel-body">
				<div class="text-center missingPage">
					<h1 class="fontthin">404</h1>
					<div class="gap20"></div>
					<h4 class="bold">Page not found</h4>
					<div class="gap10"></div>
					<p class="noMargin">Looks like the page you are trying to visit does not exist.</p>
					<p>Please check the URL and try again.</p>
					<div class="gap10"></div>
					<a href="{{URL::action('PagesController@index')}}" class="btn orange btn-lg">Take me home</a>
					<div class="gap30"></div>
				</div>
			</div>
		</div>
	</div>

@stop