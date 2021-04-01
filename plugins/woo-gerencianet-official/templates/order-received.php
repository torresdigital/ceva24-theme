<?php
/**
 * Order Received template.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<div>
    <div class="gn-success-payment">
        <div class="gn-row gn-box-emission">
            <div class="pull-left gn-left-space-2">
                <img src="<?php echo esc_url( plugins_url( 'assets/images/', plugin_dir_path( __FILE__ ) ) ); ?>gerencianet-configurations.png"
                    alt="Gerencianet" title="Gerencianet" />
            </div>
            <div class="pull-left gn-title-emission">
                <?php echo $showText[$generated_payment_type]['title']; ?>
            </div>
            <div class="clear"></div>
        </div>

        <div class="gn-success-payment-inside-box">
            <div class="gn-row">
                <div class="gn-col-1">
                    <div class="gn-icon-emission-success">
                        <span class="gn-icon-check-circle-o"></span>
                    </div>
                </div>

                <div class="gn-col-10 gn-success-payment-billet-comments" style="font-size: 15px!important;">
                    <?php echo $showText[$generated_payment_type]['content']; ?>

                    <?php if ($charge_id != '') { ?>
                    <p>
                        <?php echo $gn_success_payment_charge_number; ?> <b><?php echo $charge_id; ?></b>
                    </p>
                    <?php } ?>
                </div>

            </div>

            <?php if ($qrcode !== "") { ?>
            <div class="gn-qrcode" style="text-align:center;">
                <img src="<?php echo $qrcode; ?>" />

                <div class="gn-row" style="font-size: 15px!important;text-align: center !important;">
                    <div class="gn-col-12">
                        <span style="font-weight: bold !important;">
                            <?php echo $pix_copy_paste ?>
                        </span>
                    </div>
                    <script>
                    var clipboard = new ClipboardJS('#btnCopiar');
                    clipboard.on('success', function(e) {
                        Swal.fire(
                            'Código Pix copiado com sucesso!',
                            '',
                            'success'
                        );
                        e.clearSelection();
                    });
                    </script>
                    <div class="gn-row">
                        <div class="gn-col-12">
                            <textarea name="pixCopiaCola" style="width: 500px;margin-left: auto;margin-right: auto;"
                                id="pixCopiaCola" cols="30" rows="10" disabled><?php echo $pixCopiaCola;  ?></textarea>
                        </div>
                    </div>
                    <div class="gn-col-12">
                        <button id="btnCopiar" data-clipboard-text="<?php echo $pixCopiaCola;  ?>">Copiar Código
                            Pix!</button>
                    </div>



                </div>

            </div>
            <?php } ?>

            <?php if ( $generated_payment_type == "billet" && $billet_url != "" ) { ?>
            <div class="gn-align-center gn-success-payment-button">
                <button class="button" id="showBillet" name="showBillet"
                    onclick="window.open('<?php echo $billet_url; ?>', '_blank');" style="height: auto;">
                    <div class="gn-success-payment-button-icon pull-left"><span class="gn-icon-download"></span>
                    </div>
                    <div class="pull-left"><?php echo $gn_success_payment_open_billet; ?></div>
                    <div class="clear"></div>
                </button>
            </div>
            <?php } ?>
        </div>
    </div>
</div>