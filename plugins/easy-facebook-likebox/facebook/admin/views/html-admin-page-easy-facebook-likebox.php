<?php
/**
 * Admin View: Page - Facebook
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$FTA = new Feed_Them_All();

$ESF_Admin = new ESF_Admin();

$fta_settings = $FTA->fta_get_settings();
if( isset($fta_settings['hide_plugin'] ) ){
	$hide_plugin = $fta_settings['hide_plugin'];
}

if( isset($fta_settings['hide_upgrade'] ) ){
	$hide_upgrade = $fta_settings['hide_upgrade'];
}

if( isset( $hide_plugin ) && isset( $hide_upgrade ) ){
    $hide_sidebar_class = 'esf-sidebar-is-hide';
}else{
	$hide_sidebar_class = '';
}

$app_ID = [ '405460652816219', '222116127877068' ];

$rand_app_ID = array_rand( $app_ID, '1' );

$u_app_ID = $app_ID[ $rand_app_ID ];

$auth_url = esc_url( add_query_arg( [
	'client_id'    => $u_app_ID,
	'redirect_uri' => 'https://maltathemes.com/efbl/app-' . $u_app_ID . '/index.php',
	'scope'        => 'manage_pages',
	'state'        => admin_url( 'admin.php?page=easy-facebook-likebox' ),
], 'https://www.facebook.com/dialog/oauth' ) );

?>
    <div class="esf_loader_wrap">
        <div class="esf_loader_inner">
            <div class="loader efbl_loader"></div>
        </div>
    </div>
<div class="fta_wrap_outer <?php echo $hide_sidebar_class; ?>" <?php if( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ){?> style="width: 78%" <?php } ?>>
    <div class="efbl_wrap z-depth-1">
        <div class="efbl_wrap_inner">

            <div class="efbl_tabs_holder">
                <div class="efbl_tabs_header">
                    <ul id="efbl_tabs" class="tabs">
                        <li class="tab col s3">
                            <a class="active" href="#efbl-authentication">
                                <span><?php esc_html_e( "1", 'easy-facebook-likebox' ); ?>. <?php esc_html_e( "Authenticate", 'easy-facebook-likebox' ); ?></span>
                            </a>
                        </li>
                        <li class="tab col s3">
                            <a class="active" href="#efbl-general">
                                <span><?php esc_html_e( "2", 'easy-facebook-likebox' ); ?>. <?php esc_html_e( "Use (Display)", 'easy-facebook-likebox' ); ?></span>
                            </a>
                        </li>
                        <li class="tab col s3">
                            <a class="" href="#efbl-skins">
                                <span><?php esc_html_e( "3", 'easy-facebook-likebox' ); ?>. <?php esc_html_e( "Customize (skins)", 'easy-facebook-likebox' ); ?></span>
                            </a>
                        </li>
                        <li class="tab col s3 efbl-moderate-tab-li">
                            <a class="" href="#efbl-moderate">
                                <span><?php esc_html_e( "Moderate", 'easy-facebook-likebox' );
                                    if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ){ ?>
                                        (<?php esc_html_e( "Pro", 'easy-facebook-likebox' ); ?>)
                                  <?php } ?>
                                </span>
                            </a>
                        </li>
                        <li class="tab col s3">
                            <a class="active" href="#efbl-likebox">
                                <span><?php esc_html_e( "Facebook Like box(Page Plugin)", 'easy-facebook-likebox' ); ?></span>
                            </a>
                        </li>
	                    <?php do_action('efbl_admin_tab', $fta_settings ); ?>
                        <li class="tab col s3">
                            <a class="active" href="#efbl-cached">
                                <span><?php esc_html_e( "Clear Cache", 'easy-facebook-likebox' ); ?></span>
                            </a>
                        </li>
                        <li class="indicator"></li>
                    </ul>

					<?php if ( ( $fta_settings['plugins']['instagram']['status'] ) && ( 'activated' == $fta_settings['plugins']['instagram']['status'] ) ) { ?>

                        <div class="efbl_tabs_right">
                            <a class=""
                               href="<?php echo esc_url( admin_url( 'admin.php?page=mif' ) ) ?>"><?php esc_html_e( "Instagram", 'easy-facebook-likebox' ); ?></a>
                        </div>

					<?php } ?>
                </div>
            </div>
	        <?php do_action('efbl_admin_after_tabs', $fta_settings); ?>
            <div class="efbl_tab_c_holder">
				<?php include_once EFBL_PLUGIN_DIR . 'admin/views/html-authenticate-tab.php'; ?>
				<?php include_once EFBL_PLUGIN_DIR . 'admin/views/html-how-to-use-tab.php'; ?>
				<?php include_once EFBL_PLUGIN_DIR . 'admin/views/html-moderate-tab.php'; ?>
				<?php include_once EFBL_PLUGIN_DIR . 'admin/views/html-skins-tab.php'; ?>
				<?php include_once EFBL_PLUGIN_DIR . 'admin/views/html-likebox-tab.php'; ?>
				<?php include_once EFBL_PLUGIN_DIR . 'admin/views/html-clear-cache-tab.php'; ?>
				<?php do_action('efbl_admin_tab_content', $fta_settings); ?>
            </div>
        </div>
    </div>

</div>

<?php if ( efl_fs()->is_free_plan() || efl_fs()->is_plan( 'instagram_premium', true ) ) {
if( !isset( $hide_plugin ) && !isset( $hide_upgrade ) ){

	$mt_plugins = $ESF_Admin->mt_plugins_info();
	?>
    <div class="fta-other-plugins-sidebar">
		<?php if ( $mt_plugins && !isset( $fta_settings['hide_plugin']) ) { ?>

            <div class="fta-other-plugins-wrap z-depth-1 esf-hide-plugin">

                <div class="fta-other-plugins-head">
                    <div class="dashicons dashicons-no-alt esf-hide-free-sidebar" data-id="plugin"></div>
                    <h5><?php esc_html_e( 'Love this plugin?', 'easy-facebook-likebox' ); ?></h5>
                    <p><?php esc_html_e( 'Then why not try our other FREE plugins.', 'easy-facebook-likebox' ); ?></p>
                </div>

                <div class="fta-plugins-carousel">
                    <div class="carousel carousel-slider center">

						<?php foreach ( $mt_plugins as $slug => $mt_plugin ) {

							$install_link = $ESF_Admin->mt_plugin_install_link( $slug ); ?>

                            <div class="carousel-item"
                                 href="<?php esc_attr_e( $slug ); ?>">

								<?php if ( $mt_plugin->name ) { ?>

                                    <h2><?php esc_html_e( $mt_plugin->name ); ?></h2>

								<?php } ?>

								<?php if ( $mt_plugin->description ) { ?>

                                    <p><?php echo nl2br( esc_html( $mt_plugin->description ) ); ?></p>

								<?php } ?>

								<?php if ( $mt_plugin->active_installs ) { ?>

                                    <p><?php if ( strpos( $mt_plugin->active_installs, 'Just' ) !== false ) {
											esc_html_e( $mt_plugin->active_installs );
										} else {
											esc_html_e( 'Active Installs: ', 'easy-facebook-likebox' );
											esc_html_e( $mt_plugin->active_installs );
										} ?></p>

								<?php } ?>

                                <span title="<?php esc_html_e( '5-Star Rating', 'easy-facebook-likebox' ) ?>"
                                      class="stars">★ ★ ★ ★ ★ </span>

                                <div class="fta-carousel-actions">
                                    <a href="<?php echo esc_url( $install_link ); ?>"><?php if ( filter_var( $install_link, FILTER_VALIDATE_URL ) === false ) {
											esc_html_e( 'Already Installed', 'easy-facebook-likebox' );
										} else {
											esc_html_e( 'Install Now Free', 'easy-facebook-likebox' );
										} ?></a>

                                    <a class="right"
                                       href="https://wordpress.org/plugins/<?php esc_attr_e( $slug ); ?>"
                                       target="_blank"><?php esc_html_e( 'More Info', 'easy-facebook-likebox' ) ?></a>
                                </div>

                            </div>
						<?php } ?>

                    </div>
                </div>
            </div>

		<?php } ?>

	    <?php       $banner_info = $ESF_Admin->esf_upgrade_banner();
	    if( !isset( $fta_settings['hide_upgrade']) ){ ?>
        <div class="espf-upgrade z-depth-2 esf-hide-upgrade">
            <div class="dashicons dashicons-no-alt esf-hide-free-sidebar" data-id="upgrade"></div>
            <h2><?php  esc_html_e( $banner_info['name'] ); ?>
                <b><?php  esc_html_e( $banner_info['bold'] ); ?></b></h2>
            <p><?php  esc_html_e( $banner_info['fb-description'] ); ?></p>
            <p><?php  esc_html_e( $banner_info['discount-text'] ); ?> <code><?php  esc_html_e( $banner_info['coupon'] ); ?></code>
            </p>
            <a href="<?php echo esc_url( efl_fs()->get_upgrade_url() ) ?>"
               class="waves-effect waves-light btn"><i class="material-icons right">lock_open</i><?php esc_html_e( $banner_info['button-text'] ); ?>
            </a>
        </div>
        <?php } ?>
    </div>

    </div>
<?php }
} ?>

    <!-- Popup starts<!-->
    <div id="fta-auth-error" class="modal">
        <div class="modal-content">
            <span class="mif-close-modal modal-close"><i
                        class="material-icons dp48">close</i></span>
            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">error_outline</i> </span>
                <p><?php esc_html_e( "Sorry, the Plugin is unable to get the page data. Please delete the access token and select pages in the second step of authentication to give permission.", 'easy-facebook-likebox' ); ?></p>

                <a class="waves-effect waves-light efbl_authentication_btn btn"
                   href="<?php echo $auth_url ?>"><img class="efb_icon left"
                                                       src="<?php echo EFBL_PLUGIN_URL ?>/admin/assets/images/facebook-icon.png"/><?php esc_html_e( "Connect My Facebook Pages", 'easy-facebook-likebox' ); ?>
                </a>

            </div>
        </div>

    </div>
    <!-- Popup ends<!-->

    <!-- Popup starts<!-->
    <div id="fta-remove-at" class="modal">
        <div class="modal-content">
            <span class="mif-close-modal modal-close"><i
                        class="material-icons dp48">close</i></span>
            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">error_outline</i> </span>
                <h5><?php esc_html_e( "Are you sure?", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "Do you really want to delete the access token? It will delete all the pages data, access tokens, and permissions given to the app.", 'easy-facebook-likebox' ); ?></p>
                <a class="waves-effect waves-light btn modal-close"
                   href="javascript:void(0)"><?php esc_html_e( "Cancel", 'easy-facebook-likebox' ); ?></a>
                <a class="waves-effect waves-light btn efbl_delete_at_confirmed modal-close"
                   href="javascript:void(0)"><?php esc_html_e( "Delete", 'easy-facebook-likebox' ); ?></a>
            </div>
        </div>

    </div>
    <!-- Popup ends<!-->

    <!-- Remove Skin Popup starts<!-->
    <div id="efbl-remove-skin"
         class="modal efbl-remove-skin efbl-confirm-modal">
        <div class="modal-content">
            <span class="mif-close-modal modal-close"><i
                        class="material-icons dp48">close</i></span>
            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">error_outline</i> </span>
                <h5><?php esc_html_e( "Are you sure?", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "Do you really want to delete the skin? It will delete all the settings values of the skin.", 'easy-facebook-likebox' ); ?></p>
                <a class="waves-effect waves-light btn modal-close"
                   href="javascript:void(0)"><?php esc_html_e( "Cancel", 'easy-facebook-likebox' ); ?></a>
                <a class="waves-effect waves-light btn efbl_skin_delete modal-close"
                   href="javascript:void(0)"><?php esc_html_e( "Delete", 'easy-facebook-likebox' ); ?></a>
            </div>
        </div>

    </div>
    <!-- Remove Skin Popup ends<!-->

<?php if ( efl_fs()->is_free_plan() ) { ?>
    <!-- Filter Modal Structure -->
    <div id="efbl-filter-upgrade" class="fta-upgrade-modal modal">
        <div class="modal-content">

            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">lock_outline</i> </span>
                <h5><?php esc_html_e( "Premium Feature", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "We're sorry, posts filter is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ); ?>
                    <a target="_blank"
                       href="https://easysocialfeed.com/custom-facebook-feed"><?php esc_html_e( "Check out the demo", 'easy-facebook-likebox' ); ?></a>
                </p>
                <p><?php esc_html_e( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?', 'easy-facebook-likebox' ); ?></br><code>ESPF10</code></p>
                <hr/>
                <a href="<?php echo efl_fs()->get_upgrade_url() ?>"
                   class="waves-effect waves-light btn"><i
                            class="material-icons right">lock_open</i><?php esc_html_e( "Upgrade to pro", 'easy-facebook-likebox' ); ?>
                </a>

            </div>
        </div>

    </div>

    <div id="efbl-load-more-upgrade" class="fta-upgrade-modal modal">
        <div class="modal-content">

            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">lock_outline</i> </span>
                <h5><?php esc_html_e( "Premium Feature", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "Add load more button at the bottom of each feed to load more posts, events, photos, videos, or albums.", 'easy-facebook-likebox' ); ?>
                    <a target="_blank"
                       href="https://easysocialfeed.com/custom-facebook-feed"><?php esc_html_e( "Check out the demo", 'easy-facebook-likebox' ); ?></a>
                </p>
                <p><?php esc_html_e( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?', 'easy-facebook-likebox' ); ?></br><code>ESPF10</code></p>
                <hr/>
                <a href="<?php echo efl_fs()->get_upgrade_url() ?>"
                   class="waves-effect waves-light btn"><i
                            class="material-icons right">lock_open</i><?php esc_html_e( "Buy Now", 'easy-facebook-likebox' ); ?>
                </a>

            </div>
        </div>

    </div>

    <div id="efbl-live-stream-only-upgrade" class="fta-upgrade-modal modal">
        <div class="modal-content">

            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">lock_outline</i> </span>
                <h5><?php esc_html_e( "Premium Feature", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "We are sorry Live stream feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ); ?>
                </p>
                <p><?php esc_html_e( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?', 'easy-facebook-likebox' ); ?></br><code>ESPF10</code></p>
                <hr/>
                <a href="<?php echo efl_fs()->get_upgrade_url() ?>"
                   class="waves-effect waves-light btn"><i
                            class="material-icons right">lock_open</i><?php esc_html_e( "Buy Now", 'easy-facebook-likebox' ); ?>
                </a>

            </div>
        </div>

    </div>

    <!-- Filter Modal Structure Ends-->
    <div id="efbl-free-grid-upgrade" class="fta-upgrade-modal modal">
        <div class="modal-content">
            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">lock_outline</i> </span>
                <h5><?php esc_html_e( "Premium Feature", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "We are sorry grid layout is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ); ?>
                    <a target="_blank"
                       href="https://easysocialfeed.com/custom-facebook-feed/grid"><?php esc_html_e( "Check out the demo", 'easy-facebook-likebox' ); ?></a>
                </p>
                <p><?php esc_html_e( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?', 'easy-facebook-likebox' ); ?></br><code>ESPF10</code></p>
                <hr/>
                <a href="<?php echo efl_fs()->get_upgrade_url() ?>"
                   class="waves-effect waves-light btn"><i
                            class="material-icons right">lock_open</i><?php esc_html_e( "Upgrade to pro", 'easy-facebook-likebox' ); ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Grid Layout Modal Structure -->
    <div id="efbl-free-masonry-upgrade" class="fta-upgrade-modal modal">
        <div class="modal-content">

            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">lock_outline</i> </span>
                <h5><?php esc_html_e( "Premium Feature", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "We are sorry masonry layout is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ); ?>
                    <a target="_blank"
                       href="https://easysocialfeed.com/custom-facebook-feed/masonry"><?php esc_html_e( "Check out the demo", 'easy-facebook-likebox' ); ?></a>
                </p>
                <p><?php esc_html_e( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?', 'easy-facebook-likebox' ); ?></br><code>ESPF10</code></p>
                <hr/>
                <a href="<?php echo efl_fs()->get_upgrade_url() ?>"
                   class="waves-effect waves-light btn"><i
                            class="material-icons right">lock_open</i><?php esc_html_e( "Upgrade to pro", 'easy-facebook-likebox' ); ?>
                </a>

            </div>
        </div>

    </div>

    <!-- Grid Layout Structure Ends-->

    <!-- Carousel Layout Modal Structure -->
    <div id="efbl-free-carousel-upgrade" class="fta-upgrade-modal modal">
        <div class="modal-content">

            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">lock_outline</i> </span>
                <h5><?php esc_html_e( "Premium Feature", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "We are sorry carousel layout is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ); ?>
                    <a target="_blank"
                       href="https://easysocialfeed.com/custom-facebook-feed/carousel"><?php esc_html_e( "Check out the demo", 'easy-facebook-likebox' ); ?></a>
                </p>
                <p><?php esc_html_e( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?', 'easy-facebook-likebox' ); ?></br><code>ESPF10</code></p>
                <hr/>
                <a href="<?php echo efl_fs()->get_upgrade_url() ?>"
                   class="waves-effect waves-light btn"><i
                            class="material-icons right">lock_open</i><?php esc_html_e( "Upgrade to pro", 'easy-facebook-likebox' ); ?>
                </a>

            </div>
        </div>

    </div>

    <!-- Carousel Layout Structure Ends-->

    <!-- Other page Modal Structure -->
    <div id="efbl-other-pages-upgrade" class="fta-upgrade-modal modal">
        <div class="modal-content">

            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">lock_outline</i> </span>
                <h5><?php esc_html_e( "Premium Feature", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "We're sorry, ability to display posts from other pages not managed by you is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ); ?></p>
                <p><?php esc_html_e( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?', 'easy-facebook-likebox' ); ?></br><code>ESPF10</code></p>
                <hr/>
                <a href="<?php echo efl_fs()->get_upgrade_url() ?>"
                   class="waves-effect waves-light btn"><i
                            class="material-icons right">lock_open</i><?php esc_html_e( "Upgrade to pro", 'easy-facebook-likebox' ); ?>
                </a>

            </div>
        </div>

    </div>

    <!-- Other page Modal Structure Ends-->

    <!-- Tabs Modal Structure -->
    <div id="efbl-tabs-upgrade" class="fta-upgrade-modal modal">
        <div class="modal-content">

            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">lock_outline</i> </span>
                <h5><?php esc_html_e( "Premium Feature", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "We are sorry showing tabs in likebox feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ); ?></p>
                <p><?php esc_html_e( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?', 'easy-facebook-likebox' ); ?></br><code>ESPF10</code></p>
                <hr/>
                <a href="<?php echo efl_fs()->get_upgrade_url() ?>"
                   class="waves-effect waves-light btn"><i
                            class="material-icons right">lock_open</i><?php esc_html_e( "Upgrade to pro", 'easy-facebook-likebox' ); ?>
                </a>

            </div>
        </div>

    </div>

    <!-- Filter Tabs Structure Ends-->

    <!-- Select pages Modal Structure -->
    <div id="efbl-pages-enable" class="fta-upgrade-modal modal">
        <div class="modal-content">

            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">lock_outline</i> </span>
                <h5><?php esc_html_e( "Premium Feature", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "We are sorry showing popup on specific pages feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ); ?></p>
                <p><?php esc_html_e( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?', 'easy-facebook-likebox' ); ?></br><code>ESPF10</code></p>
                <hr/>
                <a href="<?php echo efl_fs()->get_upgrade_url() ?>"
                   class="waves-effect waves-light btn"><i
                            class="material-icons right">lock_open</i><?php esc_html_e( "Upgrade to pro", 'easy-facebook-likebox' ); ?>
                </a>

            </div>
        </div>

    </div>

    <!-- Select pages Structure Ends-->

    <!-- Select posts Structure -->
    <div id="efbl-posts-enable" class="fta-upgrade-modal modal">
        <div class="modal-content">

            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">lock_outline</i> </span>
                <h5><?php esc_html_e( "Premium Feature", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "We're sorry, ability to display posts from other pages not managed by you is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ); ?></p>
                <p><?php esc_html_e( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?', 'easy-facebook-likebox' ); ?></br><code>ESPF10</code></p>
                <hr/>
                <a href="<?php echo efl_fs()->get_upgrade_url() ?>"
                   class="waves-effect waves-light btn"><i
                            class="material-icons right">lock_open</i><?php esc_html_e( "Upgrade to pro", 'easy-facebook-likebox' ); ?>
                </a>

            </div>
        </div>

    </div>

    <!-- Select posts Structure Ends-->

    <!-- exit intent  Structure -->
    <div id="efbl-exit-intent" class="fta-upgrade-modal modal">
        <div class="modal-content">

            <div class="mif-modal-content"><span class="mif-lock-icon"><i
                            class="material-icons dp48">lock_outline</i> </span>
                <h5><?php esc_html_e( "Premium Feature", 'easy-facebook-likebox' ); ?></h5>
                <p><?php esc_html_e( "We are sorry showing popup on exit intent feature is not included in your plan. Please upgrade to premium version to unlock this and all other cool features.", 'easy-facebook-likebox' ); ?></p>
                <p><?php esc_html_e( 'Upgrade today and get a 10% discount! On the checkout click on "Have a promotional code?', 'easy-facebook-likebox' ); ?></br><code>ESPF10</code></p>
                <hr/>
                <a href="<?php echo efl_fs()->get_upgrade_url() ?>"
                   class="waves-effect waves-light btn"><i
                            class="material-icons right">lock_open</i><?php esc_html_e( "Upgrade to pro", 'easy-facebook-likebox' ); ?>
                </a>

            </div>
        </div>

    </div>

<?php } ?>

<div id="efbl-addon-upgrade" class="fta-upgrade-modal modal">
    <div class="modal-content">
        <div class="mif-modal-content"><span class="mif-lock-icon"><i
                        class="material-icons dp48">lock_outline</i> </span>
            <h5><?php esc_html_e( "Multifeed Add-on", 'easy-facebook-likebox' ); ?></h5>
            <p><?php esc_html_e( "The Multifeed add-on gives you the ability to display multiple posts or events from multiple Facebook accounts (even not owned/managed by you) in one single feed ordered by date.", 'easy-facebook-likebox' ); ?>
                <a target="_blank" href="https://easysocialfeed.com/custom-facebook-feed/multifeed"><?php esc_html_e( "Check out the demo", 'easy-facebook-likebox' ); ?></a>
            </p>
            <hr>
            <a href="<?php echo esc_url( admin_url('admin.php?slug=esf-multifeed&page=feed-them-all-addons') ); ?>"
               class="waves-effect waves-light btn"><i
                        class="material-icons right">lock_open</i><?php esc_html_e( "Get Started", 'easy-facebook-likebox' ); ?>
            </a>
        </div>
    </div>
</div>
