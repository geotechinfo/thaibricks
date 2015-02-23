@extends('layouts.default')

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
  	@if($dataset["user_id"] == Auth::user()->user_id)
  	<div class="search-btn-wrap clearfix"> <a data-toggle="modal" data-target="#addPrperty" class="btn btn-primary btn-lg search-button margin-top details-search-button adProperty" href=""> <span class="fa fa-plus"></span> <span>Add New Property</span> </a> </div>
    @endif

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
    
    @if(Session::get('info'))
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    {{{ Session::forget('info') }}}
    @endif
  
  	<?php $validity_days = 7; ?>
  	@foreach($dataset["properties"] as $property)
    <div class="propertylist clearfix new myproperty">
      	<div class="btn-group btn-group-xs edit-delete" role="group" aria-label="...">
          @if($dataset["user_id"] == Auth::user()->user_id)
          	<a href="{{URL::to('/property/edit')}}/{{{ $property->property_id }}}" class="btn btn-default"><span class="fa fa-edit"></span></a>
          	<!--<a href="javascript:void(0);" class="btn btn-default"><span class="fa fa-trash-o"></span></a>-->
          @endif
        </div>
      <div class="col-md-5 cls_extend">
          <div class="propertyimg" style="overflow:hidden;">
          		<?php if(floor((strtotime("now")-$property->last_active)/3600/24) > $validity_days){ ?>
          		<div class="disablePropertyHolder">
                    <div class="disablePropertyText flexCenter enableBtnHolder">
                        <a href="javascript:;" class="cls_extend_btn" data-id="{{ $property->property_id}}"><i class="fa fa-check-circle"></i> Enable your Property</a>
                        <!-- <span><i class="fa fa-warning"></i> DISABLED</span> -->
                    </div>
                </div>
                <?php } ?>
            	<div class="propertymark"></div>
            	{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => 'img-responsive')) }}
              
          </div>
          <p>
            <span class="cls_extend_text">
              <?php 
                  $day_renmain = ($validity_days - floor((strtotime("now")-$property->last_active)/3600/24)); 
                  if($day_renmain>=0){echo "This property is active for next $day_renmain days. ";}
                  else{echo "This property was inactive  for last ".($day_renmain*(-1)). " days";}
              ?>
              
            </span>
            <?php if($day_renmain<=($validity_days-2) && $day_renmain!=0){ ?>
              
              <a href="javascript:;" class="btn btn-primary btn-xs cls_extend_btn" data-id="{{ $property->property_id}}">Extend</a>
              
            <?php }?>
          </p>
      </div>
      <div class="col-md-7 propertylist-body">
        <h3 class="propertylist-heading uppercase">{{{ $property->title }}}</h3>
        <h5 class="uppercase">&#xe3f; {{{ number_format($property->price, 2, ".", ",") }}}</h5>
        <small>{{{ $property->first_name }}} {{{ $property->last_name }}}</small>
        <div class="otherinfo clearfix">
        	<div class="pull-left">
            <h5>{{{ $property->locationsub_name }}}, {{{ $property->location_name }}}</h5>
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
         <!--<div class="linkgroup">
         	<a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/mtrsmall.png', '', array('class' => 'searchsmallimg')) }}Ekamai station </a>
            <a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/googlemall.png', '', array('class' => 'searchsmallimg')) }}Location</a>
         </div>-->
         <div class="row">
         	<div class="col-sm-12">
                 <div class="nearLocation">
					<?php foreach($property->transports as $transports){ ?>
                        <?php foreach($transports as $transport){ ?>
                            <?php if(is_array($transport)){ ?>
                            <?php foreach($transport as $location){ ?>
                                <?php if(array_key_exists($location->transport_id, $property->selected_transports)){ ?>
                                  <div class="text-center">
                                    <div class="location" style="background-image:url('<?php echo asset('images'); ?>/nearlocation/<?php echo $transports->transport_icon; ?>');"></div>
                                    <p>Near to <?php echo $location->transport_name; ?></p>
                                  </div>
                                <?php } ?>
                            <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                      <!--<div class="text-center">
                        <div class="location nearMrt"></div>
                        <p>Near MRT</p>
                      </div>
                      <div class="text-center">
                        <div class="location nearAirport"></div>
                        <p>Near Airport</p>
                      </div>
                      <div class="text-center">
                        <div class="location nearHospital"></div>
                        <p>Hospital (2Km)</p>
                      </div>
                      <div class="text-center">
                        <div class="location nearSchool"></div>
                        <p>School (1Km)</p>
                      </div>
                      <div class="text-center">
                        <div class="location nearPark"></div>
                        <p>Park (4Km)</p>
                      </div>-->
                 </div>
            </div>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('.cls_extend_btn').click(function(){
      var ths = $(this);
      ths.button('loading')
      var property_id = $(this).data('id')
      $.post(
        '<?php echo URL::to("property/extend")?>',
        {
          property_id:property_id
        },
        function(m){
          //alert(m);
          ths.button('reset');
          ths.closest('.cls_extend').find('.cls_extend_text').text('You property is active for next 7 days.');
          ths.closest('.cls_extend').find('.cls_extend_btn').hide();
          ths.closest('.cls_extend').find('.disablePropertyHolder').removeClass('disablePropertyHolder');
        }
      )
    });
  });
</script>
@stop