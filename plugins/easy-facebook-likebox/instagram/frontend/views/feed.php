<?php

/**
 * Represents the view for the public-facing feed of the Instagram.
 *
 * @package   Easy Social Feed
 * @author    Danish Ali Malik
 * @link      https://easysocialfeed.com
 * @copyright 2020 MaltaThemes
 */
error_reporting( E_ERROR | E_PARSE );
global  $mif_skins ;
global  $post ;
$esf_insta_demo_page_id = esf_insta_demo_page_id();
$FTA = new Feed_Them_All();
$fta_settings = $FTA->fta_get_settings();
$mif_skin_default_id = $fta_settings['plugins']['instagram']['default_skin_id'];

if ( is_customize_preview() && isset( $post->ID ) && $post->ID == $esf_insta_demo_page_id ) {
    $skin_id = get_option( 'mif_skin_id', false );
    $user_id = get_option( 'mif_account_id', false );
}

if ( empty($cache_unit) ) {
    $cache_unit = 1;
}
if ( empty($cache_duration) ) {
    $cache_duration = 'hours';
}
if ( $cache_duration == 'minutes' ) {
    $cache_duration = 60;
}
if ( $cache_duration == 'hours' ) {
    $cache_duration = 60 * 60;
}
if ( $cache_duration == 'days' ) {
    $cache_duration = 60 * 60 * 24;
}
$link_target = ( $links_new_tab ? '_blank' : '_self' );
/*
 * Converting cache duration to seconds
 */
$cache_seconds = $cache_duration * $cache_unit;

if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
} else {
    $hashtag = null;
}

if ( isset( $skin_id ) ) {
    $mif_values = $mif_skins[$skin_id]['design'];
}
if ( is_customize_preview() && isset( $post->ID ) && $post->ID == $esf_insta_demo_page_id ) {
    $mif_values = get_option( 'mif_skin_' . $skin_id, false );
}
$fta_settings = $FTA->fta_get_settings();
$mif_instagram_type = esf_insta_instagram_type();
$mif_instagram_personal_accounts = esf_insta_personal_account();
if ( empty($user_id) ) {
    
    if ( $mif_instagram_type == 'personal' ) {
        $user_id = esf_insta_default_id();
    } else {
        $user_id = esf_insta_default_business_id();
    }

}

if ( class_exists( 'Esf_Multifeed_Instagram_Frontend' ) && empty($hashtag) && $mif_instagram_type == 'business' ) {
    $esf_insta_feed = apply_filters( 'esf_insta_filter_queried_data', $atts );
    $esf_insta_multifeed = true;
} else {
    $account_ids = explode( ',', $user_id );
    if ( count( $account_ids ) > 1 ) {
        $user_id = $account_ids[0];
    }
    $esf_insta_feed = $this->esf_insta_get_feeds(
        $feeds_per_page,
        0,
        $cache_seconds,
        $user_id,
        $hashtag
    );
    $esf_insta_multifeed = false;
}

$trasneint_name = "esf_insta_user_posts-{$user_id}-{$feeds_per_page}-{$mif_instagram_type}";

if ( isset( $mif_skins[$skin_id]['layout'] ) ) {
    $selected_template = $mif_skins[$skin_id]['layout'];
} else {
    $selected_template = $mif_values['layout_option'];
}

if ( !isset( $selected_template ) && empty($selected_template) ) {
    $selected_template = 'grid';
}
$selected_template = strtolower( $selected_template );
if ( efl_fs()->is_plan( 'instagram_premium', true ) or efl_fs()->is_plan( 'combo_premium', true ) ) {
    $mif_ver = 'pro';
}
?>

<div id="esf-insta-feed"
     class="esf-insta-wrap esf_insta_feed_wraper esf-instagram-type-<?php 
echo  sanitize_text_field( $mif_instagram_type ) ;
?>  <?php 
echo  sanitize_text_field( $wrapper_class ) ;
?> esf-insta-skin-<?php 
echo  intval( $skin_id ) ;
?> esf-insta-<?php 
echo  sanitize_text_field( $mif_ver ) ;
?>">
	<?php 
/*
 * Getting user data
 */
$esf_insta_user_data = $this->esf_insta_get_bio( intval( $user_id ) );

if ( $mif_values['show_header'] && !$esf_insta_multifeed ) {
    /*
     * Load header template if avaiable in active theme
     * Header template can be overriden by "{your-theme}/easy-facebook-likebox/instagram/frontend/views/html-feed-header.php"
     */
    
    if ( $esf_insta_header_templateurl = locate_template( [ 'easy-facebook-likebox/instagram/frontend/views/html-feed-header.php' ] ) ) {
        $esf_insta_header_templateurl = $esf_insta_header_templateurl;
    } else {
        $esf_insta_header_templateurl = ESF_INSTA_PLUGIN_DIR . '/frontend/views/html-feed-header.php';
    }
    
    include $esf_insta_header_templateurl;
}


if ( !isset( $esf_insta_feed->error ) && !empty($esf_insta_feed->data) ) {
    $carousel_class = null;
    $carousel_atts = null;
    ?>

    <div class="esf_insta_feeds_holder esf_insta_feeds_<?php 
    echo  sanitize_text_field( $selected_template ) ;
    ?>  <?php 
    echo  sanitize_text_field( $carousel_class ) ;
    ?>" <?php 
    echo  sanitize_text_field( $carousel_atts ) ;
    ?>
         data-template="<?php 
    echo  sanitize_text_field( $selected_template ) ;
    ?>">

		<?php 
    if ( $selected_template == 'grid' ) {
        ?>

                <div class="esf-insta-grid-skin">
                    <div class="esf-insta-row e-outer">

						<?php 
    }
    $i = 0;
    if ( !isset( $esf_insta_feed->error ) && !empty($esf_insta_feed->data) ) {
        foreach ( $esf_insta_feed->data as $feed ) {
            $caption = '';
            $created_time = $feed->timestamp;
            if ( $feed->timestamp ) {
                $feed_time = esf_insta_readable_time( $feed->timestamp );
            }
            
            if ( $feed->caption ) {
                $caption = $feed->caption;
                
                if ( str_word_count( $caption ) <= $caption_words ) {
                    $esf_insta_caption_trimmed = false;
                } else {
                    $caption = wp_trim_words( $caption, $caption_words, '' );
                    $esf_insta_caption_trimmed = true;
                }
                
                $caption = nl2br( esf_insta_convert_to_hashtag( $caption ) );
            }
            
            
            if ( $feed->media_type == 'VIDEO' ) {
                $thumbnail_url = $feed->thumbnail_url;
                if ( isset( $hashtag ) && !empty($hashtag) ) {
                    $thumbnail_url = apply_filters( 'esf_insta_hashtag_video_placeholder', ESF_INSTA_PLUGIN_URL . '/frontend/assets/images/esf-insta-video-placeholder.png' );
                }
                $video_url = $feed->media_url;
            } else {
                $thumbnail_url = $feed->media_url;
            }
            
            $esf_insta_feed_popup_url = '';
            /*
             * Load Feed template if avaiable in active theme
             * Feed template can be overriden by "{your-theme}/easy-facebook-likebox/instagram/frontend/views/templates/template-{$layout}.php"
             */
            
            if ( $esf_feed_templateurl = locate_template( [ 'easy-facebook-likebox/instagram/frontend/views/templates/template-' . $selected_template . '.php' ] ) ) {
                $esf_feed_templateurl = $esf_feed_templateurl;
            } else {
                $esf_feed_templateurl = ESF_INSTA_PLUGIN_DIR . '/frontend/views/templates/template-' . $selected_template . '.php';
            }
            
            require $esf_feed_templateurl;
            $i++;
            if ( $i == $feeds_per_page ) {
                break;
            }
        }
    }
    if ( $selected_template == 'masonary' || $selected_template == 'grid' ) {
        ?>
                    </div>
                </div>
			<?php 
    }
    ?>
            </div>
			<?php 
    /*
     * Load Feed footer template if avaiable in active theme
     * Feed footer template can be overriden by "{your-theme}/easy-facebook-likebox/instagram/frontend/views/html-feed-footer.php"
     */
    
    if ( $esf_feed_footer_url = locate_template( [ 'easy-facebook-likebox/instagram/frontend/views/html-feed-footer.php' ] ) ) {
        $esf_feed_footer_url = $esf_feed_footer_url;
    } else {
        $esf_feed_footer_url = ESF_INSTA_PLUGIN_DIR . 'frontend/views/html-feed-footer.php';
    }
    
    include $esf_feed_footer_url;
}


if ( isset( $esf_insta_feed->error ) && empty($esf_insta_feed->data) ) {
    ?>
                <p class="esf_insta_error_msg"><?php 
    echo  __( 'Error: ', 'easy-facebook-likebox' ) ;
    echo  $esf_insta_feed->error ;
    ?></p>
			<?php 
}

?>

        </div>