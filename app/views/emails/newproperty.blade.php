<table width="800" border="0" cellspacing="0" cellpadding="7" align="center">
  <tr>
    <td width="752">{{ HTML::image('images/logo.png', '', array('class' => 'logo')) }}</td>
  </tr>
  <tr>
    <td>
    	<p style="margin:0px;padding-bottom:7px">Dear {{$dataset['user']->first_name." ".$dataset['user']->last_name}},</p>
        <p style="margin-top:0px;padding-bottom:6px">Thank you for posting your property with us! Your property [{{$dataset['property']->title}}] will be screened in 24 business hours. Once approved, it will start featuring in the search results.</p>
    </td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td colspan="2"><h3>{{$dataset['property']->title}}<h3></td>
        </tr>
      <tr>
        <td width="18%">
        	 <a href="{{URL::action('PropertiesController@show', [$dataset['property']->property_id])}}" class="item-inner btn-block"> 
                {{ HTML::image(asset('files/properties')."/".$dataset['property']->media[0]->media_data, '', array('class' => 'img-responsive')) }}
            </a> 
            <br/>
             <font style="color:#fe7800;padding-right:4px">&#xe3f; {{{ number_format($dataset['property']->price, 0, ".", ",") }}}</font>
        </td>
        <td width="82%">{{$dataset['property']->description}}</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
  	<td>
    	<p style="margin:0px;padding:0px">All trademarks, logos and names are properties of their respective owners. All Rights Reserved.<br>
          © Copyright {{date('Y')}} Thaibricks.  </p>
    </td>
  </tr>
</table>
