<?php

namespace Ababilitworld\FlexPaginationByAbabilitworld\Package\Service;

(defined( 'ABSPATH' ) && defined( 'WPINC' )) || die();

use Ababilitworld\FlexTraitByAbabilitworld\Trait\StaticTrait\StaticTrait;
use function Ababilitworld\{
    FlexPluginInfoByAbabilitworld\Package\Service\service as plugin_info,
    FlexPaginationByAbabilitworld\Package\package as flex_pagination
};

if ( ! class_exists( '\Ababilitworld\FlexPaginationByAbabilitworld\Package\Service\Service' ) ) 
{
    class Service 
    {
        use StaticTrait;

        private $pagination;

        /**
         * Constructor
         */
        public function __construct() 
		{
            $this->pagination = flex_pagination();
            $this->pagination || die();
            add_action('admin_enqueue_scripts', array($this, 'enqueue'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        }

        public function enqueue() 
        {
            wp_enqueue_style(
                $this->pagination::$package_pre_hyph . '-style', 
                $this->pagination::$package_asset_url . 'css/style.css',
                array(), 
                time()
            );

            wp_enqueue_script(
                $this->pagination::$package_pre_hyph . '-script', 
                $this->pagination::$package_asset_url . 'js/script.js',
                array(), 
                time(), 
                true
            );
            
            wp_localize_script(
                $this->pagination::$package_pre_hyph . '-script', 
                $this->pagination::$package_pre_unds . '_localize', 
                array(
                    'adminAjaxUrl' => admin_url('admin-ajax.php'),
                    'ajaxUrl' => admin_url('admin-ajax.php'),
                    'ajaxNonce' => wp_create_nonce($this->pagination::$package_pre_unds . '_nonce'),
                    'ajaxAction' => $this->pagination::$package_pre_unds . '_action',
                    'ajaxData' => $this->pagination::$package_pre_unds . '_data',
                    'ajaxError' => $this->pagination::$package_pre_unds . '_error',
                )
            );
        }

        public function paginate($query = null,$attribute) 
        {
            if (null === $query) 
            {
                global $wp_query;
                $query = $wp_query;
            }
    
            $big = 999999999;
            
            if (is_admin()) 
            {
                $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
                global $pagenow;
                $base = add_query_arg(array(
                    'paged' => '%#%',
                    'post_type' => $attribute['post_type'],
                    'page' => $attribute['page']
                ), admin_url($pagenow));
            }
            else 
            {
                $paged = max(1, get_query_var('paged'));
                $base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));
            }

            $pagination_links = paginate_links(array(
                'base'            => $base,
                'format'          => '&paged=%#%',
                'current'         => $paged,
                'total'           => $query->max_num_pages,
                'prev_text'       => __('« Prev'),
                'next_text'       => __('Next »'),
                'type'            => 'array',
            ));

            if ($pagination_links) 
            {
                echo '<div class="pagination">' . join("\n", $pagination_links) . '</div>';
            }
        
        }

    }

    //new Service();
	
    /**
     * Return the instance
     *
     * @return \Ababilitworld\FlexPaginationByAbabilitworld\Package\Service\Service
     */
    function service() 
    {
        return Service::instance();
    }

    // take off
    //service();
		
}

?>
