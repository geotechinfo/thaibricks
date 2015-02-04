@extends('admin.layouts.default')
@section('body')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h2>Create Relation</h2>
        
        @if(Session::get('exist') == true)
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>This relation already exist in the application!</strong>
        </div>
        @endif
        
        @if(Session::get('success') == true)
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Relation successfully created in the application!</strong>
        </div>
        @endif
        
        {{ Form::open(array('route' => array('admin.relation.store'), 'method' => 'post')) }}
        <div class="form-group">
            {{Form::label('deal','Deal')}}
            {{Form::select('deal_id', $dataset["deals"], null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('type','Type')}}
            {{Form::select('type_id', $dataset["types"], null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('group','Group')}}
            {{Form::select('group_id', $dataset["groups"], null, array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('attribute','Attribute')}}
            {{Form::select('attribute_id', $dataset["attributes"], null, array('class' => 'form-control'))}}
        </div>
        {{Form::submit('Create', array('class' => 'btn btn-primary'))}}
        {{ Form::close() }}
    </div>
</div>
@stop