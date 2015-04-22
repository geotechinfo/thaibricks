
<?php
$loc = array(''=>'Location');
foreach ($dataset['locations'] as $k=>$v){
  $loc[$k]=$v['location_name'];
}

$filters = Input::all();
//pr($filters,1);
//pr($dataset['price'],1);
$all_price_range = ((isset($filters['price_range']) && isset($filters['deal_id']) && $filters['deal_id']=='')?$filters['price_range']:$dataset['price']['all']['min'].",".$dataset['price']['all']['max']);
$sale_price_range = ((isset($filters['price_range']) && isset($filters['deal_id']) && $filters['deal_id']==1)?$filters['price_range']:$dataset['price']['sale']['min'].",".$dataset['price']['sale']['max']);
$rent_price_range = ((isset($filters['price_range']) && isset($filters['deal_id']) && $filters['deal_id']==2)?$filters['price_range']:$dataset['price']['rent']['min'].",".$dataset['price']['rent']['max']);
$lease_price_range = ((isset($filters['price_range']) && isset($filters['deal_id']) && $filters['deal_id']==3)?$filters['price_range']:$dataset['price']['lease']['min'].",".$dataset['price']['lease']['max']);
$deal_id = (isset($filters['deal_id'])?$filters['deal_id']:'');

$properties = new Property();
$dataset["deals"] = $properties->getlist_deals();
//echo $price_range;die;
?>          {{ Form::open(array('class' => 'center', 'id' => 'search_frm', 'route' => array('property.search'), 'method' => 'get')) }}
            <fieldset class="search-form">
              
              <div class="col-md-<?php echo (Route::currentRouteAction() == "PagesController@index") ? "4" : "5" ?> col-sm-6">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="arrow margin-top">
                      <div class="btn-group mutiselectbtn">
                        {{Form::select('deal_id',$dataset['deals'],$deal_id,array('class'=>'form-control','id'=>'deal_id'))}}
                        
                      </div>
                    </div>  
                    
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group margin-top propertytype">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                      <button  class="multiselect form-control" type="button" title="None selected">Property
                      Type <b class="caret"></b></button>
                      <div class="multiselect-container dropdown-menu">
                      <?php 
                        $types = $dataset["types"]; 
                        if(isset($types[0])){unset($types[0]);}
                        //pr($types,1);
                      ?>
                        @foreach($types as $key=>$value)
                          <div class="col-md-4 col-sm-4 prTypesHolder">
                              <div>
                                <h5>{{{ $key }}}</h5>
                              </div>
                              @foreach($value as $ck=> $child)
                              <div class="checkoptions">
                                <label class="checkbox">
                                  <input type="checkbox" <?php echo (isset($filters['types']) && in_array($ck, $filters['types'])?'checked="checked"':"")?> name="types[]"  value="<?php echo $ck; ?>" >
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
                  </div>
                </div>

                <div class="gap10 hidden-xs"></div><div class="gap5 hidden-xs"></div>
                <div class="form-group sale_rent_slider" id="all_price_slider" data-id="">
                  <label for="price_range" class="searchlabel pull-left">Price range</label>
                  <span class="pricerangeval pull-right"><span class="min-price">&#xe3f;{{$dataset['price']['all']['min']}}</span> - <span class="max-price">&#xe3f;{{$dataset['price']['all']['max']}}</span></span>
                  <input id="all_price_range" name="price_range" type="text" class="price_range" data-slider-id="price_selector" data-slider-min="{{$dataset['price']['all']['min']}}" data-slider-max="{{$dataset['price']['all']['max']}}" value="<?php echo $all_price_range; ?>" data-slider-step="1000" data-slider-value="[{{$all_price_range}}]" />
                </div>
                <div class="form-group sale_rent_slider" id="sale_price_slider" data-id="1" style="display:none">
                  <label for="price_range" class="searchlabel pull-left">Sale Price range</label>
                  <span class="pricerangeval pull-right"><span class="min-price">&#xe3f;{{$dataset['price']['sale']['min']}}</span> - <span class="max-price">&#xe3f;{{$dataset['price']['sale']['max']}}</span></span>
                  <input id="sale_price_range" name="price_range" type="text" class="price_range" data-slider-id="price_selector" data-slider-min="{{$dataset['price']['sale']['min']}}" data-slider-max="{{$dataset['price']['sale']['max']}}" value="<?php echo $sale_price_range; ?>" data-slider-step="500" data-slider-value="[{{$sale_price_range}}]" />
                </div>
                 <div class="form-group sale_rent_slider" id="rent_price_slider" data-id="2" style="display:none">
                  <label for="price_range" class="searchlabel pull-left">Rent Price range</label>
                  <span class="pricerangeval pull-right"><span class="min-price">&#xe3f;{{$dataset['price']['rent']['min']}}</span> - <span class="max-price">&#xe3f;{{$dataset['price']['rent']['max']}}</span></span>
                  <input id="rent_price_range" name="" type="text" class="price_range" data-slider-id="price_selector" data-slider-min="{{$dataset['price']['rent']['min']}}" data-slider-max="{{$dataset['price']['rent']['max']}}" value="<?php echo $rent_price_range; ?>" data-slider-step="500" data-slider-value="[{{$rent_price_range}}]" />
                </div>
                <div class="form-group sale_rent_slider" id="lease_price_slider" data-id="3" style="display:none">
                  <label for="price_range" class="searchlabel pull-left">Lease Price range</label>
                  <span class="pricerangeval pull-right"><span class="min-price">&#xe3f;{{$dataset['price']['lease']['min']}}</span> - <span class="max-price">&#xe3f;{{$dataset['price']['lease']['max']}}</span></span>
                  <input id="lease_price_range" name="" type="text" class="price_range" data-slider-id="price_selector" data-slider-min="{{$dataset['price']['lease']['min']}}" data-slider-max="{{$dataset['price']['lease']['max']}}" value="<?php echo $lease_price_range; ?>" data-slider-step="500" data-slider-value="[{{$lease_price_range}}]" />
                </div>
                
              </div>
              <div class="col-md-<?php echo (Route::currentRouteAction() == "PagesController@index") ? "4" : "5" ?> col-sm-6">
                <div class="form-group margin-top">
                      <div class="arrow">
                        <div class="btn-group mutiselectbtn numberOfBedrooms">
                          <button  class="multiselect form-control" type="button" title="None selected">Bedroom <b class="caret"></b></button>
                          <div class="multiselect-container dropdown-menu">
                            <div class="col-md-12">
                              <div class="checkoptions">
                                <label class="checkbox">
                                  <input type="checkbox" name="bedroom[]" <?php echo (isset($filters['bedroom']) && in_array(1, $filters['bedroom'])?'checked="checked"':"")?> value="1" >
                                  1 BHK
                                  </label>
                              </div>
                              <div class="checkoptions">
                                <label class="checkbox">
                                  <input type="checkbox" name="bedroom[]" <?php echo (isset($filters['bedroom']) && in_array(2, $filters['bedroom'])?'checked="checked"':"")?> value="2" >
                                  2 BHK
                                </label>
                              </div>
                              <div class="checkoptions">
                                <label class="checkbox">
                                  <input type="checkbox" name="bedroom[]" <?php echo (isset($filters['bedroom']) && in_array(3, $filters['bedroom'])?'checked="checked"':"")?> value="3" >
                                  3 BHK
                                  </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>


                <div class="col-md-6 hmSearchDropLeft">
                <div class="form-group margin-top">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                      {{Form::select('location', $loc, LOCATION_ID, array('class' => 'form-control', 'id'=>"location", 'style'=>""))}}
                    </div>
                  </div>
                </div>
                
                </div>
                <div class="col-md-6 hmSearchDropRight">
                <div class="form-group margin-top">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                      {{Form::select('location_sub', array(''=>'Sub-Location'), '', array('class' => 'form-control', 'id'=>"location_sub", 'style'=>""))}}
                    </div>
                  </div>
                </div>
                </div>
                
              </div>
              <div class="col-md-<?php echo (Route::currentRouteAction() == "PagesController@index") ? "4" : "2" ?> col-sm-12 search-map-btn">
                <div class="col-md-5 search-btn-wrap"> 
                  <button class="btn btn-primary btn-lg search-button orange margin-top" type="submit">
                    <span class="fa fa-search block"></span> <span>Search</span>
                  </button>
                 <!-- <a href="javascript:void(0);" onclick='document.forms["search"].submit();' class="btn btn-primary btn-lg search-button orange margin-top"> <span class="fa fa-search block"></span> <span>Search</span> </a> -->
                </div>
                @if(Route::currentRouteAction() == "PagesController@index")
                <div class="col-md-7 searchby-wrap">
                  <div class="mtr margin-top srchByLocation" style="position:relative;left:1px;">
                    <!-- <a href=""><img src="images/searchwrapbuttons/searchbymtr.png" style="width:100%; height:auto; "></a> -->
                    <a href="{{URL::to('/')}}/bangkok/property/search?transport=1" data-original-title="Search near BTS" data-toggle="tooltip" data-placement="top" title="">
                      {{ HTML::image('images/icons/btsLogo.png', $alt="BTS", $attributes = array('style'=>"height:auto; ")) }}
                    </a>
                    <a data-original-title="Search near MRT" href="{{URL::to('/')}}/bangkok/property/search?transport=2" data-toggle="tooltip" data-placement="top" title="">
                      {{ HTML::image('images/icons/mrLogo.png', $alt="MRT", $attributes = array()) }}
                    </a>
                    <a data-original-title="Airport Link" href="{{URL::to('/')}}/bangkok/property/search?transport=3" data-toggle="tooltip" data-placement="top" title="">
                      {{ HTML::image('images/icons/airportLogo.png', $alt="AirportLink", $attributes = array()) }}
                    </a>                   
                   </div>
                  <div class="google">
                    <a href="{{URL::to('property/search')}}?gmap=1">
                    {{ HTML::image('images/searchwrapbuttons/searchbygooglemap.png', $alt="GoogleMap", $attributes = array('style'=>"width:98%; height:auto; ")) }}
                    
                    </a>
                  </div>
                </div>
                @endif
                
              </div>
            </fieldset>
          {{ Form::close() }}
{{ HTML::script('libraries/validator/validation.js') }}
<style type="text/css">
  small.search_validation{position: absolute;bottom: -15px;}
</style>
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

  $('#deal_id').change(function(){
    //$('.sale_rent_slider').toggle();
    //alert($(this).val());
    $('.price_range').attr({name:''});
    $('.sale_rent_slider').hide();
    $('.sale_rent_slider[data-id="'+$(this).val()+'"]').show();
    $('.sale_rent_slider[data-id="'+$(this).val()+'"] .price_range').attr({name:'price_range'})

  });

  $('#deal_id').trigger('change');

  $('#search_frm').validate({
    rules:{
      'location':{required:true,min:1}
    },
    messages:{
      'location':{required:'!'}
    },
    errorClass:'search_error search_validation',
    errorElement:'small',
    errorPlacement:function(error,element){
        $(element).closest('.arrow').addClass('search_error_parent')
    }
  });

  $("[name='location']").change(function(){
    if($(this).val()!="")
    {
      $(this).closest('.arrow').removeClass('search_error_parent');
	  $("#search_frm").attr("action", "<?php echo URL::to("/"); ?>/"+$(this).find("option:selected").text().toLowerCase().replace(" ", "_")+"/property/search");
    }
  });
  

  $(".propertytype .prTypesHolder input:checkbox").click( function(){
  	if($(this).is(':checked') == true){
		$(this).closest(".prTypesHolder").removeClass("propTypeDisabled");
		
		$(this).closest(".prTypesHolder").siblings().find("input:checkbox").attr("checked", false);
		$(this).closest(".prTypesHolder").siblings().addClass("propTypeDisabled");	
		
		if($(this).closest(".prTypesHolder").is(':first-child') == false){
			$(".numberOfBedrooms input:checkbox").attr("checked", false);
			$(".numberOfBedrooms .dropdown-menu").css("visibility", "hidden");
      $(".numberOfBedrooms").closest('.form-group').addClass('formDisabled')
		}else{
			$(".numberOfBedrooms .dropdown-menu").css("visibility", "visible");
      $(".numberOfBedrooms").closest('.form-group').removeClass('formDisabled')
		}
	}else{
		if($(".propertytype .prTypesHolder input:checkbox:checked").length == 0){
			$(".propertytype .prTypesHolder").removeClass("propTypeDisabled");
			$(".numberOfBedrooms .dropdown-menu").css("visibility", "visible");
      $(".numberOfBedrooms").closest('.form-group').removeClass('formDisabled')
		}
	}
  });

});
</script>