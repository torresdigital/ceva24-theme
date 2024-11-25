<?php defined('ABSPATH') || die('Cheatin\' uh?'); ?>
<?php
$edit_link = false;

$post = $view->auditpage->wppost;

if (isset($post->ID)) {
    if ($post->post_type <> 'profile') {
        $edit_link = get_edit_post_link($post->ID, false);
    }

} elseif (isset($post->term_id) && $post->term_id) {
    $term = get_term_by('term_id', $post->term_id, $post->taxonomy);
    if (!is_wp_error($term)) {
        $edit_link = get_edit_term_link($term->term_id, $post->taxonomy);
    }
}

if (strtotime($view->auditpage->audit_datetime)) {
    $audit_timestamp = strtotime($view->auditpage->audit_datetime) + ((int)get_option('gmt_offset') * 3600);
    $audit_timestamp = date(get_option('date_format') . ' ' . get_option('time_format'), $audit_timestamp);
} else {
    $audit_timestamp = $view->auditpage->audit_datetime;
}
?>

<td style="min-width: 380px;">

    <?php if ($post instanceof SQ_Models_Domain_Post) { ?>
        <div class="sq_auditpages_title col-12 px-0 mx-0 font-weight-bold">
            <?php echo (isset($post->sq->title) ? $post->sq->title : '') ?> <?php echo(($post->post_status <> 'publish' && $post->post_status <> 'inherit' && $post->post_status <> '') ? ' <spam style="font-weight: normal">(' . esc_html($post->post_status) . ')</spam>' : '') ?>
            <?php if (isset($edit_link) && $edit_link <> '') { ?>
                <a href="<?php echo esc_url($edit_link) ?>" target="_blank">
                    <i class="fa fa-edit" style="font-size: 11px"></i>
                </a>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="sq_auditpages_url small"><?php echo '<a href="' . esc_url($view->auditpage->permalink) . '"  class="text-link" rel="permalink" target="_blank">' . urldecode($view->auditpage->permalink) . '</a>' ?></div>
    <div class="sq_focuspages_lastaudited small my-1"><?php echo esc_html__("Last checked", _SQ_PLUGIN_NAME_) ?>:
        <span class="text-danger"><?php echo (string)$audit_timestamp ?></span>
    </div>
</td>
<?php if ($view->auditpage->audit_error) { ?>
    <td>
        <div class="text-danger my-2"><?php echo esc_html__("Could not create the audit for this URL", _SQ_PLUGIN_NAME_) . ' (' . esc_html__("error code", _SQ_PLUGIN_NAME_) . ': ' . $view->auditpage->audit_error . ')' ?></div>
        <div class="text-black-50" style="font-size: 11px">
            <em><?php echo sprintf(esc_html__("The way your WordPress site is currently hosted can affect the way Squirrly SEO operates in order to retrieve and process data about this page. %sIt’s important to do everything on your end to ensure that the audits can be generated by our system. %s Whitelist our crawler IP address (176.9.112.210) to allow our server to verify your page so that you’ll receive a full audit.", _SQ_PLUGIN_NAME_), '<br /><br />', '<br /><br />') ?></em>
            <div class="my-1 text-info sq_previewurl font-weight-bold"  style="cursor: pointer" onclick="jQuery('#sq_previewurl_modal').attr('data-post_id', '<?php echo (int)$view->auditpage->user_post_id ?>');  jQuery('#sq_previewurl_modal').sq_inspectURL()" data-dismiss="modal"><?php echo esc_html__("Inspect URL", _SQ_PLUGIN_NAME_); ?></div>
        </div>

    </td>
<?php } else { ?>
    <td></td>
<?php } ?>

<td class="px-0" style="width: 20px">
    <div class="sq_sm_menu">
        <div class="sm_icon_button sm_icon_options">
            <i class="fa fa-ellipsis-v"></i>
        </div>
        <div class="sq_sm_dropdown">
            <ul class="p-2 m-0 text-left">
                <li class="m-0 p-1 py-2">
                    <form method="post" class="p-0 m-0" >
                        <?php SQ_Classes_Helpers_Tools::setNonce('sq_audits_page_update', 'sq_nonce'); ?>
                        <input type="hidden" name="action" value="sq_audits_page_update"/>
                        <input type="hidden" name="post_id" value="<?php echo (int)$view->auditpage->user_post_id ?>"/>
                        <i class="sq_icons_small fa fa-refresh" style="padding: 2px"></i>
                        <button type="submit" class="btn btn-sm bg-transparent p-0 m-0">
                            <?php echo esc_html__("Request New Audit", _SQ_PLUGIN_NAME_) ?>
                        </button>
                    </form>
                </li>
                <li class="m-0 p-1 py-2">
                    <i class="sq_icons_small fa fa-info-circle" style="padding: 2px"></i>
                    <button class="btn btn-sm bg-transparent p-0 m-0" onclick="jQuery('#sq_previewurl_modal').attr('data-post_id', '<?php echo (int)$view->auditpage->user_post_id  ?>'); jQuery('#sq_previewurl_modal').sq_inspectURL()" data-dismiss="modal"><?php echo esc_html__("Inspect URL", _SQ_PLUGIN_NAME_); ?></button>
                </li>
                <li class="m-0 p-1 py-2">
                    <form method="post" class="p-0 m-0" onSubmit="return confirm('<?php echo esc_html__("Do you want to delete the Audit Page?",_SQ_ASSETS_URL_) ?>') ">
                        <?php SQ_Classes_Helpers_Tools::setNonce('sq_audits_delete', 'sq_nonce'); ?>
                        <input type="hidden" name="action" value="sq_audits_delete"/>
                        <input type="hidden" name="id" value="<?php echo (int)$view->auditpage->user_post_id ?>"/>
                        <i class="sq_icons_small fa fa-trash-o" style="padding: 2px"></i>
                        <button type="submit" class="btn btn-sm bg-transparent p-0 m-0">
                            <?php echo esc_html__("Remove Page from Audit", _SQ_PLUGIN_NAME_) ?>
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>


</td>
