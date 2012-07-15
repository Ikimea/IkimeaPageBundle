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
use Ikimea\PageBundle\Entity\Component;
use Ikimea\PageBundle\Form\ComponentType;

class ComponentController extends Controller {

    public function newAction($zone) {
        
        $em = $this->getDoctrine()->getManager();

        $entity = new Component();
        $entity->setZone($zone);
        $entity->setValue('Nouveau widget Texte');
        $entity->setType('richtext');


        $em->persist($entity);
        $em->flush();


        $response = $this->forward('IkimeaPageBundle:Component:show', array('id' => $entity->getId()));


        return $response;
    }

    public function showAction() {

        $em = $this->getDoctrine()->getManager();
        $component = $em->getRepository('IkimeaPageBundle:Component')->find($id);

        return $this->render('IkimeaPageBundle:Components:' . $component->getType() . '.html.twig', array('component' => $component));
    }

    public function updateAction($id) {
        $em = $this->getDoctrine()->getManager();
        $sfResponse = new Response();

        $entity = $em->getRepository('IkimeaPageBundle:Component')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Component entity.');
        }

        $editForm = $this->createForm(new ComponentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            
            if($request->get('xhr')){
                echo $entity->{'get'.ucfirst($entity->getType())}();
                return $sfResponse;
            }
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IkimeaPageBundle:Component')->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Component entity.');
        }

        $editForm = $this->createForm(new ComponentType(), $entity);

        return $this->render('IkimeaPageBundle:Component:edit.html.twig', array(
            'component' => $entity,
            'edit_form' => $editForm->createView()
        ));
        
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
