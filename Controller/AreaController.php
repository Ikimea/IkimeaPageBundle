<?php

/*
* This file is part of the Ikimea Pages package.
*
* (c) Ikimea <http://www.ikimea.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/


namespace Ikimea\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Request;

use Ikimea\PageBundle\Exception\InternalErrorException;
use Ikimea\PageBundle\Entity\Area;
use Ikimea\PageBundle\Util\Url;


class AreaController extends Controller
{
    
    public function getAction($name )
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $culture = $this->get('request')->getLocale();

        if(strpos($name, ' ', 1) !== false){
            throw new InternalErrorException('The block name must not contain spaces');
        }

        $slug = Url::format($this->getRequest()->getPathInfo());

        $page =  $em->getRepository('IkimeaPageBundle:Page')->getPageBySlug($slug);

        $getArea =  $em->getRepository('IkimeaPageBundle:Area')->areaExist($name, $page->getId(), $culture );

        if(false === $getArea){

           $area =  new Area();
           $area->setPage($page);
           $area->setCulture($culture);
           $area->setName($name);


           $em->persist($area);
           $em->flush();
        }else{

            $area = $em->getRepository('IkimeaPageBundle:Area')->getArea($name, $page->getId(), $culture);
        }

        return $this->render('IkimeaPageBundle:Area:get.html.twig', array('area' => $area));
    }
}
