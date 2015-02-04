@extends('admin.layouts.default')
@section('body')
<!-- /Page Header and Breadcrumb Start -->
<section class="content-header row">
  <h1 class="page-header"> Manage Transport <small>locations and transport</small> </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="fa fa-dashboard"></span>Dashboard</a></li>
    <li class="active">Manage Transport</li>
  </ol>
</section>
<!-- /Page Header and Breadcrumb End -->

<!-- /Page Content Start -->
<div class="row">
  <div class="divider"></div>
</div>

{{ Form::open(array('route' => array('location.save'), 'method' => 'post')) }}
<div class="form-group col-md-6">
    {{Form::label('group','Transport Group')}}
    {{Form::select('transport_group', $dataset["groups"], null, array('class' => 'form-control'))}}
</div>
<div class="form-group col-md-6">
    {{Form::label('transport','Transport Name')}}
    {{Form::text('transport_name', null, array('class' => 'form-control'))}}
</div>
<div class="form-group col-md-2">
	{{Form::submit('Create', array('class' => 'form-control btn btn-primary'))}}
</div>
{{ Form::close() }}

<div class="form-group col-md-12">
	<div id="locations"></div>
</div>

@stop