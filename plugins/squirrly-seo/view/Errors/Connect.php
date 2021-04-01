<?php defined('ABSPATH') || die('Cheatin\' uh?'); ?>
<?php
SQ_Classes_ObjController::getClass('SQ_Classes_DisplayController')->loadMedia('bootstrap-reboot');
SQ_Classes_ObjController::getClass('SQ_Classes_DisplayController')->loadMedia('bootstrap');
SQ_Classes_ObjController::getClass('SQ_Classes_DisplayController')->loadMedia('fontawesome');
SQ_Classes_ObjController::getClass('SQ_Classes_DisplayController')->loadMedia('switchery');
SQ_Classes_ObjController::getClass('SQ_Classes_DisplayController')->loadMedia('global');
SQ_Classes_ObjController::getClass('SQ_Classes_DisplayController')->loadMedia('navbar');

$page = apply_filters('sq_page', SQ_Classes_Helpers_Tools::getValue('page', ''));
?>
<div id="sq_wrap">
    <?php SQ_Classes_ObjController::getClass('SQ_Core_BlockToolbar')->init(); ?>
    <?php do_action('sq_notices'); ?>
    <div class="d-flex flex-row my-0 bg-white p-0 m-0">
        <div class="sq_flex flex-grow-1 mx-0 px-2">
            <div class="mx-auto">
                <div class="bg-title col-8 mx-auto card-body my-3 p-2 offset-2 rounded-top" style="min-width: 600px;">
                    <div class="col-12 text-center m-2 p-0 e-connect">
                        <div class="mt-3 mb-4 mx-auto e-connect-link">
                            <div class="p-0 mx-2 float-left" style="width:48px;">
                                <div class="sq_wordpress_icon m-0 p-0" style="width: 48px; height: 48px;">
                                </div>
                            </div>
                            <div class="p-0 mx-2 float-right" style="width:48px;">
                                <div class="sq_squirrly_icon m-0 p-0" style="width: 40px; height: 48px;"></div>
                            </div>
                        </div>
                        <h4 class="card-title"><?php echo esc_html__("Connect Your Site to Squirrly Cloud", _SQ_PLUGIN_NAME_); ?></h4>
                        <div class="small"><?php echo sprintf(esc_html__("Get Access to the Non-Human SEO Consultant, Focus Pages, SEO Audits and all our features %s by creating a free account", _SQ_PLUGIN_NAME_), '<br/>') ?></div>
                    </div>

                    <?php SQ_Classes_ObjController::getClass('SQ_Core_Blocklogin')->init(); ?>
                </div>
            </div>

            <?php if ($page == 'sq_dashboard') { ?>
                <div class="mt-5">
                    <?php SQ_Classes_ObjController::getClass('SQ_Core_BlockFeatures')->init(); ?>
                </div>
            <?php } ?>
        </div>

        <div class="sq_col sq_col_side mr-2">
            <div class="card col-12 p-0 my-2">
                <?php echo SQ_Classes_ObjController::getClass('SQ_Core_BlockKnowledgeBase')->init(); ?>
            </div>
        </div>
    </div>
</div>
