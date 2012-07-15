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

interface PageInterface
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
     * @return string
     */
    public function getSlug();
    
    /**
     * @return string
     */
    public function getTemplate();
    
    /**
     * @return string
     */
    public function getMetaKeyword();
    
    /**
     * @return string
     */
    public function getMetaDescription();

    /**
     * @return datetime
     */
    public function getCreated();

    /**
     * @return datetime
     */
    public function getUpdated();

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAreas();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @param string $slug
     */
    public function setSlug($slug);
    
    /**
     * @param string $template
     */
    public function setTemplate($slug);
    
     /**
     * @param string $metaKeyword
     */
    public function setMetaKeyword($metaKeyword);
    
    /**
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription);

    /**
     * @param datetime $created
     */
    public function setCreated(\DateTime $updated);

    /**
     * @param datetime $updated
     */
    public function setUpdated(\DateTime $updated);

    /**
     * set areas
    */

    public function setAreas($areas);

}