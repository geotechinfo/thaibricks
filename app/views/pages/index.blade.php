@extends('layouts.default')
@section('content')
<!--/Main Theme & Search-->

<section class="no-margin" id="main-slider">
  <div class="container ad-text-wrap">

  </div>
  <div class="themewrap">
    <div class="theme" id="theme">
      <?php 
        $premium_banner = CommonHelper::getAds(array('ad_type'=>1,'location_id'=>LOCATION_ID),$limit=1);
        $premium_banner_image_file = $premium_banner[0]->image_file;
        //pr($premium_banner);
        $slug = seo_url($premium_banner[0]->title).'_'.$premium_banner[0]->property_code;
      ?>
    	{{ HTML::image('files/advertise/'.$premium_banner_image_file, '', array('class' => 'banner')) }}
      <div class="container searchcontent">
        <div class="contentwrap">
             @if($premium_banner[0]->link!='')
            <div class="ad-text">
            <?php $text = unserialize($premium_banner[0]->description);?>
                @if(isset($text['caption']))
                <h3>{{$text['caption']}}</h3>
                @endif

                @if(isset($text['info_line']))
                <p>{{$text['info_line']}}</p>
                @endif
                
                <small><a target="_blank" href="{{$premium_banner[0]->link}}">Read More </a></small>
                
            </div>
            @endif
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
        
                 
        <li role="presentation" class="active"><a href="#apartments" aria-controls="apartments" role="tab" data-toggle="tab">Featured
            Apartments</a></li>           
        <li role="presentation"><a href="#house" aria-controls="house" role="tab" data-toggle="tab">Featured
            House</a></li>
        <li role="presentation"><a href="#condos" aria-controls="condos" role="tab" data-toggle="tab">Featured
            Condos</a></li>
        <li role="presentation"><a href="#project" aria-controls="project" role="tab" data-toggle="tab">Featured
            Projects</a></li>     
      </ul>
     
      <!--/#portfolio-filter-->
      <div class="tab-content featured_bricks">  

        <div role="tabpanel" class="tab-pane active" id="apartments">
          <div class="ad-wrap margin-top-20">
             <?php 
              $featured_apartments = CommonHelper::getAds(array('ad_type'=>4,'location_id'=>LOCATION_ID),$limit=1);
              //pr( $featured_apartments);
            ?>
            <a href="{{$featured_apartments[0]->link}}">{{ HTML::image('files/advertise/'.$featured_apartments[0]->image_file, '', array('class' => '')) }}</a>
          </div>
          <ul class="portfolio-items">
            @foreach($dataset['featured_apartment'] as $k=>$property)
            <li class="portfolio-item col-md-3 col-sm-6">
            <div class="outlineHover">
              <div class="item-inner"> <a href="{{URL::action('PropertiesController@details',[''])}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" target="_blank" class="homepgFeaturedBricksImage">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => '')) }}</a>
                <div class="eventphototext">
                  <h5><a href="{{URL::action('PropertiesController@details',[''])}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" target="_blank">{{$property->title}}</a></h5>
                  <?php $small_desc = preg_replace('/\s+?(\S+)?$/', '', substr($property->description, 0, 80)); ?>{{{ $small_desc }}}</p>
                </div>              
              </div>
              <div class="commentwrap asbestos">
                <div class="clearfix">
                  <div class="price projectinfobtn center pull-left">&#xe3f;{{$property->price}}</div>
                  <a href="{{URL::action('PropertiesController@details',[''])}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="seemore viewmore projectinfobtn center pull-right" target="_blank"><span class="">See More</span> </a>
                </div>
              </div>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane" id="house">
          <div class="ad-wrap margin-top-20">
           <?php 
              $featured_house = CommonHelper::getAds(array('ad_type'=>5,'location_id'=>LOCATION_ID),$limit=1);
            ?>
            <a href="{{$featured_house[0]->link}}">{{ HTML::image('files/advertise/'.$featured_house[0]->image_file, '', array('class' => '')) }}</a>
          </div>
          <ul class="portfolio-items">
          	 @foreach($dataset['featured_house'] as $k=>$property)
            <li class="portfolio-item col-md-3 col-sm-6">
            <div class="outlineHover">
              <div class="item-inner"> <a href="{{URL::action('PropertiesController@details',[''])}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" target="_blank" class="homepgFeaturedBricksImage">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => '')) }}</a>
                <div class="eventphototext">
                  <h5><a href="{{URL::action('PropertiesController@details',[''])}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" target="_blank">{{$property->title}}</a></h5>
                  <p>We can add a short description here, for 1 to 2 lines of
                    sentences.</p>
                </div>
                <!--
                <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                -->
              </div>
              <div class="commentwrap asbestos">
                <div class="clearfix">
                  <div class="price projectinfobtn center pull-left">&#xe3f;{{$property->price}}</div>
                  <a href="{{URL::action('PropertiesController@details',[''])}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="seemore viewmore projectinfobtn center pull-right" target="_blank"><span class="">See
                        More</span> </a>
                </div>
              </div>
              </div>
            </li>
            @endforeach
            
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane" id="condos">
          <div class="ad-wrap margin-top-20">
            <?php 
              $featured_condos = CommonHelper::getAds(array('ad_type'=>3,'location_id'=>LOCATION_ID),$limit=1);
            ?>
            <a href="{{$featured_condos[0]->link}}">{{ HTML::image('files/advertise/'.$featured_condos[0]->image_file, '', array('class' => '')) }}</a>
          </div>
          <ul class="portfolio-items">
            
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane" id="project">
          <div class="ad-wrap margin-top-20">
            <?php 
              $featured_projects = CommonHelper::getAds(array('ad_type'=>2,'location_id'=>LOCATION_ID),$limit=1);
            ?>
            <a href="{{$featured_projects[0]->link}}">{{ HTML::image('files/advertise/'.$featured_projects[0]->image_file, '', array('class' => '')) }}</a>
          </div>
          <ul class="portfolio-items">
                       
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
   	<div class="contactuswrap"><a href="{{URL::action('PagesController@contact')}}" class="btn btn-primary upperclass contactus">Contact US</a></div>
   </div>
</div>
</section>
<!--/Need Help-->

<!-- Latest properties -->
@if(count($dataset["properties_latest"])>0)
<section class="container ">
  <div class="row">
	<h2 class="mtPtNone">Latest Properties</h2>
    <ul class="portfolio-items home_latest">
    	@foreach($dataset["properties_latest"] as $property)
      <?php //pr($property);?>
    	<li class="portfolio-item col-md-2 col-sm-6">
            <div class="outlineHover">
              <div class="item-inner "> 
                  <a href="{{URL::action('PropertiesController@details',[''])}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="homeLatestPhotoHolder" target="_blank">
                  {{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => '')) }}
                  <span class="latestLocation">{{$property->location_name}}</span>
                  <span class="typeOfProp">{{$property->deal_name}}</span>
                  </a>
                    <div class="eventphototext evPhotoHt">
                      <h5 class="text-center"><a href="{{URL::action('PropertiesController@details',[''])}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" target="_blank">{{{ $property->title }}}</a></h5>
                      <!--<p>{{{ substr($property->description, 0, 125) }}}</p>-->
                    </div>
                    <!--
                    <div class="overlay"> <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="fa fa-search"></i></a> </div>
                    -->
                  </div>
                  <div class="commentwrap asbestos">
                    <div class="clearfix">
                      <div class="price projectinfobtn center pull-left fullWidth">&#xe3f; {{{ number_format($property->price, 0, ".", ",") }}}</div>
                      <!-- <div class="viewmore projectinfobtn center pull-right">
                          <a href="{{URL::to('/property/show')}}/{{{ $property->property_id }}}" class="seemore">
                              <span class="">See More</span>
                          </a>
                      </div> -->
                    </div>
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
@if(count($dataset['featured_user']))
	<section class="container mtPtNone" id="FeaturedAgent">

  <div class="row">
	<h2 class="mtPtNone" >Featured Agents</h2>
    <div class="slider image_slider agentprofile col-md-12 no-margin">
      <div class="clearfix fAgentList">
        @foreach($dataset['featured_user'] as $k=>$agent)
        <?php if($agent->profile_image==''){
            $image = "images/agentprofile/profiledummy.png";
        }else{
          $image = "files/profiles/".$agent->profile_image;
        }

        ?>
        <?php 
          $slug = seo_url($agent->first_name.' '.$agent->last_name).'_'.$agent->user_code;
        ?>
        <div class="white col-md-15 col-sm-3">
       	  <div class="profileimg"><a href="{{URL::action('UsersController@agent', [$slug])}}" data-toggle="tooltip" data-placement="top" title="{{$agent->first_name}} {{$agent->last_name}}" target="_blank" class="noPadding"> {{ HTML::image($image, '', array('class' => 'img-responsive')) }}
          <span>{{$agent->first_name}} {{$agent->last_name}}</span></a>
          </div>
        </div>
        
        @endforeach
      </div>
      
    </div>
    
  </div>
</section>
@endif
<!--/Featured Agent-->

<!--/ThaiBrick Recomendation-->
{{View::make('layouts.recommendation')}}
<!--/ThaiBrick Recomendation-->
 <!--#gototop-->

@stop