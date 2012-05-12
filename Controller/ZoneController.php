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


class ZoneController extends Controller
{
    
    public function getAction($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        
        $zone = $em->getRepository('IkimeaPageBundle:Zone')->find($id);
       
        
        $components  = $em->getRepository('IkimeaPageBundle:Component')->getAllComponentsByZone($id);
        
        return $this->render('IkimeaPageBundle:Zone:get.html.twig', array('components' => $components));
    }
}
