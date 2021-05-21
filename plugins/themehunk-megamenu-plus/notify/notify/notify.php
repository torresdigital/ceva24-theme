<?php
// Exit if accessed directly.
if (!defined('ABSPATH')){
    exit;
}
$theme = wp_get_theme(); // gets the current theme
if ( 'Royal Shop' == $theme ){
    return;
}
if ( ! function_exists( 'themehunk_megamenu_admin_notice' ) ){
/**
 * Add admin notice when active theme, just show one time
 *
 * @return bool|null
 */
function themehunk_megamenu_admin_notice(){
  global $current_user;
  $user_id   = $current_user->ID;
  $scheme = (parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY)) ? '&' : '?';
  $theme_data  = wp_get_theme();
  $thunk_companion_icon    = apply_filters( 'thunk_companion_page_top_icon', true );
  $thunk_companion_nme     = apply_filters( 'thunk_companion_welcome_page_notice_header_site_title','');
  $url = $_SERVER['REQUEST_URI'] . $scheme . 'thunk_companion_marketplace_dismiss=yes';
    $dismiss_url = wp_nonce_url($url, 'thunk-marketplace-nonce');
  if ( !get_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ) ) {
    ?>
    <div class="thunk-notice">
    	<div class="thunk-review-thumbnail">
        <a href="https://wpzita.com/royal-shop" target="_blank">
            <img src="<?php echo THEMEHUNK_MEGAMENU_URL.'notify/assets/images/plugin-banner.png';?>" alt="">
          </a>
        </div>
        <div class="thunk-notice-text">
      <h3><?php esc_html_e('Royal Shop - New Free WooCommerce Theme', 'hunk-companion') ?></h3>
      <p>
                <?php
                echo sprintf(
                        // esc_html__('%1$s - new free WooCommerce theme form ThemeHunk Themes. Check out theme %2$s, that can be imported for FREE with simple click.', 'hunk-companion'),

                  esc_html__('Royal Shop is a free eCommerce WordPress theme, Specially made for WooCommerce. Theme comes with one click demo import feature, Which help you to setup website in few minutes. You can create single as well as multi vendor store using this theme.'),
                        '<a href="#" target="_blank">ThemeHunk Market</a>',
                        '<a href="https://wpzita.com/royal-shop/" target="_blank">Demo</a>')
                ?>
            </p>
            <ul class="thunk-review-ul">
                <li class="show-mor-message">
                    <a href="https://wpzita.com/royal-shop/#themedemo" target="_blank">
                        <span class="dashicons dashicons-desktop"></span>
                        <?php esc_html_e('Live Demo', 'hunk-companion') ?>
                    </a>
                </li>
                <li class="free-download-message">
                    <a href="https://wpzita.com/royal-shop" target="_blank">
                        <span class="dashicons dashicons-external"></span>
                        <?php esc_html_e('Check Detail', 'hunk-companion') ?>
                    </a>
                </li>
                <li class="hide-message">
                	<?php
        printf( '<a href="%1$s" class="dashicons-dismiss-icon"><span class="dashicons dashicons-welcome-comments"></span>Hide message</a>', '?' . esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore=0' );?>
                   
                </li>
            </ul>
      
   
    </div>
</div>
    <?php
  }
}
}
add_action( 'admin_notices', 'themehunk_megamenu_admin_notice' );

add_action( 'admin_init', 'themehunk_megamenu_notice_ignore' );
if ( ! function_exists( 'themehunk_megamenu_notice_ignore' ) ){
function themehunk_megamenu_notice_ignore(){
  global $current_user;
  $theme_data  = wp_get_theme();
  $user_id   = $current_user->ID;
  /* If user clicks to ignore the notice, add that to their user meta */
  if ( isset( $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) && '0' == $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) {
    add_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore', 'true', true );
  }
}
}
if ( ! function_exists( 'themehunk_megamenu_notice_scripts' ) ){
function themehunk_megamenu_notice_scripts(){  
            wp_enqueue_style('hunk-companion-notices', THEMEHUNK_MEGAMENU_URL.'notify/assets/css/notice.css');
        }
      }
add_action('admin_enqueue_scripts', 'themehunk_megamenu_notice_scripts');