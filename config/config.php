<?php
/**
 * Custom post types and taxonomies configuration.
 *
 * Plugin will update rewrites whenever the hash is changed. (It can be any string you like.)
 *
 * @author  Caspar Green
 * @since   1.0.0
 */

return [
    'hash' => '1.0.0',

    'post-types' => [
        'project' => [
            'slug' => 'books',
            'name' => _x('Books', 'dc-post-tax'),
            'singular' => _x('Book', 'dc-post-tax'),
            'plural' => _x('Books', 'dc-post-tax'),
            'public' => true,
            'description' => _x('Books', 'dc-post-tax'),
            'menu_position' => 33,
            'menu_icon' => 'dashicons-book',
            'show_in_nav_menus' => true,
            'has_archive' => true,
            'hierarchical' => true
        ]
    ],

    'taxonomies' => [
        'book-taxonomy' => [
            'slug' => 'book-category',
            'object-types' => ['books', 'attachment'],
            'singular' => _x('Book Category', 'dc-post-tax'),
            'plural' => _x('Book Categories', 'dc-post-tax'),
            'hierarchical' => true
        ],

        'image-tag-taxonomy' => [
            'slug' => 'image-tag',
            'object-types' => ['attachment'],
            'singular' => _x('Image Tag', 'dc-post-tax'),
            'plural' => _x('Image Tags', 'dc-post-tax'),
            'hierarchical' => true
        ]
    ]
];
