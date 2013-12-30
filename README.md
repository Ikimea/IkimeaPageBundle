
Quick Installation
------------------

``` bash
$ composer require ikimea/page-bundle "dev-master"
```


### Add bundle to your application kernel

``` php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Ikimea\PageBundle\IkimeaPageBundle(),
        new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
        new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
        // ...
    );
}
```

Register the routing definition in app/config/routing.yml:

``` yaml
# app/config/routing.yml

IkimeaPageBundle:
    resource: "@IkimeaPageBundle/Resources/config/routing.yml"
    prefix:   /

fos_js_routing:
    resource: "@FOSJsRoutingBundle/Resources/config/routing/routing.xml"
```

### Usage

Add lines in your layout:

<script src="{{ asset('bundles/fosjsrouting/js/router.js') }}"></script>
<script src="{{ path('fos_js_routing_js', {"callback": "fos.Router.setData"}) }}"></script>

{% include 'IkimeaPageBundle:Default:css.html.twig' %}
{% include 'IkimeaPageBundle:Default:toolbar.html.twig' %}
{% include 'IkimeaPageBundle:Default:js.html.twig' %}



### Install assets

``` bash
$ php app/console assets:install web --symlink
```