=== AWS SNS Plugin ===
Contributors: Fayzan Siddiqui - fayzandotcom@hotmail.com
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=fayzandotcom%40hotmail%2ecom&lc=MY&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: Amazon Web Services, Amazon Simple Notification Service, Amazon, Push Notifications, Notifications, GCM, APNS, MPNS
Requires at least: 3.0.1
Tested up to: 4.4.2
Stable tag: trunk
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is created to send push notifications to different devices using Amazon Simple Notification Service.

== Description ==

This plugin is created to send push notifications to different devices using Amazon Simple Notification Service.
It connects with the Amazon SNS and fetch all the Topics created. And publish messages to that topics.

To use this plugin you must need following things.
1. Amazon web service account.
2. Amazon API "Access Key ID" and "Secret Access Key".
3. Create atleast one topic in SNS.

Following payload is send to the selected topic, togather with the title and message you provide.

{
"default": "[MESSAGE]",
"APNS": "{\"aps\":{\"alert\": \"[MESSAGE]\"} }", 
"APNS_SANDBOX":"{\"aps\":{\"alert\":\"[MESSAGE]\"}}", 
"GCM": "{ \"data\": { \"message\": \"[MESSAGE]\", \"title\": \"[TITLE]\", \"datetime\": \"[DATETIME]\" } }", 
"MPNS" : "<?xml version=\"1.0\" encoding=\"utf-8\"?><wp:Notification xmlns:wp=\"WPNotification\"><wp:Tile><wp:Count>1</wp:Count><wp:Title>[MESSAGE]</wp:Title></wp:Tile></wp:Notification>", 
"WNS" : "<badge version\"1\" value\"23\"/>"
}

In above payload following tags are replaced by the data provided.
[TITLE] -> The title you provide.
[MESSAGE] -> The message you provide.
[DATETIME] -> server current datetime.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/aws-sns` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Settings->AWS SNS screen to configure the plugin.
4. Provide Access Key ID, Secret Access Key, and Region of your Amazon SNS.

= 1.0 =
* Initial release.
