<?php

//Setting options page
/*******************************
 * Callback function to add the menu
 *******************************/
function px_show_settngs_page_callback_func()
{
	add_submenu_page(
		'edit.php?post_type=qcpx_portfolio',
		'Settings',
		'Settings',
		'manage_options',
		'qcpx-options-page',
		'qcpx_settings_page_callback_func'
	);
	add_action( 'admin_init', 'px_register_plugin_settings' );
} //show_settings_page_callback_func
add_action( 'admin_menu', 'px_show_settngs_page_callback_func');

function px_register_plugin_settings() {
	//register our settings
	//general Section
	register_setting( 'qc-px-plugin-settings-group', 'qcpx_details_page_width' );
	register_setting( 'qc-px-plugin-settings-group', 'qcpx_details_page_width_val' );
	register_setting( 'qc-px-plugin-settings-group', 'qcld_template_links' );
	register_setting( 'qc-px-plugin-settings-group', 'qcpx_list_page_width' );
	
	register_setting( 'qc-px-plugin-settings-group', 'qcpx_list_page_width_val' );
	register_setting( 'qc-px-plugin-settings-group', 'qcld_post_per_page' );
	register_setting( 'qc-px-plugin-settings-group', 'qcld_link_title' );
	register_setting( 'qc-px-plugin-settings-group', 'qcpo_tpl1_serial_number' );
	//Language Settings
	register_setting( 'qc-px-plugin-settings-group', 'qcpo_tpl1_color_scheme' );
	register_setting( 'qc-px-plugin-settings-group', 'qcpo_tpl1_qcld_img_border_radius' );
	register_setting( 'qc-px-plugin-settings-group', 'qcpo_tpl2_item_border_radius' );
	register_setting( 'qc-px-plugin-settings-group', 'qcpo_tpl2_item_margin_tp' );
	register_setting( 'qc-px-plugin-settings-group', 'qcpo_tpl2_item_margin_rt' );
	register_setting( 'qc-px-plugin-settings-group', 'qcpo_tpl2_item_margin_bt' );
	register_setting( 'qc-px-plugin-settings-group', 'qcpo_tpl2_item_margin_lt' );
	//custom css section
	register_setting( 'qc-px-plugin-settings-group', 'qcld_port_custom_css' );
	//custom js section

	//help sectio
	
}

function qcpx_settings_page_callback_func(){
	
	?>
	<div class="wrap swpm-admin-menu-wrap">
		<h1>Portfolio-x Settings Page</h1>
		<h2 style="color: #ff0000; font-size: 18px;">*** If the portfolio details pages are giving 404 errors, please go to WordPress <a target="_blank" href="<?php echo admin_url('options-permalink.php'); ?>"><em>Settings->Permalinks</em></a> and save again without changing anything ***</h2>

		<h2 class="nav-tab-wrapper sld_nav_container">
			<a class="nav-tab px_click_handle nav-tab-active" href="#general_settings">General Settings</a>
			<a class="nav-tab px_click_handle" href="#template_01">Template 01</a>
			<a class="nav-tab px_click_handle" href="#template_02">Template 02</a>
			<a class="nav-tab px_click_handle" href="#custom_css">Custom Css</a>
			<a class="nav-tab px_click_handle" href="#help">Help</a>
		</h2>
		
		<form method="post" action="options.php">
			<?php settings_fields( 'qc-px-plugin-settings-group' ); ?>
			<?php do_settings_sections( 'qc-px-plugin-settings-group' ); ?>
			<div id="general_settings">
				<table class="form-table">
					<tr valign="top">
						<th scope="row">Single Page Width for Details Page</th>
						<td>
							<select name="qcpx_details_page_width">
								<option value="single_full" <?php echo (esc_attr( get_option('qcpx_details_page_width') )=='single_full'?'selected="selected"':''); ?>>Full Width for Details Page</option>
								<option value="single_box" <?php echo (esc_attr( get_option('qcpx_details_page_width') )=='single_box'?'selected="selected"':''); ?>>Boxed Width for Details Page</option>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Box Width Value for Details Page</th>
						<td>
							<input type="text" name="qcpx_details_page_width_val" size="100" value="<?php echo esc_attr( get_option('qcpx_details_page_width_val') ); ?>"  />
							<i>Enter value for single page width for details page , Example: 1170, 850,1050 etc.</i>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Show All Portfolio Links at Top</th>
						<td>
							<input type="checkbox" name="qcld_template_links" value="on" <?php echo (esc_attr( get_option('qcld_template_links') )=='on'?'checked="checked"':''); ?> />
							<i>Enable/Disable portfolio links at the top of the listing page</i>
						</td>
					</tr>
					
					<tr valign="top">
						<th scope="row">Filtered Listing Page Width</th>
						<td>
							<select name="qcpx_list_page_width">
								<option value="list_full" <?php echo (esc_attr( get_option('qcpx_list_page_width') )=='list_full'?'selected="selected"':''); ?>>Full Width for Filtered Listing Page</option>
								<option value="list_box" <?php echo (esc_attr( get_option('qcpx_list_page_width') )=='list_box'?'selected="selected"':''); ?>>Boxed Width for Filtered Listing Page</option>
							</select>
							<i>Filtered Listing Page Width option for portfolio details.</i>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">Box Width Value for Filtered Listing Page</th>
						<td>
							<input type="text" name="qcpx_list_page_width_val" size="100" value="<?php echo esc_attr( get_option('qcpx_list_page_width_val') ); ?>"  />
							<i>Enter value for Filtered Listing Page, Example: 1170, 850,1050 etc.</i>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Items Per Page</th>
						<td>
							<input type="text" name="qcld_post_per_page" size="100" value="<?php echo esc_attr( get_option('qcld_post_per_page') ); ?>"  />
							<i>Enter number of items to display on per page listing. Only even numbers are preferred, Example: 2, 4, 6 etc.</i>
						</td>
					</tr>
					 
					<tr valign="top">
						<th scope="row">Link Listing Title</th>
						<td>
							<input type="checkbox" name="qcld_link_title" value="on" <?php echo (esc_attr( get_option('qcld_link_title') )=='on'?'checked="checked"':''); ?> />
							<i>Link title to open portfolio details.</i>
						</td>
					</tr>

					
				</table>
			</div>
			<div id="template_01" style="display:none">
				<table class="form-table">

					<tr valign="top">
						<th scope="row">Show/Hide Item Serial Number</th>
						<td>
							<input type="checkbox" name="qcpo_tpl1_serial_number" value="on" <?php echo (esc_attr( get_option('qcpo_tpl1_serial_number') )=='on'?'checked="checked"':''); ?> />
							<i>Display item serial number on listing page.</i>
						</td>
					</tr>
				
					<tr valign="top">
						<th scope="row">Select A Color Scheme</th>
						<td>
							<select name="qcpo_tpl1_color_scheme">
								<option value="1" <?php echo (esc_attr( get_option('qcpo_tpl1_color_scheme') )=='1'?'selected="selected"':''); ?>>Light</option>
								<option value="2" <?php echo (esc_attr( get_option('qcpo_tpl1_color_scheme') )=='2'?'selected="selected"':''); ?>>Dark</option>
							</select>
							
						</td>
					</tr>
				
					<tr valign="top">
						<th scope="row">Image Border Radius</th>
						<td>
							<input type="text" name="qcpo_tpl1_qcld_img_border_radius" size="100" value="<?php echo esc_attr( get_option('qcpo_tpl1_qcld_img_border_radius') ); ?>"  />
							
						</td>
					</tr>
					

				</table>
			</div>
			<div id="template_02" style="display:none">
				<table class="form-table">

					
				
					<tr valign="top">
						<th scope="row">Image Border Radius</th>
						<td>
							<input type="text" name="qcpo_tpl2_item_border_radius" size="100" value="<?php echo esc_attr( get_option('qcpo_tpl2_item_border_radius') ); ?>"  />
							
						</td>
					</tr>
					
					<tr valign="top">
						<th scope="row">Item Margin: Top</th>
						<td>
							<input type="text" name="qcpo_tpl2_item_margin_tp" size="100" value="<?php echo esc_attr( get_option('qcpo_tpl2_item_margin_tp') ); ?>"  />
							
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">Item Margin: Right</th>
						<td>
							<input type="text" name="qcpo_tpl2_item_margin_rt" size="100" value="<?php echo esc_attr( get_option('qcpo_tpl2_item_margin_rt') ); ?>"  />
							
						</td>
					</tr>
					
					<tr valign="top">
						<th scope="row">Item Margin: Bottom</th>
						<td>
							<input type="text" name="qcpo_tpl2_item_margin_bt" size="100" value="<?php echo esc_attr( get_option('qcpo_tpl2_item_margin_bt') ); ?>"  />
							
						</td>
					</tr>
					
					<tr valign="top">
						<th scope="row">Item Margin: Left</th>
						<td>
							<input type="text" name="qcpo_tpl2_item_margin_lt" size="100" value="<?php echo esc_attr( get_option('qcpo_tpl2_item_margin_lt') ); ?>"  />
							
						</td>
					</tr>
					

				</table>
			</div>
			
			<div id="custom_css" style="display:none">
				<table class="form-table">

					<tr valign="top">
						<th scope="row">Custom Css</th>
						<td>
							
							<textarea name="qcld_port_custom_css" rows="10" cols="100"><?php echo esc_attr( get_option('qcld_port_custom_css') ); ?></textarea>
							<i>Write your custom CSS here. Please do not use <b>style</b> tag in this textarea.</i>
						</td>
					</tr>

				</table>
			</div>
			
			<div id="help" style="display:none">
				<table class="form-table">

					<tr valign="top">
						<th scope="row">Help</th>
						<td>
							
							<div>
								<p>
									<strong><u>Example of Shortcode to Display any Portfolio:</u></strong>
									<br>
									[portfolio-x portfolio="99"] 
									<br>
									<br>
									Here, 99 is portfolio ID, which should be replaced in your case. You can also copy shortcode from portfolio list (Portfolio-X) page.
									<br>
									<br>

									<strong><u>Example of Shortcode to Display Portfoli Showcase:</u></strong>
									<br>
									[portfolio-x-showcase template="style-01" limit="5" orderby="title" order="ASC"]
									<br>
									<br>
									<strong><u>Available Parameters For Showcase Shortcode:</u></strong>
									<br>
								</p>
								<p>
									<strong>1. orderby</strong>
									<br>
									Compatible order by values: "ID", "author", "title", "name", "type", "date", "modified", "rand" and "menu_order".
									
								</p>
							    <p>
									<strong>2. order</strong>
									<br>
									Value for this option can be set as "ASC" for Ascending or "DESC" for Descending order.
								</p>
								<p>
									<strong>3. template</strong>
									<br>
									Supported values: "style-01", "style-02"
								</p>
								<p>
									<strong>4. limit</strong>
									<br>
									Specify the number of items you want to show. Default value is 5.
								</p>

					          </div>
					          <div>
								<p>
									<strong><u>Available Widgets:</u></strong>
									<br>
									<br>
									Two widget variations are avilable in this version:
									<br>
									<br>
									You can check "Appearence --> Widgets" menu. Then "Portfolio-X : Latest Items". Tune config options then save the widget. 
								</p>
					          </div>
						</td>
					</tr>

				</table>
			</div>
			
			<?php submit_button(); ?>

		</form>
		
	</div>
	
	<script type="text/javascript">
		

		
		jQuery(document).ready(function($){
			$('.px_click_handle').on('click', function(e){
				e.preventDefault();
				var obj = $(this);
				container_id = obj.attr('href');
				$('.px_click_handle').each(function(){
					$(this).removeClass('nav-tab-active');
					$($(this).attr('href')).hide();
				})
				obj.addClass('nav-tab-active');
				$(container_id).show();
			})
			var hash = window.location.hash;
			if(hash!=''){
				$('.px_click_handle').each(function(){
					
					$($(this).attr('href')).hide();
					if($(this).attr('href')==hash){
						$(this).removeClass('nav-tab-active').addClass('nav-tab-active');
					}else{
						$(this).removeClass('nav-tab-active');
					}
				})
				$(hash).show();
			}
			
		})
		
	</script>
	
	<?php
	
}