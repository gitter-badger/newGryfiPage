<?php
namespace Concrete\Package\BasicTablePackage;

defined('C5_EXECUTE') or die(_("Access Denied."));

// Autoload needs to happen already here as we need the included libraries
// already in the package's extend statement. Too bad if we need different
// versions of the same library in multiple packages, the one that is loaded
// the first will always win. That's a widely acknowledged problem and there
// are some possible ways to solve it:

// Maybe some day built into composer:
// https://github.com/composer/composer/issues/183

// Drupal's way:
// https://www.drupal.org/project/composer_manager
// https://www.acquia.com/blog/using-composer-manager-get-island-now

// Hopefully we'll have some way of handling this in concrete5 as well at some point...

use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Package\Package;
use Concrete\Core\Foundation\ClassLoader;
use Punic\Exception;
use Loader;

class Controller extends Package
{

    protected $pkgHandle = 'basic_table_package';
    protected $appVersionRequired = '5.7.4';
    protected $pkgVersion = '0.0.1';

    public function getPackageName()
    {
        return t("BasicTablePackage");
    }

    public function getPackageDescription()
    {
        return t("Package to provide a basic CRUD from DB to GUI");
    }

    public function install()
    {
        /*
        // We need to register the autoloaders for the DB uninstallation to
        // work properly. This would not otherwise be done in the install
        // function. 
        ClassLoader::getInstance()->registerPackage($this);
        */

        $pkg = parent::install();
        BlockType::installBlockType("basic_table_block_packaged", $pkg);
        $db = Loader::db();
        $q = "COMMIT";
        $db->query($q);


    }

    public function uninstall()
    {
        $block = BlockType::getByHandle("basic_table_block_packaged");
        if(is_object($block)) {
            $blockId = $block->getBlockTypeID();
            $db = Loader::db();
            $db->query("DELETE FROM BlockTypes WHERE btID = ?", array($blockId));
        }
        parent::uninstall(); // TODO: Change the autogenerated stub
    }


}

