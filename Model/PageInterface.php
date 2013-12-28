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
     * Get enabled
     *
     * @return boolean $published
     */
    public function isPublished();

    /**
     * Set Published
     *
     * @param boolean $published
     */
    public function setPublished($published);

    /**
     * @return datetime
     */
    public function getCreated();

    /**
     * @return datetime
     */
    public function getUpdated();

    /**
     * Set parent
     *
     * @param PageInterface $parent
     */
    public function setParent(PageInterface $parent = null);

    /**
     * Get parent
     *
     * @param integer $level default -1
     *
     * @return PageInterface $parent
     */
    public function getParent($level = -1);

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
     * Get local
     *
     * @return string $locale
     */
    public function getLocale();

    /**
     * set local
     *
     * @param string $culture
     */
    public function setLocale($culture);

    /**
     * Get route
     *
     * @return string $route
     */
    public function getRoute();

    /**
     * set route
     *
     * @param string $route
     */
    public function setRoute($route);

    /**
     * @param string $template
     */
    public function setTemplate($template);

     /**
     * @param string $metaKeyword
     */
    public function setMetaKeyword($metaKeyword);

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription);

    /**
     * @param \DateTime $created
     *
     */
    public function setCreated(\DateTime $created);

    /**
     * @param \DateTime $updated
     *
     */
    public function setUpdated(\DateTime $updated);

    /**
     * set areas
    */
    public function setAreas($areas);
}