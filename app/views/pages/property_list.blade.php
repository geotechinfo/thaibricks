@extends('layouts.default')
{{ HTML::style('libraries/startrating/jquery.rating.css') }}

{{ HTML::script('libraries/slick/slick.js') }}
{{ HTML::script('libraries/startrating/jquery.rating.js') }}
{{ HTML::script('libraries/slimheader/classie.js') }}

@section('content')


<section class="container container2" id="gototopwrap">
  <div class="">
    <div class="innerBread">
      <div class="col-sm-12">
      	  <span>You are here:</span>
          <ul class="topBreadcrumbs">
            <li><a href="javascript:;">Home</a></li>
            <li><a href="javascript:;">{{$dataset['title']}}</a></li>
          </ul>
      
      </div>
    </div>
  </div>
</section>


<section class="container container2" id="propertylist">
  <div class="col-sm-9 propertylistwrap">
  	@if(Session::get('info'))
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}</p>
    </div>
    {{{ Session::forget('info') }}}
    @endif
  
  
  	@foreach($dataset["properties"] as $property)
  	<div class="propertylist clearfix new">
      <div class="col-md-5">
        <div class="propertyimg" style="overflow:hidden;"><div class="propertymark"></div>
      	<a href="{{URL::action('PropertiesController@details')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => 'img-responsive')) }}</a>
      </div>
      </div>
      <div class="col-md-7 propertylist-body">
        <h3 class="propertylist-heading uppercase">{{{ $property->title }}}</h3>
        <h5 class="uppercase">&#xe3f; {{{ number_format($property->price, 0, ".", ",") }}}</h5>
        <small>{{{ $property->first_name }}} {{{ $property->last_name }}}</small>
        <div class="otherinfo clearfix">
        	<div class="pull-left">
            <h5>{{{ $property->locationsub_name }}}, {{{ $property->location_name }}}</h5>
            </div>
        </div>
        <p class="propertydesc">{{{ $property->description }}} <a href="{{URL::action('PropertiesController@details')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="saveshortlist"><small>Read More</small></a></p>
         <div class="row">
         	<div class="col-sm-12">
                 <div class="nearLocation">
					       <?php foreach($property->transports as $transports){ ?>
                      <?php if($transports->type=='1'){ ?>
                        <?php foreach($transports as $transport){ ?>
                          
                            <?php if(is_array($transport)){ ?>
                            <?php foreach($transport as $location){ ?>
                                <?php if(array_key_exists($location->transport_id, $property->selected_transports)){ ?>
                                  <div class="text-center">
                                    <div class="location" data-toggle="tooltip" title="<?php echo $location->transport_name; ?>" data-placement="bottom" style="background-image:url('<?php echo asset('images'); ?>/nearlocation/<?php echo $transports->transport_icon; ?>');"></div>
                                    <!--<p>Near to <?php echo $location->transport_name; ?></p>-->
                                  </div>
                                <?php } ?>
                            <?php } ?>
                            <?php } ?>
                        <?php } ?>
                      <?php } ?>
                    <?php } ?>
                      
                 </div>
            </div>
         </div>
         
         <div>
              <div class="pull-right">
              	<a href="{{URL::action('PropertiesController@details')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="btn btn-primary upperclass viewproperty">VIEW PROPERTY DETAILS</a>
              </div>
              </div>
      </div>
    </div>
    @endforeach
  
  
    
  </div>
  <aside class="col-sm-3">
  {{View::make('layouts.side_ad_block')}}
  </aside>
  
</section>

@stop