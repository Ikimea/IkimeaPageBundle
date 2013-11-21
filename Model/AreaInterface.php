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

interface AreaInterface
{

    /**
     * @return integer $id
     */
    public function getId();

    /**
     * @return string $name
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string $name
     */
    public function getCulture();

    /**
     * @param string $culture
     */
    public function setCulture($culture);

    /**
     * @return string $name
     */
    public function getComponents();

    /**
     * @param string $components
     */
    public function setComponents($components);

}