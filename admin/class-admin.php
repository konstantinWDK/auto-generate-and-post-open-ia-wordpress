<?php
/**
 * Admin class
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Miapg_Admin {
    
    /**
     * Instance
     */
    private static $instance = null;
    
    /**
     * Get instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_action('admin_notices', array($this, 'admin_notices'));
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            __('Auto Post Generator', MIAPG_TEXT_DOMAIN),
            __('Auto Post Generator', MIAPG_TEXT_DOMAIN),
            'manage_options',
            'miapg-post-generator',
            array($this, 'admin_page_content'),
            'dashicons-edit-page',
            30
        );
        
        add_submenu_page(
            'miapg-post-generator',
            __('Settings', MIAPG_TEXT_DOMAIN),
            __('Settings', MIAPG_TEXT_DOMAIN),
            'manage_options',
            'miapg-post-generator',
            array($this, 'admin_page_content')
        );
    }
    
    /**
     * Admin page content
     */
    public function admin_page_content() {
        // Load admin pages handler
        Miapg_Admin_Pages::get_instance()->render_main_page();
    }
    
    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts($hook) {
        // Only load on plugin pages
        if (strpos($hook, 'miapg-post-generator') === false) {
            return;
        }
        
        wp_enqueue_style(
            'miapg-post-generator-admin',
            MIAPG_PLUGIN_URL . 'assets/css/admin.css',
            array(),
            MIAPG_VERSION
        );
        
        wp_enqueue_script(
            'miapg-post-generator-admin',
            MIAPG_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery'),
            MIAPG_VERSION,
            true
        );
        
        // Localize script
        wp_localize_script(
            'miapg-post-generator-admin',
            'miapgAdmin',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('miapg_nonce'),
                'strings' => array(
                    'confirm_delete' => __('Are you sure you want to delete this idea?', MIAPG_TEXT_DOMAIN),
                    'generating' => __('Generating...', MIAPG_TEXT_DOMAIN),
                    'error' => __('An error occurred. Please try again.', MIAPG_TEXT_DOMAIN),
                )
            )
        );
    }
    
    /**
     * Admin notices
     */
    public function admin_notices() {
        // Check if API keys are configured
        $openai_key = Miapg_Settings::get_setting('miapg_openai_api_key');
        $deepseek_key = Miapg_Settings::get_setting('miapg_deepseek_api_key');
        $provider = Miapg_Settings::get_setting('miapg_ai_provider', 'openai');
        
        $show_notice = false;
        
        if ($provider === 'openai' && empty($openai_key)) {
            $show_notice = true;
        } elseif ($provider === 'deepseek' && empty($deepseek_key)) {
            $show_notice = true;
        }
        
        if ($show_notice) {
            $settings_url = admin_url('admin.php?page=miapg-post-generator&tab=general');
            ?>
            <div class="notice notice-warning is-dismissible">
                <p>
                    <?php
                    printf(
                        __('Auto Post Generator: Please configure your %s API key in the <a href="%s">settings</a> to start generating content.', MIAPG_TEXT_DOMAIN),
                        ucfirst($provider),
                        $settings_url
                    );
                    ?>
                </p>
            </div>
            <?php
        }
    }
}