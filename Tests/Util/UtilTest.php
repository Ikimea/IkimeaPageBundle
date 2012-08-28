<?php

/*
* This file is part of the Ikimea Pages package.
*
* (c) Ikimea <http://www.ikimea.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

use Ikimea\PageBundle\Util\Url;

class UtilTest extends \PHPUnit_Framework_TestCase
{
    public function testUrl()
    {
        $url = Url::format('/fr/metiers');
        $this->assertEquals($url, 'metiers');
    }
}