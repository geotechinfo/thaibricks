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
            <li><a href="{{URL::action('PagesController@index')}}">Home</a></li>
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
  <div class="row">
  <div class="col-sm-6 propertyname_price">
   <div class="gap10"></div>
    <h2 class="pull-left">Agent List</h2>
    <h2 class="pull-right"></h2>
   </div>
   <div class="col-sm-3">
     <div class="gap20"></div>
     <input type="text" id="agent_search" data-toggle="search" data-target="#propertydetail .cls_agents" data-norecord=".norecord" class="form-control" placeholder="Search Agent" />
   </div>
   <div class="col-sm-3">
     <div class="gap20"></div>
     <?php //pr($location_list) ?>
      <?php 
        $loc_list = CommonHelper::getLocation(1);
        //$loc_list[''] = 'Select Location';
        //$loc_list = array_reverse($loc_list);
        //array_unshift($loc_list, 'Select Location');
      ?>
      {{Form::select('agent_location',$loc_list,$dataset['location'],array('class'=>'form-control','id'=>'agent_location'))}}
    
   </div>
  </div>
   
    
  </div>
  <!---->
</section>


<!--/Main Theme & Search-->
<section class="container container2 noPadding" id="propertydetail">
  

  <div class="col-md-9 col-md-push-3 propertydetailswrap">
    <div class="row propety-feature nrLocationInner agent_details" style="padding-top:3px;">
    @if(count($dataset['list']))
      @foreach($dataset['list'] as $k=>$user)
      <div class="col-sm-3 cls_agents">
        <div class="well featuredagentbo featureAgBox boxHover">
          <div class="row">
            <div class="col-sm-12">
            	<?php 
        				$slug = seo_url($user->first_name.' '.$user->last_name).'_'.$user->user_code;
        			?>
                <?php if($user->profile_image!=''){?>
                <a class="selected agListImageHolder" href="{{URL::action('UsersController@agent', [$slug])}}"> 
                  {{ HTML::image('files/profiles/'.$user->profile_image, '', array('class' => 'img-responsive btn-block ','id'=>'profile_image','style'=>'')) }}
                </a> 
                <?php }else{?>
                <a class="selected agListImageHolder" href="{{URL::action('UsersController@agent', [$slug])}}"> 
                  {{ HTML::image('images/agentprofile/profiledummy.png', '', array('class' => 'img-responsive btn-block ','id'=>'profile_image','style'=>'')) }}
                </a>
                <?php }?>
                
                  <div class="phototext text-left">
                  <div class="gap10"></div>
                      <p class="textTruncate text-capitalize noMargin">
                        <span class="fa fa-user"></span> {{$user->first_name }} {{$user->last_name}}
                        @if($user->location_name!='')
                        <small>({{$user->location_name}})</small>
                        @endif
                      </p>
                      <!--<p class="textTruncate"><small><i class="fa fa-envelope"></i> <span>{{$user->email}}</span></small></p>
                      <p class="textTruncate"><small><i class="fa fa-phone"></i> <span>{{$user->phone}}</span></small></p>-->
                      <p class="textTruncate"><small><i class="fa fa-map-marker"></i> <span>{{$user->location_name}}</span></small></p>
                      <a href="{{URL::action('UsersController@agent',[$slug])}}" target="_blank" class="btn btn-default fullWidth orange">View Properties</a>
                  </div>
            </div>
            <!--<div class="col-sm-8">
                <p class="text-justify">{{$user->description}}</p>
            </div>-->
          </div>
        </div>
      </div>
      @endforeach
      <div class="norecord" style="display:none">
        <div class="alert alert-danger">
          <i class="fa fa-exclamation-triangle"></i> No agent has been found
        </div>
      </div>
    @else
      <div class="">
        <div class="alert alert-danger">
          <i class="fa fa-exclamation-triangle"></i> No agent has been found
        </div>
      </div>
    @endif  
      
    </div>
  </div>
  
  <aside class="col-md-3 col-md-pull-9 left-panel">
    {{View::make('layouts.side_ad_block')}}
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
      
      var url = ($(this).find('option:selected').text()).toLowerCase().replace(' ','_');  
      if($(this).val()!=''){
        window.location.href="{{URL::to('/')}}/agents/"+url;
      }else{
        window.location.href="{{URL::to('/')}}/agents/all";
      }     
      
      return false;
    });

    
    $('[data-toggle="search"]').bind('keyup blur change',function(){

      var selector = $(this).data('target');
      var norecordcss = $(this).data('norecord');
      $(norecordcss).hide();
      $(selector).hide();
      var ths = $(this);
      var v = ths.val();
      if(v.length==0){
         $(selector).fadeIn();
      }else{          
        var totlen = $(selector).length;
        var count = 0;
        //$(selector).hide();
        $(selector).each(function(i){                
            if($(this).text().search(new RegExp(v, "i")) > 0){    
                $(this).fadeIn();
            }else{
                count++;
                $(this).fadeOut();
            }                
        });
        if(totlen==count){
            $(norecordcss).show();
        }else{
            $(norecordcss).hide();
        }
      }
  });

  });

  </script>
@stop