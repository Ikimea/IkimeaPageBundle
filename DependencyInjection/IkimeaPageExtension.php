<?php

/*
* This file is part of the Ikimea Pages package.
*
* (c) Ikimea Pages <http://www.ikimea.com/>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Ikimea\PageBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;


class IkimeaPageExtension extends Extension {

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        
        
       $configuration = new Configuration();
       $config = $this->processConfiguration($configuration, $configs);
        
        
       $config = array();
       foreach($configs as $c){
        $config = array_merge($config, $c);
       
       }
       
       $container->setParameter('ikimea_page', array());
       $container->setParameter('ikimea_page.seo', $config['seo']);

       $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
       $loader->load('services.yml');
    }

}
