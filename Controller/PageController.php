<?php

/*
* This file is part of the Ikimea Pages package.
*
* (c) Ikimea Pages <http://www.ikimea.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
namespace Ikimea\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Ikimea\PageBundle\Entity\Component;
use Ikimea\PageBundle\Form\ComponentType;

class PageController extends Controller {
    
    public $_template = 'IkimeaPageBundle:Page:show.html.twig';


    public function showAction() {

        $pathInfo = ltrim($this->get('request')->getPathInfo(), '/' );
        $params = array();

        $page = $this->getDoctrine()->getRepository('IkimeaPageBundle:Page')->getPageBySlug($pathInfo);

        if (!$page) {

            throw new NotFoundHttpException('The current url does not exist!');
        }


        if ($this->has('ikimea_page.breadcrumb')) {
            $breadcrumbs = $this->get('ikimea_page.breadcrumb');
            $breadcrumbs->addChild($page->getName())->setCurrent(true);
            $breadcrumbs->addChild($page->getName(), array('uri' => '/solution'));
        }

        $params['breadcrumb'] = $breadcrumbs;
        $params['page'] = $page;


        $this->addSeoMeta($page);



        if(null != $page->getTemplate()){

            $this->_template = $page->getTemplate();
        }

        return $this->render($this->_template, $params);
    }

    public function editAction($slug) {
        
    }
    
    
    public function getSeoPage()
    {
        return $this->get('sonata.seo.page');
    }
    
    
    protected function addSeoMeta($page)
    {
        
        if($this->container->hasParameter('ikimea_page.seo')){
            $page_seo  = $this->container->getParameter('ikimea_page.seo');
            $this->getSeoPage()->setTitle($page_seo['title_prefix'].$page->getName(). $page_seo['title_suffix']); 
            
        }else{
            $this->getSeoPage()->setTitle($page->getName());        
        }
        

        if ($page->getMetaDescription()) {
            $this->getSeoPage()->addMeta('name', 'description', $page->getMetaDescription());
        }

        if ($page->getMetaKeyword()) {
            $this->getSeoPage()->addMeta('name', 'keywords', $page->getMetaKeyword());
        }

        $this->getSeoPage()->addMeta('property', 'og:type', 'article');
    }

}