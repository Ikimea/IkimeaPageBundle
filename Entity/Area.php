<?php

/*
* This file is part of the Ikimea Pages package.
*
* (c) Ikimea <http://www.ikimea.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/


namespace Ikimea\PageBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use Ikimea\PageBundle\Model\Area as BaseArea;



class Area extends BaseArea
{
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    public function __construct()
    {
        $this->components = new ArrayCollection();
    }
}