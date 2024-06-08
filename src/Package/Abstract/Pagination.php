<?php

namespace Ababilitworld\FlexPaginationByAbabilitworld\Package\Abstract;

(defined('ABSPATH') && defined('WPINC')) || die();

use Ababilitworld\FlexTraitByAbabilitworld\Standard\Standard;
use Ababilitworld\FlexTraitByAbabilitworld\Security\Sanitization\Sanitization;
use Ababilitworld\FlexPaginationByAbabilitworld\Package\Interface\Pagination as PaginationInterface;

use function Ababilitworld\{
    FlexPaginationByAbabilitworld\Package\Service\service as pagination_service,
    FlexPaginationByAbabilitworld\Package\Presentation\Template\template as pagination_template,
};

if (!class_exists('\Ababilitworld\FlexPaginationByAbabilitworld\Package\Abstract\Pagination')) 
{
    abstract class Pagination implements PaginationInterface
    {
        use Standard,Sanitization;

        protected $query;
        protected $attribute;
        protected $totalPages;
        protected $currentPage;
        protected $paginationLinks;

        /**
         * Constructor.
         *
         * @param array $data Initialization data including 'query' and 'attribute'.
         */
        public function __construct($data)
        {
            $this->query = $data['query'];
            $this->attribute = $data['attribute'];
        }

        abstract public function init($data);

        abstract public function paginate();

        abstract public function pagination_links();

        abstract public function render();
    }
}

?>
