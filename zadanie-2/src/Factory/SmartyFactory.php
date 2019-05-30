<?php

namespace App\Factory;

use Smarty;

class SmartyFactory
{
    /**
     * @return Smarty
     */
    public static function create(): Smarty
    {
        $smarty = new Smarty();

        $smarty->setCompileDir('../cache/smarty/templates_c/');
        $smarty->setConfigDir('../cache/smarty/configs/');
        $smarty->setTemplateDir('../templates');
        $smarty->setCacheDir('../cache/smarty/cache/');

        $smarty->caching = false;
        $smarty->compile_check = true;
        $smarty->force_compile = true;

        return $smarty;
    }
}
