<?php

namespace Ababilitworld\FlexPaginationByAbabilitworld\Package\Abstract;

(defined('ABSPATH') && defined('WPINC')) || die();

use Ababilitworld\{
    FlexTraitByAbabilitworld\Standard\Standard,
    FlexTraitByAbabilitworld\Security\Sanitization\Sanitization,
    FlexPaginationByAbabilitworld\Package\Interface\Pagination as PaginationInterface
};

if (!class_exists(__NAMESPACE__.'\Pagination')) 
{
    abstract class Pagination implements PaginationInterface
    {
        use Standard,Sanitization;

        protected $query;
        protected $attribute;
        protected $totalPages;
        protected $currentPage;
        protected $paginationLinks;
        protected $paginationTemplate;
        
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