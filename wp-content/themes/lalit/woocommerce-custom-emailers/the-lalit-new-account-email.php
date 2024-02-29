<?php

add_action('the_lalit_email_new_account_header', 'the_lalit_email_new_account_header_callback', 10, 3);
function the_lalit_email_new_account_header_callback($email_heading, $account_salutation, $last_name){
?>
	<!DOCTYPE html>
	<html lang="en">
	   <head>
	      <meta http-equiv="Content-Type" content="Type=text/html; charset=utf-8">
	      <meta name="viewport" content="width: 600, initial-scale: 1">
	      <title>The LaLit: New Account</title>
	   </head>
	   <body style="font-family: Arial; font-size: 12px; font-weight: normal; line-height: 16px; color:#f7f7f7; background-color:#f7f7f7; margin: 0px; padding:0px;" yahoo="fix">
	   	<table id="emailerContainer" cellspacing="0" cellpadding="0" width="100%" style="font-family: Arial; font-size: 12px; font-weight: normal; line-height: 16px; color:#333333; background-color:#f7f7f7; margin: 0px; padding:0px;">
		   <tbody>
		      <tr>
		         <td>
		            <table cellspacing="0" cellpadding="0" width="600" align="center" class="container">
		               <tbody>
		                  <tr>
		                     <td>
		                        <table cellspacing="0" cellpadding="0" width="100%">
		                           <tbody>
		                              <tr>
		                                 <td style="padding-top: 30px; padding-bottom: 60px;">
		                                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
		                                       <tbody>
		                                          <tr>
		                                             <td style="width: 100%; text-align: left;" class="bannerCell">
		                                               <a href="<?php echo site_url(); ?>" style="cursor: pointer; text-decoration: none;">
		                                                <img src="<?php echo site_url(); ?>/wp-content/themes/lalit/images/Lalit-Logo.png" alt="The Lalit Logo" border="0" height="auto" width="114" style="text-decoration: none; border-width:0;">
		                                               </a>
		                                             </td>
		                                          </tr>
		                                       </tbody>
		                                    </table>
		                                 </td>
		                              </tr>
		                              <tr>
		                                 <td>
		                                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
		                                       <tbody>
		                                          <tr>
		                                             <td style="padding: 25px 35px;border: 1px solid #000000; background-color: #ffffff;">
		                                                <table>
		                                                   <tbody>
		                                                      <tr>
		                                                         <td>
		                                                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
		                                                               <tbody>
		                                                                  <tr>
	                                                                        <td style=" float: left;font-weight: normal; font-family:Arial; font-size: 21px; line-height: 25px; color: #996600; letter-spacing: 0.3px; padding-bottom: 40px;"><?php echo $email_heading; ?></td>
	                                                                     </tr>
	                                                                     <tr>
	                                                                        <td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 30px;">Dear <?php echo $account_salutation.' '.$last_name; ?>, Namaskar!</td>
	                                                                     </tr>
	                                                                     <tr>
	                                                                        <td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">We thank you for creating your account with The LaLiT, it is indeed a pleasure and an honour to have you as a customer.</td>
	                                                                     </tr>
	                                                                     <tr>
	                                                                        <td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">Find your 5 star hotel in India with The LaLiT, explore our signature services and products.</td>
	                                                                     </tr>
		                                                               </tbody>
		                                                            </table>
		                                                         </td>
		                                                      </tr>
<?php
}

add_action('the_lalit_email_new_account_hotel_links', 'the_lalit_email_new_account_hotel_links_callback', 11);
function the_lalit_email_new_account_hotel_links_callback(){

  if(isMobile()){

    $font_size = '10px';
  }
  else{

    $font_size = '12px';
  }

?>
	<tr>
         <td>
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
               <tbody>
                  <tr>
                     <td width="33.33%" style=" padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family: Arial; font-size: <?php echo $font_size; ?>; line-height: 16px; letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-bangalore/">Bangalore</a></td>
                     <td width="33.33%" style="padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family: Arial; font-size: <?php echo $font_size; ?>; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-jaipur/">Jaipur</a></td>
                     <td width="33.33%" style="padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family: Arial; font-size: <?php echo $font_size; ?>; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-mumbai/">Mumbai</a></td>
                  </tr>
                  <tr>
                     <td width="33.33%" style="padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family: Arial; font-size: <?php echo $font_size; ?>; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-bekal/">Bekal</a></td>
                     <td width="33.33%" style="padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family: Arial; font-size: <?php echo $font_size; ?>; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-khajuraho/">Khajuraho</a></td>
                     <td width="33.33%" style="padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family: Arial; font-size: <?php echo $font_size; ?>; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-delhi/">New Delhi</a></td>
                  </tr>
                  <tr>
                     <td width="33.33%" style="padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family: Arial; font-size: <?php echo $font_size; ?>; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-chandigarh/">Chandigarh</a></td>
                     <td width="33.33%" style="padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family: Arial; font-size: <?php echo $font_size; ?>; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-kolkata/">Kolkata</a></td>
                     <td width="33.33%" style="padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family:Arial; font-size: <?php echo $font_size; ?>; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-srinagar/">Srinagar</a></td>
                  </tr>
                  <tr>
                     <td width="33.33%" style="padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family:Arial; font-size: <?php echo $font_size; ?>; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-goa/">Goa</a></td>
                     <td width="33.33%" style="padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family: Arial; font-size: <?php echo $font_size; ?>; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-mangar/">Mangar</a></td>
                     <td width="33.33%" style="padding-bottom: 15px;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family: Arial; font-size: <?php echo $font_size; ?>; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase;" href="<?php echo site_url(); ?>/the-lalit-udaipur/">Udaipur</a></td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
<?php
}


add_action('the_lalit_email_new_account_body', 'the_lalit_email_new_account_body_callback', 12);
function the_lalit_email_new_account_body_callback(){
?>
														<tr>
                                                         <td>
                                                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                               <tbody>
                                                                  <tr>
                                                                     <td style="border: 1px solid #cccccc; border-left: none; border-right: none;">
                                                                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                                                           <tbody>
                                                                              <tr>
                                                                                 <td style="padding-top: 20px; font-family: Arial; font-size: 14px; line-height: 18px;font-weight: normal;">You can access your account to view your orders, edit your personal details, and more.</td>
                                                                              </tr>
                                                                              <tr>
                                                                                 <td style="padding: 10px 0 20px 0; font-family: Arial; font-size: 14px; line-height: 18px;font-weight: bold;"><a style="text-decoration: none; color: #d8252f; font-weight: normal; font-family: Arial; font-size: 12px; line-height: 16px;  letter-spacing: 0.3px; text-transform: uppercase" href="<?php echo site_url(); ?>/my-account">View Your Account</td>
                                                                              </tr>
                                                                           </tbody>
                                                                        </table>
                                                                     </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td style="padding-top: 20px; font-family: Arial; font-size: 14px; line-height: 18px;font-weight: normal;">We look forward to the pleasure of serving you soon!</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td style="padding-top: 20px; font-family: Arial; font-size: 14px; line-height: 18px; letter-spacing: 0.7px; color: #363636;">Please don't hesitate to contact us for any assistance:</td>
                                                      </tr>
                                                      <tr>
                                                         <td style="font-family: Arial; font-size: 14px; line-height: 1.57;letter-spacing: 0.7px; color: #363636;">
                                                            <table>
                                                               <tbody>
                                                                  <tr>
                                                                     <td><strong>Bharat Hotels Limited</strong></td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>+91 11 4444 7777</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>corporate@thelalit.com</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>                                                                     
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
<?php
}

add_action('the_lalit_email_new_account_footer', 'the_lalit_email_new_account_footer_callback', 13);
function the_lalit_email_new_account_footer_callback(){
?>
			<tfoot width="600" align="center" class="container">
                 <tr>
                    <td style="padding-top: 20px;font-family: Arial; font-size: 12px; line-height: 16px; letter-spacing: 0.6px; color: #363636;">
                       India Toll Free: 1800 11 77 11 | Corporate Office: +91 11 4444 7474
                    </td>
                 </tr>
                 <tr>
                    <td style="font-family: Arial; font-size: 11px; font-weight: 300; line-height: 15px; letter-spacing: 0.6px; color: #363636; padding-top: 15px; padding-bottom: 15px;">
                       © The LaLiT <?php echo date('Y'); ?>. All rights reserved by Bharat Hotels Ltd.
                    </td>
                 </tr>
            </tfoot>
        </table>
   </body>
</html>
<?php
}
?>