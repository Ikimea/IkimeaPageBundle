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

class Area implements AreaInterface{

    protected $id;
    protected $page_id;
    protected $components;
    protected $name;
    protected $culture;
    protected $page;

    /**
     * {@inheritdoc}
     */
    public function getId(){
       return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(){
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getCulture(){
        return $this->culture;
    }

    /**
     * {@inheritdoc}
     */
    public function setCulture($culture){
        $this->culture = $culture;
    }

    /**
     * {@inheritdoc}
     */
    public function setPage($page ){
        $this->page = $page;
    }

    /**
     * {@inheritdoc}
     */
    public function getComponents(){
        return $this->components;
    }

    /**
        * {@inheritdoc}
    */
    public function setComponents($components){
        $this->components = $components;
    }

}