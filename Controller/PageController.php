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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PageController extends Controller
{
    public $defaultTemplatePath = 'IkimeaPageBundle:Page:show.html.twig';

    /**
     * Displays page
     *
     * @param String $slug  Page slug
     * @param String $variables Variables to be passed to the displayed page
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction()
    {
        $slug = $this->get('request')->getPathInfo();

        $page = $this->getDoctrine()->getRepository('IkimeaPageBundle:Page')->getPageBySlug($slug);

        if (!$page) {
            throw new NotFoundHttpException('The current url does not exist!');
        }

        if (null != $page->getCredentials() && !$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        if ($this->has('ikimea_page.breadcrumb')) {
            $breadcrumbs = $this->get('ikimea_page.breadcrumb');
            $breadcrumbs->addChild($page->getName());
        }

        $params['page'] = $page;
        $this->addSeoMeta($page);

        if (null != $page->getTemplate()) {
            $this->defaultTemplatePath = $page->getTemplate();
        }

        return $this->render($this->defaultTemplatePath, $params);
    }

    /**
     * Edit page
     * @param String $slug Page slug
     */
    public function editAction($slug)
    {
        return new Response();
    }


    protected function getSeoPage()
    {
        return $this->get('sonata.seo.page');
    }

    /*
     * set meta description
     */
    protected function addSeoMeta($page)
    {
        if($this->container->hasParameter('ikimea_page.seo')){
            $page_seo  = $this->container->getParameter('ikimea_page.seo');
            $this->getSeoPage()->setTitle($page_seo['title_prefix'].$page->getName(). $page_seo['title_suffix']);

        } else {
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