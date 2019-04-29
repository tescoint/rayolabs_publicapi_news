<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://facebook.com/tsal3
 * @since      1.0.0
 *
 * @package    Rayolabs_publicapi_news
 * @subpackage Rayolabs_publicapi_news/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
/**
*
* admin/partials/wp-cbf-admin-display.php - Don't add this comment
*
**/
// echo plugins_url('','rayolabs_paper_admin');
?>

    <?php
        //Grab all options
        $options = get_option($this->plugin_name);

        // Cleanup
        if(!empty($options['site_token'])){
        $site_token = $options['site_token'];
         }
         if(!empty($options['post_type'])){
         $post_type = $options['post_type'];
         }
         if(!empty($options['categories'])){
         $categories = $options['categories'];
         }
     ?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <form method="post" name="rayolabs_publicapi_news" action="options.php">
    <?php settings_fields($this->plugin_name); ?>
        <!-- Enter Token Gotten From PublicApi  -->
        <fieldset>
            <legend class="screen-reader-text"><span>Site Token</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-site_token">
            	<span>Site Token:</span>
                <input type="text" id="<?php echo $this->plugin_name; ?>-site_token" name="<?php echo $this->plugin_name; ?>[site_token]" value="<?php if(!empty($site_token)){ echo $site_token; } ?>"/>
                <span><?php esc_attr_e('Enter Site Token Gotten From https://publicapi.org.ng', $this->plugin_name); ?></span>
            </label>
        </fieldset>
        <?php if(!empty($site_token)){?>
        <!-- Post Type -->
        <fieldset>
            <legend class="screen-reader-text"><span>Post Type:</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-post_type">
            <span>Post Type:</span>
            <select id="<?php echo $this->plugin_name; ?>-post_type" name="<?php echo $this->plugin_name; ?>[post_type]">
            	<option <?php if($post_type == 'excerpt'){echo "selected";} ?> value="excerpt">Excerpt</option>
            	<option <?php if($post_type == 'full'){echo "selected";} ?> value="full">Full Article</option>
            </select>
                <span><?php esc_attr_e('Should Full Article Be Posted Or Excerpt With Link to Original Article', $this->plugin_name); ?></span>
            </label>
        </fieldset>
         <!-- Create Categories Or Not -->
        <fieldset>
            <legend class="screen-reader-text"><span>Create Non-Existing Categories:</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-categories">
            <span>Create Non-Existing Categories:</span>
            <select id="<?php echo $this->plugin_name; ?>-categories" name="<?php echo $this->plugin_name; ?>[categories]">
                <option <?php if($categories == 'yes'){echo "selected";} ?> value="yes">Yes</option>
                <option <?php if($categories == 'no'){echo "selected";} ?> value="no">No</option>
            </select>
                <span><?php esc_attr_e('Should Non-Existing Categories be created automatically', $this->plugin_name); ?></span>
            </label>
        </fieldset>
        <?php }?>


        

        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>
