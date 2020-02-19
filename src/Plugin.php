<?php
/**
 * Main Plugin Class.
 *
 * @package DigitalCanvas\CustomPostTypes
 * @author  Caspar Green
 * @since   1.0.0
 */

namespace DigitalCanvas\CustomPostTypes;

class Plugin
{

    /**
     *  Current Plugin Version.
     *
     * @var string
     */
    private string $version;

    /**
     * Custom post type and taxonomy configuration.
     *
     * @var array
     */
    private array $config;

    /**
     * Plugin constructor.
     *
     * @param array $config Custom post type and taxonomy configuration.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->setVersion();
    }

    /**
     * Set the current plugin version.
     *
     * @return void
     * @since  1.0.0
     */
    private function setVersion(): void
    {
        $rootFile = (dirname(dirname(__FILE__)) . '/plugin-root.php');
        $fileData = get_file_data($rootFile, ['version' => 'Version']);

        $this->version = $fileData['version'];
    }

    /**
     * Initialize.
     *
     * @return void
     * @since  1.0.0
     */
    public function init(): void
    {
        add_action('init', [$this, 'registerCustomPostTypes']);
        add_action('init', [$this, 'registerCustomTaxonomies']);

        if (is_admin()) {
            add_action('admin_init', [$this, 'UpdateRewrites']);
        }
    }

    /**
     * Register the project post type.
     *
     * @return void
     * @since  1.0.0
     */
    public function registerCustomPostTypes(): void
    {
        $postTypeConfigs = $this->config['post-types'];

        foreach ($postTypeConfigs as $postTypeConfig) {
            $postType = new PostType($postTypeConfig);
            $postType->register();
        }
    }

    /**
     * Register custom taxonomies.
     *
     * @return void
     * @since  1.0.0
     */
    public function registerCustomTaxonomies(): void
    {
        $taxonomyConfigs = $this->config['taxonomies'];

        foreach ($taxonomyConfigs as $taxonomyConfig) {
            $taxonomy = new Taxonomy($taxonomyConfig);
            $taxonomy->register();
        }
    }

    /**
     * Update rewrites.
     *
     * @return void
     * @since 1.0.0
     */
    public function updateRewrites(): void
    {
        $currentHash = $this->config['hash'];

        if (get_option('dc_custom_post_types_config_hash') === $currentHash) {
            return;
        }

        flush_rewrite_rules();
        update_option('dc_custom_post_types_config_hash', $currentHash);
    }
}
