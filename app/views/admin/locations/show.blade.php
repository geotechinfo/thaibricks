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

@if(Session::has('success'))
<div class="margin-top-10 message">
<p class="btn-success text-success padding-5">
    <span class="fa fa-times-circle"></span>{{ Session::get('success') }}
    <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a>
</p>
</div>
@endif

@foreach ($errors->all() as $message)
<div class="margin-top-10 message">
<p class="btn-danger text-danger padding-5">
    <span class="fa fa-times-circle"></span>{{{ $message }}}
    <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a>
</p>
</div>
<?php break; ?>
@endforeach

<div class="row">
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
</div>

<div class="row">
    <h3>Location Tree</h3>
    <div class="col-md-6">
    	<div id="locations"></div>
    </div>
</div>

@stop