<?php

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

$filters = Input::all();
//pr($filters);
$price_range = (empty($filters['price_range'])?$dataset['price']['min'].",".$dataset['price']['max']:$filters['price_range']);

?>          {{ Form::open(array('class' => 'center', 'id' => 'search', 'route' => array('property.search'), 'method' => 'get')) }}
            <fieldset class="search-form">
              <div class="col-md-<?php echo (Route::currentRouteAction() == "PagesController@index") ? "4" : "5" ?> col-sm-6">
                <div class="form-group margin-top propertytype">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                      <button  class="multiselect form-control" type="button" title="None selected">Property
                      Type <b class="caret"></b></button>
                      <div class="multiselect-container dropdown-menu">
                      <?php $types = $dataset["types"]; ?>
                        @foreach($types as $key=>$value)
                          <div class="col-md-4 col-sm-4">
                              <div>
                                <h5>{{{ $key }}}</h5>
                              </div>
                              @foreach($value as $ck=> $child)
                              <div class="checkoptions">
                                <label class="checkbox">
                                  <input type="checkbox" <?php echo (!empty($filters['types']) && in_array($ck, $filters['types'])?'checked="checked"':"")?> name="types[]"  value="<?php echo $ck; ?>" >
                                  {{{ $child }}}
                                </label>
                              </div>
                              @endforeach
                            </div>
                        @endforeach
                        
                        
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="price_range" class="searchlabel pull-left">Price range</label>
                  <span class="pricerangeval pull-right"><span class="min-price">&#xe3f;{{$dataset['price']['min']}}</span> - <span class="max-price">&#xe3f;{{$dataset['price']['max']}}</span></span>
                  <input id="price_range" name="price_range" type="text" class="price_range" data-slider-id="price_selector" data-slider-min="{{$dataset['price']['min']}}" data-slider-max="{{$dataset['price']['max']}}" value="<?php echo $price_range; ?>" data-slider-step="100" data-slider-value="[{{$price_range}}]" />
                </div>
                
              </div>
              <div class="col-md-<?php echo (Route::currentRouteAction() == "PagesController@index") ? "4" : "5" ?> col-sm-6">
                <div class="form-group margin-top">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                      <button  class="multiselect form-control" type="button" title="None selected">Bedroom <b class="caret"></b></button>
                      <div class="multiselect-container dropdown-menu">
                        <div class="col-md-12">
                          <div class="checkoptions">
                            <label class="checkbox">
                              <input type="checkbox" name="bedroom[]" <?php echo (!empty($filters['bedroom']) && in_array(1, $filters['bedroom'])?'checked="checked"':"")?> value="1" >
                              1 BHK
                              </label>
                          </div>
                          <div class="checkoptions">
                            <label class="checkbox">
                              <input type="checkbox" name="bedroom[]" <?php echo (!empty($filters['bedroom']) && in_array(2, $filters['bedroom'])?'checked="checked"':"")?> value="2" >
                              2 BHK
                            </label>
                          </div>
                          <div class="checkoptions">
                            <label class="checkbox">
                              <input type="checkbox" name="bedroom[]" <?php echo (!empty($filters['bedroom']) && in_array(3, $filters['bedroom'])?'checked="checked"':"")?> value="3" >
                              3 BHK
                              </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 no-margin">
                <div class="form-group margin-top">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                      {{Form::select('location', $loc, '', array('class' => 'form-control', 'id'=>"location"))}}
                    </div>
                  </div>
                </div>
                
                </div>
                <div class="col-md-6 no-margin">
                <div class="form-group margin-top">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                      {{Form::select('location_sub', array(), '', array('class' => 'form-control', 'id'=>"location_sub"))}}
                    </div>
                  </div>
                </div>
                </div>
                
              </div>
              <div class="col-md-<?php echo (Route::currentRouteAction() == "PagesController@index") ? "4" : "2" ?> col-sm-12 search-map-btn">
                <div class="col-md-5 search-btn-wrap"> <a href="javascript:void(0);" onclick='document.forms["search"].submit();' class="btn btn-primary btn-lg search-button orange margin-top"> <span class="fa fa-search block"></span> <span>Search</span> </a> </div>
                @if(Route::currentRouteAction() == "PagesController@index")
                <div class="col-md-7 searchby-wrap">
                  <div class="mtr margin-top srchByLocation">
                    <!-- <a href=""><img src="images/searchwrapbuttons/searchbymtr.png" style="width:100%; height:auto; "></a> -->
                    <a data-original-title="Search near BTS" href="javascvript:;" data-toggle="tooltip" data-placement="top" title="">
                      {{ HTML::image('images/nearLocation/btsLogo.png', $alt="BTS", $attributes = array('style'=>"width:98%; height:auto; ")) }}
                    </a>
                    <a data-original-title="Search near MRT" href="javascvript:;" data-toggle="tooltip" data-placement="top" title="">
                      {{ HTML::image('images/nearLocation/mrLogo.png', $alt="MRT", $attributes = array()) }}
                    </a>
                    <a data-original-title="Airport Link" href="javascvript:;" data-toggle="tooltip" data-placement="top" title="">
                      {{ HTML::image('images/nearLocation/airportLogo.png', $alt="AirportLink", $attributes = array()) }}
                    </a>                   
                   </div>
                  <div class="google">
                    <a href="javascript:void(0);">
                    {{ HTML::image('images/searchwrapbuttons/searchbygooglemap.png', $alt="GoogleMap", $attributes = array('style'=>"width:98%; height:auto; ")) }}
                    
                    </a>
                  </div>
                </div>
                @endif
                
              </div>
            </fieldset>
          {{ Form::close() }}
<script type="text/javascript">
$(document).ready(function(){
  $('.multiselect').click(function(event){
    event.stopPropagation();
    var ths = $(this);
    $('.multiselect-container').not(ths.closest('.mutiselectbtn').find('.multiselect-container')).hide();
    ths.closest('.mutiselectbtn').find('.multiselect-container').toggle();
  });
  $(document).click(function(e) {
      if (!$(e.target).is('.mutiselectbtn *')) {
          $(".multiselect-container").hide();
      }
  });
});
</script>