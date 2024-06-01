<?php
namespace Ababilitworld\FlexPaginationByAbabilitworld\Package\Presentation\Template;

(defined('ABSPATH') && defined('WPINC')) || die();

use Ababilitworld\FlexTraitByAbabilitworld\Trait\StaticTrait\StaticTrait;
use function Ababilitworld\{
    FlexPluginInfoByAbabilitworld\Package\Service\service as plugin_info,
    FlexPaginationByAbabilitworld\Package\package as package,
};

if (!class_exists('\Ababilitworld\FlexPaginationByAbabilitworld\Package\Presentation\Template\Template')) 
{
    class Template 
    {
        use StaticTrait;

        public static function render_pagination(array $paginationData) 
        {
            ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php            
                        for ($i = 1; $i <= $paginationData['totalPages']; $i++) 
                        {
                    ?>
                    <li class="page-item <?php echo ($i == $paginationData['currentPage'] ? 'active' : '') ?> " >
                    <a class="page-link" href="?page=<?php echo esc_attr($i) ?>"><?php echo esc_html($i); ?></a>
                    </li>
                    <?php
                        }
                    ?>
                
                </ul>
            </nav>
            <?php
        }

        public static function default_pagination_template(array $data) 
        {
            if ($data['pagination_links'])
            {
            ?>
            
                <div class="pagination" data-current-page="<?php echo esc_attr($data['paged']); ?>"><?php join("\n", $data['pagination_links']); ?></div>
                
            <?php
            }
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