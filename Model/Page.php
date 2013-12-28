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

use DateTime;

/**
 * @author Mbechezi Mlanawo <mlanawo.mbechezi@ikimea.com>
 */

abstract class Page implements PageInterface
{
    const ROLE_SUPER_ADMIN = 'ROLE_ADMIN';

    protected $id;
    protected $name;
    protected $slug;
    protected $culture;
    protected $metaKeyword;
    protected $metaDescription;
    protected $created;
    protected $updated;
    protected $isPublished;
    protected $template;
    protected $credentials;
    protected $areas;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function getCulture()
    {
        return $this->culture;
    }

    /**
     * {@inheritdoc}
     */
    public function setCulture($culture)
    {
        $this->culture = $culture;
    }


    /**
     * {@inheritdoc}
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * {@inheritdoc}
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * {@inheritdoc}
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * {@inheritdoc}
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetaKeyword()
    {
        return $this->metaKeyword;
    }

    /**
     * {@inheritdoc}
     */
    public function setMetaKeyword($metaKeyword)
    {
        $this->metaKeyword = $metaKeyword;
    }

    /**
     * {@inheritdoc}
     */
    public function setIsPublished($isPublished)
    {
        $this->is_published = $isPublished;
    }

    /**
     * {@inheritdoc}
     */
    public function getIsPublished()
    {
        return $this->is_published;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdated(DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * {@inheritdoc}
     */
    public function setAreas($areas)
    {
        $this->areas = $areas;
    }

    /**
     * {@inheritdoc}
     */
    public function getAreas()
    {
        return $this->areas;
    }
}
