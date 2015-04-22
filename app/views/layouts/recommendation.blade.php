<?php 
  $reco = CommonHelper::getRecommendation(5);
  //pr($reco);
?>
@if(count($reco))
<section class="container " id="StrategyAds">
<div class="row">
<h2 style="margin-top:0;">ThaiBricks Recommendations / Strategy Ads</h2>

<div class="container">
    <!-- main slider carousel -->
    <div class="row">
      <div class="" id="slider">
        <!-- main slider carousel items -->
        <div class="col-md-8" id="carousel-bounding-box">
          <div id="myCarousel" class="carousel slide homeCarousel">
            <div class="carousel-inner">
              @foreach($reco as $k=>$v)
              <div class="<?php echo ($k==0?'active':'')?> item" data-slide-number="{{$k}}"> 
                <img src="{{{ asset('files/recommendation') }}}/{{$v->image_file}}" class="img-responsive"> 
                <div class="well col-md-12 carouseltext">
                  <div class="col-md-8"><div style="min-height:60px;">{{$v->description}}</div></div>
                  <div class="col-md-4">
                    <a href="{{URL::action('PropertiesController@details',[''])}}/{{seo_url($v->title)}}_{{$v->property_code}}" class="btn btn-primary upperclass seemore">See More</a>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
             <a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a> <a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
        </div>
        <!-- thumb navigation carousel -->
        <div class="col-md-4">
          <div class="col-md-12 hidden-sm hidden-xs" id="slider-thumbs">
            <ul class="list-inline">
              @foreach($reco as $k=>$v)
              <li class="clearfix" id="carousel-selector-{{$k}}"> 
              <a class="<?php echo ($k==0?'selected':'')?> col-md-5"> <img src="{{{ asset('files/recommendation') }}}/thumb_{{$v->image_file}}"  > </a> 
              <div class="phototext col-md-7">
                  <strong>{{ Str::limit($v->title, 15) }}</strong>
                  <small>{{ Str::limit($v->description, 60) }}</small>
              </div>
              </li>
               @endforeach
              
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--/main slider carousel-->
  </div>
</div>
</section>
@endif