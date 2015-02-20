@extends('admin.layouts.default')
@section('body')
<!-- /Page Header and Breadcrumb Start -->
<section class="content-header row">
  <h1 class="page-header"> Manage NearBy <small>locations and Nearby</small> </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="fa fa-dashboard"></span>Dashboard</a></li>
    <li class="active">Manage NearBy</li>
  </ol>
</section>
<!-- /Page Header and Breadcrumb End -->

<!-- /Page Content Start -->
<div class="row">
  <div class="divider"></div>
</div>

<div class="row">
@if(Session::has('success'))
<p></p>
<div class="alert alert-success">
	<span class="fa fa-tick"></span>&nbsp; {{ Session::get('success') }}
</div>
@endif

@foreach ($errors->all() as $message)
<p></p>
<div class="alert alert-danger">
	<span class="fa fa-times"></span>&nbsp; {{{ $message }}}
</div>
<?php break; ?>
@endforeach
</div>

<div class="row">
    <h3>NearBy Group</h3>
    {{ Form::open(array('route' => array('location.addnearbygroup'), 'method' => 'post')) }}
    <div class="form-group col-md-6">
        {{Form::label('location','Location / City')}}
        {{Form::select('location_id', $dataset["locations"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('transport','NearBy Group')}}
        {{Form::text('group_name', null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-2">
        {{Form::submit('Create', array('class' => 'form-control btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

<div class="row">
    <h3>Nearby Name</h3>
    {{ Form::open(array('route' => array('location.addnearby'), 'method' => 'post')) }}
    <div class="form-group col-md-6">
        {{Form::label('group','NearBy Group')}}
        {{Form::select('transport_group', $dataset["groups"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('transport','NearBy Name')}}
        {{Form::text('transport_name', null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-2">
        {{Form::submit('Create', array('class' => 'form-control btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

<div class="row">
    <h3>Near By Tree</h3>
    <div class="form-group col-md-12">
        <div id="nearby_tree"></div>
    </div>
</div>

@stop