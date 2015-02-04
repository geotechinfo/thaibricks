@extends('admin.layouts.default')
@section('body')
<!-- /Page Header and Breadcrumb Start -->
<section class="content-header row">
  <h1 class="page-header"> Manage Location <small>locations and transport</small> </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="fa fa-dashboard"></span>Dashboard</a></li>
    <li class="active">Manage Location</li>
  </ol>
</section>
<!-- /Page Header and Breadcrumb End -->

<!-- /Page Content Start -->
<div class="row">
  <div class="divider"></div>
</div>

<h3>Create Location</h3>
{{ Form::open(array('route' => array('location.store'), 'method' => 'post')) }}
<div class="form-group col-md-6">
    {{Form::label('parent','Parent Location')}}
    {{Form::select('parent_location', $dataset["parents"], null, array('class' => 'form-control'))}}
</div>
<div class="form-group col-md-6">
    {{Form::label('location','Location Name')}}
    {{Form::text('location_name', null, array('class' => 'form-control'))}}
</div>
<div class="form-group col-md-2">
	{{Form::submit('Create', array('class' => 'form-control btn btn-primary'))}}
</div>
{{ Form::close() }}

<div class="form-group col-md-12">
    <h3>Location Tree</h3>
    <div id="locations"></div>
</div>

@stop