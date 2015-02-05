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
    <h3>Transport Group</h3>
    {{ Form::open(array('route' => array('location.addgroup'), 'method' => 'post')) }}
    <div class="form-group col-md-6">
        {{Form::label('location','Location / City')}}
        {{Form::select('location_id', $dataset["locations"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('transport','Transport Group')}}
        {{Form::text('group_name', null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-2">
        {{Form::submit('Create', array('class' => 'form-control btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

<div class="row">
    <h3>Transport System</h3>
    {{ Form::open(array('route' => array('location.addtransport'), 'method' => 'post')) }}
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
</div>

<div class="row">
    <h3>Transport Tree</h3>
    <div class="form-group col-md-12">
        <div id="transports"></div>
    </div>
</div>

@stop