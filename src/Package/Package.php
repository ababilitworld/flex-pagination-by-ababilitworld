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
        private $package_parent_plugin_info;

        public function __construct() 
        {
            $this->package_parent_plugin_info = plugin_info();                        
        }
    }
	
    /**
     * Return the instance
     *
     * @return \Ababilitworld\FlexPaginationByAbabilitworld\Package\Package
     */
    function package() 
    {
        return Package::instance();
    }
}

?>
