@extends('layouts.default')
{{ HTML::style('libraries/startrating/jquery.rating.css') }}

{{ HTML::script('libraries/slick/slick.js') }}
{{ HTML::script('libraries/startrating/jquery.rating.js') }}
{{ HTML::script('libraries/slimheader/classie.js') }}

@section('content')

<style type="text/css">
.fit_inthe_box{width:100%;}
.propetymap-desc .ad-wrap:before{display:none; }    
</style>
<section class="container container2" id="gototopwrap">
  <div class="">
    <div class="innerBread">
      <div class="col-sm-12">
      	  <span>You are here:</span>
          <ul class="topBreadcrumbs">
            <li><a href="{{URL::to('/')}}">Home</a></li>
            <li><a href="javascript:;">Property Detail</a></li>
          </ul>
      
      </div>
      
    </div>
  </div>
</section>

<?php $property = $dataset["properties"][0]; ?>
<!--/Main Theme & Search
<section class="no-margin" id="list-search">
  <div class="container searchcontent container2 headrow">
     <?php if(Session::has('admin')){?>
    <div class="col-md-3">
     <div class="adminRule">
     
      <a href="{{URL::to('property/change_status/')}}/status/{{$property->property_id}}" class="btn <?php echo ($property->status==1?'btn-default':'orange')?> btn-sm ">
        <i class="fa fa-cog"></i> 
        <?php echo ($property->status==1?'Deactivate':'Activate')?>
      </a>
      <a href="{{URL::to('property/change_status/')}}/featured/{{$property->property_id}}" class="btn <?php echo ($property->is_featured==1?'btn-default':'orange')?> btn-sm">
        <i class="fa fa-star-o"></i>
        <?php echo ($property->is_featured==1?'Unfeatured':'Featured')?> 
      </a>
      <a href="{{URL::to('property/change_status/')}}/hot/{{$property->property_id}}" class="btn <?php echo ($property->is_hot==1?'btn-default':'orange')?> btn-sm  ">
        <i class="fa fa-fire"></i> Hot
      </a>
      
      </div>
    </div>
    <?php }?>
   <div class="col-md-<?php echo (Session::has('admin')?'9':'12')?> propertyname_price">
    <h2 class="pull-left">{{{ $property->title }}}</h2>
    <h2 class="pull-right">&#xe3f; {{{ number_format($property->price, 2, ".", ",") }}}</h2>
   </div>
    
  </div>
</section>-->


<!--/Main Theme & Search-->
<section class="container container2" id="propertydetail">
  

<div class="<?php if(Session::has('admin')){echo "col-md-12 noBorder";}else{echo "col-md-9 col-md-push-3";}?> propertydetailswrap">
  


<section class="noMargin" id="list-search">
  <div class="searchcontent  headrow clearfix">
     <?php if(Session::has('admin')){?>
    <div class="col-md-3" style="padding-left:0;">
     <div class="adminRule">
     
      <a href="{{URL::to('property/change_status/')}}/status/{{$property->property_id}}" class="btn <?php echo ($property->status==1?'btn-default':'orange')?> btn-sm ">
        <i class="fa fa-cog"></i> 
        <?php echo ($property->status==1?'Deactivate':'Activate')?>
      </a>
      <a href="{{URL::to('property/change_status/')}}/featured/{{$property->property_id}}" class="btn <?php echo ($property->is_featured==1?'btn-default':'orange')?> btn-sm">
        <i class="fa fa-star-o"></i>
        <?php echo ($property->is_featured==1?'Unfeatured':'Featured')?> 
      </a>
      <a href="{{URL::to('property/change_status/')}}/hot/{{$property->property_id}}" class="btn <?php echo ($property->is_hot==1?'btn-default':'orange')?> btn-sm  ">
        <i class="fa fa-fire"></i> Hot
      </a>
      
      </div>
    </div>
    <?php }?>
   <div class="col-md-<?php echo (Session::has('admin')?'9':'12')?> propertyname_price noPadding clearfix">
    <h2 class="pull-left noPadding">{{{ $property->title }}}</h2>
    <h2 class="pull-right noPadding">&#xe3f; {{{ number_format($property->price, 2, ".", ",") }}}</h2>
   </div>
   <div class="col-sm-12"><div class="gap10"></div></div>
    
  </div>
<div class="gap20"></div>
</section>
	
    <div class="clearfix propetymap-desc padding greyBackground" style="padding-top:20px;">
      <div class="col-md-5">
        <!--<h5 class="uppercase">Property Image</h5>-->
        <div class="mapwrap">
          <div class="ad-wrap">
            @foreach($property->media as $key=>$media)
              <a class="fancybox-thumbs" href="{{asset('files/properties')."/".$media->media_data}}" title="{{$media->media_title}}" data-fancybox-group="thumb" style="display:<?php echo ($key>0?'none':'')?>">
                 {{ HTML::image(asset('files/properties')."/".$media->media_data, '', array('class' => '')) }}
              </a>
            @endforeach
          </div>
        </div>
        <div class="gap10"></div>
        <div class="share text-left">
                <a href="https://api.addthis.com/oexchange/0.8/forward/pinterest/offer?url=<?php echo urlencode(URL::to('property/change_status/')."/hot/".$property->property_id)?>&pubid=ra-550a7f4438a2d811&ct=1&title=<?php echo urlencode($property->title)?>&pco=tbxnj-1.0" target="_blank">
                        <i class="fa fa-pinterest-square" title="Pinterest"></i>
                </a>


                <a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=<?php echo urlencode(URL::to('property/change_status/')."/hot/".$property->property_id)?>&pubid=ra-550a7f4438a2d811&ct=1&title=<?php echo urlencode($property->title)?>&pco=tbxnj-1.0" target="_blank">
                        <i class="fa fa-google-plus-square" title="Google+"></i>
                </a>


                <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?php echo urlencode(URL::to('property/change_status/')."/hot/".$property->property_id)?>&pubid=ra-550a7f4438a2d811&ct=1&title=<?php echo urlencode($property->title)?>&pco=tbxnj-1.0" target="_blank">
                        <i class="fa fa-facebook-square" title="Facebook"></i>
                </a>


                <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=<?php echo urlencode(URL::to('property/change_status/')."/hot/".$property->property_id)?>&pubid=ra-550a7f4438a2d811&ct=1&title=<?php echo urlencode($property->title)?>&pco=tbxnj-1.0" target="_blank">
                        <i class="fa fa-twitter-square" title="Twitter"></i>
                </a>


                <a href="https://www.addthis.com/bookmark.php?source=tbx32nj-1.0&v=300&url=<?php echo urlencode(URL::to('property/change_status/')."/hot/".$property->property_id)?>&pubid=ra-550a7f4438a2d811&ct=1&title=<?php echo urlencode($property->title)?>&pco=tbxnj-1.0" target="_blank">
                        <i class="fa fa-plus-square" title="More"></i>
                </a>


        </div>
      </div>
      <div class="col-md-7 propertylist-body">
        <!--<h5 class="uppercase">{{{ $property->first_name }}} {{{ $property->last_name }}}</h5>-->
        <p class="">{{{ $property->description }}}</p>
        <p><a class="btn btn-primary btn-lg orange" href="javascript:;" data-toggle="scrollTo" data-target=".agent_details"> <span class="fa fa-envelope"></span> <span>Contact Info</span> </a></p> 
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
    	
    </div>
    </div>
    <!--<div class="floorplan">
    <div class="col-md-12">
    	<h5 class="uppercase">Floor Plan</h5>
        <div class="ad-wrap">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => '')) }}</div>
    </div>
    </div>-->
    @if(count($property->amenities))
    <div class="">
    <div class="clearfix propety-feature">
        <div class="col-md-12 noPadding">
            <div class="amenities padding greyBackground">
            <h5 class="uppercase">Amenities and Facilities</h5>
              <div class="row  greyBackground">
                 @foreach ($property->amenities as $id => $am) 
                  <div class="col-sm-4">
                    <span class="amenitiesIcon pull-left flexCenter">    
                        <?php echo HTML::image('images/amenities/'.$am['amenity_icon'], '', array('class' => '')); ?>
                    </span>
                    <p>{{$am['amenity_title']}}</p>
                  </div>
                  @endforeach
              </div>
            </div>
        </div>
    </div>
    </div>
    @endif
    <?php 
        $trns = array();
        foreach($property->transports as $transports){ 
          if($transports->type==1 && count($transports->Child)>0){
            foreach ($transports->Child as $k => $v) {
              if(array_key_exists($v->transport_id,$property->selected_transports)){
                $trns[$v->transport_id] = array(
                    'transport_id'=>$v->transport_id,
                    'transport_name'=>$v->transport_name,
                    'transport_icon'=>$transports->transport_icon,
                    'transport_parent'=>$transports->transport_name,
                    'transport_parent_id'=>$transports->transport_id,
                );
              }
            }
          }
        }   
      //  pr($trns); 
    ?>
              
    <div class="clearfix propety-feature nrLocationInner">
        <div class="col-md-12">
            <h5 class="uppercase">Transports</h5>
        </div>
        <div class="col-md-12">
            <div class="row">
              <?php foreach($property->transports as $transports){ ?>
                <?php if($transports->type==1 && count($transports->Child)>0){?>
              <div class="col-sm-3">
                <p class="nrbyHeader">{{$transports->transport_name}}</p>
                <ul class="list-unstyled nrbyList">
                  <?php foreach ($transports->Child as $k => $v) {?>
                  @if(array_key_exists($v->transport_id,$property->selected_transports))
                  <li><i class="fa fa-check"></i> {{$v->transport_name}}</li>
                  @endif
                  <?php }?>
                </ul>
              </div>
                <?php }?>
              <?php }?>
              
            </div>
        </div>
    </div>
    
    <div class="clearfix propety-feature nrLocationInner">
        <div class="col-md-12">
            <h5 class="uppercase">Nearby</h5>
        </div>
        <div class="col-md-12">
            <div class="row">
              <?php foreach($property->transports as $transports){ ?>
                <?php if($transports->type==2 && count($transports->Child)>0){?>
              <div class="col-sm-3">
                <p class="nrbyHeader">{{$transports->transport_name}}</p>
                <ul class="list-unstyled nrbyList">
                  <?php foreach ($transports->Child as $k => $v) {?>
                  <li><i class="fa fa-check"></i> {{$v->transport_name}}</li>
                  <?php }?>
                </ul>
              </div>
                <?php }?>
              <?php }?>
              
            </div>
        </div>
    </div>

    <div class="row propety-feature nrLocationInner agent_details">
      <div class="col-md-12">
            <h5 class="uppercase">Agent Details</h5>
      </div>
      <div class="col-sm-12">
        <div class="well featuredagentbox clearfix agBox">
            <div class="clearfix"> 


            <div class="row">
              <div class="col-sm-3  agHeightFix">
                  @if($dataset['user']->profile_image!='')
                  <a class="selected pull-left" href="javascript:;"> 
                    {{ HTML::image('files/profiles/'.$dataset['user']->profile_image, '', array('class' => 'img-responsive btn-block img-thumbnail agentImage','id'=>'profile_image','style'=>'')) }}
                  </a> 
                  @endif
              </div>
              <div class="col-sm-4 agHeightFix">
                    <div class="phototext text-left agDetailsHolder">
                        <strong> {{$dataset['user']->first_name }} {{$dataset['user']->last_name}}</strong><br>
                        <p class="noMargin"><small><i class="fa fa-phone"></i>: <span>{{$dataset['user']->phone}}</span></small></p>
                        <p class="noMargin"><small><i class="fa fa-envelope"></i>: <span>{{$dataset['user']->email}}</span></small></p>
                        <div class="gap20 hidden-xs"></div>
                        <!--<a href="{{URL::to('property/mylist/')}}/{{$property->user_id}}" class="btn btn-default">View Other Properties</a>                        -->
                        <a href="{{URL::to('agent/')}}/{{seo_url($property->first_name." ".$property->last_name)}}_{{$property->user_code}}" class="btn btn-default">View Other Properties</a>                        
                    </div>
              </div>
              <div class="col-sm-5 agDescHolder">
                  <p class="text-left agentDesc">{{$dataset['user']->description}}</p>
              </div>
            </div>


                    



              </div>
            
         </div>
      </div>
      
    </div>
    @if(count($dataset["related"])>0)
    
    <div class="relatedproperty clearfix">
    <div class="col-md-12">
    <h2>Related Properties :</h2>
    @if(count($dataset["related"])==0)
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>No related properties found at this time!<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    @endif
    
    <ul class="portfolio-items relatedpropety clearfix">
    		@foreach($dataset["related"] as $related)
            @if($related->property_id != $property->property_id)
            <li class="portfolio-item col-md-2">
              <a class="item-inner btn-block" href="{{URL::to('/properties/')}}/{{seo_url($related->title)}}_{{{$related->property_code}}}"> <img alt="" src="{{{ asset('files/properties') }}}/{{{ $related->media[0]->media_data }}}">
              </a>
              <a class="commentwrap asbestos btn-block" href="{{URL::to('/properties/')}}/{{seo_url($related->title)}}_{{{$related->property_code}}}">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f; {{{ number_format($related->price, 2, ".", ",") }}}</div>
                  
                </div>
              </a>
            </li>
            @endif
            @endforeach
            <!--/.portfolio-item-->
            
            <!--/.portfolio-item-->
            
          </ul>
    </div>
    </div>
    @endif
  </div>
  <?php if(!Session::has('admin')){?>
  <aside class="col-md-3 col-md-pull-9 left-panel">
  		 <form class="center" role="form">
  		
         <div class="ad-wrap">{{ HTML::image('images/demoimages/ad8.jpg', '', array('class' => '')) }}</div>
         <div class="ad-wrap">{{ HTML::image('images/demoimages/ad1.jpg', '', array('class' => '')) }}</div>
         <div class="ad-wrap">{{ HTML::image('images/demoimages/ad6.jpg', '', array('class' => '')) }}</div>
         </form>
  </aside>
  <?php }?>
  
  
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
  });
  </script>
@stop