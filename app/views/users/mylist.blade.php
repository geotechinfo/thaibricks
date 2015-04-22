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
            <li><a href="{{URL::action('PagesController@index')}}">Home</a></li>
            <li><a href="javascript:;">Agent Page</a></li>
          </ul>
      
      </div>
      
    </div>
  </div>
</section>


<!--/profileimage-->
<section class="container container2 margin-top-10 white radius-top" id="profileimage">
  <div class="clearfix clouds">
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
                      <div><i class="fa fa-globe"></i> {{{ $dataset['user']->location_name }}}</div>
                      <div><i class="fa fa-check-circle"></i> {{{ $dataset['user']->user_code }}}</div>
                      <div><i class="fa fa-phone"></i> {{{ $dataset['user']->phone }}}</div>
                      <div><i class="fa fa-envelope"></i> {{{ $dataset['user']->email }}}</div>
              </div>
          </div>
          <div class="col-sm-9 text-justify agentDescr">
          @if($dataset['user']->description!='')
          <p>{{$dataset['user']->description}}</p>
          @else
          <p class="noDescription text-center"><i class="fa fa-warning"></i> Sorry, No Description Found.</p>
          @endif
          </div>
      </div>
    </div>
  </div>
<!-- Agent Details -->



<section class="container container2 margin-top-10 white radius-top">
    <div class="row">
  <aside class="col-sm-3 col-sm-push-9">
  	
    
    {{View::make('layouts.side_ad_block')}}
   
    </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
        	@if(Session::get('success'))
          <div class="margin-top-10 message">
          <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>{{{ Session::get('success') }}}</p>
          </div>
          @endif
          
          @if(Session::get('info'))
          <div class="margin-top-10 message">
          <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}</p>
          </div>
          {{{ Session::forget('info') }}}
          @endif
        
        	{{View::make('layouts.property_items',array('properties'=>$dataset["properties"]))}}
          <ul class="portfolio-items trendingproperty hot myitems">
                 @foreach($dataset["hot"] as $hot)
                  <li class="portfolio-item col-md-3 col-sm-4">
                    <div class="item-inner"> 
                      <div class="item-inner-image">
                      	<?php
      					$slug = seo_url($hot->title)."_".$hot->property_code;
      					?>
                        <a class="imgInAgentProfilePage" href="{{URL::action('PropertiesController@details', [$slug])}}" target="_blank">{{ HTML::image(asset('files/properties')."/".$hot->media[0]->media_data, '', array('class' => '')) }}</a>
                      </div>  
                      <div class="eventphototext htAuto">
                        <h5><a href="{{URL::action('PropertiesController@details', [$slug])}}" target="_blank">{{{ $hot->title }}}</h5>
                        <!--<p>{{{ substr($hot->description, 0, 125) }}}</a></p>-->
                        <p><i class="fa fa-map-marker"></i> {{{ $hot->location_name }}}</p>
                      </div>
                    </div>
                    <div class="commentwrap asbestos">
                      <div>
                        <div class="price projectinfobtn center pull-left textTruncate" style="width: 49.5%;">&#xe3f; {{{ number_format($hot->price, 0, ".", ",") }}}</div>
                        
                          <a class="seemore viewmore projectinfobtn center pull-right" href="{{URL::action('PropertiesController@details', [$slug])}}" target="_blank"><span class="">See More</span> </a> 
                        
                      </div>
                    </div>
                    <div class="propertymark"></div>
                  </li>
                  @endforeach
         
      	</ul>
          
          
  </div>
  </div>
</section>
<script type="text/javascript">
  $(document).ready(function(){
    $('.cls_extend_btn').click(function(){
      var ths = $(this);
      ths.button('loading')
      var property_id = $(this).data('id')
      $.post(
        '<?php echo URL::action("PropertiesController@date_extend")?>',
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