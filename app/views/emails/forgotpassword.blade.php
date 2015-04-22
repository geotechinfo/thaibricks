@extends('layouts.ajax')
@section('content')

<div>
<table width="620" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#eff2f3" style="border-top:1px solid #d5d8d9;border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000">
  <tbody><tr>
    <td style="padding:13px 12px 0px 12px"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="border-top:1px solid #d5d8d9;border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9">
      <tbody><tr>
        <td style="padding:7px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td bgcolor="#fafafa" style="color:#000;padding-bottom:5px"><table width="45%" border="0" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <td style="line-height:33px">&nbsp;</td>
                <td>
                  <div style="width:225px">
                    <div >
                      <a href="{{URL::action('PagesController@index')}}" style="text-decoration:none;color:#000000" target="_blank">
                          {{ HTML::image('images/logo.png', '', array('class' => 'logo')) }}
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
                </tbody></table></td>
              </tr>
            </tbody></table></td>
          </tr>
        </tbody></table></td>
      </tr>
    </tbody></table>
  

<table width="620" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#eff2f3" style="border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000">
  <tbody><tr>
    <td style="padding:0px 12px 0px 12px"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9">
      <tbody><tr>
        <td style="padding:0px 14px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr>
                    <td style="color:#c3262d;font-size:19px;font-family:Arial,Helvetica,sans-serif;padding-top:14px">Recover Password</td>
                  </tr>
                  <tr>
                    <td style="padding-top:5px;color:#313131"><br>
                      
                     	<table>
							<tr>
								<td>
									Dear {{$dataset['first_name']}} {{$dataset['last_name']}},<br>
									Please click here to reset your password <a href="{{$dataset['reset_link']}}">Reset Password</a>
								</td>
							</tr>
						</table>
                      </td>                
                </tr>
                  
                  
                                    <tr>
                    <td>&nbsp;</td>
                  </tr>
                  
                                    
                  
                  
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="padding:4px 0 0 0;line-height:16px;color:#313131">Your Trusted Partner,<br>
                      <a href="{{URL::action('PagesController@index')}}" style="color:#313131" target="_blank">Thaibricks</a><br>
                    </td>
                  </tr>
                </tbody></table></td>
                
              </tr>
            </tbody></table></td>
          </tr>
        </tbody></table></td>
      </tr>
            
    </tbody></table></td>
  </tr>

</tbody></table>

<table width="620" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#eff2f3" style="border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9;border-bottom:1px solid #d5d8d9;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000">
  <tbody><tr>
    <td style="padding:0px 12px 0px 12px"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tbody><tr>
        <td style="padding:0px 14px 0px;border-bottom:1px solid #d5d8d9;border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#eff2f3" style="font-size:11px;color:#727272;padding:9px 0 10px 18px;line-height:16px"><p style="margin:0px;padding:0px">All trademarks, logos and names are properties of their respective owners. All Rights Reserved.<br>
          © Copyright {{date('Y')}} Tahibricks. </p></td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>
</div>
@stop()


