# Custom Post Types and Taxonomies for WordPress

Nearly every WordPress build we do involves registering one or more custom post types
and taxonomies.

This plugin allows us to just install and set the custom post type and taxonomy essentials
in a single config file. Updating the hash entry in the config file signals the plugin to
update the rewrites when any of those essentials changes during development (or down the
road when clients ask for further work).

## Requirements:

* WordPress 4.9 or later.
* PHP 7.4 or later.

## Install:

* Add plugin files to the `wp_content/plugins` directory.
* Modify the `config/config.php` to suit your situation. (Sample post type and taxonomies are included.)
* Run `composer install` -- there are currently no dependencies, but this builds the auto-loader.
* Go to the plugins page on the WordPress dashboard and click *Activate*.
