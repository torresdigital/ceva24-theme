<?php

/**
 * Compatibility with other plugins and themes
 * Class SQ_Models_Compatibility
 */
class SQ_Models_Compatibility {

    /**
     * Check compatibility for late loading buffer
     */
    public function checkCompatibility() {
        //compatible with other cache plugins
        if (defined('CE_FILE')) {
            add_filter('sq_lateloading', '__return_true');
        }

        //Compatibility with Hummingbird Plugin
        if (SQ_Classes_Helpers_Tools::isPluginInstalled('hummingbird-performance/wp-hummingbird.php')) {
            add_filter('sq_lateloading', '__return_true');
        }

        //Compatibility with Cachify plugin
        if (SQ_Classes_Helpers_Tools::isPluginInstalled('cachify/cachify.php')) {
            add_filter('sq_lateloading', '__return_true');
        }

        //Compatibility with WP Super Cache plugin
        global $wp_super_cache_late_init;
        if (isset($wp_super_cache_late_init) && $wp_super_cache_late_init == 1 && !did_action('init')) {
            add_filter('sq_lateloading', '__return_true');
        }

        //Compatibility with Ezoic
        if (SQ_Classes_Helpers_Tools::isPluginInstalled('ezoic-integration/ezoic-integration.php')) {
            remove_all_actions('shutdown');
        }

        //Compatibility with BuddyPress plugin
        if (defined('BP_REQUIRED_PHP_VERSION')) {
            add_action('template_redirect', array(SQ_Classes_ObjController::getClass('SQ_Models_Frontend'), 'setPost'), 10);
        }

    }

    /**
     * Prevent other plugins from loading styles in Squirrly SEO Settings
     * > Only called on Squirrly Settings pages
     */
    public function fixEnqueueErrors() {
        global $sq_fullscreen, $wp_styles;

        //exclude known plugins that affect the layout in Squirrly SEO
        $exclude = array('boostrap',
            'wpcd-admin-js', 'ampforwp_admin_js', '__ytprefs_admin__', 'wpf-graphics-admin-style',
            'wpf_admin_style', 'wpf_bootstrap_script', 'wpf_wpfb-front_script',
            'wdc-styles-extras', 'wdc-styles-main', 'wp-color-picker-alpha', //collor picker compatibility
        );

        //dequeue styles and scripts that affect the layout in Squirrly SEO pages
        foreach ($exclude as $name) {
            wp_dequeue_script($name);
            wp_dequeue_style($name);
        }

        //deregister other plugins styles to prevent layout issues in Squirrly SEO pages
        if($sq_fullscreen) {
            if (isset($wp_styles->registered) && !empty($wp_styles->registered)) {
                foreach ($wp_styles->registered as $name => $style) {
                    if (isset($style->src)
                        && (strpos($style->src, 'wp-content/plugins') !== false || strpos($style->src, 'wp-content/themes') !== false)
                        && strpos($style->src, 'squirrly-seo') === false
                        && strpos($style->src, 'monitor') === false
                        && strpos($style->src, 'debug') === false) {
                        wp_deregister_script($name);
                        wp_deregister_style($name);
                    }
                }
            }
        }

    }
}
