<?php 
	  $limit = (isset($dataset['limit'])?$dataset['limit']:3);
      $boxpanel = CommonHelper::getAds(array('ad_type'=>6,'location_id'=>LOCATION_ID),$limit);
?>      
@foreach($boxpanel as $k=>$v)
<?php
  $link = "#";
  if($v->type==1){
    $link = URL::action('PropertiesController@details',[seo_url($v->title)."_".$v->property_code]);
  }elseif ($v->type==2) {
    $link = $v->external_link;
  }
?>
<div class="ad-wrap"><a href="{{$link}}">{{ HTML::image('files/advertise/'.$v->image_file, '', array('class' => '')) }}</a></div>

@endforeach