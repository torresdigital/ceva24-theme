<?php defined('ABSPATH') || die('Cheatin\' uh?'); ?>
<?php $features = $view->getFeatures(); ?>
<a name="features"></a>
<div class="sq_features border my-2 py-2">
    <div class="row text-left m-0 p-5" style="max-width: 1200px;">
        <div class="px-2 text-center" style="width: 38%;">
            <img src="<?php echo _SQ_ASSETS_URL_ . 'img/squirrly_features.png' ?>" style="width: 250px">
        </div>
        <div class="col px-2 py-3">
            <div class="col-12 m-0 p-0 pl-4">
                <h3><?php echo esc_html__("Squirrly SEO Feature Categories", _SQ_PLUGIN_NAME_) ?></h3>
                <div class="small text-black-50"><?php echo esc_html__("Manage the features & access them directly from here.", _SQ_PLUGIN_NAME_); ?></div>
            </div>
            <div class="sq_separator"></div>
            <div class="col-12 m-2 p-0">
                <div class="row py-2 px-3">
                    <form method="get" class="form-inline col-12">
                        <input type="hidden" name="page" value="<?php echo SQ_Classes_Helpers_Tools::getValue('page', 'sq_features') ?>">
                        <input type="search" class="d-inline-block align-middle col p-2 mr-2" autofocus name="sfeature" value="<?php echo SQ_Classes_Helpers_Sanitize::escapeKeyword(SQ_Classes_Helpers_Tools::getValue('sfeature')) ?>"/>
                        <?php if (SQ_Classes_Helpers_Tools::getIsset('sfeature')) { ?>
                            <a href="<?php echo SQ_Classes_Helpers_Tools::getAdminUrl(SQ_Classes_Helpers_Tools::getValue('page', 'sq_features')) ?>" style="position: relative;right: 20px;margin-left: -10px;">X</a>
                        <?php } ?>
                        <input type="submit" class="btn btn-lg btn-light ml-2 border" value="<?php echo esc_html__("Search Feature", _SQ_PLUGIN_NAME_) ?>"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 px-1 mx-1" style="max-width: 1200px;">
        <?php foreach ($features as $index => $feature) {

            if (SQ_Classes_Helpers_Tools::getIsset('sfeature')) {
                $sfeature = SQ_Classes_Helpers_Tools::getValue('sfeature');
                if (stripos($feature['title'], $sfeature) === false && stripos($feature['description'], $sfeature) === false) {
                    continue;
                }
            }
            ?>
            <div class="col-4 px-2 py-0 mb-5">
                <div id="sq_feature_<?php echo $index ?>" class="sq_feature card h-100 p-0 shadow-0 rounded-0 <?php echo($feature['active'] ? 'active' : '') ?>">
                    <div class="card-body m-0 p-0">
                        <div class="row mx-3 my-4 p-0">
                            <div class="col p-0 d-flex align-items-center">
                                <img src="<?php echo _SQ_ASSETS_URL_ . 'img/logos/' . $feature['logo'] ?>" class="img-fluid" style="width: 35px; vertical-align: middle;">
                            </div>
                            <div class="col-10 p-0 d-flex align-items-center ml-2">
                                <h5 class="p-0 m-0">
                                    <a href="<?php echo $feature['link'] ?>" class="text-dark" style="text-decoration: none"><?php echo wp_kses_post($feature['title']) ?></a>
                                </h5>
                            </div>
                        </div>
                        <div class="mx-3 my-4 p-0 text-black" style="min-height: 80px; font-size: 16px;">
                            <div class="pt-3 pb-1 small" style="color: #696868">
                                <?php echo wp_kses_post($feature['description']) ?>
                                <?php if ($feature['link']) { ?>
                                    <div class="col-12 p-0 pt-2">
                                        <?php if ($feature['optional']) { ?>
                                            <a href="<?php echo $feature['link'] ?>" class="small">
                                                <?php echo esc_html__("start feature setup", _SQ_PLUGIN_NAME_) ?> >>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo $feature['link'] ?>" class="small">
                                                <?php echo esc_html__("see feature", _SQ_PLUGIN_NAME_) ?> >>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-0 m-0">
                        <div class="row m-0 p-0">
                            <div class="col-7 px-2 py-1 m-0 align-middle text-left" style="line-height: 30px">
                                <?php if ($feature['optional']) { ?>
                                    <div class="checker col-sm-3 row m-0 p-0 sq_save_ajax">
                                        <div class="col-sm-12 p-0 sq-switch sq-switch-sm text-right">
                                            <input type="checkbox" id="activate_<?php echo $index ?>" <?php echo($feature['active'] ? 'checked="checked"' : '') ?> data-name="<?php echo $feature['option'] ?>" data-action="sq_ajax_seosettings_save" data-javascript="if($value){$this.closest('div.sq_feature').addClass('active');}else{ $this.closest('div.sq_feature').removeClass('active');}" class="switch" value="1"/>
                                            <label for="activate_<?php echo $index ?>" class="m-0"></label>
                                        </div>
                                    </div>
                                <?php } else {
                                    if ($feature['connection'] && !SQ_Classes_Helpers_Tools::getOption('sq_api')) { ?>
                                        <div class="pt-1 m-0 align-middle text-left">
                                            <a href="<?php echo SQ_Classes_Helpers_Tools::getAdminUrl('sq_dashboard') ?>" class="small font-weight-bold text-warning" style="font-size: 14px;"><?php echo esc_html__("connect to cloud", _SQ_PLUGIN_NAME_) ?></a>
                                        </div>
                                    <?php } elseif($feature['active']) { ?>
                                        <div class="pt-1 m-0 align-middle text-left">
                                            <a href="<?php echo $feature['link'] ?>" class="small font-weight-bold text-info" style="font-size: 14px;"><?php echo esc_html__("already active", _SQ_PLUGIN_NAME_) ?></a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="pt-1 m-0 align-middle text-left">
                                            <a href="<?php echo $feature['link'] ?>" class="small font-weight-bold" style="font-size: 14px;"><?php echo esc_html__("activate feature", _SQ_PLUGIN_NAME_) ?></a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="col-5 p-3 m-0 align-middle text-right">
                                
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        <?php } ?>
    </div>

</div>
<div class="col-12 p-2 m-0 align-middle text-center">
    <h4>
        <a href="https://www.squirrly.co/wordpress/plugins/seo/" target="_blank">
            <?php if (SQ_Classes_Helpers_Tools::getIsset('sfeature')) { ?>
                <?php echo esc_html__("Do you want to search in the 400 features list?", _SQ_PLUGIN_NAME_) ?>
            <?php } else { ?>
                <?php echo esc_html__("Do you want to see all 400 features list?", _SQ_PLUGIN_NAME_) ?>
            <?php } ?>
        </a>
    </h4>
</div>