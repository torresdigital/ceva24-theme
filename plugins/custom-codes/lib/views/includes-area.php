<?php

/**
 *
 * The "Includes" metabox area. (Vue JS)
 *
 * @since   2.0.0
 * @package Custom_Codes
 */
defined( 'ABSPATH' ) || die( 'No script kiddies please!' );
/**
 * Register the "Includes" metabox.
 */
function codes_create_includes_box()
{
    global  $post ;
    // Registered Language.
    $current_language = get_post_meta( $post->ID, '_codes_language', true );
    if ( empty($current_language) ) {
        return;
    }
    $pro_link = ( !codes_fs()->is_premium() ? '<a href="' . esc_url( codes_fs()->get_upgrade_url() ) . '" target="_blank"><b>PRO Feature</b></a>' : '' );
    add_meta_box(
        'codes_includes_box',
        // Unique ID.
        __( 'Includes', 'custom-codes' ) . $pro_link,
        // Box title.
        'codes_includes_box_html',
        // Content callback, must be of type callable.
        'custom-code'
    );
}

add_action( 'add_meta_boxes', 'codes_create_includes_box', 100 );
/**
 * Includes metabox content.
 *
 * @param object $post Returns the global post object.
 */
function codes_includes_box_html( $post )
{
    global  $codes_posts, $codes_langs ;
    // Registered Language.
    $current_language = get_post_meta( $post->ID, '_codes_language', true );
    ?>

	<div id="codes_includes" :class="{ loaded: initialized }" style="opacity: 0;" v-if="(currentLang && currentLang.id == '<?php 
    echo  esc_js( $current_language ) ;
    ?>') || ('<?php 
    echo  esc_js( $current_language ) ;
    ?>' == '' && currentLang)">

		<p>You can simply include a file or URL to this code instead of writing snippets inside of the editor.</p>

		<table class="wp-list-table widefat fixed striped table-view-list">
			<thead>
				<tr>
					<th scope="col" class="column-primary" width="180">
						<span>Type</span>
					</th>
					<th scope="col" class="column-primary">
						<span>Code or URL</span>
					</th>
					<th scope="col" class="column-postss">
						<span>Editor</span>
					</th>
					<th scope="col" class="column-posts">
						<span>Placement</span>
					</th>
					<th scope="col" class="column-posts num">
						<span>Order</span>
					</th>
					<th scope="col" class="column-posts">
						<span class="screen-reader-text">Delete</span>
					</th>
			</thead>

			<tbody>
				<?php 
    ?>
				<tr v-if="! includes.length">
					<td colspan="6">No file or URL has been included yet.</td>
				</tr>
			</tbody>

		</table>

		<p>
			<?php 
    ?>
				<a href="<?php 
    echo  esc_url( codes_fs()->get_upgrade_url() ) ;
    ?>" target="_blank" class="button tooltip-not-contained dark-tooltip" :data-tooltip="!isPremium ? 'Click here to upgrade' : null"> + Include a File or URL</a>
			<?php 
    ?>
			<span class="codes-pro-link" v-if="!isPremium"><a href="<?php 
    echo  esc_url( codes_fs()->get_upgrade_url() ) ;
    ?>" target="_blank"><b>Upgrade Now</b></a></span>
		</p>

	</div>

	<div v-else>
		...
	</div>

	<?php 
}
