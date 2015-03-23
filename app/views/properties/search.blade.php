@extends('layouts.default')
{{ HTML::style('libraries/startrating/jquery.rating.css') }}

{{ HTML::script('libraries/slick/slick.js') }}
{{ HTML::script('libraries/startrating/jquery.rating.js') }}
{{ HTML::script('libraries/slimheader/classie.js') }}

@section('content')
<?php
$location = new Location;
$dataset['locations']=$location->get_location_with_sub();

$loc = array(''=>'Select Location');
$subloc[''] = array(''=>'Select Location');
$transport_group =  array('' => 'Select Transport Group' );
foreach ($dataset['locations'] as $k=>$v){
  $loc[$k]=$v['location_name'];
   if($v['SubLocation']){
	   foreach ($v['SubLocation'] as $k1 => $v1) {
		  $subloc[$k][$v1['location_id']]=$v1['location_name'];
	   }
   }
   if($v['Transport']){
	   foreach ($v['Transport'] as $k1 => $v1) {
		  $transport_group[$k][$v1['transport_id']]=$v1['transport_name'];
	   }
   }
}
//print_r($dataset["property"]->location);die;
?> 


<section class="container container2" id="gototopwrap">
  <div class="">
    <div class="innerBread">
      <div class="col-sm-12">
      	  <span>You are here:</span>
          <ul class="topBreadcrumbs">
            <li><a href="javascript:;">Home</a></li>
            <li><a href="javascript:;">Search Property</a></li>
          </ul>
      
      </div>
    </div>
  </div>
</section>

<!--/Main Theme & Search-->
<section class="no-margin" id="list-search">
  <div class="container searchcontent container2">
    <h2>Searching for property here :</h2>
    <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?php echo (($dataset['transport']=='' && $dataset['gmap']==0)?'active':'');?>"><a href="{{URL::to('property/search')}}" >Search</a></li>
        <li role="presentation" class="<?php echo ($dataset['transport']=='1'?'active':'');?>"><a href="{{URL::to('property/search')}}?transport=1" aria-controls="bts" role="tab" >BTS </a></li>
        <li role="presentation" class="<?php echo ($dataset['transport']=='2'?'active':'');?>"><a href="{{URL::to('property/search')}}?transport=2" aria-controls="mrt" role="tab" >MRT</a></li>
        <li role="presentation" class="<?php echo ($dataset['transport']=='3'?'active':'');?>"><a href="{{URL::to('property/search')}}?transport=3" aria-controls="alink" role="tab" >ALink</a></li>
        <li role="presentation" class="<?php echo ($dataset['gmap']=='1'?'active':'');?>"><a href="{{URL::to('property/search')}}?location=1&gmap=1" aria-controls="alink" role="tab" >Google Map</a></li>
      </ul>
    </div>
    <div class="tab-content searchparam noPadding">
      <div role="tabpanel" class="tab-pane <?php echo (($dataset['transport']=='' && $dataset['gmap']==0 )?'active':'');?>" id="bsearch">
        
        {{ $dataset['search_panel'] }}
        
      </div>
      <?php
        $location = new Location;
        $location_list=$location->get_location_with_sub();
      ?>
      <div role="tabpanel" class="tab-pane <?php echo ($dataset['transport']=='1'?'active':'');?>" id="bts">
        <fieldset class="search-form">
        <form action="{{URL::to('property/search')}}">

        <div class="row">
          <div class="col-md-2 srch_icon_bg">
            {{ HTML::image(asset('images/icons/bts_big.png'), '', array('class' => '')) }}
          </div>
          <div class="col-md-8">
            <div class="row">
            <input type="hidden" name="transport" value="1">  
            <?php
              foreach ($location_list[1]['Transport'][1]['Child'] as $key => $value) {
            ?>
              <label class="col-sm-3">
                <input type="radio" name="sub_transport[]" <?php echo (isset($_GET['sub_transport']) && in_array($value->transport_id, $_GET['sub_transport'])?'checked':'')?> value="{{$value->transport_id}}"> 
                <span>{{$value->transport_name}}</span>
              </label>
            <?php    
              }
            ?>
            </div>
          </div>
          <div class="col-md-2">
          <div class="col-md-5 search-btn-wrap">
            <button class="btn btn-primary btn-lg search-button orange noMargin"> <span class="fa fa-search block"></span> <span>Search</span></button>
          </div>
          </div>
        </div>
        </form>
        </fieldset>  
      </div>
      <div role="tabpanel" class="tab-pane <?php echo ($dataset['transport']=='2'?'active':'');?>" id="mrt">
        <fieldset class="search-form">
        <form action="{{URL::to('property/search')}}">
          <div class="row">
          <div class="col-md-2 srch_icon_bg">
            {{ HTML::image(asset('images/icons/mrt_big.png'), '', array('class' => '')) }}
          </div>
          <div class="col-md-8">
            <div class="row">
            <input type="hidden" name="transport" value="2">  
            <?php
              foreach ($location_list[1]['Transport'][2]['Child'] as $key => $value) {
            ?>
              <label class="col-sm-3">
                <input type="radio" name="sub_transport[]" <?php echo (isset($_GET['sub_transport']) && in_array($value->transport_id, $_GET['sub_transport'])?'checked':'')?> value="{{$value->transport_id}}"> 
                <span>{{$value->transport_name}}</span>
              </label>
            <?php    
              }
            ?>
            </div>
          </div>
          <div class="col-md-2">
          <div class="col-md-5 search-btn-wrap">
            <button class="btn btn-primary btn-lg search-button orange noMargin"> <span class="fa fa-search block"></span> <span>Search</span></button>
          </div>
          </div>
        </div>
        </form>
        </fieldset> 
      </div>
      <div role="tabpanel" class="tab-pane <?php echo ($dataset['transport']=='3'?'active':'');?>" id="alink">
        <fieldset class="search-form">
        <form action="{{URL::to('property/search')}}">
          <div class="row">
          <div class="col-md-2 srch_icon_bg">
            {{ HTML::image(asset('images/icons/alink_big.png'), '', array('class' => '')) }}
          </div>
          <div class="col-md-8">
            <div class="row">
            <input type="hidden" name="transport" value="3">  
            <?php
              foreach ($location_list[1]['Transport'][3]['Child'] as $key => $value) {
            ?>
              <label class="col-sm-3">
                <input type="radio" name="sub_transport[]" <?php echo (isset($_GET['sub_transport']) && in_array($value->transport_id, $_GET['sub_transport'])?'checked':'')?> value="{{$value->transport_id}}"> 
                <span>{{$value->transport_name}}</span>
              </label>
            <?php    
              }
            ?>
            </div>
          </div>
          <div class="col-md-2">
          <div class="col-md-5 search-btn-wrap">
            <button class="btn btn-primary btn-lg search-button orange noMargin"> <span class="fa fa-search block"></span> <span>Search</span></button>
          </div>
          </div>
        </div>
        </form>
        </fieldset>  
      </div>
       <div role="tabpanel" class="tab-pane <?php echo ($dataset['gmap']=='1'?'active':'');?>" style="display:none" id="alink">
        <fieldset class="search-form">
        <form action="{{URL::to('property/search')}}">
          
        </div>
        </form>
        </fieldset>  
      </div>
    </div>
  </div>
  <!---->
</section>

<!--/Main Theme & Search-->

<!--HotProperty-->
<!--HotProperty-->


<section class="container container2" id="propertylist">
  <div class="col-sm-9 propertylistwrap">
  	@if(Session::get('info'))
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    {{{ Session::forget('info') }}}
    @endif
  
    @if($dataset['gmap']==0)
  	@foreach($dataset["properties"] as $property)
  	<div class="propertylist clearfix new">
      <div class="col-md-5"><div class="propertyimg" style="overflow:hidden;"><div class="propertymark"></div>
        <!--<a href="{{URL::to('/property/show')}}/{{{ $property->property_id }}}">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => 'img-responsive')) }}</a>-->
      	<a target="_blank" href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}">{{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => 'img-responsive')) }}</a>
      </div></div>
      <div class="col-md-7 propertylist-body">
        <h3 class="propertylist-heading uppercase">
          <a target="_blank" href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}">  {{{ $property->title }}} </a>
        </h3>
        <h5 class="uppercase">&#xe3f; {{{ number_format($property->price, 2, ".", ",") }}}</h5>
        <small>{{{ $property->first_name }}} {{{ $property->last_name }}}</small>
        <div class="otherinfo clearfix">
        	<div class="pull-left">
            <h5>{{{ $property->locationsub_name }}}, {{{ $property->location_name }}}</h5>
            </div>
            
            
        </div>
        <p class="propertydesc">{{{ $property->description }}} <a target="_blank" href="{{URL::to('/properties/')}}/{{seo_url($property->title)}}_{{{$property->property_code}}}" class="saveshortlist"><small>Read More</small></a></p>
         <div class="row">
         	<div class="col-sm-12">
                 <div class="nearLocation">
					<?php foreach($property->transports as $transports){ ?>
                      <?php if($transports->type=='1'){ ?>
                        <?php foreach($transports as $transport){ ?>
                          
                            <?php if(is_array($transport)){ ?>
                            <?php foreach($transport as $location){ ?>
                                <?php if(array_key_exists($location->transport_id, $property->selected_transports)){ ?>
                                  <div class="text-center">
                                    <div class="location" data-toggle="tooltip" title="<?php echo $location->transport_name; ?>" data-placement="bottom" style="background-image:url('<?php echo asset('images'); ?>/nearlocation/<?php echo $transports->transport_icon; ?>');"></div>
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
    @endif
    @if($dataset['gmap']==1)

    <div class="gap10">
    </div>
      <div class="row">
              <div class="col-sm-8">
                <h2 class="noMargin noPadding">Map View</h2>
              </div>
              <div class="col-sm-4 text-right">
              <div class="arrow">
                <select class="form-control" id="gmaplocation">
                <?php foreach ($loc as $key => $value) {
                  if($key!=''){
                    echo '<option value="'.$key.'" '.((isset($_GET['location']) && $_GET['location']==$key)?'selected':'').'>'.$value.'</option>';
                  }
                }?>
                  
                </select>
              </div>
              </div>
      </div>

    <div class="gap10">
    </div>

      <div class="row">
        <div class="col-sm-12">
          <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD40Kax9O0IRkBb8QWHcZaRDiehfuTXEX0"></script>
          <script type="text/javascript">
          var markersArray=new Array();
            function bindInfoWindow(marker, map, infoWindow, html) {
              google.maps.event.addListener(marker, 'click', function() {
                infoWindow.setContent(html);
                infoWindow.open(map, marker);
              });
            }
            function initialize() {
              var myLatlng = new google.maps.LatLng(15.870032,100.992541);
              var infoWindow = new google.maps.InfoWindow;
            
              var myOptions = {
                            center:myLatlng, 
                            zoom: 12, 
                            /*mapTypeId: google.maps.MapTypeId.SATELLITE,*/
                            navigationControlOptions:{style: google.maps.NavigationControlStyle.SMALL}
                          };
              var map = new google.maps.Map(document.getElementById('map-canvas-1'),myOptions);
              geocoder = new google.maps.Geocoder();
              var tot_lat=0;
              var tot_lng=0;
              var count = <?php echo count($dataset['properties']);?>;
              <?php foreach($dataset['properties'] as $k => $v) {?>
              latlang = geocoder.geocode( {'address': '<?php echo str_replace(array("\n","\r"),array(",",","),$v->address).",".$v->location_name;?>'},function(results, status){  
                if (status == google.maps.GeocoderStatus.OK){
                    //map.setCenter(results[0].geometry.location);
                    marker = new google.maps.Marker({
                      map: map,
                      position: results[0].geometry.location,
                      title:'<?php echo $v->title?>'
                    });

                    //tot_lat = tot_lat + results[0].geometry.location.lat();
                    //tot_lng = tot_lng + results[0].geometry.location.lng();
                    html = '<div style="height:50;width:100px"><a target="_blank" href="{{URL::to("properties")}}/{{seo_url($v->title)}}_{{$v->property_code}}">{{$v->title}}</a></div>';
                    map.setCenter(new google.maps.LatLng(results[0].geometry.location.lat(),results[0].geometry.location.lng()));
                    bindInfoWindow(marker, map, infoWindow, html);

                }
              });  

              <?php }?>

              //alert(count+"/"+tot_lat);
              
            }


            google.maps.event.addDomListener(window, 'load', initialize);

          </script>
          <div id="map-canvas-1"  style="height:500px;width:100%;border: 5px solid rgb(255, 255, 255);outline: 1px solid rgb(170, 170, 170);" ></div>
        </div>
      </div>
    @endif

  
    
  </div>
  <aside class="col-sm-3">
  	<div class="ad-wrap">{{ HTML::image('images/demoimages/ad1.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad5.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad7.jpg', '', array('class' => '')) }}</div>
  </aside>
  
</section>
<script type="text/javascript">
  $(document).ready(function(){
    $('#gmaplocation').change(function(){
      window.location.href="{{URL::to('property/search')}}?location="+$(this).val()+"&gmap=1";
    });
  });
</script>
@stop