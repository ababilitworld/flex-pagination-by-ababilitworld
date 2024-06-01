<?php

namespace Ababilitworld\FlexPaginationByAbabilitworld\Package\Presentation;

(defined('ABSPATH') && defined('WPINC')) || die();

use Ababilitworld\FlexTraitByAbabilitworld\Trait\StaticTrait\StaticTrait;
use function Ababilitworld\{
    FlexPluginInfoByAbabilitworld\Package\Service\service as plugin_info,
    FlexPaginationByAbabilitworld\Package\package as package,
};

if (!class_exists('\Ababilitworld\FlexPaginationByAbabilitworld\Package\Presentation\Presentation')) 
{
    class Presentation 
    {
        use StaticTrait;

        private $package;

        public function __construct() 
        {
            $this->package = package();
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts' ) );
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts' ) );
        }

        public function enqueue_scripts()
        {
            wp_enqueue_style(
                $this->package::$package_pre_hyph . '-style', 
                $this->package::$package_asset_url . 'css/style.css',
                array(), 
                time()
            );

            wp_enqueue_script(
                $this->package::$package_pre_hyph . '-script', 
                $this->package::$package_asset_url . 'js/script.js',
                array(), 
                time(), 
                true
            );
            
            wp_localize_script(
                $this->package::$package_pre_hyph . '-script', 
                $this->package::$package_pre_unds . '_localize', 
                array(
                    'adminAjaxUrl' => admin_url('admin-ajax.php'),
                    'ajaxUrl' => admin_url('admin-ajax.php'),
                    'ajaxNonce' => wp_create_nonce($this->package::$package_pre_unds . '_nonce'),
                    'ajaxAction' => $this->package::$package_pre_unds . '_action',
                    'ajaxData' => $this->package::$package_pre_unds . '_data',
                    'ajaxError' => $this->package::$package_pre_unds . '_error',
                )
            );
        }
    }

    //new Presentation();
	
    /**
     * Return the instance
     *
     * @return \Ababilitworld\FlexPaginationByAbabilitworld\Package\Presentation\Presentation
     */
    function presentation() 
    {
        return Presentation::instance();
    }

    // take off
    //presentation();
}

?>
