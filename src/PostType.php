<?php
/**
 * PostType class.
 *
 * @package DigitalCanvas\CustomPostTypes
 * @author  Caspar Green
 * @since   1.0.0
 */

namespace DigitalCanvas\CustomPostTypes;

class PostType {

	/**
	 * Post type configuration.
	 *
	 * @var array
	 */
	private array $config;

	/**
	 * PostType constructor.
	 *
	 * @param array $config Post type configuration.
	 */
	public function __construct( array $config ) {
		$this->config = $config;
	}

	/**
	 * Register the post type.
	 *
	 * @return void
	 * @since  1.0.0
	 */
	public function register(): void {
		register_post_type( $this->config['slug'], $this->buildPostTypeArgs() );
	}

	/**
	 * Build the post type arguments array.
	 *
	 * @return array
	 * @since  1.0.0
	 */
	private function buildPostTypeArgs(): array {
		$args = $this->config;

		$args['labels']   = $this->buildLabelsArray();
		$args['supports'] = $this->buildSupportsArray();
		$args['rewrite']  = $this->buildRewriteArray();

		return $args;
	}

	/**
	 * Build a labels array.
	 *
	 * @return array
	 * @since  1.0.0
	 */
	private function buildLabelsArray() {
		$niceName = $this->config['name'];
		$singular = $this->config['singular'];
		$plural   = $this->config['plural'];

		return [
			'name'                  => $niceName,
			'singular_name'         => $singular,
			'add_new'               => sprintf( ' % s % s', __( 'Add New', 'dc-post-tax' ), $singular ),
			'add_new_item'          => sprintf( ' % s % s', __( 'Add New', 'dc-post-tax' ), $singular ),
			'edit_item'             => sprintf( ' % s % s', __( 'Edit', 'dc-post-tax' ), $singular ),
			'new_item'              => sprintf( ' % s % s', __( 'New', 'dc-post-tax' ), $singular ),
			'view_item'             => sprintf( ' % s % s', __( 'View', 'dc-post-tax' ), $singular ),
			'search_items'          => sprintf( ' % s % s', __( 'Search', 'dc-post-tax' ), $plural ),
			'all_items'             => sprintf( ' % s % s', __( 'All', 'dc-post-tax' ), $plural ),
			'archives'              => sprintf( ' % s % s', $singular, __( 'Archives', 'dc-post-tax' ) ),
			'insert_into_item'      => sprintf( ' % s % s', __( 'Insert into', 'dc-post-tax' ), $singular ),
			'uploaded_to_this_item' => sprintf( ' % s % s', __( 'Upload to this', 'dc-post-tax' ),
				$singular ),
			'filter_items_list'     => $plural,
			'items_list_navigation' => $plural,
			'items_list'            => $plural,
			'not_found'             => sprintf( ' %s %s %s',
				__( 'No', 'dc-post-tax' ),
				$plural,
				__( 'found', 'dc-post-tax' )
			),
		];
	}

	/**
	 * Build a post supports array.
	 *
	 * @return array
	 * @since  1.0.0
	 */
	private function buildSupportsArray(): array {
		if ( ! isset( $this->config['supports'] ) ) {
			return array_keys( get_all_post_type_supports( 'post' ) );
		}

		return $this->config['supports'];
	}

	/**
	 * Build a post rewrite array.
	 *
	 * @return array
	 * @since  1.0.0
	 */
	private function buildRewriteArray(): array {
		if ( ! isset( $this->config['rewrite'] ) ) {
			return [ 'slug' => $this->config['slug'] ];
		}

		return $this->config['rewrite'];
	}
}
