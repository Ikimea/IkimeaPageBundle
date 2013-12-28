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
use Symfony\Component\HttpFoundation\Request;

use Ikimea\PageBundle\Exception\InternalErrorException;
use Ikimea\PageBundle\Entity\Area;

class AreaController extends Controller
{
    public function getAction(Request $request, $name, $currentRoute = null)
    {
        $em = $this->getDoctrine()->getManager();
        $culture = $request->getLocale();

        if(strpos($name, ' ', 1) !== false) {
            throw new InternalErrorException('The block name must not contain spaces');
        }

        if($currentRoute === null ) {
            $pathInfo =  $request->getPathInfo();
            $slug =  ltrim($pathInfo, '/'.$culture.'/');
            $page =  $em->getRepository('IkimeaPageBundle:Page')->getPageBySlug($slug);
        } else {
            $page =  $em->getRepository('IkimeaPageBundle:Page')->getPageByRoute($currentRoute);
        }

        $getArea =  $em->getRepository('IkimeaPageBundle:Area')->areaExist($name, $page->getId() );

        if (false === $getArea) {

            $area =  new Area();
            $area->setPage($page);
            $area->setName($name);

            $em->persist($area);
            $em->flush();

        } else {
            $area = $em->getRepository('IkimeaPageBundle:Area')->getArea($name, $page->getId(), $culture);
        }

        return $this->render('IkimeaPageBundle:Area:get.html.twig', array('area' => $area));
    }
}