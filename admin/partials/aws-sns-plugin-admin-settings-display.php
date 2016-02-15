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

<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    
    <form method="post" name="aws_sns_options" action="options.php">
		
		<?php
			//Grab all options
			$options = get_option($this->plugin_name);
			
			$accessKeyId = isset($options['access-key-id']) ? $options['access-key-id'] : "";
			$secretAccessKey = isset($options['secret-access-key']) ? $options['secret-access-key'] : "";
			$region = isset($options['region']) ? $options['region'] : "";
		?>
	
		<?php 
			settings_fields($this->plugin_name);
			do_settings_sections($this->plugin_name);
		?>
   	
        <fieldset>
            <legend class="screen-reader-text"><span>Access Key ID</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-cleanup">
                <span><?php esc_attr_e('Access Key ID', $this->plugin_name); ?></span>
				<input type="text" size="35" id="<?php echo $this->plugin_name; ?>-access-key-id" name="<?php echo $this->plugin_name; ?>[access-key-id]" value="<?php echo $accessKeyId ?>"/>
            </label>
        </fieldset>
		
		<fieldset>
            <legend class="screen-reader-text"><span>Secret Access Key</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-secret-access-key">
                <span><?php esc_attr_e('Secret Access Key', $this->plugin_name); ?></span>
				<input type="text" size="50" id="<?php echo $this->plugin_name; ?>-secret-access-key" name="<?php echo $this->plugin_name; ?>[secret-access-key]" value="<?php echo $secretAccessKey ?>" />
            </label>
        </fieldset>
		
		<fieldset>
            <legend class="screen-reader-text"><span>Region</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-region">
                <span><?php esc_attr_e('Region', $this->plugin_name); ?></span>
				<input type="text" size="50" id="<?php echo $this->plugin_name; ?>-region" name="<?php echo $this->plugin_name; ?>[region]" value="<?php echo $region ?>" />
            </label>
        </fieldset>

        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>