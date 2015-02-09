@extends('admin.layouts.default')
@section('body')
<!-- /Page Header and Breadcrumb Start -->
<section class="content-header row">
  <h1 class="page-header"> Attribute Relations <small>attributes and relations</small> </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="fa fa-dashboard"></span>Dashboard</a></li>
    <li class="active">Attribute Relations</li>
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
    <h3>Create Relation</h3>
    {{ Form::open(array('route' => array('attribute.store'), 'method' => 'post')) }}
    <div class="form-group col-md-6">
        {{Form::label('deal','Deal')}}
        {{Form::select('deal_id', $dataset["deals"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('type','Type')}}
        {{Form::select('type_id', $dataset["types"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('group','Group')}}
        {{Form::select('group_id', $dataset["groups"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('attribute','Attribute')}}
        {{Form::select('attribute_id', $dataset["attributes"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-6">
    	{{Form::submit('Create', array('class' => 'btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

<div class="row">
    <h3>Attribute Relations</h3>
    <div class="col-md-12">
    	<div id="relations"></div>
    </div>
</div>

@stop