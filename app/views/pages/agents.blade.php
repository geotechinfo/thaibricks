@extends('layouts.default')
{{ HTML::style('libraries/startrating/jquery.rating.css') }}

{{ HTML::script('libraries/slick/slick.js') }}
{{ HTML::script('libraries/startrating/jquery.rating.js') }}
{{ HTML::script('libraries/slimheader/classie.js') }}

@section('content')

<?php
  $loc = new Location();
  $location_list=$loc->get_location_with_sub();
  //pr($location_list);
?>
<section class="container container2" id="gototopwrap">
  <div class="">
    <div class="innerBread">
      <div class="col-sm-12">
      	  <span>You are here:</span>
          <ul class="topBreadcrumbs">
            <li><a href="{{URL::to('/')}}">Home</a></li>
            <li><a href="javascript:;">Agents </a></li>
          </ul>
      
      </div>
      
    </div>
  </div>
</section>

<?php $property = $dataset["properties"][0]; ?>
<!--/Main Theme & Search-->
<section class="no-margin" id="list-search">
  <div class="container searchcontent container2 headrow">

   <div class="col-sm-9 propertyname_price">
   <div class="gap10"></div>
    <h2 class="pull-left">Agent List</h2>
    <h2 class="pull-right"></h2>
   </div>
   <div class="col-sm-3">
   <div class="gap20"></div>
   <?php //pr($location_list) ?>
    <select class="form-control" id="agent_location">
      <option <?php echo ($dataset['selected']=='all'?'selected':'')?> value="all">Select Location</option>
      <?php foreach ($location_list as $k => $v) {
        echo "<option ".($dataset['selected']==$v['location_id']?'selected':'')." value='".$v['location_id']."'>".$v['location_name']."</option>";
      }?>
    </select>
   </div>
    
  </div>
  <!---->
</section>


<!--/Main Theme & Search-->
<section class="container container2" id="propertydetail">
  

  <div class="col-md-9 col-md-push-3 propertydetailswrap">
    <div class="row propety-feature nrLocationInner agent_details">
      @foreach($dataset['list'] as $k=>$user)
      <div class="col-sm-4">
        <div class="well featuredagentbo featureAgBox">
          <div class="row">
            <div class="col-sm-12">
                <?php if($user->profile_image!=''){?>
                <a class="selected agListImageHolder" href="{{URL::to('agent/')}}/{{seo_url($user->first_name." ".$user->last_name)}}_{{$user->user_code}}"> 
                  {{ HTML::image('files/profiles/'.$user->profile_image, '', array('class' => 'img-responsive btn-block ','id'=>'profile_image','style'=>'')) }}
                </a> 
                <?php }else{?>
                <a class="selected agListImageHolder" href="{{URL::to('agent/')}}/{{seo_url($user->first_name." ".$user->last_name)}}_{{$user->user_code}}"> 
                  {{ HTML::image('images/agentprofile/profiledummy.png', '', array('class' => 'img-responsive btn-block ','id'=>'profile_image','style'=>'')) }}
                </a>
                <?php }?>
                
                  <div class="phototext text-left">
                  <div class="gap20"></div>
                      <p class="textTruncate text-capitalize">
                        <strong><span class="fa fa-user"></span> {{$user->first_name }} {{$user->last_name}}</strong>
                        @if($user->location_name!='')
                        <small>({{$user->location_name}})</small>
                        @endif
                      </p>
                      <p class="textTruncate"><small><i class="fa fa-envelope"></i> <span>{{$user->email}}</span></small></p>
                      <p class="textTruncate"><small><i class="fa fa-phone"></i> <span>{{$user->phone}}</span></small></p>
                    <div class="gap20"></div>
                      <a href="{{URL::to('agent/')}}/{{seo_url($user->first_name." ".$user->last_name)}}_{{$user->user_code}}" target="_blank" class="btn btn-default fullWidth">View Other Properties</a>
                      
                  </div>
            </div>
            <!--<div class="col-sm-8">
                <p class="text-justify">{{$user->description}}</p>
            </div>-->
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  
  <aside class="col-md-3 col-md-pull-9 left-panel">
  		 <form class="center" role="form">
  		
         <div class="ad-wrap">{{ HTML::image('images/demoimages/ad8.jpg', '', array('class' => '')) }}</div>
         <div class="ad-wrap">{{ HTML::image('images/demoimages/ad1.jpg', '', array('class' => '')) }}</div>
         <div class="ad-wrap">{{ HTML::image('images/demoimages/ad6.jpg', '', array('class' => '')) }}</div>
         </form>
  </aside>
  
  
</section>
  
  {{ HTML::script('libraries/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js') }}

  {{ HTML::script('libraries/fancyBox/source/jquery.fancybox.js?v=2.1.5') }}
  {{ HTML::style('libraries/fancyBox/source/jquery.fancybox.css?v=2.1.5') }}

  {{ HTML::script('libraries/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}
  {{ HTML::style('libraries/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}

  {{ HTML::script('libraries/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7') }}
  {{ HTML::style('libraries/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') }}

  {{ HTML::script('libraries/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.6') }}
 
  <script type="text/javascript">
  $(document).ready(function(){
    $('.fancybox-thumbs').fancybox({
        prevEffect : 'none',
        nextEffect : 'none',

        closeBtn  : true,
        arrows    : true,
        nextClick : true,

        helpers : {
          thumbs : {
            width  : 50,
            height : 50
          }
        }
      });

    $('#agent_location').change(function(){
      window.location="{{URL::to('agents')}}/"+$(this).val();
    });
  });

  </script>
@stop