<?php
namespace AIOSEO\Plugin\Common\Schema\Graphs;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Organization graph class.
 *
 * @since 4.0.0
 */
class Organization extends Graph {
	/**
	 * Returns the graph data.
	 *
	 * @since 4.0.0
	 *
	 * @return array $data The graph data.
	 */
	public function get() {
		$homeUrl          = trailingslashit( home_url() );
		$organizationName = aioseo()->options->searchAppearance->global->schema->organizationName;
		$data    = [
			'@type' => 'Organization',
			'@id'   => $homeUrl . '#organization',
			'name'  => $organizationName ? $organizationName : aioseo()->helpers->decodeHtmlEntities( get_bloginfo( 'name' ) ),
			'url'   => $homeUrl,
		];

		$logo = $this->logo();
		if ( $logo ) {
			$data['logo']  = $logo;
			$data['image'] = [ '@id' => $homeUrl . '#organizationLogo' ];
		}

		$socialUrls = $this->socialUrls();
		if ( $socialUrls ) {
			$data['sameAs'] = $socialUrls;
		}

		$phone       = aioseo()->options->searchAppearance->global->schema->phone;
		$contactType = aioseo()->options->searchAppearance->global->schema->contactType;
		if ( $phone && $contactType ) {
			if ( 'manual' === $contactType ) {
				$contactType = aioseo()->options->searchAppearance->global->schema->contactTypeManual;
			}
			if ( $contactType ) {
				$data['contactPoint'] = [
					'@type'       => 'ContactPoint',
					'telephone'   => $phone,
					'contactType' => $contactType,
				];
			}
		}
		return $data;
	}

	/**
	 * Returns the logo data.
	 *
	 * @since 4.0.0
	 *
	 * @return array The logo data.
	 */
	public function logo() {
		$logo = aioseo()->options->searchAppearance->global->schema->organizationLogo;
		if ( $logo ) {
			return $this->image( $logo, 'organizationLogo' );
		}

		$imageId = aioseo()->helpers->getSiteLogoId();
		if ( $imageId ) {
			return $this->image( $imageId, 'organizationLogo' );
		}
	}
}