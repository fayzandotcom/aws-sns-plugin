# AWS SNS Plugin

WordPress plugin to send push notifications using Amazon Simple Notification Service

## Platforms/Frameworks
1. PHP
2. WordPress
3. AWS Simple Notification Service
4. AWS SDK for PHP

## Download

Plugin can be downloaded directly from WordPress plugin directory.
https://wordpress.org/plugins/aws-sns/

## Installation

1. Upload the plugin files to the `/wp-content/plugins/aws-sns` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Settings->AWS SNS screen to configure the plugin.
4. Provide Access Key ID, Secret Access Key, and Region of your Amazon SNS.

## Usage

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

## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

Version: 1.0
* Initial release.

## License

GPLv2
http://www.gnu.org/licenses/gpl-2.0.html
