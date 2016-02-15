<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://my.linkedin.com/in/fayzansiddiqui
 * @since      1.0.0
 *
 * @package    Aws_Sns_Plugin
 * @subpackage Aws_Sns_Plugin/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<script type="text/javascript">

	jQuery(document).ready(function() {
		
		// clear the fields
		jQuery("#clear").click(function() {
			jQuery("#title").val("");
			jQuery("#message").val("");
		});
		
	});

</script>

<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	
	<br>
	
	<?php
	
			 
			require ABSPATH . 'wp-content/plugins/'. $this->plugin_name .'/sdk/aws-sdk/aws-autoloader.php';
			
			use Aws\Sns\SnsClient;
			
			//init variable;
			$topicArn = "";
			$message = "";
			$title = "";
			$client = null;
			$topicList = null;
			$currDate = date("Y-m-d H:i:s");
			
			//Grab all options from wordpress for this plugin
			$options = get_option($this->plugin_name);
			$accessKeyId = $options['access-key-id'];
			$secretAccessKey = $options['secret-access-key'];
			$region = $options['region'];

			try {
				// create sns client
				$client = SnsClient::factory(array(
					'version' => '2010-03-31',
					'credentials' => array(
						'key'    => $accessKeyId,
						'secret' => $secretAccessKey,
					),
					'region'  => $region
				));
			} catch (Exception $ex) {
				echo "<div class='error notice'><p>Unable to connect to AWS SNS! <br> Error: ".$ex->getMessage()."</p></div>";
				return;
			}
	
			try {
				// get topic list
				$topicList = $client->listTopics(array(
					//'NextToken' => 'string',
				));
			} catch (Exception $ex) {
				echo "<div class='error notice'><p>Unable to get Topics list from AWS SNS! <br> Error: ".$ex->getMessage()."</p></div>";
				return;
			}
			
			// check if the request is POST
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if($_POST['topic']!="" && $_POST['message']!="") {

					// get Topic ARN and Message
					$topicArn = $_POST['topic'];
					$message = $_POST['message'];
					
					// get Title if exists
					$title = "";
					if(isset($_POST['title'])) {	// title is optional
						$title = $_POST['title'];
					}
					
					// payload for AWS SNS
					$payload = '{
								"default": "[MESSAGE]",
								"APNS": "{\"aps\":{\"alert\": \"[MESSAGE]\"} }", 
								"APNS_SANDBOX":"{\"aps\":{\"alert\":\"[MESSAGE]\"}}", 
								"GCM": "{ \"data\": { \"message\": \"[MESSAGE]\", \"title\": \"[TITLE]\", \"datetime\": \"[DATETIME]\" } }", 
								"MPNS" : "<?xml version=\"1.0\" encoding=\"utf-8\"?><wp:Notification xmlns:wp=\"WPNotification\"><wp:Tile><wp:Count>1</wp:Count><wp:Title>[MESSAGE]</wp:Title></wp:Tile></wp:Notification>", 
								"WNS" : "<badge version\"1\" value\"23\"/>"
								}';
					$payload = str_replace("[MESSAGE]", $message, $payload);
					$payload = str_replace("[TITLE]", $title, $payload);
					$payload = str_replace("[DATETIME]", $currDate, $payload);
					
					try {					
						//publish message
						$result = $client->publish(array(
							'TopicArn' => $topicArn,
							// Message is required
							'Message' => $payload,
							'MessageStructure' => 'json',
						));
						
						echo "<div class='updated notice'><p>Message sent successfully!</p></div>";
						
					} catch (Exception $ex) {
						echo "<div class='error notice'><p>Fail to send message! <br> Error: ".$ex->getMessage()."</p></div>";
					}
				
				} else {
					echo "<div class='error notice'><p>Please select a Topic and fill the message area.<br> Message area can't be empty.</p></div>";
				}
			}
			
			
			?>
			
			<form action="" method="POST">
			
				<table>
					<tr>
						<td>Select Topic: </td>
						<td>
							<select name="topic" id="topic">
								<?
									// parse topic array
									$arrTopics = $topicList->get('Topics');
									foreach ($arrTopics as $topic) {
										$topicArn = $topic['TopicArn'];
										$topicName = explode(':', $topicArn)[5];
										echo "<option value='$topicArn'>$topicName</option>";
									}
								?>
							</select>
						</td>
					<tr>
					<tr>
						<td>Title: </td>
						<td>
							<input type="text" id="title" name="title" size=50 value="<?php echo $title ?>"/> (optional)
						</td>
					<tr>
					<tr>
						<td>Message: </td>
						<td>
							<textarea id="message" name="message" rows="8" cols="50"><?php echo $message ?></textarea>
						</td>
					<tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="send" id="send" class="button button-primary" value="Send"  />
							<input type="button" name="clear" id="clear" class="button" value="Clear"  />
						</td>
					<tr>
				</table>
			
			</form>

</div>