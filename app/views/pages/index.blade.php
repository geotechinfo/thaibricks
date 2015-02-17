@extends('layouts.default')
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
<section class="no-margin" id="main-slider">
  <div class="container ad-text-wrap">
  	<!--<div class="ad-text_">
            <h3>House For Sale In Prachuap Khiri Khan</h3>
            <p>he villa is located 6 km west of Hua Hin city center in green lush surroundings.</p>
            <small><a href="{{URL::to('/property/show/1')}}">Read More </a></small> </div>-->
  </div>
  <div class="themewrap">
    <div class="theme" id="theme">
    	{{ HTML::image('images/slider/bg1.jpg', '', array('class' => 'banner')) }}
      <div class="container searchcontent">
        <div class="contentwrap">
            <div class="ad-text">
                <h3>House For Sale In Prachuap Khiri Khan</h3>
                <p>he villa is located 6 km west of Hua Hin city center in green lush surroundings.</p>
                <small><a href="{{URL::to('/property/show/1')}}">Read More </a></small>
            </div>
          {{ Form::open(array('class' => 'center', 'id' => 'search', 'route' => array('property.search'), 'method' => 'get')) }}
            <fieldset class="search-form">
              <div class="col-md-4 col-sm-6">
                <div class="form-group margin-top propertytype">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                      <button data-toggle="dropdown" class="multiselect form-control" type="button" title="None selected">Property
                      Type <b class="caret"></b></button>
                      <div class="multiselect-container dropdown-menu">
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
              <div class="col-md-4 col-sm-12 search-map-btn">
                <div class="col-md-5 search-btn-wrap"> <a href="javascript:void(0);" onclick='document.forms["search"].submit();' class="btn btn-primary btn-lg search-button orange margin-top"> <span class="fa fa-search block"></span> <span>Search</span> </a> </div>
                <div class="col-md-7 searchby-wrap">
                  <div class="mtr margin-top srchByLocation">
                  	<!-- <a href=""><img src="images/searchwrapbuttons/searchbymtr.png" style="width:100%; height:auto; "></a> -->
                    <a data-original-title="Search near BTS" href="javascvript:;" data-toggle="tooltip" data-placement="top" title=""><img src="images/nearLocation/btsLogo.png" alt=""></a>
                    <a data-original-title="Search near MRT" href="javascvript:;" data-toggle="tooltip" data-placement="top" title=""><img src="images/nearLocation/mrLogo.png" alt=""></a>
                    <a data-original-title="Airport Link" href="javascvript:;" data-toggle="tooltip" data-placement="top" title=""><img src="images/nearLocation/airportLogo.png" alt=""></a>                   
                   </div>
                  <div class="google"><a href="javascript:void(0);"><img src="images/searchwrapbuttons/searchbygooglemap.png" style="width:98%; height:auto; "></a></div>
                </div>
              </div>
            </fieldset>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
  <!---->
</section>
<!--/Main Theme & Search-->
<!--/#portfolio-->
<section id="portfolio" class="container">
  <div class="row paddingwrapper">
    <h2>Featured Bricks</h2>
    <div role="tabpanel">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#project" aria-controls="project" role="tab" data-toggle="tab">Featured
            Projects</a></li>
        <li role="presentation"><a href="#condos" aria-controls="condos" role="tab" data-toggle="tab">Featured
            Condos</a></li>
        <li role="presentation"><a href="#apartments" aria-controls="apartments" role="tab" data-toggle="tab">Featured
            Apartments</a></li>
        <li role="presentation"><a href="#house" aria-controls="house" role="tab" data-toggle="tab">Featured
            House</a></li>
      </ul>
      <!--
        <ul class="portfolio-filter">
            <li><a class="btn btn-default active" href="#" data-filter="*">All</a></li>
            <li><a class="btn btn-default" href="#" data-filter=".bootstrap">Bootstrap</a></li>
            <li><a class="btn btn-default" href="#" data-filter=".html">HTML</a></li>
            <li><a class="btn btn-default" href="#" data-filter=".wordpress">Wordpress</a></li>
        </ul>
        -->
      <!--/#portfolio-filter-->
      <div class="tab-content">
      	<div class="ad-wrap margin-top-20" style="width:98%;">{{ HTML::image('images/demoimages/bannerAd.jpg', '', array('class' => '')) }}</div>
      
        <div role="tabpanel" class="tab-pane active" id="project">
          <ul class="portfolio-items">
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a9.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a2.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a3.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a4.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a5.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a6.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a7.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a8.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane" id="condos">
          <ul class="portfolio-items">
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a11.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a10.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a11.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a12.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a13.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a14.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a15.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a7.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane" id="apartments">
          <ul class="portfolio-items">
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a2.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a5.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a11.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a14.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a9.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a1.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a3.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a4.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane" id="house">
          <ul class="portfolio-items">
          	<li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a7.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a12.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a15.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a10.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a5.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a8.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a4.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image('images/demoimages/a11.jpg', '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;24,500</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="#" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            <!--/.portfolio-item-->
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/#portfolio-->
<!--/Need Help-->
<section class="container" id="need-help">
<div class="row well silver white">
  <div class="col-md-8 col-sm-8">
    <h4>Need help finding one</h4>
    Dont worry, we have dedicated sales staff ? Agent to help you find the place
    you need in no time 
   </div>
   <div class="col-md-4 col-sm-4">
   	<div class="contactuswrap"><button type="button" class="btn btn-primary upperclass contactus">Contact US</button></div>
   </div>
</div>
</section>
<!--/Need Help-->

<!-- Latest properties -->
@if(count($dataset["properties"])>0)
<section class="container">
  <div class="row">
	<h2>Latest Properties</h2>
    <ul class="portfolio-items">
    	@foreach($dataset["properties"] as $property)
    	<li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> {{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => '')) }}
                <div class="eventphototext">
                  <h5>{{{ $property->title }}}</h5>
                  <p>{{{ substr($property->description, 0, 125) }}}</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f; {{{ number_format($property->price, 2, ".", ",") }}}</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="{{URL::to('/property/show')}}/{{{ $property->property_id }}}" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            @endforeach
    </ul>
    
  </div>
</section>
@endif
<!-- Latest properties -->

<!--/Featured Agent-->
	<section class="container"id="FeaturedAgent">

  <div class="row">
	<h2>Featured Agents</h2>
    <div class="slider image_slider agentprofile col-md-12 no-margin">
       <div class="white col-md-15 col-sm-3">
       	<div class="profileimg"><a href="{{URL::to('/property/mylist/1')}}"> {{ HTML::image('images/demoimages/logo1.jpg', '', array('class' => 'img-responsive')) }}</a></div>
       	<!--<a href="javascript:void(0)" class="center"> Agent Name </a>
        <div>
        <p class="center">We can add a short description here, for 1 to 2 lines of sentences.</p>
        </div>-->
       </div>
       <div class="white col-md-15 col-sm-3">
       	<div class="profileimg"><a href="{{URL::to('/property/mylist/1')}}"> {{ HTML::image('images/demoimages/logo2.jpg', '', array('class' => 'img-responsive')) }}</a></div>
       	
       </div>
       <div class="white col-md-15 col-sm-3">
       	<div class="profileimg"><a href="{{URL::to('/property/mylist/1')}}"> {{ HTML::image('images/demoimages/logo3.jpg', '', array('class' => 'img-responsive')) }}</a></div>
       	
       </div>
       <div class="white col-md-15 col-sm-3">
       	<div class="profileimg"><a href="{{URL::to('/property/mylist/1')}}"> {{ HTML::image('images/demoimages/logo4.jpg', '', array('class' => 'img-responsive')) }}</a></div>
       	
       </div>
       <div class="white col-md-15 col-sm-3">
       	<div class="profileimg"><a href="{{URL::to('/property/mylist/1')}}"> {{ HTML::image('images/demoimages/logo5.jpg', '', array('class' => 'img-responsive')) }}</a></div>
       	
       </div>
    </div>
    
  </div>
</section>
<!--/Featured Agent-->

<!--/ThaiBrick Recomendation-->
<section class="container" id="StrategyAds">
<div class="row">
<h2>ThaiBricks Recommendations / Strategy Ads</h2>

<div class="container">
    <!-- main slider carousel -->
    <div class="row">
      <div class="" id="slider">
        <!-- main slider carousel items -->
        <div class="col-md-8" id="carousel-bounding-box">
          <div id="myCarousel" class="carousel slide homeCarousel">
            <div class="carousel-inner">
              <div class="active item" data-slide-number="0"> 
              	<img src="{{{ asset('images/demoimages') }}}/slWide1.jpg" class="img-responsive"> 
              	<div class="well col-md-12 carouseltext">
              <div class="col-md-8">Its all about chicken crossing the road. why did the chicken cross road. I have no clue. Its all about chicken crossing the road. why did 
              </div>
              <div class="col-md-4">
              <button type="button" class="btn btn-primary upperclass seemore">See More</button>
              </div>
              </div>
              </div>
              <div class="item" data-slide-number="1"> 
              	<img src="{{{ asset('images/demoimages') }}}/slWide2.jpg" class="img-responsive"> 
                <div class="well col-md-12 carouseltext">
              <div class="col-md-8">Its all about chicken crossing the road. why did the chicken cross road. I have no clue. Its all about chicken crossing the road. why did 
              </div>
              <div class="col-md-4">
              <button type="button" class="btn btn-primary upperclass seemore">See More</button>
              </div>
              </div>
              </div>
              <div class="item" data-slide-number="2"> 
              	<img src="{{{ asset('images/demoimages') }}}/slWide3.jpg" class="img-responsive"> 
                <div class="well col-md-12 carouseltext">
              <div class="col-md-8">Its all about chicken crossing the road. why did the chicken cross road. I have no clue. Its all about chicken crossing the road. why did 
              </div>
              <div class="col-md-4">
              <button type="button" class="btn btn-primary upperclass seemore">See More</button>
              </div>
              </div>
              </div>
              <div class="item" data-slide-number="3"> 
              	<img src="{{{ asset('images/demoimages') }}}/slWide4.jpg" class="img-responsive"> 
                <div class="well col-md-12 carouseltext">
              <div class="col-md-9">Its all about chicken crossing the road. why did the chicken cross road. I have no clue. Its all about chicken crossing the road. why did 
              </div>
              <div class="col-md-3">
              <button type="button" class="btn btn-primary upperclass seemore">See More</button>
              </div>
              </div>
              </div>
              <div class="item" data-slide-number="4"> 
              	<img src="{{{ asset('images/demoimages') }}}/slWide5.jpg" class="img-responsive"> 
                <div class="well col-md-12 carouseltext">
              <div class="col-md-8">Its all about chicken crossing the road. why did the chicken cross road. I have no clue. Its all about chicken crossing the road. why did 
              </div>
              <div class="col-md-4">
              <button type="button" class="btn btn-primary upperclass seemore">See More</button>
              </div>
              </div>
              </div>
            </div>
             <a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a> <a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
        </div>
        <!-- thumb navigation carousel -->
        <div class="col-md-4">
          <div class="col-md-12 hidden-sm hidden-xs" id="slider-thumbs">
            <ul class="list-inline">
              <li class="clearfix" id="carousel-selector-0"> 
              <a class="selected col-md-5"> <img src="{{{ asset('images/demoimages') }}}/sliderThumb1.jpg" > </a> 
              <div class="phototext col-md-7">
                  <strong>Asoke Plu Condo</strong>
                  <small>We can add a short description here, for 1 to 2 lines of
                    sentences.</small>
                </div>
              </li>
              <li class="clearfix"  id="carousel-selector-1"> 
              <a class="selected col-md-5"> <img src="{{{ asset('images/demoimages') }}}/sliderThumb2.jpg" > </a> 
              <div class="phototext col-md-7">
                  <strong>Asoke Plu Condo</strong>
                  <small>We can add a short description here, for 1 to 2 lines of
                    sentences.</small>
                </div>
              </li>
              <li class="clearfix"  id="carousel-selector-2"> 
              <a class="selected col-md-5"> <img src="{{{ asset('images/demoimages') }}}/sliderThumb3.jpg" > </a> 
              <div class="phototext col-md-7">
                  <strong>Asoke Plu Condo</strong>
                  <small>We can add a short description here, for 1 to 2 lines of
                    sentences.</small>
                </div>
              </li>
              <li class="clearfix"  id="carousel-selector-3"> 
              <a class="selected col-md-5"> <img src="{{{ asset('images/demoimages') }}}/sliderThumb4.jpg" > </a> 
              <div class="phototext col-md-7">
                  <strong>Asoke Plu Condo</strong>
                  <small>We can add a short description here, for 1 to 2 lines of
                    sentences.</small>
                </div>
              </li>
              <li class="clearfix"  id="carousel-selector-4"> 
              <a class="selected col-md-5"> <img src="{{{ asset('images/demoimages') }}}/sliderThumb5.jpg" > </a> 
              <div class="phototext col-md-7">
                  <strong>Asoke Plu Condo</strong>
                  <small>We can add a short description here, for 1 to 2 lines of
                    sentences.</small>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--/main slider carousel-->
  </div>
</div>
</section>
<!--/ThaiBrick Recomendation-->
 <!--#gototop-->
<section class="container" id="gototopwrap" style="background:none;">
  <div class="">
    <div class="row">
      <div class="col-sm-6"> You are here:  <a title="home" href="javascript:void(0)">Home</a></div>
      <div class="col-sm-6">
        <ul class="pull-right">
          <li class="totop"><a href="#" class="gototop" id="gototop">Top  <span class="fa fa-arrow-up"></span></a></li>
          <!--#gototop-->
        </ul>
      </div>
    </div>
  </div>
</section>
@stop