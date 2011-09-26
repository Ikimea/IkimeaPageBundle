<?php

namespace Ikimea\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Ikimea\PageBundle\Entity\Component;
use Ikimea\PageBundle\Form\ComponentType;

class ComponentController extends Controller {

    public function newAction($zone) {
        
        $em = $this->getDoctrine()->getEntityManager();

        $entity = new Component();
        $entity->setZone($zone);
        $entity->setText('Nouveau widget Texte');
        $entity->setType('text');


        $em->persist($entity);
        $em->flush();


        $response = $this->forward('IkimeaPageBundle:Component:show', array('id' => $entity->getId()));


        return $response;
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $component = $em->getRepository('IkimeaPageBundle:Component')->find($id);


        return $this->render('IkimeaPageBundle:Components:' . $component->getType() . '.html.twig', array('component' => $component)
        );
    }

    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('IkimeaPageBundle:Component')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Component entity.');
        }

        $editForm = $this->createForm(new ComponentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            
            if($request->get('xhr')){
                return new Response();
            }else{
                
                return $this->redirect($this->generateUrl('component_edit', array('id' => $id)));
            }
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
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
