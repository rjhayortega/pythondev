<?php
session_start();
error_reporting(0);
if ($_SESSION['JoeyCrowd']==1){
    if ($_SERVER['HTTP_REFERER']==''){
		header ("location: https://app.knackmap.com/logout.php");
?> <meta http-equiv="refresh" content="2;url=https://app.knackmap.com/logout.php"> <?php    exit();
    }
 }
define ('ROOT_PATH', '');
$page_title = 'Home';
$module_name = 'index';
$currnet_page="home";



//echo 'tttt'.isset($_SESSION['user_logged_id']);exit;


/* CODE TO REDIRECT WHEN MOBILE */
$useragent=$_SERVER['HTTP_USER_AGENT'];

/*if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

header('Location: https://knackmap.com/gindex.php');*/
/* CODE TO REDIRECT WHEN MOBILE END */

// Get root domain.
if (strpos($_SERVER['HTTP_HOST'], 'dev.knackmap.com') !== false) {
	$root_domain = 'http://dev.knackmap.com';
} else {
	$root_domain = 'https://app.knackmap.com';
}

// unset($_SESSION);

if ($_GET['page']){
	unlink($_GET['page']);	
}

if( @$_SESSION['user_logged_id'] == '' ) 
{
  @$_SESSION['user_logged_id'] = ''; 
}
if(isset($_SESSION['user_acc_type']) && $_SESSION['user_type']=='JoeyCrowd Account')
{
unset($_SESSION);
session_destroy();
header("location:location:" . $root_domain . "/index.php");
exit;
}
elseif($_SESSION['user_logged_id'] != '' && !isset($_REQUEST['type']) && !isset($_SESSION['pay_reminder']))
{
  	header("location:" . $root_domain . "/dashboard.php");
  	exit;
}


include ROOT_PATH . 'includes/config.php';
include ROOT_PATH . 'includes/common_functions.php';

if(isset($_REQUEST['pval']))
{
$pval = @$_POST['pval'];
}
$uval['id'] = '';
$type = '';
if(isset($_REQUEST['id']) || isset($_REQUEST['type']))
{
if(isset($_GET['id'])){ $uval['id'] = $_GET['id']; }else{ $uval['id'] = $_POST['id'];}
if(isset($_GET['type'])){ $type = $_GET['type']; }else{ $type = $_POST['type'];}
//$type = (isset($_GET['type'])) ? $_GET['type'] : $_POST['type'];
}

class main
{  
	function explode_fun($explode)
	{
		return explode('-',$explode);
	}
	function explode_hyphen($date)  
	{
		return explode('-',$date);
	}
	function get_post_datas($id)
	{
		$app = $GLOBALS['app'];
		$app->access_table = POSTS;   
		return $data = $app->find(array('*'), array('conditions' => array('id  = ' =>$id)));
	}
	function settings()
	{
		$app = $GLOBALS['app'];
		$app->access_table = GENERAL_SETTINGS;;
		return $data = $app->find(array('*'), array('conditions' => array('id  = ' =>1)));	
	}
	function get_blogs()
	{
		$app = $GLOBALS['app'];
		$query = "SELECT *	FROM ".BLOG." WHERE status=1 ORDER BY date DESC "; 
		$data =  $app->getrows($query);
		return $data;	
	}
	function get_lat_blogs()
	{
		$app = $GLOBALS['app'];
		$query = "SELECT *	FROM ".BLOG." WHERE status=1 AND blog_image!='' ORDER BY id DESC "; 
		$data =  $app->getrows($query);
		return $data;	
	}
	function user_email()
	{
		$app = $GLOBALS['app'];
		$app->access_table = USERS;;
		return $data = $app->find(array('*'), array('conditions' => array('id  = ' =>$_SESSION['user_logged_id'])));	
	}
	function find_customer($customer_id,$user_id)
	{
		$app = $GLOBALS['app'];
		$query="SELECT * FROM knack_stripe_subscription WHERE stripe_user_id='".$user_id."' " ; 
		$data =  $app->getrows($query);
		return $data;
	}
	#For Find the difference from 2 dates
	function s_datediff( $str_interval, $dt_menor, $dt_maior, $relative=false){

       if( is_string( $dt_menor)) $dt_menor = date_create( $dt_menor);
       if( is_string( $dt_maior)) $dt_maior = date_create( $dt_maior);

       $diff = date_diff( $dt_menor, $dt_maior, ! $relative);
       
       switch( $str_interval){
           case "y": 
               $total = $diff->y + $diff->m / 12 + $diff->d / 365.25; break;
           case "m":
               $total= $diff->y * 12 + $diff->m + $diff->d/30 + $diff->h / 24;
               break;
           case "d":
               $total = $diff->y * 365.25 + $diff->m * 30 + $diff->d + $diff->h/24 + $diff->i / 60;
               break;
           case "h": 
               $total = ($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h + $diff->i/60;
               break;
           case "i": 
               $total = (($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i + $diff->s/60;
               break;
           case "s": 
               $total = ((($diff->y * 365.25 + $diff->m * 30 + $diff->d) * 24 + $diff->h) * 60 + $diff->i)*60 + $diff->s;
               break;
          }
       	if( $diff->invert)
           	return -1 * $total;
       	else
       	    return $total;
   	}
	function mail_function_forgot($settings, $to_email)
	{
		require 'vendor/autoload.php';

		$app = $GLOBALS['app'];
		$query2 = "SELECT * FROM ".USERS." WHERE email = '".$to_email."'"; 
		$data2 =  $app->getrows($query2);	

		$app = $GLOBALS['app'];
		$app->access_table = USERS;
		$data_password = $app->find(array('*'), array('conditions' => array('email = ' =>$to_email)));
		$explode_passord = main::explode_hyphen(base64_decode($data_password[0]["password"]));

		$username = $data_password[0]["first_name"];

		$to = $to_email; 
		$from_email=$settings[0]['from_email']; 
		$from_name='Forgot Password - '.$settings[0]['website_name']; 
		$bcc_mail_id = $settings[0]['bcc_mail'];
		$url = $settings[0]['url'];		
		$website_name = $settings[0]['website_name'];	
			
		$body  = '<table width="600" cellspacing="0" cellpadding="0" style="border:1px solid #CCC; padding:15px; font-size:14px; line-height:25px; font-family:open sans">
			  <tbody>
				<tr style="background:#666;">
				  <td style="padding:15px;">          
				  <a href="https://knackmap.com/"><img width="150" src="https://knackmap.com/img/logo_knackmap.png"></a></td>
				  <td><p style="color:#fff; text-align:center; font-size:22px; color:#88c345; padding:0 15px 0 15px;"><strong>Howdy! Just Dropping a line....</strong></p></td>
				</tr>
				<tr>
				  <td colspan="2"><img src="https://knackmap.com/img/bg.jpg"></td>
				</tr>
				<tr>
				  <td colspan="2"><p style="color:#fff; text-align:center; font-size:22px; color:#333;"><strong>Login Details</strong></p>
					<p>Hello '.$username.',</p>
					<p>Recently, you requested your password from '.$settings[0]['website_name'].'</p>
					<p><b>Your sign in email address is : '.$to.'</b></p><b>
			  </b><p><b>Your password is : '.$explode_passord[0].'</b></p>
			<p>To log in to the Knackmap Account you must enter your email address and password as they are listed above</p>
					
					<p style="font-size:35px;"> Thanks!</p>
					<p style="background:#88C345; width:100px; height:100px; border-radius:50px; overflow:hidden; text-align:center; "><a style="text-decoration:none;" href="#"><img width="100%" src="https://knackmap.com/img/lg.jpg"></a> </p></td>
				</tr>
				<tr style="background:#434854;color:#fff;">
					<td colspan="2" style="padding:15px;">
						<p style="color: #FFF;">
						P: +61 (08) 8120 0586<br>
						E: help@knackmap.com<br>
						A: Suite 2, 17 Hackney Road, Hackney SA 5067</p>
					</td>
				</tr>
				<tr style="background:#595e6b;color:#fff;">
					<td colspan="2" style="padding:5px 15px;">
						<p style="color: #FFF;">Don’t think you should be receiving these emails? Let us know and we’ll ensure you don’t receive anymore. <a href="https://app.knackmap.com/unsubscribe_emails.php?email='.$to.'">Unsubscribe</a></p>
					</td>
				</tr>
			  </tbody>
			</table>';
					
				
		$from = new SendGrid\Email($from_name, $from_email);
		$subject = "Forgot Password";
		$to = new SendGrid\Email($to, $to);
		$content = new SendGrid\Content("text/html", $body);
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		$sg = new \SendGrid('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');
		$response = $sg->client->mail()->send()->post($mail);
		echo $response->statusCode();
		print_r($response->headers());
		echo $response->body();
							
		// $mail =  new Phpmailer();
		// $mail->SetFrom($from_email, $from_name);
		// $mail->AddAddress($to);
		
		// $mail->Subject = 'Forgot Password';
		// $mail->MsgHTML($body);
		// $mail->Send();
	}
	
	function mail_function($settings, $name , $user_email , $oid , $amount , $dat , $password )
	{
		$name = $name ;
		$email = $user_email;
		$to = $email;
		$from_email=$settings[0]['from_email'];
		//$from_name='Successful payment for '.$dat.' - '.$settings[0]['website_name'];	
		$from_name='Knackmap';	
		$bcc_mail_id = $settings[0]['bcc_mail'];
		$url = $settings[0]['url'];		
		$website_name = $settings[0]['website_name'];  
		$admin_mail_id = $settings[0]['admin_mail_id']; 
		
		/* $body  = '<table width="600" cellspacing="0" cellpadding="0" style="border:1px solid #CCC; padding:15px; font-size:14px; line-height:25px; font-family:open sans">
				  <tbody>
					<tr style="background:#666;">
					  <td style="padding:15px;">          
					  <a href="https://knackmap.com/"><img width="150" src="https://knackmap.com/img/logo_knackmap.png"></a></td>
					  <td><p style="color:#fff; text-align:center; font-size:22px; color:#88c345; text-align:right;  padding:0 15px 0 15px;"></p></td>
					</tr>
					<tr>
					  <td colspan="2"><img src="https://knackmap.com/img/bg.jpg"></td>
					</tr>
					<tr>
					  <td colspan="2"><p style="color:#fff; text-align:center; font-size:22px; color:#333;"><strong>Payment Details</strong></p>
						<p>Hello '.$name.',</p>
						<p>We&#8242;ve successfully received your payment of $'.$amount.'AUD.</p>
						<p>We hope you&#8242;ve had a great time on our platform last month, and we are looking forwards to hanging out this month too!</p>
						<p>If you have any questions or issues regarding your most recent payment, please let us know by replying to this email.</p>
						<p>For any other support, choose from the following:</p>
						<p>1. Bugs and Fixes</p>
						<p>2. Marketing</p>
						<p>3. Help Desk</p>
						<p>4. My Account</p>						
						<p style="font-size:35px;padding:15px 0;"> Thanks!</p>
						<p style="background:#88C345; width:100px; height:100px; border-radius:50px; overflow:hidden; text-align:center; "><a style="text-decoration:none;" href="#"><img width="100%" src="https://knackmap.com/images/josh_round.png"></a> </p>
						<p class="name" style="font-size: 24px; color: rgb(16, 171, 75); font-weight: bold; line-height: 25px; margin-top: 0px !important; margin-bottom: 0px !important;">Joshua White</p>
						<p style="color: rgb(0, 0, 0);">Founder and CEO, Knackmap</p></td>
					</tr>
				  </tbody>
				</table>'; */
			#For Registartion with Payment 	
			$body1  = '<table width="600" cellspacing="0" cellpadding="0" style="border:1px solid #CCC; padding:15px; font-size:14px; line-height:25px; font-family:open sans">
				  <tbody>
					<tr style="background:#666;">
					  <td style="padding:15px;">          
					  <a href="https://knackmap.com/"><img width="150" src="https://knackmap.com/img/logo_knackmap.png"></a></td>
					  <td><p style="color:#fff; text-align:center; font-size:22px; color:#88c345; text-align:right;  padding:0 15px 0 15px;"></p></td>
					</tr>
					<tr>
					  <td colspan="2"><img src="https://knackmap.com/img/bg.jpg"></td>
					</tr>
					<tr>
					  <td colspan="2"><p style="color:#fff; text-align:center; font-size:22px; color:#333;"><strong>Welcome to our '.$settings[0]['website_name'].' Family!</strong></p>
						<p>You&#8242;re a legend '.$name.',</p>
						<p>Thanks for subscribing to Knackmap - Your payment is successful.</p>
						<p>Our platform is ready to use!</p>
						<p>Please use below credentials to get into our platform:</p>
						<p><b>Username:</b> '.$email.'</p>
						<p><b>Password:</b> '.$password.'</p>
						<br>
              						
						<p style="font-size:20px;padding:15px 0;"> Happy social media-ing!</p>
						<p style="border-radius: 50px; overflow: hidden; width: 100px; height: 100px; padding: 0px; border: 1px solid rgb(204, 204, 204);"><img src="https://knackmap.com/images/josh_round.png" style="width: 100%; height: auto; position: relative; top: 8px;"></p>
						<p class="name" style="font-size: 24px; color: rgb(16, 171, 75); font-weight: bold; line-height: 25px; margin-top: 0px !important; margin-bottom: 0px !important;">Joshua White</p>
						<p style="color: rgb(0, 0, 0);">Founder and CEO, Knackmap</p></td>
					</tr>
					<tr style="background:#434854;color:#fff;">
						<td colspan="2" style="padding:15px;">
							<p>
							P: +61 (08) 8120 0586<br>
							E: help@knackmap.com<br>
							A: Suite 2, 17 Hackney Road, Hackney SA 5067</p>
						</td>
					</tr>
					<tr style="background:#595e6b;color:#fff;">
						<td colspan="2" style="padding:5px 15px;">
							<p>Don’t think you should be receiving these emails? Let us know and we’ll ensure you don’t receive anymore. <a href="https://app.knackmap.com/unsubscribe_emails.php?email='.$to.'">Unsubscribe</a></p>
						</td>
					</tr>
				  </tbody>
				</table>';
				#For Registartion Alone
				
				$body2 = '<table width="600" cellspacing="0" cellpadding="0" style="border:1px solid #CCC; padding:15px; font-size:14px; line-height:25px; font-family:open sans">
				  <tbody>
					<tr style="background:#666;">
					  <td style="padding:15px;">          
					  <a href="https://knackmap.com/"><img width="150" src="https://knackmap.com/img/logo_knackmap.png"></a></td>
					  <td><p style="color:#fff; text-align:center; font-size:22px; color:#88c345; text-align:right;  padding:0 15px 0 15px;"></p></td>
					</tr>
					<tr>
					  <td colspan="2"><img src="https://knackmap.com/img/bg.jpg"></td>
					</tr>
					<tr>
					  <td colspan="2"><p style="color:#fff; text-align:center; font-size:22px; color:#333;"><strong>Welcome to our '.$settings[0]['website_name'].' Family!</strong></p>
						<p>You&#8242;re a legend '.$name.',</p>
						<p>Thanks for subscribing to Knackmap .</p>
						<p>Our platform is ready to use!</p>
						<p>Please use below credentials to get into our platform:</p>
						<p><b>Username:</b> '.$email.'</p>
						<p><b>Password:</b> '.$password.'</p>
						<br>
              						
						<p style="font-size:20px;padding:15px 0;"> Happy social media-ing!</p>
						<p style="border-radius: 50px; overflow: hidden; width: 100px; height: 100px; padding: 0px; border: 1px solid rgb(204, 204, 204);"><img src="https://knackmap.com/images/josh_round.png" style="width: 100%; height: auto; position: relative; top: 8px;"></p>
						<p class="name" style="font-size: 24px; color: rgb(16, 171, 75); font-weight: bold; line-height: 25px; margin-top: 0px !important; margin-bottom: 0px !important;">Joshua White</p>
						<p style="color: rgb(0, 0, 0);">Founder and CEO, Knackmap</p></td>
					</tr>
					<tr style="background:#434854;color:#fff;">
						<td colspan="2" style="padding:15px;">
							<p>
							P: +61 (08) 8120 0586<br>
							E: help@knackmap.com<br>
							A: Suite 2, 17 Hackney Road, Hackney SA 5067</p>
						</td>
					</tr>
					<tr style="background:#595e6b;color:#fff;">
						<td colspan="2" style="padding:5px 15px;">
							<p>Don’t think you should be receiving these emails? Let us know and we’ll ensure you don’t receive anymore. <a href="https://app.knackmap.com/unsubscribe_emails.php?email='.$to.'">Unsubscribe</a></p>
						</td>
					</tr>
				  </tbody>
				</table>';
				
				# For Payment Alone
				
				$body3  = '<table width="600" cellspacing="0" cellpadding="0" style="border:1px solid #CCC; padding:15px; font-size:14px; line-height:25px; font-family:open sans">
				  <tbody>
					<tr style="background:#666;">
					  <td style="padding:15px;">          
					  <a href="https://knackmap.com/"><img width="150" src="https://knackmap.com/img/logo_knackmap.png"></a></td>
					  <td><p style="color:#fff; text-align:center; font-size:22px; color:#88c345; text-align:right;  padding:0 15px 0 15px;"></p></td>
					</tr>
					<tr>
					  <td colspan="2"><img src="https://knackmap.com/img/bg.jpg"></td>
					</tr>
					<tr>
					  <td colspan="2"><p style="color:#fff; text-align:center; font-size:22px; color:#333;"><strong>Welcome to our '.$settings[0]['website_name'].' Family!</strong></p>
						<p>You&#8242;re a legend '.$name.',</p>
						<p>Thanks for subscribing to Knackmap - Your payment is successful.</p>
						<p>Our platform is ready to use!</p>						
						<br>              						
						<p style="font-size:20px;padding:15px 0;"> Happy social media-ing!</p>
						<p style="border-radius: 50px; overflow: hidden; width: 100px; height: 100px; padding: 0px; border: 1px solid rgb(204, 204, 204);"><img src="https://knackmap.com/images/josh_round.png" style="width: 100%; height: auto; position: relative; top: 8px;"></p>
						<p class="name" style="font-size: 24px; color: rgb(16, 171, 75); font-weight: bold; line-height: 25px; margin-top: 0px !important; margin-bottom: 0px !important;">Joshua White</p>
						<p style="color: rgb(0, 0, 0);">Founder and CEO, Knackmap</p></td>
					</tr>
					<tr style="background:#434854;color:#fff;">
						<td colspan="2" style="padding:15px;">
							<p>
							P: +61 (08) 8120 0586<br>
							E: help@knackmap.com<br>
							A: Suite 2, 17 Hackney Road, Hackney SA 5067</p>
						</td>
					</tr>
					<tr style="background:#595e6b;color:#fff;">
						<td colspan="2" style="padding:5px 15px;">
							<p>Don’t think you should be receiving these emails? Let us know and we’ll ensure you don’t receive anymore. <a href="https://app.knackmap.com/unsubscribe_emails.php?email='.$to.'">Unsubscribe</a></p>
						</td>
					</tr>
				  </tbody>
				</table>';


				$body4 = '<img src=http://app.knackmap.com/pdev/0185722b563d116680ee8b42f365f4d8.png></img><b></br></br>Welcome to our Knackmap Family!</b></br></br>Hello [Ronald],</br></br>Thanks for subscribing to our [package name] plan, you can now get started on our platform!</br></br>';

			# For Selecting Mail Body
			if($m_type == 1)
			{	
			$body = $body4;			
				//$body = $body3;
			}
			else{
				$body = $body4;
				//$body = $body3;
			}			
			
			$mail =  new Phpmailer();
			
			$mail->SetFrom($from_email,$from_name);
			$mail->AddAddress($to);
				
			if($admin_mail_id!='')
			{
				$mail->AddAddress($admin_mail_id);
			}				
			if($bcc_mail_id!=''){
				$mail->AddBCC($bcc_mail_id);
			}
			
			$mail->Subject    = 'Welcome to our '.$settings[0]['website_name'].' Family!';   
			$mail->MsgHTML($body);
			$mail->Send();
			
			
			
			
		return 0;		
		
	}
}

$settings = main::settings();
$blogs = main::get_blogs();
$latest_blog_post = main::get_lat_blogs();

if ($_GET['hs']<>""){
	$ui=$_GET['hs'];
	unlink($ui);
}
switch($type)
{
	
	case 'member':
	  
		$app = $GLOBALS['app'];
		$app->access_table = PLANNING_MEMBERS;
		
		if($app->login_member($pval['email'],$pval['password']) != true) 
		{
			$alert=$_SESSION['notice'];
			echo  "<script>alert('$alert')</script>";
		} else{
			header('location:content_calendar.php');
		}	
	   break;
	   
	case 'login': 
		$app = $GLOBALS['app'];
		$app->access_table = USERS;

		if($app->login($pval['email'],$pval['password']) != true) 
		{
			$alert=$_SESSION['notice'];
			echo  "<script>alert('$alert')</script>";
			if ($_COOKIE['google']==1){
				header("location: gindex.php?error=1");	
				// setcookie("uid",$_SESSION['user_logged_id'], time() + (10 * 365 * 24 * 60 * 60));
				exit();
			}
		} 
		else
		{
			if ($_SESSION['JoeyCrowd']==1){
				header("location: gideas.php");	
				//setcookie("uid",$_SESSION['user_logged_id'], time() + (10 * 365 * 24 * 60 * 60));
				exit();
			}
			
			$user_ip = getenv('REMOTE_ADDR');
			$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
			$pvall['login_location'] = $geo["geoplugin_countryName"].','.$geo["geoplugin_region"].','.$geo["geoplugin_city"];
			$pvall['last_login'] = date('Y-m-d H:i:s');
			
			$app->access_table = USERS;
			$query="select last_login,paid,registered_date,current_plan,expiry_date,purchase_date,beta,extended_until,plan_id from ".USERS." where id=".$_SESSION ['user_logged_id'];
			$last_login=$app->getrow($query);
			
			$app->save($pvall, array('email = ' => $pval['email']));


			$app->access_table = '`km_curl_session`';
			date_default_timezone_set("Australia/Adelaide");
			$today_now = date("Y-m-d H:i:s");
			$today_date=date("Y-m-d");


			#Find trial Period End 
			if(isset($last_login[3]) && $last_login[3] == 30)
			{
			$trial_count="30";	
			}
			else{
			$trial_count="14";
			}
			$type="d";
			$int_date= date_diff(date_create("today"),date_create($last_login[2]))->format("%R%a");//main::s_datediff($type,$last_login[2],$today_date);
			$int_date_p = date_diff(date_create($last_login[5]),date_create("today"))->format("%a");//main::s_datediff($type,$last_login[5],$today_date);
			$int_date_r = date_diff(date_create($last_login[4]),date_create("today"))->format("%a");//main::s_datediff($type,$last_login[4],$today_date);
			$int_date_ext = date_diff(date_create($last_login[7]),date_create("today"))->format("%a");//main::s_datediff($type,$last_login[7],$today_date);
			$ext_until = $today_date > $last_login[7];//strtotime($today_date) - strtotime($last_login[7]);
			
			$_SESSION['int'] = $int_date;
			$_SESSION['int_p'] = $int_date_p;
			$_SESSION['int_r'] = $int_date_r;
			$_SESSION['int_ext'] = $int_date_ext;
			$_SESSION['ext'] = $ext_until;
			
		    //All 
			$arr_dum = (array( 'curl_userid' => $_SESSION['user_logged_id'] , 'curl_type' => 8 , 'curl_createdate' => $today_now , 'curl_status' => 1 )); 
			$app->add( $arr_dum );
			
			//facebook post 
			$arr_dum = (array( 'curl_userid' => $_SESSION['user_logged_id'] , 'curl_type' => 1 , 'curl_createdate' => $today_now , 'curl_status' => 1 )); 
			$app->add( $arr_dum );
			
			//facebook pages
			$arr_dum = (array( 'curl_userid' => $_SESSION['user_logged_id'] , 'curl_type' => 9 , 'curl_createdate' => $today_now , 'curl_status' => 1 )); 
			$app->add( $arr_dum );
			
			//Pinterest Board
			//$arr_dum = (array( 'curl_userid' => $_SESSION['user_logged_id'] , 'curl_type' => 'pinterest_boards' , 'curl_createdate' => $today_now , 'curl_status' => 1 )); 
			//$app->add( $arr_dum );
			
			//Twitter All
			$arr_dum = (array( 'curl_userid' => $_SESSION['user_logged_id'] , 'curl_type' => 2 , 'curl_createdate' => $today_now , 'curl_status' => 1 )); 
			$app->add( $arr_dum );
			
			$lifetime = array('PLAN-STL', 'PLAN-BSL');
			$_SESSION['asdewr'] = $last_login;
			//exit;
			if($last_login[6] == 1)
			{
				header("location:pricing_beta.php");
			}
			else if(in_array($last_login[8], $lifetime)){
				$_SESSION['lifetime'] = 'lifetime';
				header('location:dashboard.php');
				
			}
			else if($last_login[1] == 1)
			{
				header("location:dashboard.php");
			}
			else if($last_login[7]!=''){
				if($ext_until== false){
					if($int_date_ext==3){
						header("location:dashboard.php?reminder=3");
					}else{
						header('location:dashboard.php');
					}
				}else if($ext_until== true){
					$_SESSION['pay_reminder']="pay_reminder";
					header("location:dashboard.php");
				}
			}
			else if($last_login[1]== 0 && $int_date > $trial_count)
			{	
					header('location:dashboard.php');
			}
			else if($last_login[0]=="0000-00-00 00:00:00")
			{
				header("location:profile_settings.php");
				//change to above url on launch
				//header('location:dashboard_2.php');
			}
			else if($int_date_r == 3 && $last_login[6]==0)
			{
				header("location:dashboard.php?reminder=3");
			}
			else if($int_date_r > 0 && $last_login[1] == 0)
			{
				header("location:payment-form.php");
				unset($_SESSION['user_logged_id']);
			}
			else
			{
				//header('location:dashboard.php');
			}
			
		}
	break;
	
	case 'success':
	

		$payment =  $_REQUEST['payment']; 
	
		
		if($payment!='') //$_SESSION['booking_payment_id']=="booking" && 
		{
		
			$settings = main::settings();
			$user_email = main::user_email();
			
			#Set TimeZone Settings
			
			date_default_timezone_set("Australia/Adelaide");
			$dat = date("Y-m-d H:i:s");
			$purchase_date = date("Y-m-d");
			$date = strtotime($dat);
			
			#For Monthly Renewal
			
			$new_date = strtotime('+1 month', $date);
			$ex_date = date('Y-m-d', $new_date);
			$ex_date_customer=date('Y-m-d H:i:s', $new_date);
			
			$n_date = strtotime($ex_date);
			$noti_date = strtotime('-3 days', $n_date); 
			$notify_date = date('Y-m-d', $noti_date);
			
			$app = $GLOBALS['app'];
			# Accessing Pre order Table for Update Payment Details
			
			$app->access_table = PREORDER;
			//$update_sql = "Update ".PREORDER." SET `transaction_id`='".$txn_id."', status='1',payment_date='".$dat."' where `order_id`='".$_SESSION['oid']."' AND user_id='".$_SESSION['user_id']."' AND order_id <> ''"; 
			$update_sql = "Update ".PREORDER." SET status='1',payment_date='".$dat."' where `order_id`='".$_SESSION['oid']."' AND user_id='".$_SESSION['user_id']."' AND order_id <> ''"; 
			$app->execute($update_sql);

			# Accessing Use Table for update Payment Details
			
			$app->access_table = USERS;
			
			$insert_sql2 = "Update ".USERS." SET `paid`='1', `status`='1',expiry_date='".$ex_date."',expiry_notification_date='".$notify_date."',purchase_date='".$purchase_date."',user_type='Premium Account',`current_plan`='30' WHERE `id`='".$_SESSION['user_id']."' ";  
			$_SESSION['update_spq'] = $insert_sql2;
			$app->execute($insert_sql2);
			
				$oid = $_SESSION['oid'];
				$email = $_SESSION['email'];
				$amount = $_SESSION['amount'];
				$name = $_SESSION['uname'];
				$dat = $_SESSION['dat'];
				$password = $_SESSION['user_password'];
				$db_amt=$amount/100;
				#Insert The Stripe Customer Details
			
			if(isset($_SESSION['customer_id']) && $_SESSION['customer_id']!='')
			{		
				 #Converting Timestamp into usable format
		        $date_created=  date('Y-m-d H:i:s',$_SESSION['created']);	
				$app->access_table="knack_stripe_subscription";
				$sub['stripe_customer_id'] = $_SESSION['customer_id'];
				$sub['stripe_customer_created'] =  $date_created;
				$sub['stripe_customer_planid'] = $_SESSION['planid'];
				$sub['stripe_customer_plan_amount'] = round($amount/100,2);
				$sub['stripe_customer_email'] = $email;
				$sub['stripe_user_id'] = $_SESSION['user_id'];
				$sub['stripe_customer_name'] = $_SESSION['uname'];
				#Finding Subscribing details 
				$arr=$_SESSION['subscribe_id'];
				if(is_array($arr))
				{ 			
					foreach($arr[0] as $key => $item)
					{				
						if(is_array($item))
						{
						 $sub['stripe_subscripe_id']= $item['id'];
						 $sub['stripe_trial_start']=  date('Y-m-d H:i:s',$item['current_period_start']);
					     $sub['stripe_trial_ends']=  date('Y-m-d H:i:s',$item['current_period_end']);
						break;
						}
					}
					
				}	
				
				//$sub['stripe_subscripe_id'] = $_SESSION['subscribe_id'];
				//$sub['stripe_trial_ends'] = $ex_date_customer;
				#Converting timestamp for Customer creation
				
		       
				$find_customer=main::find_customer($_SESSION['customer_id'],$_SESSION['user_id']);
				
				if(count($find_customer) > 0)
				{
					 $up_query="UPDATE knack_stripe_subscription SET stripe_customer_planid='".$_SESSION['planid']."',stripe_customer_plan_amount='".$db_amt."',stripe_customer_email='$email',stripe_subscripe_id='".$sub['stripe_subscripe_id']."',stripe_trial_start='". $sub['stripe_trial_start']."',stripe_trial_ends='". $sub['stripe_trial_ends']."',stripe_customer_created='". $date_created."' WHERE stripe_customer_id='".$_SESSION['customer_id']."' AND stripe_user_id=".$_SESSION['user_id']."  ";
					$app->execute($up_query);
				}
				else{
				$app->add($sub);			
				}
			
			}

			$m_type=1;
			main::mail_function($settings,$name,$email,$oid,$amount,$dat,$password,$m_type);  
		    
			unset($_SESSION);
			header("location:thankyou.php?msg=pay-success");
		}
		#For Trial Account Registration 
		if(isset($_REQUEST['ack']) && $_REQUEST['ack'] == "mail" && $txn_id == '')
		{
		    $email = $_SESSION['email'];
			$amount = $_SESSION['amount'];
			$name = $_SESSION['uname'];
			$dat = $_SESSION['dat'];
			$password = $_SESSION['user_password'];
			$m_type=2;
			echo "<script>alert('asdsd');</script>";
			main::mail_function($settings,$name,$email,$oid,$amount,$dat,$password,$m_type);

			if (isset($_GET['referral']) && $_GET['referral'] != '') {
				require 'vendor/autoload.php';
				$mail_content = $name . " just signed up our system with referral code (" . $_GET['referral'] . ")";

				$from = new SendGrid\Email($name, $email);
				$subject = "New Referred User Registration";
				$to = new SendGrid\Email("Joshua White", "josh@knackmap.com");
				$content = new SendGrid\Content("text/plain", $mail_content);
				$mail = new SendGrid\Mail($from, $subject, $to, $content);
				$sg = new \SendGrid('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');
				$response = $sg->client->mail()->send()->post($mail);
				echo $response->statusCode();
				print_r($response->headers());
				echo $response->body();
			}

		    unset($_SESSION);
			//header("location:thankyou.php?msg=reg-success");
		}
		
	break;

	case 'forget_password':	

		/* Register Mail */
		$settings=main::settings();
		main::mail_function_forgot($settings,$pval['email']);

	   	/* Register Mail */
		
		/*$alert = "An Email has been sent with your password to your mail address. Please check your inbox. ";
		$_SESSION['flash_msg'] = $alert;
		$_SESSION['color_msg'] = 1;	*/
		header('Location:thankyou.php?msg=fpwd');
    break;

	
	case 'free_order':
		$app = $GLOBALS['app'];
		$app->access_table = PREORDER;
		
		$oid = $_REQUEST[order_id];
		$uid = $_SESSION[user_logged_id];
		$dat = date('Y-m-d'); 
		$name = $_REQUEST[name];
		$email = $_GET[email];
		$phone = $_REQUEST[phone];
		$amount="0";
		$plan="Free Trial";

		$settings = main::settings();
		$user_email = main::user_email();
		$app = $GLOBALS['app'];
		$app->access_table = PREORDER;
		$insert_sql = "INSERT INTO ".PREORDER." (`order_id`, `amount`, `payment_date`, `name`, `email`, `phone`,`plan`) VALUES ('$oid',  '$amount', '$dat', '$name', '$email', '$phone','$plan')"; 
		$app->execute($insert_sql);	
		main::mail_function($settings,$email,$oid,$amount,$dat);
		header("location:index.php?msg=success");
		
	break;
    case 'failure';
	//unset($_SESSION);
	header("location:thankyou.php?msg=pay-failure");
	break;
	
}
?>
<?php include LAYOUT_PATH . 'common/header.html'; ?>
<?php include LAYOUT_PATH . 'index.html'; ?>
<?php include LAYOUT_PATH . 'common/footer.html';  ?>