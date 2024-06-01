<?php

namespace Ababilitworld\FlexPaginationByAbabilitworld\Package\Service;

(defined( 'ABSPATH' ) && defined( 'WPINC' )) || die();

use Ababilitworld\FlexPaginationByAbabilitworld\Package\Abstract\Pagination;
use function Ababilitworld\{
    FlexPaginationByAbabilitworld\Package\Presentation\Template\template as pagination_template,
};

if (!class_exists('\Ababilitworld\FlexPaginationByAbabilitworld\Package\Service\Service')) 
{
    class Service extends Pagination
    {
        /**
         * Constructor.
         */
        public function __construct()
        {
            // Constructor can initialize other settings if needed
        }

        /**
         * Initialize the service with query and attributes.
         *
         * @param array $data Initialization data including 'query' and 'attribute'.
         */
        public function init($data)
        {
            $this->query = $data['query'];
            $this->attribute = $data['attribute'];
        }

        /**
         * Paginate the query results.
         */
        public function paginate()
        {
            $this->currentPage = max(1, intval($this->query->get('paged', 1)));
            $this->totalPages = intval($this->query->max_num_pages);
            $this->query->set('paged', $this->currentPage);
            $this->paginationLinks = $this->pagination_links();
        }

        /**
         * Generate pagination links.
         *
         * @return array Pagination links.
         */
        public function pagination_links()
        {
            $big = 999999999;
            $base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));

            if (is_admin()) {
                $base = add_query_arg(
                    array(
                        'paged' => '%#%',
                    ),
                    admin_url('admin.php')
                );
            }

            return paginate_links(
                array(
                    'base' => $base,
                    'format' => '?paged=%#%',
                    'current' => $this->currentPage,
                    'total' => $this->totalPages,
                    'prev_text' => __('« Previous'),
                    'next_text' => __('Next »'),
                    'type' => 'array',
                )
            );
        }

        /**
         * Render the pagination.
         */
        public function render()
        {
            $paginationTemplate = pagination_template();
            $paginationTemplate->default_pagination_template(
                array(
                    'paged' => $this->currentPage,
                    'pagination_links' => $this->paginationLinks,
                )
            );
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
