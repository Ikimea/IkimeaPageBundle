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
use Symfony\Bundle\FrameworkBundle\Request;
use Ikimea\PageBundle\Exception\InternalErrorException;
use Ikimea\PageBundle\Entity\Zone;


class ZoneController extends Controller
{
    
    public function getAction($name )
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        if(strpos($name, ' ', 1) !== false){
            throw new InternalErrorException('The block name must not contain spaces');
        }

        $getPathInfo = str_replace('/', '', $this->get('request')->getPathInfo() );
        $culture = $this->get('request')->getLocale();
        $page =  $em->getRepository('IkimeaPageBundle:Page')->findOneBySlug($getPathInfo);


        if($em->getRepository('IkimeaPageBundle:Zone')->getArea($name, $culture, $getPathInfo) == false){

           $area =  new Zone();
           $area->setPage($page);
           $area->setCulture($culture);
           $area->setName($name);


            $em->persist($area);
            $em->flush();
        }

        $zone = $em->getRepository('IkimeaPageBundle:Zone')->getArea($name, $culture, $getPathInfo);
        $zone = $zone[0];

        $components = $zone->getComponents();


        return $this->render('IkimeaPageBundle:Zone:get.html.twig', array('components' => $components));
    }
}
