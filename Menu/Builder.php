<?php


namespace Ikimea\PageBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class Builder extends ContainerAware
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function breadcrumb(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setCurrentUri($request->getRequestUri());
        $menu->setChildrenAttribute('id', 'breadcrumb');
        $menu->setChildrenAttribute('class', 'clearfix');

        $menu->addChild('Accueil', array('route' => '_welcome'));
        
        return $menu;
    }
}