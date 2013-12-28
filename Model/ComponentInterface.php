<?php

/*
* This file is part of the Ikimea Pages package.
*
* (c) Ikimea <http://www.ikimea.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Ikimea\PageBundle\Model;

/**
 * @author Mbechezi Mlanawo <mlanawo.mbechezi@ikimea.com>
 */

interface ComponentInterface
{
    /**
     * @return integer
     */
    public function getId();

    /**
     * @param string $zone
     */
    public function setArea($zone);

    /**
     * @return string
     */
    public function getArea();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $type
     */
    public function setType($type);

    /**
     * @return string
     */
    public function getType();

    /**
     * @return value
     */
    public function getValue();

    /**
     * @param $value $value
     */
    public function setValue($value);

}
