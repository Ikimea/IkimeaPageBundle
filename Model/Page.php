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
    protected $locale;
    protected $route;
    protected $parent;
    protected $metaKeyword;
    protected $metaDescription;
    protected $created;
    protected $updated;
    protected $published;
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
        $this->setSlug($name);
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = self::slugify(trim($slug));
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
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Get route
     *
     * @return string $route
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * set route
     *
     * @param string $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
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
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * {@inheritdoc}
     */
    public function isPublished()
    {
        return $this->published;
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
    public function setParent(PageInterface $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent($level = -1)
    {
        if (-1 === $level) {
            return $this->parent;
        }

        $parents = $this->getParents();

        if ($level < 0) {
            $level = count($parents) + $level;
        }

        return isset($parents[$level]) ? $parents[$level] : null;
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

    /**
     * source : http://snipplr.com/view/22741/slugify-a-string-in-php/
     *
     * @static
     *
     * @param string $text
     *
     * @return mixed|string
     */
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        return $text;
    }
}