<?php

namespace Ababilitworld\FlexPaginationByAbabilitworld\Package\Abstract;

(defined('ABSPATH') && defined('WPINC')) || die();

use Ababilitworld\FlexTraitByAbabilitworld\Trait\StaticTrait\StaticTrait;
use Ababilitworld\FlexTraitByAbabilitworld\Trait\Security\Sanitization\Sanitization;
use Ababilitworld\FlexPaginationByAbabilitworld\Package\Interface\Pagination as PaginationInterface;
use Ababilitworld\FlexPaginationByAbabilitworld\Package\Presentation\Template\Template;

if (!class_exists('\Ababilitworld\FlexPaginationByAbabilitworld\Package\Abstract')) 
{
    abstract class Pagination implements PaginationInterface
    {
        use StaticTrait, Sanitization;

        protected $query;
        protected $totalPages;
        protected $currentPage;

        abstract public function paginate($query);

        abstract public function render($query, $attribute);

        public function paginate_default($query) 
        {
            $this->query = $query;
            $this->currentPage = max(1, $this->query->get_query_var('paged'));
            $this->totalPages = $query->max_num_pages;
            
            $query->query_vars['paged'] = $this->currentPage;
        }

        public function render_default($query, $attribute)
        {
            $big = 999999999;
            
            if (is_admin()) 
            {
                $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
                global $pagenow;
                $base = add_query_arg(array(
                    'paged' => '%#%',
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
                'format'          => '?paged=%#%',
                'current'         => $paged,
                'total'           => $query->max_num_pages,
                'prev_text'       => __('« Previous'),
                'next_text'       => __('Next »'),
                'type'            => 'array',
            ));

            if ($pagination_links) 
            {
                echo '<div class="pagination">' . join("\n", $pagination_links) . '</div>';
            }
        }

        public function ajax_render_default($query, $attribute)
        {
            $big = 999999999;
            $paged = max(1, get_query_var('paged'));
            $base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));

            if (is_admin()) 
            {
                $base = add_query_arg(array(
                    'paged' => '%#%',
                    'page' => $attribute['page']
                ), admin_url('admin.php'));
            }

            $pagination_links = paginate_links(array(
                'base' => $base,
                'format' => '?paged=%#%',
                'current' => $paged,
                'total' => $query->max_num_pages,
                'prev_text' => __('« Previous'),
                'next_text' => __('Next »'),
                'type' => 'array',
            ));

            if ($pagination_links) 
            {
                echo '<div class="pagination" data-current-page="' . $paged . '">' . join("\n", $pagination_links) . '</div>';
            }
        }

    }

}

?>
