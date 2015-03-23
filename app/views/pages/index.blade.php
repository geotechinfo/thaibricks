@extends('layouts.default')
@section('content')
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
            {{ $dataset['search_panel'] }}
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
        <!--<li role="presentation" class="active"><a href="#project" aria-controls="project" role="tab" data-toggle="tab">Featured
            Projects</a></li>
        <li role="presentation"><a href="#condos" aria-controls="condos" role="tab" data-toggle="tab">Featured
            Condos</a></li>-->
        @if(count($dataset['featured_apartment']))    
        <li role="presentation"><a href="#apartments" aria-controls="apartments" role="tab" data-toggle="tab">Featured
            Apartments</a></li>
        @endif
        @if(count($dataset['featured_house']))        
        <li role="presentation"><a href="#house" aria-controls="house" role="tab" data-toggle="tab">Featured
            House</a></li>
         @endif    
      </ul>
     
      <!--/#portfolio-filter-->
      <div class="tab-content featured_bricks">
      	<div class="ad-wrap margin-top-20">
        <a href="javascript:;">{{ HTML::image('images/demoimages/bannerAd.jpg', '', array('class' => '')) }}</a>
       </div>
      
        <div role="tabpanel" class="tab-pane" id="project">
          <ul class="portfolio-items">
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <a href="javascript:;">{{ HTML::image('images/demoimages/a9.jpg', '', array('class' => '')) }}</a>
                <div class="eventphototext">
                  <h5>Asoke Plu Condo</h5>
                  <p>We can add a short description here, for 1 to 2 lines of sentences.</p>
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
            
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane" id="condos">
          <ul class="portfolio-items">
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <a href="javascript:;">{{ HTML::image('images/demoimages/a11.jpg', '', array('class' => '')) }}</a>
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
           
          </ul>
        </div>


        <div role="tabpanel" class="tab-pane active" id="apartments">
          <ul class="portfolio-items">
            @foreach($dataset['featured_apartment'] as $k=>$property)
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <a href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => '')) }}</a>
                <div class="eventphototext">
                  <h5><a href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}">{{$property->title}}</a></h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;{{$property->price}}</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane" id="house">
          <ul class="portfolio-items">
          	 @foreach($dataset['featured_house'] as $k=>$property)
            <li class="portfolio-item col-md-3 col-sm-6">
              <div class="item-inner"> <a href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => '')) }}</a>
                <div class="eventphototext">
                  <h5><a href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}">{{$property->title}}</a></h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f;{{$property->price}}</div>
                  <div class="viewmore projectinfobtn center pull-right"><a href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="seemore"><span class="">See
                        More</span> </a> </div>
                </div>
              </div>
            </li>
            @endforeach
            
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
    <ul class="portfolio-items home_latest">
    	@foreach($dataset["properties"] as $property)
    	<li class="portfolio-item col-md-2 col-sm-6">
              <div class="item-inner"> 
              <a href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="homeLatestPhotoHolder">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => '')) }}
              <span class="latestLocation">Bangkok</span>
              </a>
                <div class="eventphototext evPhotoHt">
                  <h5><a href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}">{{{ $property->title }}}</a></h5>
                  <!--<p>{{{ substr($property->description, 0, 125) }}}</p>-->
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left fullWidth">&#xe3f; {{{ number_format($property->price, 2, ".", ",") }}}</div>
                  <!-- <div class="viewmore projectinfobtn center pull-right">
                      <a href="{{URL::to('/property/show')}}/{{{ $property->property_id }}}" class="seemore">
                          <span class="">See More</span>
                      </a>
                  </div> -->
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
      <div class="row">
        @foreach($dataset['featured_user'] as $k=>$agent)
        @if($agent->profile_image!='')
        <div class="white col-md-15 col-sm-3">
       	  <div class="profileimg"><a href="{{URL::to('/property/mylist/')}}/{{$agent->user_id}}"> {{ HTML::image('files/profiles/'.$agent->profile_image, '', array('class' => 'img-responsive')) }}</a></div>
        </div>
        @endif
        @endforeach
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
      <div class="col-sm-12">

          <span>You are here:</span>
          <ul class="topBreadcrumbs">
            <li><a href="javascript:;">Home</a></li>
          </ul>

      </div>

    </div>
  </div>
</section>
@stop