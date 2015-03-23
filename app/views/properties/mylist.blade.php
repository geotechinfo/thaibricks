@extends('layouts.default')
<!-- config section  -->
  <?php $validity_days = 90; ?>
@section('content')
<section class="container container2" id="gototopwrap">
  <div class="">
    <div class="innerBread">
      <div class="col-sm-12">
          <span>You are here:</span>
          <ul class="topBreadcrumbs">
            <li><a href="{{URL::to('/')}}">Home</a></li>
            <li><a href="javascript:;">Agent Page</a></li>
          </ul>
      
      </div>
      
    </div>
  </div>
</section>


<!--/profileimage-->
<section class="container container2 margin-top-10 white radius-top" id="profileimage">
  <div class="clearfix padding-5 clouds">
    {{ $dataset['banner_panel'] }}
  </div>
</section>
<!--/profileimage-->

<!-- Agent Details -->
  <div class="container container2">
    <div class="gap20">
    </div>
    <div class="well agDetailsSection row">
      <div class="row">
          <div class="col-sm-3">
            <div class=" agDetailSpace">
                      <h4 class="noMargin text-capitalize"><i class="fa fa-user"></i> {{{ $dataset['user']->first_name }}} {{{ $dataset['user']->last_name }}}</h4>
                      <div class="gap10"></div>
                      <p><i class="fa fa-check-circle"></i> {{{ $dataset['user']->user_code }}}</p>
                      <p><i class="fa fa-phone"></i> {{{ $dataset['user']->phone }}}</p>
                      <p><i class="fa fa-envelope"></i> {{{ $dataset['user']->email }}}</p>
              </div>
          </div>
          <div class="col-sm-9">
          <p>{{$dataset['user']->description}}</p>
          </div>
      </div>
    </div>
  </div>
<!-- Agent Details -->



<section class="container container2 margin-top-10 white radius-top">
  <aside class="col-sm-3 col-sm-push-9">
  	@if($dataset["user_id"] == Auth::user()->user_id)
  	<div class="search-btn-wrap clearfix"> <a data-toggle="modal" data-target="#addPrperty" class="btn btn-primary btn-lg search-button margin-top details-search-button adProperty" href=""> <span class="fa fa-plus"></span> <span>Add New Property</span> </a> </div>
    @endif

    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad6.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad8.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad7.jpg', '', array('class' => '')) }}</div>
  </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
  	@if(Session::get('success'))
    <div class="margin-top-10 message">
    <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>{{{ Session::get('success') }}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    @endif
    
    @if(Session::get('info'))
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    {{{ Session::forget('info') }}}
    @endif
  
  	
  	@foreach($dataset["properties"] as $property)
    <div class="propertylist clearfix new myproperty">
      	<div class="btn-group btn-group-xs edit-delete" role="group" aria-label="...">
          @if($dataset["user_id"] == Auth::user()->user_id)
          	<a href="{{URL::to('/property/edit')}}/{{{ $property->property_id }}}" class="btn btn-default"><span class="fa fa-edit"></span></a>
          	<!--<a href="javascript:void(0);" class="btn btn-default"><span class="fa fa-trash-o"></span></a>-->
          @endif
        </div>
      <div class="col-md-5 cls_extend">
          <div class="propertyimg" style="overflow:hidden;">
          		<?php if(floor((strtotime("now")-$property->last_active)/3600/24) > $validity_days && $property->user_id==Auth::user()->user_id){ ?>
          		<div class="disablePropertyHolder">
                    <div class="disablePropertyText flexCenter enableBtnHolder">
                        <a href="javascript:;" class="cls_extend_btn" data-id="{{ $property->property_id}}"><i class="fa fa-check-circle"></i> Enable your Property</a>
                        <!-- <span><i class="fa fa-warning"></i> DISABLED</span> -->
                    </div>
                </div>
                <?php } ?>
            	<div class="propertymark"></div>
            	<a href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => 'img-responsive')) }}</a>
              
          </div>
          <p>
            <span class="cls_extend_text">
              <?php 
                  $day_renmain = ($validity_days - floor((strtotime("now")-$property->last_active)/3600/24)); 
                  if($day_renmain>=0){echo "This property is active for next $day_renmain days. ";}
                  else{echo "This property was inactive  for last ".($day_renmain*(-1)). " days";}
              ?>
              
            </span>
            <?php if($day_renmain<=($validity_days-2) && $day_renmain!=0 && $property->user_id==Auth::user()->user_id){ ?>
              
              <a href="javascript:;" class="btn btn-default btn-xs cls_extend_btn" data-id="{{ $property->property_id}}">Extend</a>
              
            <?php }?>

          </p>
      </div>
      <div class="col-md-7 propertylist-body">
        <h3 class="propertylist-heading uppercase">{{{ $property->title }}}</h3>
        <h5 class="uppercase">&#xe3f; {{{ number_format($property->price, 2, ".", ",") }}}</h5>
        <small>{{{ $property->first_name }}} {{{ $property->last_name }}}</small>
        <div class="otherinfo clearfix">
        	<div class="pull-left">
            <h5>{{{ $property->locationsub_name }}}, {{{ $property->location_name }}}</h5>
            </div>
            
            <!--<div class="pull-right starwrap">
            <span class="star-rating-control"><div class="rating-cancel"><a title="Cancel Rating"></a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div><div class="star-rating rater-0 star star-rating-applied star-rating-live" aria-label="" role="text"><a title="on">on</a></div></span><input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> <input type="radio" class="star star-rating-applied" name="star1" style="display: none;"> 
            <a class="saveshortlist" href="javascript:void(0);"><small>Save to shortlist</small></a>
            </div>
            <div class="pull-right starwrap">
            	<small>My rating:</small>
            </div>-->
        </div>
        <!--<p class="propertydesc">{{{ substr($property->description, 0, 125) }}} <a class="saveshortlist" href="{{URL::to('/property/show')}}/{{{ $property->property_id }}}"><small>Read More</small></a></p>-->
        <p class="propertydesc">{{{ substr($property->description, 0, 125) }}} <a class="saveshortlist" href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}"><small>Read More</small></a></p>
         <!--<div class="linkgroup">
         	<a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/mtrsmall.png', '', array('class' => 'searchsmallimg')) }}Ekamai station </a>
            <a class="" href="javascript:void(0);">{{ HTML::image('images/searchwrapbuttons/googlemall.png', '', array('class' => 'searchsmallimg')) }}Location</a>
         </div>-->
         <div class="row">
         	<div class="col-sm-12">
                 <div class="nearLocation">
					<?php foreach($property->transports as $transports){ ?>
                        <?php foreach($transports as $transport){ ?>
                            <?php if(is_array($transport)){ ?>
                            <?php foreach($transport as $location){ ?>
                                <?php if(array_key_exists($location->transport_id, $property->selected_transports)){ ?>
                                  <div class="text-center">
                                    <div class="location" style="background-image:url('<?php echo asset('images'); ?>/nearlocation/<?php echo $transports->transport_icon; ?>');"></div>
                                    <p>Near to <?php echo $location->transport_name; ?></p>
                                  </div>
                                <?php } ?>
                            <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                 </div>
            </div>
         </div>
         <div>
              <div class="pull-right">
              <!--<a href="{{URL::to('/property/show')}}/{{{ $property->property_id }}}" class="btn btn-primary upperclass viewproperty">VIEW PROPERTY DETAILS</a>-->
              <a href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="btn btn-primary upperclass viewproperty">VIEW PROPERTY DETAILS</a>
              </div>
              </div>
      </div>
    </div>
    @endforeach
    
    
    <ul class="portfolio-items trendingproperty hot myitems">
           @foreach($dataset["hot"] as $hot)
            <li class="portfolio-item col-md-3 col-sm-4">
              <div class="item-inner"> 
                <div class="item-inner-image">
                  <a href="{{URL::to('/properties/')}}/{{seo_url($hot->title)}}_{{{$hot->property_code}}}">{{ HTML::image(asset('files/properties')."/".$hot->media[0]->media_data, '', array('class' => '')) }}</a>
                </div>  
                <div class="eventphototext">
                  <h5><a href="{{URL::to('/properties/')}}/{{seo_url($hot->title)}}_{{{$hot->property_code}}}">{{{ $hot->title }}}</h5>
                  <p>{{{ substr($hot->description, 0, 125) }}}</a></p>
                </div>
              </div>
              <div class="commentwrap asbestos">
                <div>
                  <div class="price projectinfobtn center pull-left">&#xe3f; {{{ number_format($hot->price, 2, ".", ",") }}}</div>
                  <div class="viewmore projectinfobtn center pull-right">
                    <a class="seemore" href="{{URL::to('/properties/')}}/{{seo_url($hot->title)}}_{{{$hot->property_code}}}"><span class="">See More</span> </a> 
                  </div>
                </div>
              </div>
              <div class="propertymark"></div>
            </li>
            @endforeach
   
	</ul>
    
    
  </div>
</section>
<script type="text/javascript">
  $(document).ready(function(){
    $('.cls_extend_btn').click(function(){
      var ths = $(this);
      ths.button('loading')
      var property_id = $(this).data('id')
      $.post(
        '<?php echo URL::to("property/extend")?>',
        {
          property_id:property_id
        },
        function(m){
          //alert(m);
          ths.button('reset');
          ths.closest('.cls_extend').find('.cls_extend_text').text('You property is active for next 7 days.');
          ths.closest('.cls_extend').find('.cls_extend_btn').hide();
          ths.closest('.cls_extend').find('.disablePropertyHolder').removeClass('disablePropertyHolder');
        }
      )
    });
  });
</script>
@stop