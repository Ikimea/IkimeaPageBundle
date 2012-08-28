<?php

/*
* This file is part of the Ikimea Pages package.
*
* (c) Ikimea <http://www.ikimea.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Ikimea\PageBundle\Util;


/**
 *  Formate URL
 */
class Url {

    /**
     * @static
     * @param $pathinfo
     * @return string
     */
    public static function format($pathinfo)
    {
        //delete first slash
        $pathInfo = ltrim($pathinfo, '/' );
        $slug = explode('/', $pathinfo);
        $slug = $slug[count($slug) - 1];

        return  $slug;
    }
}