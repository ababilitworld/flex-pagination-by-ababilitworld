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

        /**
         * Static Vendor Name
         *
         * @var string
         */
        public static $vendor_name;

        /**
         * Static Vendor Package Name
         *
         * @var string
         */
        public static $package_name;

        /**
         * Static Vendor Package Version
         *
         * @var string
         */
        public static $package_version;

        /**
         * Static Vendor Package Prefix with Underscore
         *
         * @var string
         */
        public static $package_pre_unds;

        /**
         * Static Vendor Package Prefix with Hyphen
         *
         * @var string
         */
        public static $package_pre_hyph;

        /**
         * Static Package URL
         *
         * @var string
         */
        public static $package_url;

        /**
         * Static Package DIR
         *
         * @var string
         */
        public static $package_dir;

        /**
         * Static Package File
         *
         * @var string
         */
        public static $package_file;

        private $package_parent_plugin_info;

        public function __construct() 
        {
            self::set_static('vendor_name', 'ababilitworld');
            self::set_static('package_name', 'flex-pagination-by-ababilitworld');
            self::set_static('package_version', '1.0.0');
            self::set_static('package_pre_unds', 'flex_pagination_by_ababilitworld');
            self::set_static('package_pre_hyph', 'flex-pagination-by-ababilitworld');
            self::set_static('package_dir', __DIR__);
            self::set_static('package_file', __FILE__);
            
            $this->package_parent_plugin_info = plugin_info();
            
            if ($this->package_parent_plugin_info && isset($this->package_parent_plugin_info->parent_plugin_url)) 
            {
                self::set_static('package_url', $this->package_parent_plugin_info->parent_plugin_url . '/vendor/' . self::$vendor_name. '/' . self::$package_name . '/src/Package');
            }
            else 
            {
                self::set_static('package_url', '');
            }
        }
    }

    //new Package();
	
    /**
     * Return the instance
     *
     * @return \Ababilitworld\FlexPaginationByAbabilitworld\Package\Package
     */
    function package() 
    {
        return Package::instance();
    }

    // take off
    //package();
}

?>
