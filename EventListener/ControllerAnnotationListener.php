<?php

namespace Ikimea\PageBundle\EventListener;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Ikimea\PageBundle\Annotation\Page as PageAnnotation;
use Ikimea\PageBundle\Entity\Page as PageEntity;

class ControllerAnnotationListener
{
    /** @var Container */
    private $container;

    /** @var Reader */
    private $reader;

    /** @var EntityManager */
    private $em;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->reader = $container->get('annotation_reader');
        $this->em = $container->get('doctrine.orm.entity_manager');
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        if (!is_array($controller = $event->getController())) {
            return;
        }

        $method = new \ReflectionMethod(ClassUtils::getClass($controller[0]), $controller[1]);

        if (!$annotations = $this->reader->getMethodAnnotations($method)) {
            return;
        }

        foreach ($annotations as $annotation) {
            if ($annotation instanceof PageAnnotation) {
                $route = $this->container->get('request')->get('_route');

                /** @var PageEntity $page */
                $page = $this->em->getRepository('IkimeaPageBundle:Page')->getPageByRoute($route);

                if (!$page || !$page->getIsPublished()) {
                    throw new NotFoundHttpException('Page not found');
                }
            }
        }
    }
}
