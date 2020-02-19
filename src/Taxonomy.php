<?php
/**
 * Taxonomy class.
 *
 * @package DigitalCanvas\CustomPostTypes
 * @author  Caspar Green
 * @since   1.0.0
 */

namespace DigitalCanvas\CustomPostTypes;

class Taxonomy {

	/**
	 * Taxonomy configuration.
	 *
	 * @var array
	 */
	private array $config;

	public function __construct( array $config ) {
		$this->config = $config;
	}

	/**
	 * Register the taxonomy.
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function register(): void {
		register_taxonomy( $this->config['slug'], $this->config['object-types'], $this->buildTaxonomyArgs() );
	}

	/**
	 * Build the taxonomy arguments array.
	 *
	 * @return array
	 * @since  1.0.0
	 */
	public function buildTaxonomyArgs(): array {
		$args = $this->config;

		$args['labels']  = $this->buildLabelsArray();
		$args['rewrite'] = $this->buildTaxRewriteArray();

		return $args;
	}

	/**
	 * Build a labels array.
	 *
	 * @return array
	 * @since  1.0.0
	 */
	private function buildLabelsArray(): array {
		$singular = $this->config['singular'];
		$plural   = $this->config['plural'];

		return [
			'name'                       => $plural,
			'singular_name'              => $singular,
			'all_items'                  => sprintf( '%s %s', __( 'All', 'dc-post-tax' ), $plural ),
			'edit_item'                  => sprintf( '%s %s', __( 'Edit', 'dc-post-tax' ), $singular ),
			'view_item'                  => sprintf( '%s %s', __( 'View', 'dc-post-tax' ), $singular ),
			'update_item'                => sprintf( '%s %s', __( 'Update', 'dc-post-tax' ), $singular ),
			'add_new_item'               => sprintf( '%s %s', __( 'Add New', 'dc-post-tax' ), $singular ),
			'new_item_name'              => sprintf( '%s %s', __( 'New Name for', 'dc-post-tax' ),
				$singular ),
			'search_items'               => sprintf( '%s %s', __( 'Search', 'dc-post-tax' ), $plural ),
			'popular_items'              => sprintf( '%s %s', __( 'Popular' ), $plural ),
			'separate_items_with_commas' => sprintf( '%s %s %s', __( 'Separate', 'dc-post-tax' ), $plural,
				__( 'with commas', 'dc-post-tax' ) ),
			'add_or_remove_items'        => sprintf( '%s %s', __( 'Add or remove', 'dc-post-tax' ), $plural ),
			'choose_from_most_used'      => sprintf( '%s %s', __( 'Choose from most used', 'dc-post-tax' ),
				$plural ),
			'not_found'                  => sprintf( '%s %s', $singular,
				_x( 'not found', 'taxonomy term not found', 'dc-post-tax' ) ),
		];
	}

	/**
	 * Build a taxonomy rewrite array.
	 *
	 * @return array
	 * @since  1.0.0
	 */
	private function buildTaxRewriteArray(): array {
		if ( ! isset( $this->config['rewrite'] ) ) {
			return [ 'slug' => $this->config['slug'] ];
		}

		return $this->config['rewrite'];
	}
}
