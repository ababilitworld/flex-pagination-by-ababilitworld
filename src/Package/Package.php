<?php

namespace Ababilitworld\FlexPaginationByAbabilitworld\Package;

(defined('ABSPATH') && defined('WPINC')) || die();

use Ababilitworld\FlexTraitByAbabilitworld\Standard\Standard;
use function Ababilitworld\{
    FlexPluginInfoByAbabilitworld\Package\Service\service as plugin_info
};

if (!class_exists(__NAMESPACE__.'\Package')) 
{
    class Package 
    {
        use Standard;

        public function __construct() 
        {
                                    
        }
    }
}
