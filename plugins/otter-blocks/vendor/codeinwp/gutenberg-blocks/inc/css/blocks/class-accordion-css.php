<?php
/**
 * Css handling logic for icons.
 *
 * @package ThemeIsle\GutenbergBlocks\CSS\Blocks
 */

namespace ThemeIsle\GutenbergBlocks\CSS\Blocks;

use ThemeIsle\GutenbergBlocks\Base_CSS;

use ThemeIsle\GutenbergBlocks\CSS\CSS_Utility;

/**
 * Class Accordion_CSS
 */
class Accordion_CSS extends Base_CSS {

	/**
	 * The namespace under which the blocks are registered.
	 *
	 * @var string
	 */
	public $block_prefix = 'accordion';

	/**
	 * Generate Accordion CSS
	 *
	 * @param mixed $block Block data.
	 * @return string
	 * @since   1.3.0
	 * @access  public
	 */
	public function render_css( $block ) {
		$css = new CSS_Utility( $block );

		$css->add_item(
			array(
				'selector'   => ' .wp-block-themeisle-blocks-accordion-item .wp-block-themeisle-blocks-accordion-item__title',
				'properties' => array(
					array(
						'property' => 'color',
						'value'    => 'titleColor',
					),
					array(
						'property' => 'background',
						'value'    => 'titleBackground',
					),
					array(
						'property' => 'border-color',
						'value'    => 'borderColor',
					),
				),
			)
		);

		$css->add_item(
			array(
				'selector'   => ' .wp-block-themeisle-blocks-accordion-item .wp-block-themeisle-blocks-accordion-item__title > div::after',
				'properties' => array(
					array(
						'property' => 'border-color',
						'value'    => 'titleColor',
					),
				),
			)
		);

		$css->add_item(
			array(
				'selector'   => ' .wp-block-themeisle-blocks-accordion-item .wp-block-themeisle-blocks-accordion-item__content',
				'properties' => array(
					array(
						'property' => 'background',
						'value'    => 'contentBackground',
					),
					array(
						'property' => 'border-color',
						'value'    => 'borderColor',
					),
				),
			)
		);

		$style = $css->generate();

		return $style;
	}
}
