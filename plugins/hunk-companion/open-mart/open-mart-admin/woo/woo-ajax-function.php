<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 

/***************************/
//category product section product ajax filter
/***************************/
add_action('wp_ajax_open_mart_cat_filter_ajax', 'open_mart_cat_filter_ajax');
add_action('wp_ajax_nopriv_open_mart_cat_filter_ajax', 'open_mart_cat_filter_ajax');
function open_mart_cat_filter_ajax(){
$prdct_optn = get_theme_mod('open_mart_category_optn','recent');
   if( taxonomy_exists( 'product_cat' ) ){
     // product filter  
            $args = array(
                      'tax_query' => array(
                          array(
                              'taxonomy' => 'product_cat',
                              'field' => 'slug',
                              'terms' => $_POST['data_cat_slug'],
                          )
                      ),
                      'post_type' => 'product',
                      'orderby'   => 'menu_order',
                  );

   // product filter 
  if($prdct_optn=='random'){  
     $args = array(
                      
                      'tax_query' => array(
                          array(
                              'taxonomy' => 'product_cat',
                              'field' => 'slug',
                              'terms' => $_POST['data_cat_slug'],
                          )
                      ),
                      'post_type' => 'product',
                      'orderby' => 'rand'
    );
}elseif($prdct_optn=='featured'){
    $args = array(
                      
                      'tax_query' => array(
                          array(
                              'taxonomy' => 'product_cat',
                              'field' => 'slug',
                              'terms' => $_POST['data_cat_slug'],
                          )
                      ),
                      'post_type' => 'product',
                      'post__in'  => wc_get_featured_product_ids(),
    );

}else{
    $args = array(
                      
                      'tax_query' => array(
                          array(
                              'taxonomy' => 'product_cat',
                              'field' => 'slug',
                              'terms' => $_POST['data_cat_slug'],
                          )
                      ),
                      'post_type' => 'product',
                      'orderby' => 'menu_order'
    );
}
    echo open_mart_product_filter_loop($args);
    exit;
  }
}