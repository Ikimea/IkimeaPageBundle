<?php

/*
* This file is part of the crum-project package.
*
* (c) Ikimea Pages <http://www.ikimea.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Ikimea\PagesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Ikimea\PageBundle\Entity\Page;

class PageFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load($manager)
    {
        $page = new Page();
        $page->setTitle('Homepage');
        $page->setSlug('/');
        $page->setIsPublished(false);

        $manager->persist($page);
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}