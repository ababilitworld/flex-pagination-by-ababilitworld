<?php
namespace Ababilitworld\FlexPaginationByAbabilitworld\Package\Interface;

interface Pagination 
{
    public function init($data);
    public function paginate();
    public function pagination_links();
    public function render();
}

?>