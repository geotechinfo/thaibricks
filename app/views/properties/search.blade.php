@extends('layouts.default')
{{ HTML::style('libraries/startrating/jquery.rating.css') }}

{{ HTML::script('libraries/slick/slick.js') }}
{{ HTML::script('libraries/startrating/jquery.rating.js') }}
{{ HTML::script('libraries/slimheader/classie.js') }}

@section('content')
<?php
$location = new Location;
$dataset['locations']=$location->get_location_with_sub();

$loc = array(''=>'Select Location');
$subloc[''] = array(''=>'Select Location');
$transport_group =  array('' => 'Select Transport Group' );
foreach ($dataset['locations'] as $k=>$v){
  $loc[$k]=$v['location_name'];
   if($v['SubLocation']){
	   foreach ($v['SubLocation'] as $k1 => $v1) {
		  $subloc[$k][$v1['location_id']]=$v1['location_name'];
	   }
   }
   if($v['Transport']){
	   foreach ($v['Transport'] as $k1 => $v1) {
		  $transport_group[$k][$v1['transport_id']]=$v1['transport_name'];
	   }
   }
}
//print_r($dataset["property"]->location);die;
?> 


<!--/Main Theme & Search-->
<section class="no-margin" id="list-search">
  <div class="container searchcontent container2">
    <h2>Searching for property here :</h2>
    <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#bsearch" aria-controls="bsearch" role="tab" data-toggle="tab">Basic
            search</a></li>
        <!--<li role="presentation"><a href="#bts" aria-controls="bts" role="tab" data-toggle="tab">BTS
            / MRT</a></li>
        <li role="presentation"><a href="#gmap" aria-controls="gmap" role="tab" data-toggle="tab">Google
            Map</a></li>
        <li role="presentation"><a href="#school" aria-controls="school" role="tab" data-toggle="tab">Schools</a></li>-->
      </ul>
    </div>
    <div class="tab-content searchparam">
      <div role="tabpanel" class="tab-pane active" id="bsearch">
        
        {{ $dataset['search_panel'] }}
        
      </div>
      <div role="tabpanel" class="tab-pane active" id="bts"> </div>
      <div role="tabpanel" class="tab-pane active" id="gmap"></div>
      <div role="tabpanel" class="tab-pane active" id="school"></div>
    </div>
  </div>
  <!---->
</section>
<!--/Main Theme & Search-->

<!--HotProperty-->
<!--<section class="no-margin">
<div class="container searchcontent container2 grey">
<h2>Trending properties from selected locations :</h2>
	<ul class="portfolio-items trendingproperty hot">
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <img src="images/portfolio/thumb/item1.jpg" alt="">
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>
            
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <img src="images/portfolio/thumb/item1.jpg" alt="">
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>
            
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <img src="images/portfolio/thumb/item1.jpg" alt="">
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>
            
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <img src="images/portfolio/thumb/item1.jpg" alt="">
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>
            
	</ul>
    
    <ul class="portfolio-items trendingproperty featured">
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <img src="images/portfolio/thumb/item1.jpg" alt="">
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>
            
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <img src="images/portfolio/thumb/item1.jpg" alt="">
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>
            
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <img src="images/portfolio/thumb/item1.jpg" alt="">
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>
            
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <img src="images/portfolio/thumb/item1.jpg" alt="">
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>
            
	</ul>
</div>
</section>-->
<!--HotProperty-->


<section class="container container2" id="propertylist">
  <aside class="col-sm-3 col-sm-push-9">
  	<div class="ad-wrap">{{ HTML::image('images/demoimages/ad1.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad5.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad7.jpg', '', array('class' => '')) }}</div>
  </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
  	@if(Session::get('info'))
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    {{{ Session::forget('info') }}}
    @endif
  
  
  	@foreach($dataset["properties"] as $property)
  	<div class="propertylist clearfix new">
      <div class="col-md-5"><div class="propertyimg" style="overflow:hidden;"><div class="propertymark"></div>
      	{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => 'img-responsive')) }}
      </div></div>
      <div class="col-md-7 propertylist-body">
        <h3 class="propertylist-heading uppercase">{{{ $property->title }}}</h3>
        <h5 class="uppercase">&#xe3f; {{{ number_format($property->price, 2, ".", ",") }}}</h5>
        <small>{{{ $property->first_name }}} {{{ $property->last_name }}}</small>
        <div class="otherinfo clearfix">
        	<div class="pull-left">
            <h5>{{{ $property->locationsub_name }}}, {{{ $property->location_name }}}</h5>
            </div>
            
            <!--<div class="pull-right starwrap">
            <input name="star1" type="radio" class="star"/> <input name="star1" type="radio" class="star"/> <input name="star1" type="radio" class="star"/> <input name="star1" type="radio" class="star"/> <input name="star1" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>-->
        </div>
        <p class="propertydesc">{{{ $property->description }}} <a href="{{URL::to('/property/show')}}/{{{ $property->property_id }}}" class="saveshortlist"><small>Read More</small></a></p>
         <!--<div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="{{{ asset('') }}}/images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="{{{ asset('') }}}/images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
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
  
  
    <!--<div class="propertylist clearfix new">
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
            <input name="star1" type="radio" class="star"/> <input name="star1" type="radio" class="star"/> <input name="star1" type="radio" class="star"/> <input name="star1" type="radio" class="star"/> <input name="star1" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a href="javascript:void(0);" class="saveshortlist"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button class="btn btn-primary upperclass viewproperty" type="button">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    <div class="propertylist clearfix new">
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
            <input name="star2" type="radio" class="star"/> <input name="star2" type="radio" class="star"/> <input name="star2" type="radio" class="star"/> <input name="star2" type="radio" class="star"/> <input name="star2" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a href="javascript:void(0);" class="saveshortlist"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button class="btn btn-primary upperclass viewproperty" type="button">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    <div class="propertylist clearfix">
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
            <input name="star3" type="radio" class="star"/> <input name="star3" type="radio" class="star"/> <input name="star3" type="radio" class="star"/> <input name="star3" type="radio" class="star"/> <input name="star3" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a href="javascript:void(0);" class="saveshortlist"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button class="btn btn-primary upperclass viewproperty" type="button">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    <div class="propertylist clearfix">
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
            <input name="star4" type="radio" class="star"/> <input name="star4" type="radio" class="star"/> <input name="star4" type="radio" class="star"/> <input name="star4" type="radio" class="star"/> <input name="star4" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a href="javascript:void(0);" class="saveshortlist"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button class="btn btn-primary upperclass viewproperty" type="button">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    <div class="ad-wrap"><img src="images/ads/ad2.png"/></div>
    <div class="propertylist clearfix">
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
            <input name="star5" type="radio" class="star"/> <input name="star5" type="radio" class="star"/> <input name="star5" type="radio" class="star"/> <input name="star5" type="radio" class="star"/> <input name="star5" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a href="javascript:void(0);" class="saveshortlist"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button class="btn btn-primary upperclass viewproperty" type="button">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    <div class="propertylist clearfix">
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
            <input name="star6" type="radio" class="star"/> <input name="star6" type="radio" class="star"/> <input name="star6" type="radio" class="star"/> <input name="star6" type="radio" class="star"/> <input name="star6" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a href="javascript:void(0);" class="saveshortlist"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button class="btn btn-primary upperclass viewproperty" type="button">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    <div class="propertylist clearfix">
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
            <input name="star7" type="radio" class="star"/> <input name="star7" type="radio" class="star"/> <input name="star7" type="radio" class="star"/> <input name="star7" type="radio" class="star"/> <input name="star7" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a href="javascript:void(0);" class="saveshortlist"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button class="btn btn-primary upperclass viewproperty" type="button">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    <div class="propertylist clearfix">
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
            <input name="star8" type="radio" class="star"/> <input name="star8" type="radio" class="star"/> <input name="star8" type="radio" class="star"/> <input name="star8" type="radio" class="star"/> <input name="star8" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a href="javascript:void(0);" class="saveshortlist"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button class="btn btn-primary upperclass viewproperty" type="button">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    <div class="propertylist clearfix">
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
            <input name="star9" type="radio" class="star"/> <input name="star9" type="radio" class="star"/> <input name="star9" type="radio" class="star"/> <input name="star9" type="radio" class="star"/> <input name="star9" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a href="javascript:void(0);" class="saveshortlist"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button class="btn btn-primary upperclass viewproperty" type="button">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    <div class="propertylist clearfix">
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
            <input name="star10" type="radio" class="star"/> <input name="star10" type="radio" class="star"/> <input name="star10" type="radio" class="star"/> <input name="star10" type="radio" class="star"/> <input name="star10" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a href="javascript:void(0);" class="saveshortlist"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button class="btn btn-primary upperclass viewproperty" type="button">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>
    <div class="propertylist clearfix">
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
            <input name="star11" type="radio" class="star"/> <input name="star11" type="radio" class="star"/> <input name="star11" type="radio" class="star"/> <input name="star11" type="radio" class="star"/> <input name="star11" type="radio" class="star"/> 
            <a href="javascript:void(0);" class="saveshortlist"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>
        </div>
        <p class="propertydesc">Pellentesque habitant morbi tristique senectus et netus et malesuada
          fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae. <a href="javascript:void(0);" class="saveshortlist"><small>Read More</small></a></p>
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
         </div>
         <div>
              <div class="pull-right">
              <button class="btn btn-primary upperclass viewproperty" type="button">VIEW PROPERTY DETAILS</button>
              </div>
              </div>
      </div>
    </div>-->
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