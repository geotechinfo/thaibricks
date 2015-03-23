@extends('admin.layouts.default')
@section('body')
{{ HTML::script('libraries/validator/validation.js') }}

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

@if(Session::has('info'))
<p></p>
<div class="alert alert-info">
    <span class="fa fa-tick"></span>&nbsp; {{ Session::get('info') }}
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
<script type="text/javascript">
    $(function(){
        $('form').validate({
            rules:{
                deal_id:{required:true,min:1},
                type_id:{required:true,min:1},
            },
            messages:{
                deal_id:{required:'Required field.',min:'Required field.'},
                type_id:{required:'Required field.',min:'Required field.'},
            },
            errorClass:'text-danger',
            errorElement:'small',
        })
    })
</script>
@stop