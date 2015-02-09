@extends('layouts.default')
{{ HTML::style('libraries/startrating/jquery.rating.css') }}

{{ HTML::script('libraries/slick/slick.js') }}
{{ HTML::script('libraries/startrating/jquery.rating.js') }}
{{ HTML::script('libraries/slimheader/classie.js') }}

@section('content')
<!--/profileimage-->
<section class="container container2 margin-top-10 white radius-top" id="profileimage">
  <div class="clearfix padding-5 clouds">
    <!--- <div class="white clearfix">
      <div class="col-md-2 col-sm-2 col-xs-2 no-margin">
        <div class="white center">
          <div class="profileimg">
          @if($dataset["user_id"] == Auth::user()->user_id)
          <a href="javascript:void(0)" class="editphoto"><span class="fa fa-camera" style="color:#ababab;"></span><a href="javascript:void(0)">
          @endif
          <a href="javascript:void(0)" class="flex_wrap flexCenter"> {{ HTML::image('images/demoimages/logo1.jpg', '', array('class' => 'img-responsive')) }}</a>
          </div>
          <div class="padding-5"><a class="" href="javascript:void(0)"> {{{ Auth::user()->first_name }}} {{{ Auth::user()->last_name }}}</a></div>
          <div> </div>
        </div>
      </div>
      <div class="col-md-10 col-sm-10 col-xs-10 no-margin">
        <div class="white padding-5 coverpic">
        @if($dataset["user_id"] == Auth::user()->user_id)
        <a href="javascript:void(0)" class="editphoto"><span class="fa fa-camera"></span><a href="javascript:void(0)">
        @endif
        {{ HTML::image('images/agentprofile/banner.png', '', array('class' => 'img-responsive')) }}
        </div>
      </div>
    </div> -->
    {{ $dataset['banner_panel'] }}
  </div>
</section>
<!--/profileimage-->
<section class="container container2 margin-top-10 white radius-top">
  <aside class="col-sm-3 col-sm-push-9">
  	<div class="search-btn-wrap clearfix"> <a data-toggle="modal" data-target="#addPrperty" class="btn btn-primary btn-lg search-button margin-top details-search-button adProperty" href=""> <span class="fa fa-plus"></span> <span>Add New Property</span> </a> </div>
    
    <!-- Modal -->
        <div class="modal fade" id="addPrperty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            	{{ Form::open(array('route' => array('property.create'), 'method' => 'get')) }}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Property</h4>
              </div>
              <div class="modal-body addPropertyModal">
                <div class="row">
                  <div class="col-sm-3 col-sm-offset-1">
                  <label>Property Type</label>
                  </div>
                  <div class="col-sm-7">
                     {{Form::select('type_id', $dataset["types"], null, array('class' => 'form-control'))}}
                  </div>
                </div>
                <p></p>
                <div class="row">
                  <div class="col-sm-3 col-sm-offset-1">
                  <label>Transaction Type</label>
                  </div>
                  <div class="col-sm-7">
                  	{{Form::select('deal_id', $dataset["deals"], null, array('class' => 'form-control'))}} 
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary orange modalBtn">Submit</button>
              </div>
              {{ Form::open(array('route' => array('login'), 'method' => 'post')) }}
            </div>
          </div>
        </div>

    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad6.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad8.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad7.jpg', '', array('class' => '')) }}</div>
  </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
  	@if(Session::get('success'))
    <div class="margin-top-10 message">
    <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>{{{ Session::get('success') }}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    @endif
    
    @if(Session::get('info') == true)
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    @endif
  
  	@foreach($dataset["properties"] as $property)
    <div class="propertylist clearfix new myproperty">
      	<div class="btn-group btn-group-xs edit-delete" role="group" aria-label="...">
          @if($dataset["user_id"] == Auth::user()->user_id)
          	<a href="{{URL::to('/property/edit')}}/{{{ $property->property_id }}}" class="btn btn-default"><span class="fa fa-edit"></span></a>
          	<!--<a href="javascript:void(0);" class="btn btn-default"><span class="fa fa-trash-o"></span></a>-->
          @endif
        </div>
      <div class="col-md-5"><div class="propertyimg" style="overflow:hidden;">
      	<div class="propertymark"></div>
        {{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => 'img-responsive')) }}
      </div></div>
      <div class="col-md-7 propertylist-body">
        <h3 class="propertylist-heading uppercase">{{{ $property->title }}}</h3>
        <h5 class="uppercase">&#xe3f; {{{ number_format($property->price, 2, ".", ",") }}}</h5>
        <small>{{{ $property->first_name }}} {{{ $property->last_name }}}</small>
        <div class="otherinfo clearfix">
        	<div class="pull-left">
            <h5>{{{ $property->location_sub }}}, {{{ $property->location }}}</h5>
            </div>
            
            <!--<div class="pull-right starwrap">
            <span class="star-rating-control"><div class="rating-cancel"><a title="Cancel Rating"></a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div></span><input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> 
            <a class="saveshortlist" href="javascript:void(0);"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>-->
        </div>
        <p class="propertydesc">{{{ substr($property->description, 0, 125) }}} <a class="saveshortlist" href="{{URL::to('/property/show')}}/{{{ $property->property_id }}}"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/mtrsmall.png', '', array('class' => 'searchsmallimg')) }}Ekamai station </a>
            <a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/googlemall.png', '', array('class' => 'searchsmallimg')) }}Location</a>
         </div>
         <div>
              <div class="pull-right">
              <a href="{{URL::to('/property/show')}}/{{{ $property->property_id }}}" class="btn btn-primary upperclass viewproperty">VIEW PROPERTY DETAILS</a>
              </div>
              </div>
      </div>
    </div>
    @endforeach
    
    <!--<div class="propertylist clearfix new myproperty">
      	<div class="btn-group btn-group-xs edit-delete" role="group" aria-label="...">
          <a href="javascript:void(0);" class="btn btn-default"><span class="fa fa-edit"></span></a>
          <a href="javascript:void(0);" class="btn btn-default"><span class="fa fa-trash-o"></span></a>
        </div>
      <div class="col-md-5"><div class="propertyimg"><div class="propertymark"></div></div></div>
      <div class="col-md-7 propertylist-body">
        <h3 class="propertylist-heading uppercase">Windows Development</h3>
        <h5 class="uppercase">&#xe3f;25,000 / month</h5>
        <small>&#xe3f;50,000 deposit + 25,000 1 month rent. Other terms and fee may apply. </small>
        <div class="otherinfo clearfix">
        	<div class="pull-left">
            <h5>3 bedroom house to rent</h5>
            </div>
            
            <div class="pull-right starwrap">
            <span class="star-rating-control"><div class="rating-cancel"><a title="Cancel Rating"></a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div></span><input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> 
            <a class="saveshortlist" href="javascript:void(0);"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a class="saveshortlist" href="javascript:void(0);"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/mtrsmall.png', '', array('class' => 'searchsmallimg')) }}Ekamai station </a>
            <a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/googlemall.png', '', array('class' => 'searchsmallimg')) }}Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button type="button" class="btn btn-primary upperclass viewproperty">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    
    <div class="propertylist clearfix myproperty">
      	<div class="btn-group btn-group-xs edit-delete" role="group" aria-label="...">
          <a href="javascript:void(0);" class="btn btn-default"><span class="fa fa-edit"></span></a>
          <a href="javascript:void(0);" class="btn btn-default"><span class="fa fa-trash-o"></span></a>
        </div>
      <div class="col-md-5"><div class="propertyimg"></div></div>
      <div class="col-md-7 propertylist-body">
        <h3 class="propertylist-heading uppercase">Windows Development</h3>
        <h5 class="uppercase">&#xe3f;25,000 / month</h5>
        <small>&#xe3f;50,000 deposit + 25,000 1 month rent. Other terms and fee may apply. </small>
        <div class="otherinfo clearfix">
        	<div class="pull-left">
            <h5>3 bedroom house to rent</h5>
            </div>
            
            <div class="pull-right starwrap">
            <span class="star-rating-control"><div class="rating-cancel"><a title="Cancel Rating"></a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div></span><input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> 
            <a class="saveshortlist" href="javascript:void(0);"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a class="saveshortlist" href="javascript:void(0);"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/mtrsmall.png', '', array('class' => 'searchsmallimg')) }}Ekamai station </a>
            <a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/googlemall.png', '', array('class' => 'searchsmallimg')) }}Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button type="button" class="btn btn-primary upperclass viewproperty">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    
    <div class="propertylist clearfix myproperty">
      	<div class="btn-group btn-group-xs edit-delete" role="group" aria-label="...">
          <a href="javascript:void(0);" class="btn btn-default"><span class="fa fa-edit"></span></a>
          <a href="javascript:void(0);" class="btn btn-default"><span class="fa fa-trash-o"></span></a>
        </div>
      <div class="col-md-5"><div class="propertyimg"></div></div>
      <div class="col-md-7 propertylist-body">
        <h3 class="propertylist-heading uppercase">Windows Development</h3>
        <h5 class="uppercase">&#xe3f;25,000 / month</h5>
        <small>&#xe3f;50,000 deposit + 25,000 1 month rent. Other terms and fee may apply. </small>
        <div class="otherinfo clearfix">
        	<div class="pull-left">
            <h5>3 bedroom house to rent</h5>
            </div>
            
            <div class="pull-right starwrap">
            <span class="star-rating-control"><div class="rating-cancel"><a title="Cancel Rating"></a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div></span><input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> 
            <a class="saveshortlist" href="javascript:void(0);"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a class="saveshortlist" href="javascript:void(0);"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/mtrsmall.png', '', array('class' => 'searchsmallimg')) }}Ekamai station </a>
            <a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/googlemall.png', '', array('class' => 'searchsmallimg')) }}Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button type="button" class="btn btn-primary upperclass viewproperty">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    
    <div class="propertylist clearfix myproperty">
      	<div class="btn-group btn-group-xs edit-delete" role="group" aria-label="...">
          <a href="javascript:void(0);" class="btn btn-default"><span class="fa fa-edit"></span></a>
          <a href="javascript:void(0);" class="btn btn-default"><span class="fa fa-trash-o"></span></a>
        </div>
      <div class="col-md-5"><div class="propertyimg"></div></div>
      <div class="col-md-7 propertylist-body">
        <h3 class="propertylist-heading uppercase">Windows Development</h3>
        <h5 class="uppercase">&#xe3f;25,000 / month</h5>
        <small>&#xe3f;50,000 deposit + 25,000 1 month rent. Other terms and fee may apply. </small>
        <div class="otherinfo clearfix">
        	<div class="pull-left">
            <h5>3 bedroom house to rent</h5>
            </div>
            
            <div class="pull-right starwrap">
            <span class="star-rating-control"><div class="rating-cancel"><a title="Cancel Rating"></a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div></span><input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> 
            <a class="saveshortlist" href="javascript:void(0);"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a class="saveshortlist" href="javascript:void(0);"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/mtrsmall.png', '', array('class' => 'searchsmallimg')) }}Ekamai station </a>
            <a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/googlemall.png', '', array('class' => 'searchsmallimg')) }}Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button type="button" class="btn btn-primary upperclass viewproperty">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>-->
    
    <ul class="portfolio-items trendingproperty hot myitems">
           @foreach($dataset["hot"] as $hot)
            <li class="portfolio-item col-md-4 col-sm-6">
              <div class="item-inner"> {{ HTML::image(asset('files/properties')."/".$hot->media[0]->media_data, '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>{{{ $hot->title }}}</h5>
                  <p>{{{ substr($hot->description, 0, 125) }}}</p>
                </div>
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f; {{{ number_format($hot->price, 2, ".", ",") }}}</div>
                  <div class="viewmore projectinfobtn center pull-right"><a class="seemore" href="{{URL::to('/property/show')}}/{{{ $hot->property_id }}}"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>
            @endforeach
            <!--/.portfolio-item-->
            <!--<li class="portfolio-item col-md-4 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/portfolio/thumb/item1.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a class="seemore" href="#"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>-->
            <!--/.portfolio-item-->
            <!--<li class="portfolio-item col-md-4 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/portfolio/thumb/item1.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a class="seemore" href="#"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>-->
            <!--/.portfolio-item-->
	</ul>
    
    
  </div>
</section>
<section class="container container2" id="gototopwrap">
  <div class="">
    <div class="">
      <div class="col-sm-6"> You are here: <a title="home" href="javascript:void(0)">Home</a></div>
      <div class="col-sm-6">
        <ul class="pull-right">
          <li class="totop"><a href="#" class="gototop" id="gototop">Top <span class="fa fa-arrow-up"></span></a></li>
          <!--#gototop-->
        </ul>
      </div>
    </div>
  </div>
</section>
@stop