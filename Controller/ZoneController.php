<?php

/*
* This file is part of the crum-project package.
*
* (c) Ikimea Pages <http://www.ikimea.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/


namespace Ikimea\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ikimea\PageBundle\Exception\InternalErrorException;


class ZoneController extends Controller
{
    
    public function getAction($name)
    {
        $pos = strpos($name, ' ', 1);
        if($pos !== false){
            throw new InternalErrorException('The block name must not contain spaces');
        }

        $id = 1;
        $em = $this->container->get('doctrine.orm.entity_manager');
        
        $zone = $em->getRepository('IkimeaPageBundle:Zone')->findOneByName($name);
        $components = $zone->getComponents();


        return $this->render('IkimeaPageBundle:Zone:get.html.twig', array('components' => $components));
    }
}
