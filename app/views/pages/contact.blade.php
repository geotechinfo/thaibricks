@extends('layouts.default')
@section('content')
    <section class="container container2" id="gototopwrap">
		<div class="">
			<div class="innerBread">
				<div class="col-sm-12">
					<span>You are here:</span>
					<ul class="topBreadcrumbs">
						<li><a href="{{URL::action('PagesController@index')}}">Home</a></li>
						<li><a href="javascript:;">Contact Us</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section id="aboutus" class="noMargin">
		<div class="container searchcontent container2">
			<h2>Thaibricks Contact Us</h2>
		 	<address>
		        <span class="fa fa-map-marker"></span> PhraKhanong, Sukhumvit, Bangkok<br>
		        <span class="fa fa-phone"></span> (66) 02 123 4567<br>
		        <span class="fa fa-envelope"></span> info@thaibricks.com<br>
	        </address>
		</div>		
	</section>
@stop