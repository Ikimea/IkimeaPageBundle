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

use Ikimea\PageBundle\Entity\Component;
use Ikimea\PageBundle\Form\ComponentType;

class ComponentController extends Controller {

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

        $em = $this->getDoctrine()->getManager();
        $component = $em->getRepository('IkimeaPageBundle:Component')->find($id);

        return $this->render('IkimeaPageBundle:Components:' . $component->getType() . '.html.twig', array('component' => $component));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function editAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $component = $em->getRepository('IkimeaPageBundle:Component')->find($id);


        if (!$component) {
            throw $this->createNotFoundException('Unable to find Component entity.');
        }

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
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $entity = $em->getRepository('IkimeaPageBundle:Component')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Component entity.');
        }

        $editForm = $this->createForm(new ComponentType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $response =  new Response( $entity->getValue(), 200 );
        } else {
            $response = $this->forward('IkimeaPageBundle:Component:show', array('id' => $entity->getId()));
        }

        return $response;
    }
}
