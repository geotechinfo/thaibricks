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
        <li role="presentation"><a href="#bts" aria-controls="bts" role="tab" data-toggle="tab">BTS
            / MRT</a></li>
        <li role="presentation"><a href="#gmap" aria-controls="gmap" role="tab" data-toggle="tab">Google
            Map</a></li>
        <li role="presentation"><a href="#school" aria-controls="school" role="tab" data-toggle="tab">Schools</a></li>
      </ul>
    </div>
    <div class="tab-content searchparam">
      <div role="tabpanel" class="tab-pane active" id="bsearch">
        {{ Form::open(array('class' => 'center', 'id' => 'search', 'route' => array('property.search'), 'method' => 'get')) }}
          <fieldset class="search-form">
            <div class="col-md-12 lefttxt"> <span>Rental duration</span>
              <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                Long - term </label>
              <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                Short - Term ( up to 6 months ) </label>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="form-group margin-top propertytype">
                <div class="arrow">
                  <div class="btn-group mutiselectbtn">
                    <button data-toggle="dropdown" class="multiselect form-control" type="button" title="None selected">Property
                    Type <b class="caret"></b></button>
                    <div class="multiselect-container dropdown-menu" style="z-index:999999999;">
						<?php $types = $dataset["types"]; ?>
                        @foreach($types as $key=>$value)
                            <div class="col-md-4 col-sm-4">
                              <div>
                                <h5>{{{ $key }}}</h5>
                              </div>
                              @foreach($value as $child)
                              <div class="checkoptions"><a href="javascript:void(0);">
                                <label class="checkbox">
                                  <input type="checkbox" value="Flat" >
                                  {{{ $child }}}</label>
                                </a></div>
                              @endforeach
                            </div>
                        @endforeach
                      <!--<div class="col-md-4 col-sm-4">
                        <div>
                          <h5>RESIDENTIAL</h5>
                        </div>
                        <div class="checkoptions"><a href="javascript:void(0);">
                          <label class="checkbox">
                            <input type="checkbox" value="Flat" >
                            Flat</label>
                          </a></div>
                        <div class="checkoptions"><a href="javascript:void(0);">
                          <label class="checkbox">
                            <input type="checkbox" value="House/Villa" >
                            House/Villa</label>
                          </a></div>
                        <div class="checkoptions"><a href="javascript:void(0);">
                          <label class="checkbox">
                            <input type="checkbox" value="Plot" >
                            Plot</label>
                          </a></div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div>
                          <h5>COMMERCIAL</h5>
                        </div>
                        <div class="checkoptions"><a href="javascript:void(0);">
                          <label class="checkbox">
                            <input type="checkbox" value="Office" >
                            Office</label>
                          </a></div>
                        <div class="checkoptions"><a href="javascript:void(0);">
                          <label class="checkbox">
                            <input type="checkbox" value="Shop/Showroom" >
                            Shop/Showroom</label>
                          </a></div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div>
                          <h5>Others</h5>
                        </div>
                        <div class="checkoptions"><a href="javascript:void(0);">
                          <label class="checkbox">
                            <input type="checkbox" value="type1" >
                            type1</label>
                          </a></div>
                        <div class="checkoptions"><a href="javascript:void(0);">
                          <label class="checkbox">
                            <input type="checkbox" value="type2" >
                            type2</label>
                          </a></div>
                      </div>-->
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="price_range" class="searchlabel pull-left">Price
                  range</label>
                <span class="pricerangeval pull-right"><span class="min-price">&#xe3f;8,000</span> - <span class="max-price">&#xe3f;40,000</span></span>
                <input id="price_range" type="text" class="price_range" value="" data-slider-id="price_selector" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="form-group margin-top">
                <div class="arrow">
                  <div class="btn-group mutiselectbtn">
                    <button data-toggle="dropdown" class="multiselect form-control" type="button" title="None selected">Bedroom <b class="caret"></b></button>
                    <div class="multiselect-container dropdown-menu">
                      <div class="col-md-12">
                        <div class="checkoptions"><a href="javascript:void(0);">
                          <label class="checkbox">
                            <input type="checkbox" value="1BHK" >
                            1 BHK</label>
                          </a></div>
                        <div class="checkoptions"><a href="javascript:void(0);">
                          <label class="checkbox">
                            <input type="checkbox" value="2BHK" >
                            2 BHK</label>
                          </a></div>
                        <div class="checkoptions"><a href="javascript:void(0);">
                          <label class="checkbox">
                            <input type="checkbox" value="3BHK" >
                            3 BHK</label>
                          </a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 no-margin">
                <div class="form-group margin-top">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                    	{{Form::select('location', $loc, '', array('class' => 'form-control', 'id'=>"location"))}}
                      <!--<button data-toggle="dropdown" class="multiselect form-control" type="button" title="None selected">Location <b class="caret"></b></button>
                      <div class="multiselect-container dropdown-menu">
                        <div class="col-md-12">
                          <div class="checkoptions"><a href="javascript:void(0);">
                            <label class="radio">
                              <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                              Location 1</label>
                            </a></div>
                          <div class="checkoptions"><a href="javascript:void(0);">
                            <label class="radio">
                              <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                              Location 2</label>
                            </a></div>
                          <div class="checkoptions"><a href="javascript:void(0);">
                            <label class="radio">
                              <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                              Location 3</label>
                            </a></div>
                        </div>
                      </div>-->
                    </div>
                  </div>
                </div>
                
                </div>
              <div class="col-md-6 no-margin">
                <div class="form-group margin-top">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                    	{{Form::select('location_sub', array(), '', array('class' => 'form-control', 'id'=>"location_sub"))}}
                      <!--<select class="js-example-placeholder-multiple form-control" multiple="multiple">
                        <option value="SubLocation1">Sub Location1</option>
                        <option value="SubLocation2">Sub Location2</option>
                        <option value="SubLocation3">Sub Location3</option>
                        <option value="SubLocation4">Sub Location4</option>
                        <option value="SubLocation5">Sub Location5</option>
                        <option value="SubLocation6">Sub Location6</option>
                      </select>-->
                    </div>
                  </div>
                </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 listoption">
              <div class="pull-left">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="">
                    Pet Friendly </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="">
                    other items </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="">
                    other items </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="">
                    other items </label>
                </div>
              </div>
              <div class="">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="">
                    other items </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="">
                    other items </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="">
                    other items </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="">
                    other items </label>
                </div>
              </div>
            </div>
            <div class="col-md-2 col-sm-6">
              <div class="search-btn-wrap"> <a href="javascript:void(0);" onclick='document.forms["search"].submit();' class="btn btn-primary btn-lg search-button orange margin-top"> <span class="fa fa-search block"></span> <span>Search</span> </a> </div>
            </div>
          </fieldset>
        {{ Form::close() }}
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
  	@if(Session::get('info') == true)
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
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
            <h5>{{{ $property->location_sub }}}, {{{ $property->location }}}</h5>
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
         <div class="linkgroup">
         	<a href="javascript:void(0);" class=""><img width="22" height="27" src="{{{ asset('') }}}/images/searchwrapbuttons/mtrsmall.png" class="searchsmallimg">Ekamai station </a>
            <a href="javascript:void(0);" class=""><img width="22" height="27" src="{{{ asset('') }}}/images/searchwrapbuttons/googlemall.png" class="searchsmallimg"/>Location</a>
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