@foreach($properties as $property)
<div class="propertylist clearfix new boxHover">
      <div class="col-md-5"><div class="propertyimg" style="overflow:hidden;"><div class="propertymark"></div>
        <a target="_blank" href="{{URL::action('PropertiesController@details', [''])}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="propertyInSearchpage">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => 'img-responsive')) }}</a>
      </div>
      </div>
      <div class="col-md-7 propertylist-body">
        <h3 class="propertylist-heading uppercase">
          <a target="_blank" href="{{URL::action('PropertiesController@details', [''])}}/{{seo_url($property->title)}}_{{{$property->property_code}}}">  {{{ $property->title }}} </a>
          <span class="propDetPlaceName"> &mdash;{{{ $property->locationsub_name }}}, {{{ $property->location_name }}}</span>
        </h3>

        <div class="clearfix">
          <div class="pull-left">
                <p class="noMargin small">For {{$property->deal_name}}</p>
                <span class="propDetPrice">&#xe3f; {{{ number_format($property->price, 0, ".", ",") }}}</span>
          </div>
          <div class="pull-left">
                <p class="noMargin small">Posted By</p>
                <span class="propDetPostedby label label-success textEllipsis" data-toggle="tooltip" data-placement="bottom" title="{{{ $property->first_name }}} {{{ $property->last_name }}}">{{{ $property->first_name }}} {{{ $property->last_name }}}</span>
          </div>
          <div class="pull-left" >
                <div class="nearLocation propDetNrLocation">
                    <?php foreach($property->transports as $transports){ ?>
                        <?php if($transports->type=='1'){ ?>
                            <?php foreach($transports as $transport){ ?>
                                <?php if(is_array($transport)){ ?>
                                    <?php foreach($transport as $location){ ?>
                                        <?php if(array_key_exists($location->transport_id, $property->selected_transports)){ ?>
                                            <div class="text-center noMargin">
                                                <div class="location flexCenter" data-toggle="tooltip" title="<?php echo $location->transport_name; ?>" data-placement="bottom"> 
                                                <img src="<?php echo asset('images'); ?>/icons/<?php echo $transports->transport_icon; ?>" style="height:15px;" />
                                                </div>
                                                <!--<p>Near to <?php echo $location->transport_name; ?></p>-->
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
          </div>
          <?php //pr($property); ?>
          
          @if($property->type_parent_id==1)
          <div class="pull-right">
                <div class="text-right">
                  <div class="roomCounterHolder clearfix">
                    <?php 
                      foreach ($property->attributes as $key => $value) {
                    ?>
                      @if($value->attribute_id==1)
                        <div class="roomCounter flexCenter">
                          <span class="bold"><b>{{$value->attribute_value}}</b></span>
                          <span class="rmCountImgHolder flexCenter bg-primary" data-toggle="tooltip" data-placement="bottom" title="Bedrooms">
                            <img src="{{URL::to('/')}}/images/icons/bedCount.png">
                          </span>
                        </div>
                      @endif

                       @if($value->attribute_id==2)                        
                        <div class="roomCounter flexCenter">
                          <span class="bold"><b>{{$value->attribute_value}}</b></span>
                          <span class="rmCountImgHolder flexCenter label-success" data-toggle="tooltip" data-placement="bottom" title="Bathrooms">
                            <img src="{{URL::to('/')}}/images/icons/bathCount.png">
                          </span>
                        </div>
                      @endif
                    <?php    
                      }
                    ?>
                    
                    
                  </div>
                </div>
          </div>
          @endif
        </div>

       

        <div class="gap10"></div>

        <p class="propertydesc">
        <?php $small_desc = preg_replace('/\s+?(\S+)?$/', '', substr($property->description, 0, 121)); ?>{{{ $small_desc }}}<?php if(strlen($property->description) > 120) { ?>...<?php } ?> <a target="_blank" href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="saveshortlist orange"><small>View Details</small></a></p>
        <?php //pr($property->amenities);?>
        <div class="propDetAmenitiesList clearfix">
          @foreach($property->amenities as $ka=>$va)
          
          <div class="prpDetAmntImagHolder flexCenter">
              <img src="{{ URL::to('/') }}/images/icons/{{ $va['amenity_icon'] }}" data-toggle="tooltip" title="{{$va['amenity_title']}}" data-placement="top" />
          </div>
          @endforeach
        </div>

         
         
         <div>
              
              </div>
      </div>
    </div>
@endforeach