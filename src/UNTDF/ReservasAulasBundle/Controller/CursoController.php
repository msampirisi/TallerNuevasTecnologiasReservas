<?php

namespace UNTDF\ReservasAulasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNTDF\ReservasAulasBundle\Entity\Curso;
use UNTDF\ReservasAulasBundle\Form\CursoType;

/**
 * Curso controller.
 *
 */
class CursoController extends Controller
{

    /**
     * Lists all Curso entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNTDFReservasAulasBundle:Curso')->findAll();

        return $this->render('UNTDFReservasAulasBundle:Curso:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Curso entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Curso();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->addFlash(
                'notice',
                'Curso creado con éxito!'
            );

            return $this->redirect($this->generateUrl('curso'));
        }

        return $this->render('UNTDFReservasAulasBundle:Curso:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Curso entity.
     *
     * @param Curso $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Curso $entity)
    {
        $form = $this->createForm(new CursoType(), $entity, array(
            'action' => $this->generateUrl('curso_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Aceptar'));

        return $form;
    }

    /**
     * Displays a form to create a new Curso entity.
     *
     */
    public function newAction()
    {
        $entity = new Curso();
        $form   = $this->createCreateForm($entity);

        return $this->render('UNTDFReservasAulasBundle:Curso:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    
    /**
     * Displays a form to edit an existing Curso entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Curso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Curso entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNTDFReservasAulasBundle:Curso:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Curso entity.
    *
    * @param Curso $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Curso $entity)
    {
        $form = $this->createForm(new CursoType(), $entity, array(
            'action' => $this->generateUrl('curso_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Aceptar'));

        return $form;
    }
    /**
     * Edits an existing Curso entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Curso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Curso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->addFlash(
                'notice',
                'Curso modificado con éxito!'
            );

            return $this->redirect($this->generateUrl('curso'));
        }

        return $this->render('UNTDFReservasAulasBundle:Curso:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Curso entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNTDFReservasAulasBundle:Curso')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Curso entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->addFlash(
                'notice',
                'Curso borrado con éxito!'
            );
        }

        return $this->redirect($this->generateUrl('curso'));
    }

    /**
     * Creates a form to delete a Curso entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('curso_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
}
