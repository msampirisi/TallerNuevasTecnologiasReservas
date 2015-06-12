<?php

namespace UNTDF\ReservasAulasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use UNTDF\ReservasAulasBundle\Entity\TipoActividad;
use UNTDF\ReservasAulasBundle\Form\TipoActividadType;

/**
 * TipoActividad controller.
 *
 * @Route("/tipoactividad")
 */
class TipoActividadController extends Controller
{

    /**
     * Lists all TipoActividad entities.
     *
     * @Route("/", name="tipoactividad")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNTDFReservasAulasBundle:TipoActividad')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TipoActividad entity.
     *
     * @Route("/", name="tipoactividad_create")
     * @Method("POST")
     * @Template("UNTDFReservasAulasBundle:TipoActividad:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoActividad();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipoactividad_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TipoActividad entity.
     *
     * @param TipoActividad $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoActividad $entity)
    {
        $form = $this->createForm(new TipoActividadType(), $entity, array(
            'action' => $this->generateUrl('tipoactividad_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoActividad entity.
     *
     * @Route("/new", name="tipoactividad_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoActividad();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TipoActividad entity.
     *
     * @Route("/{id}", name="tipoactividad_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:TipoActividad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoActividad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TipoActividad entity.
     *
     * @Route("/{id}/edit", name="tipoactividad_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:TipoActividad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoActividad entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a TipoActividad entity.
    *
    * @param TipoActividad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoActividad $entity)
    {
        $form = $this->createForm(new TipoActividadType(), $entity, array(
            'action' => $this->generateUrl('tipoactividad_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoActividad entity.
     *
     * @Route("/{id}", name="tipoactividad_update")
     * @Method("PUT")
     * @Template("UNTDFReservasAulasBundle:TipoActividad:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:TipoActividad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoActividad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipoactividad_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TipoActividad entity.
     *
     * @Route("/{id}", name="tipoactividad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNTDFReservasAulasBundle:TipoActividad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoActividad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipoactividad'));
    }

    /**
     * Creates a form to delete a TipoActividad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoactividad_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}