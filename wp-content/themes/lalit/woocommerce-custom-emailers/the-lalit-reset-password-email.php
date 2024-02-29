<?php

	add_action('the_lalit_email_header', 'the_lalit_email_header_callback', 10, 4);
	function the_lalit_email_header_callback($email_heading, $account_salutation, $customer_obj){
		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta http-equiv="Content-Type" content="Type=text/html; charset=utf-8">
			<meta name="viewport" content="width: 600, initial-scale: 1">
			<title>The LaLit: Reset Password</title>
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
																<img src="<?php echo get_template_directory_uri(); ?>/images/Lalit-Logo.png" alt="The Lalit Logo" border="0" height="auto" width="114" style="text-decoration: none; border-width:0;"/>
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
			                                             <td style="padding: 38px 45px;border: 1px solid #000000; background-color: #ffffff;">
			                                                <table>
			                                                   <tbody>
			                                                      <tr>
			                                                         <td>
			                                                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
			                                                               <tbody>
			                                                                  <tr>
			                                                                     <td style="font-weight: normal; font-family:Arial; font-size: 21px; line-height: 25px; color: #996600; letter-spacing: 0.3px; padding-bottom: 40px;"><?php echo $email_heading; ?></td>
			                                                                  </tr>
			                                                                  <tr>
			                                                                     <td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 30px;">Dear <?php echo $account_salutation.' '.$customer_obj->get_last_name(); ?>, Namaskar!</td>
			                                                                  </tr>
					<?php

	}

	add_action('the_lalit_email_body', 'the_lalit_email_body_callback', 11, 2);
	function the_lalit_email_body_callback($reset_key, $user_login){
		?>
					<tr>
				         <td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">Please click on the link below to reset your password. You may need to copy paste the link into a browser window in case the link does not work.</td>
				  	</tr>
			     	<tr>
				         <td style="font-weight: normal; font-family:Arial; font-size: 14px; line-height: 18px; color: #363636; letter-spacing: 0.3px; padding-bottom: 20px;">
				         	<a class="link" href="<?php echo esc_url( add_query_arg( array( 'key' => $reset_key, 'login' => rawurlencode( $user_login ) ), wc_get_endpoint_url( 'lost-password', '', wc_get_page_permalink( 'myaccount' ) ) ) ); ?>">
				         		<?php echo esc_url( add_query_arg( array( 'key' => $reset_key, 'login' => rawurlencode( $user_login ) ), wc_get_endpoint_url( 'lost-password', '', wc_get_page_permalink( 'myaccount' ) ) ) ); ?>
				         	</a>
						</td>
			    	</tr>
		       </tbody>
		    </table>
         </td>
      </tr>
		<?php
	}

	add_action('the_lalit_email_footer', 'the_lalit_email_footer_callback', 12);
	function the_lalit_email_footer_callback($footer_text){
		?>
													<tr>
                                                         <td style="font-family: Arial; font-size: 14px; line-height: 18px; letter-spacing: 0.7px; color: #363636;"><?php echo $footer_text; ?></td>
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

	add_action('the_lalit_email_reset_password_footer', 'the_lalit_email_reset_password_footer_callback', 13);
	function the_lalit_email_reset_password_footer_callback(){
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