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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Ikimea\PageBundle\Entity\Component;
use Ikimea\PageBundle\Form\Type\ComponentType;

class ComponentController extends Controller
{
    /**
     * @param $area id the area
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws
     */
    public function newAction($area)
    {
        $em = $this->getDoctrine()->getManager();
        $area =  $entity = $em->getRepository('IkimeaPageBundle:Area')->find($area);

        if (!$area) {
            throw createNotFoundException(sprintf('The Area "%s" was not found.', $area ));
        }

        $entity = new Component();
        $entity->setArea($area);
        $entity->setValue('Nouveau widget Texte');
        $entity->setType('richtext');

        $em->persist($entity);
        $em->flush();

        $response = $this->forward('IkimeaPageBundle:Component:show', array('id' => $entity->getId()));
        return $response;
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $component = $this->getComponent($id);
        return $this->render('IkimeaPageBundle:Components:' . $component->getType() . '.html.twig', array('component' => $component));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function editAction($id)
    {
        $component = $this->getComponent($id);

        $editForm = $this->createForm(new ComponentType(), $component);

        return $this->render('IkimeaPageBundle:Component:edit.html.twig', array(
            'component' => $component,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $component = $this->getComponent($id);

        $editForm = $this->createForm(new ComponentType(), $component);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($component);
            $em->flush();

            $response =  new Response( $component->getValue(), 200 );
        } else {
            $response = $this->forward('IkimeaPageBundle:Component:show', array('id' => $component->getId()));
        }

        return $response;
    }

    public function getComponent($id)
    {
        $component = $this->getDoctrine()->getManager()->getRepository('IkimeaPageBundle:Component')->find($id);

        if (!$component) {
            throw createNotFoundException(sprintf('The Component "%s" was not found.', $id ));
        }

        return $component;
    }
}
