@extends('layouts.dashboard')

@section('content')

<section class="">
  <h3><span class="fa fa-map-marker"></span>My Property</h3>
  <div class="divider"></div>
  <div class="mypropertyThumb clearfix">
  <div class="propertylistwrap">
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
  
  	<?php $validity_days = 7; ?>
    <ul class="portfolio-items relatedpropety myproperty clearfix">
    <li class="portfolio-item col-md-2 addpropertythumb"> 
          <div class="addnewbutton">
            <a href="{{URL::to('/property/create')}}" class="portfolio-item-add">
                <p class="imagebg">
                    <span class="fa fa-map-marker"></span>
                    <span class="button type-submit width-auto"><span class="fa fa-plus-square"></span>Add Property</span>
                </p>
            </a>
          </div>
          </li>
  	@foreach($dataset["properties"] as $property)
      <li class="portfolio-item col-md-2"> 
          <!--<div class="enableDisable">
            <a href="javascript:;" class="enable enabled" title="Enable"><span class="fa fa-check"></span></a>
            <span class="seperator">|</span>
            <a href="javascript:;" class="enable" title="Disable" ><span class="fa fa-ban"></span></a>
          </div>-->
          <a href="{{URL::to('/property/edit')}}/{{{ $property->property_id }}}" class="item-inner btn-block"> 
              <span class="fa fa-pencil"></span>
              {{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => 'img-responsive propertylistimg')) }}
          </a> 
          <div class="commentwrap asbestos btn-block">
            <div>           
              <div class="projectinfobtn center addpropertyname"><a href="{{URL::to('/property/show')}}/{{{ $property->property_id }}}" class="textEllipsis">{{{ $property->title }}}</a></div>
              <div class="darkGrey locationprice">
                <span class="lname">{{{ $property->locationsub_name }}}, {{{ $property->location_name }}}</span> | 
                <span class="price">&#xe3f; {{{ number_format($property->price, 2, ".", ",") }}}</span>
              </div>
            </div>
          </div> 
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