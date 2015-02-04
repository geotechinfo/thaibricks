@extends('layouts.default')
{{ HTML::style('libraries/startrating/jquery.rating.css') }}

{{ HTML::script('libraries/slick/slick.js') }}
{{ HTML::script('libraries/startrating/jquery.rating.js') }}
{{ HTML::script('libraries/slimheader/classie.js') }}

@section('content')
<?php $property = $dataset["properties"][0]; ?>
<!--/Main Theme & Search-->
<section class="no-margin" id="list-search">
  <div class="container searchcontent container2 headrow">
  <div class="col-md-3">
    <!--<h2>New quick search:</h2>-->
   </div>
   <div class="col-md-9 propertyname_price">
    <h2 class="pull-left">{{{ $property->title }}}</h2>
    <h2 class="pull-right">&#xe3f; {{{ number_format($property->price, 2, ".", ",") }}}</h2>
   </div>
    
  </div>
  <!---->
</section>
<!--/Main Theme & Search-->
<section class="container container2" id="propertydetail">
  <aside class="col-md-3 left-panel">
  		 <form class="center" role="form">
  		<!--<div class="form-group">
                <label for="price_range" class="searchlabel pull-left">Price
                  range</label>
                <span class="pricerangeval pull-right"><span class="min-price">&#xe3f;8,000</span> - <span class="max-price">&#xe3f;40,000</span></span>
                <input id="price_range" type="text" class="price_range" value="" data-slider-id="price_selector" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/>
              </div>-->
        <!--<div class="form-group margin-top propertytype">
                <div class="arrow">
                  <div class="btn-group mutiselectbtn">
                    <button data-toggle="dropdown" class="multiselect form-control" type="button" title="None selected">Property
                    Type <b class="caret"></b></button>
                    <div class="multiselect-container dropdown-menu">
                      <div class="col-md-4 col-sm-4">
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
                      </div>
                    </div>
                  </div>
                </div>
              </div>-->
        <!--<div class="form-group margin-top">
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
              </div>-->
        <!--<div class="form-group margin-top">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                      <button data-toggle="dropdown" class="multiselect form-control" type="button" title="None selected">Location <b class="caret"></b></button>
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
                      </div>
                    </div>
                  </div>
                </div>-->
                
         <!--<div class="form-group margin-top">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                      <select class="js-example-placeholder-multiple form-control" multiple="multiple">
                        <option value="SubLocation1">Sub Location1</option>
                        <option value="SubLocation2">Sub Location2</option>
                        <option value="SubLocation3">Sub Location3</option>
                        <option value="SubLocation4">Sub Location4</option>
                        <option value="SubLocation5">Sub Location5</option>
                        <option value="SubLocation6">Sub Location6</option>
                      </select>
                    </div>
                  </div>
                </div>-->
         
         <!--<div class="search-btn-wrap clearfix"> <a href="" class="btn btn-primary btn-lg search-button orange margin-top details-search-button"> <span class="fa fa-search"></span> <span>Basic search</span> </a> </div>
         <div class="search-btn-wrap clearfix"> <a href="" class="btn btn-primary btn-lg search-button orange margin-top details-search-button"> <span class="fa fa-search"></span> <span>Search by Map</span> </a> </div>
         <div class="search-btn-wrap clearfix"> <a href="" class="btn btn-primary btn-lg search-button orange margin-top details-search-button"> <span class="fa fa-search"></span> <span>BTS / MRT</span> </a> </div>-->
         <div class="well featuredagentbox clearfix">
         	<h2 class="text-left">Featured Agents</h2>
            <div class="clearfix"> 
              <a class="selected pull-left"> <img class="img-responsive" src="{{{ asset('') }}}/images/agentprofile/agentprofilethumb.png"/> </a> 
              <div class="phototext text-left">
                  <strong>Ridin Dinesh</strong><br/>
                  <small>Mobile: <span>089-4503647</span></small>
                </div>
              </div>
            <p class="text-left">If you are looking for place to rent in sukhumvit area, I am the right agent to get in touch with. I am available during 9am to 4pm Mon- Sat.</p>
         </div>
         <div class="ad-wrap">{{ HTML::image('images/demoimages/ad8.jpg', '', array('class' => '')) }}</div>
         <div class="ad-wrap">{{ HTML::image('images/demoimages/ad1.jpg', '', array('class' => '')) }}</div>
         <div class="ad-wrap">{{ HTML::image('images/demoimages/ad6.jpg', '', array('class' => '')) }}</div>
         </form>
  </aside>
  <div class="col-md-9 propertydetailswrap">
  <!--/Main Theme & Search-->
  <div id="myCarousel" class="carousel slide property-image-carousel">
    
      <div class="carousel-inner">
      	@foreach($property->media as $key=>$media)
        	<article class="item <?php if($key==0){ ?>active<?php } ?>">
              {{ HTML::image(asset('files/properties')."/".$media->media_data, '', array('class' => '')) }}
            </article>
        @endforeach
      
        <!--<article class="item active">
          <img src="libraries/imagegallery/ffffff.gif">
          
        </article>
         <article class="item">
          <img src="libraries/imagegallery/cccccc.gif">
          
        </article> 
        
        </article>
         <article class="item">
          <img src="libraries/imagegallery/ffffff.gif">
          
        </article>
        
        </article>
         <article class="item">
          <img src="libraries/imagegallery/cccccc.gif">
          
        </article>
        
        <article class="item">
          <img src="libraries/imagegallery/333333.gif">
          
        </article>-->                      
      </div>
      <!-- Indicators -->
      
      
      <ol class="carousel-indicators">
      	<style type="text/css">
		.fit_inthe_box{
			width:100%;
		}
		</style>
      	@foreach($property->media as $key=>$media)
        	<li data-target="#myCarousel" data-slide-to="<?php echo $key; ?>" class="<?php if($key==0){ ?>active<?php } ?>" style="background-image:url('{{{ asset('files/properties')."/".$media->media_data }}}');">
            	&nbsp;
            </li>
        @endforeach
        <!--<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li class="" data-target="#myCarousel" data-slide-to="1"></li>
        <li class="" data-target="#myCarousel" data-slide-to="2"></li>
        <li class="" data-target="#myCarousel" data-slide-to="3"></li>
        <li class="" data-target="#myCarousel" data-slide-to="4"></li>-->
      </ol>        
      <!-- Controls -->
      <div class="carousel-controls">
          <a class="carousel-control left" href="#myCarousel" data-slide="prev">
            <span class="fa fa-angle-left"></span>
          </a>
          <a class="carousel-control right" href="#myCarousel" data-slide="next">
            <span class="fa fa-angle-right"></span>
          </a>
      </div>
      
      <div class="contactinfowrap"><a class="btn btn-primary btn-lg search-button orange" href=""> <span class="fa fa-search"></span> <span>Contact Info</span> </a> </div>
    </div> 
  <!--/Main Theme & Search-->
  
  
    <div class="clearfix propetymap-desc">
      <div class="col-md-5">
      <h5 class="uppercase">Property Image</h5>
      <div class="mapwrap"><div class="ad-wrap">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => '')) }}</div></div>
      </div>
      <div class="col-md-7 propertylist-body">
        <h5 class="uppercase">{{{ $property->first_name }}} {{{ $property->last_name }}}</h5>
        <p class="text-bold">{{{ $property->description }}}</p>
         
         <div>
              
         </div>
      </div>
    </div>
    <div class="clearfix propety-feature">
    <div class="col-md-12">
    	<h5 class="uppercase">General Features</h5>
    </div>
    <div class="featurelist">
    	@foreach($property->attributes as $key=>$attribute)
            <div class="col-md-3 media" style="border-top:0px; border-bottom:1px solid #e8e8e8;">
                <div class="pull-left featurehaed">{{{ $attribute->attribute_name }}}</div>
                <div class="text-right">@if($attribute->attribute_value == "on") Yes @else {{{ $attribute->attribute_value }}} @endif</div>
            </div>
        @endforeach
    	<!--<div class="col-md-3">
        <div class="media">
            <div class="pull-left featurehaed">Property Type</div>
            <div class="text-right"> House</div>
          </div>
        <div class="media">
            <div class="pull-left featurehaed">Garage</div>
            <div class="text-right">Yes</div>
        </div>
        <div class="media">
            <div class="pull-left featurehaed">Cable TV</div>
            <div class="text-right"> Yes</div>
        </div>
        </div>
        <div class="col-md-3">
        <div class="media">
            <div class="pull-left featurehaed">Bedrooms</div>
            <div class="text-right"> 3</div>
          </div>
        <div class="media">
            <div class="pull-left featurehaed">Bathrooms</div>
            <div class="text-right">2</div>
        </div>
        <div class="media">
            <div class="pull-left featurehaed">Square Meters</div>
            <div class="text-right"> 30 sq/m</div>
        </div>
        </div>
        <div class="col-md-3">
        <div class="media">
            <div class="pull-left featurehaed">Gym</div>
            <div class="text-right"> Yes</div>
          </div>
        <div class="media">
            <div class="pull-left featurehaed">Central Air</div>
            <div class="text-right">Yes</div>
        </div>
        <div class="media">
            <div class="pull-left featurehaed">Pets</div>
            <div class="text-right"> allowed</div>
        </div>
        </div>
        <div class="col-md-3">
        <div class="media">
            <div class="pull-left featurehaed">Option 7</div>
            <div class="text-right"> Yes</div>
          </div>
        <div class="media">
            <div class="pull-left featurehaed">Option 8</div>
            <div class="text-right">Yes</div>
        </div>
        <div class="media">
            <div class="pull-left featurehaed">Option 9</div>
            <div class="text-right"> allowed</div>
        </div>
        </div>-->
    </div>
    </div>
    <!--<div class="floorplan">
    <div class="col-md-12">
    	<h5 class="uppercase">Floor Plan</h5>
        <div class="ad-wrap">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => '')) }}</div>
    </div>
    </div>-->
    
    <div class="relatedproperty">
    <div class="col-md-12">
    <h2>Related Properties :</h2>
    @if(count($dataset["related"])<2)
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>No related properties found at this time!<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    @endif
    
    <ul class="portfolio-items relatedpropety">
    		@foreach($dataset["related"] as $related)
            @if($related->property_id != $property->property_id)
            <li class="portfolio-item col-md-2">
              <a class="item-inner btn-block" href="{{URL::to('/property/show')}}/{{{ $related->property_id }}}"> <img alt="" src="{{{ asset('files/properties') }}}/{{{ $related->media[0]->media_data }}}">
              </a>
              <a class="commentwrap asbestos btn-block" href="{{URL::to('/property/show')}}/{{{ $related->property_id }}}">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f; {{{ number_format($related->price, 2, ".", ",") }}}</div>
                  
                </div>
              </a>
            </li>
            @endif
            @endforeach
            <!--/.portfolio-item-->
            <!--<li class="portfolio-item col-md-2">
              <div class="item-inner"> <img alt="" src="">
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  
                </div>
              </div>
            </li>
            
            <li class="portfolio-item col-md-2">
              <div class="item-inner"> <img alt="" src="">
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  
                </div>
              </div>
            </li>
            
            <li class="portfolio-item col-md-2">
              <div class="item-inner"> <img alt="" src="">
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  
                </div>
              </div>
            </li>
            
            <li class="portfolio-item col-md-2">
              <div class="item-inner"> <img alt="" src="">
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  
                </div>
              </div>
            </li>
            
            <li class="portfolio-item col-md-2">
              <div class="item-inner"> <img alt="" src="">
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  
                </div>
              </div>
            </li>-->
            <!--/.portfolio-item-->
            
          </ul>
    </div>
    </div>
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