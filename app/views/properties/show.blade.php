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




<section class="container container2 noPadding" id="propertydetail">
  

<div class="<?php if(Session::has('admin')){echo "col-md-12 noBorder property_detail_admin";}else{echo "col-md-9 col-md-push-3";}?> propertydetailswrap">
  


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
    <?php } ?>
   <div class="col-md-<?php echo (Session::has('admin')?'9':'12')?> propertyname_price noPadding clearfix">
    <h2 class="pull-left noPadding">{{{ $property->title }}}</h2>
    <span class="propDetPlaceName"> &mdash;{{{ $property->locationsub_name }}}, {{{ $property->location_name }}}</span>
    <h2 class="pull-right noPadding">&#xe3f; {{{ number_format($property->price, 0, ".", ",") }}}</h2>
   </div>
   <div class="col-sm-12"><div class="gap10"></div></div>
    
  </div>
<div class="gap20"></div>
</section>
	
    <div class="clearfix propetymap-desc greyBackground noPadding">
      <div class="gap10"></div><div class="gap5"></div>
      <div class="clearfix">
          <div class="col-md-5 specialPadding">
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
            <div class="propInfoHolder clearfix">
              <p class="pull-left">Property Code: {{{ $property->property_code }}}</p>
              <p class="pull-right"><span>{{{ $property->type_name }}}</span> for <span>{{{ $property->deal_name }}}</span></p>
            </div>
            <p class="noMargin">{{{ $property->description }}}</p>
            <div class="noMargin"></div>
            <p><a class="btn btn-primary btn-lg orange" href="javascript:;" data-toggle="scrollTo" data-target=".agent_details"> <span class="fa fa-envelope"></span> <span>Contact Info</span> </a></p> 
            <div>
                  
             </div>
          </div>
      </div>
      <div class="gap10"></div><div class="gap5"></div>
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
    <div class="gap10"></div>
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
              <div class="row  greyBackground prDetFacilityTooltip">
                 @foreach ($property->amenities as $id => $am) 
                  <div class="col-xs-6 col-sm-2 text-center " data-toggle="tooltip" data-placement="bottom" title="{{$am['amenity_title']}}">
                    <span class="amenitiesIcon flexCenter">    
                        <?php echo HTML::image('images/icons/'.$am['amenity_icon'], '', array('class' => '')); ?>
                    </span>
                    <p class="textEllipsis noMargin">{{$am['amenity_title']}}</p>
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
            
<div class="gap10"></div>

    <div class="clearfix propety-feature nrLocationInner  padding greyBackground">
      <div class="row">
        <div class="col-md-12">
            <h5 class="uppercase">Transports</h5>
        </div>

        <div class="col-md-12">
            <div class="row prDetFacilityTooltip">
                    <?php foreach($property->transports as $transports){ ?>
                    <?php if($transports->type==1 && count($transports->Child)>0){?>
                          <?php foreach ($transports->Child as $k => $v) {?>
                          @if(array_key_exists($v->transport_id,$property->selected_transports))
                          <div class="col-xs-6 col-sm-2 text-center" data-toggle="tooltip" data-placement="bottom" title="{{ $v->transport_name }}">
                                <span class="amenitiesIcon flexCenter">    
                                <?php echo HTML::image('images/icons/'.$transports->transport_icon, '', array('class' => '')); ?>
                                </span>
                                <p class="textEllipsis noMargin">{{ $v->transport_name }}</p>
                          </div>
                          @endif
                          <?php } ?>
                    <?php } ?>
                    <?php } ?>           
            </div>
        </div>
      </div>
    </div>
    
    <div class="gap10"></div>

    <div class="clearfix propety-feature nrLocationInner padding greyBackground">
        <div class="col-md-12 noPadding">
            <h5 class="uppercase">Nearby</h5>
        </div>
        <div class="col-md-12 noPadding">
            <div class="row">
              <?php $counter =0; ?>
              <?php foreach($property->transports as $transports){ ?>
                <?php if($transports->type==2 && count($transports->Child)>0){?>
              <div class="col-sm-12">
                <span class="nrbyHeader">{{$transports->transport_name}}</span>
                 
                 <span><?php 
					$str = '';
					foreach ($transports->Child as $k => $v) {
						if($str != "") $str .=", ";
						$str .=$v->transport_name;
					}
					echo $str;
                  ?></span>


              </div>
                <?php
                if($counter%4==0){
                ?>
                  <div class="clearfix"></div>
                <?php
                }
                ?>
                <?php }?>
              <?php }?>
              
            </div>
        </div>
    </div>

    <div class="gap20"></div>

    <div class="row  propety-feature nrLocationInner agent_details">
      <div class="col-md-12">
            <h5 class="uppercase">Agent Details</h5>
      </div>
      <div class="col-sm-12">
        <div class="well featuredagentbox clearfix agBox">
            <div class="clearfix"> 


            <div class="row">
              <div class="col-sm-2  agHeightFix agHeightFix_img">
                  <?php 
						$slug = seo_url($property->first_name.' '.$property->last_name).'_'.$property->user_code;
				  ?>
                  <a style="margin-right:0" class="selected pull-left" href="{{URL::action('UsersController@agent',[$slug])}}" target="_blank"> 
                    @if($dataset['user']->profile_image!='')
                    {{ HTML::image('files/profiles/'.$dataset['user']->profile_image, '', array('class' => ' img-thumbnail agentImage','id'=>'profile_image','style'=>'')) }}
                    @else
                    {{ HTML::image('images/agentprofile/profiledummy.png', '', array('class' => 'img-responsive btn-block ','style'=>'  width: 110px;')) }}
                    @endif
                  </a>
                  
              </div>
              <div class="col-sm-4 col-md-3 agHeightFix agHeightFix_Contact">
                    <div class="phototext text-left agDetailsHolder">
                        <strong> {{$dataset['user']->first_name }} {{$dataset['user']->last_name}}</strong><br>
                        <p class="noMargin"><small><i class="fa fa-phone"></i>: <span>{{$dataset['user']->phone}}</span></small></p>
                        <p class="noMargin"><small><i class="fa fa-envelope"></i>: <span>{{$dataset['user']->email}}</span></small></p>
                        <div class="gap20 hidden-xs hidden-sm"></div>
                        <!--<a href="{{URL::to('property/mylist/')}}/{{$property->user_id}}" class="btn btn-default">View Other Properties</a>                        -->
                        <a href="{{URL::action('UsersController@agent',[$slug])}}" class="btn btn-default" target="_blank">View All Properties</a>                        
                    </div>
              </div>
              <div class="col-sm-7 agDescHolder agDescHolder_desc">
                  <p class="text-left agentDesc">
                    @if($dataset['user']->description!="")
                    {{$dataset['user']->description}}
                    @else
                    <p class="noDescription text-center"><i class="fa fa-warning"></i> Sorry, No Description Found.</p>
                    @endif
                  </p>
                  
              </div>
            </div>


                    



              </div>
            
         </div>
      </div>
      
    </div>
    @if(count($dataset["related"])>0)
    
    <div class="relatedproperty row ">
    <div class="col-md-12">
    <h2>Related Properties :</h2>
    @if(count($dataset["related"])==0)
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>No related properties found at this time!</p>
    </div>
    @endif
    
    <ul class="portfolio-items relatedpropety clearfix" style="margin-left:-15px;margin-right:15px;">
    		@foreach($dataset["related"] as $related)
            @if($related->property_id != $property->property_id)
            <li class="portfolio-item col-sm-3">
            <div class="outlineHover">
              <a class="item-inner btn-block" href="{{URL::action('PropertiesController@details',[''])}}/{{seo_url($related->title)}}_{{{$related->property_code}}}">
                  <img class="relatedPropertyImgInDetailspage" alt="" src="{{{ asset('files/properties') }}}/{{{ $related->media[0]->media_data }}}">
                  <div class="relPropHolder">
                    <p class="noMargin textEllipsis text-center" title="{{{ $related->title }}}">{{{ $related->title }}}</p>
                  </div>
              </a>

              <a class="commentwrap asbestos btn-block" href="{{URL::action('PropertiesController@details',[''])}}/{{seo_url($related->title)}}_{{{$related->property_code}}}">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f; {{{ number_format($related->price, 0, ".", ",") }}}</div>                  
                </div>
              </a>
              </div>
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
  		  {{View::make('layouts.side_ad_block')}}
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