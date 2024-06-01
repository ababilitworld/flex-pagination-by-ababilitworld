<?php
namespace Ababilitworld\FlexPaginationByAbabilitworld\Package\Interface;

interface Pagination 
{
    public function paginate($query);
    public function render($query, $attribute);
}

?>