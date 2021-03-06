<?php

namespace UNTDF\ReservasAulasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UNTDF\ReservasAulasBundle\Entity\Recurso;
use UNTDF\ReservasAulasBundle\Form\RecursoType;
use Symfony\Component\HttpFoundation\Response;


/**
 * Recurso controller.
 *
 */
class RecursoController extends Controller
{

    /**
     * Lists all Recurso entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNTDFReservasAulasBundle:Recurso')->findAll();

        return $this->render('UNTDFReservasAulasBundle:Recurso:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lists all Recurso entities.
     *
     */
    public function listadoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNTDFReservasAulasBundle:Recurso')->findAll();

        $retorno = array();
        foreach ($entities as $entity){
            array_push($retorno, array('id' => $entity->getId(),'nombre' => $entity->getNombre()));
        }
        
        $response = new Response();

        $response->setContent(json_encode($retorno));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        // prints the HTTP headers followed by the content
        //$response->send();

        return $response;
    }

    /**
     * Creates a new Recurso entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Recurso();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->addFlash(
                'notice',
                'Recurso creado con éxito!'
            );
            return $this->redirect($this->generateUrl('recurso'));
            //return $this->redirect($this->generateUrl('recurso', array('id' => $entity->getId())));
        }

        return $this->render('UNTDFReservasAulasBundle:Recurso:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Recurso entity.
     *
     * @param Recurso $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Recurso $entity)
    {
        $form = $this->createForm(new RecursoType(), $entity, array(
            'action' => $this->generateUrl('recurso_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Recurso entity.
     *
     */
    public function newAction()
    {
        $entity = new Recurso();
        $form   = $this->createCreateForm($entity);

        return $this->render('UNTDFReservasAulasBundle:Recurso:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Recurso entity.
     *
     */
    /*
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Recurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recurso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNTDFReservasAulasBundle:Recurso:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /
    /**
     * Displays a form to edit an existing Recurso entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Recurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recurso entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UNTDFReservasAulasBundle:Recurso:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Recurso entity.
    *
    * @param Recurso $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Recurso $entity)
    {
        $form = $this->createForm(new RecursoType(), $entity, array(
            'action' => $this->generateUrl('recurso_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Recurso entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNTDFReservasAulasBundle:Recurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Recurso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->addFlash(
                'notice',
                'Recurso modificado con éxito!'
            );
            return $this->redirect($this->generateUrl('recurso'));
        }

        return $this->render('UNTDFReservasAulasBundle:Recurso:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Recurso entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNTDFReservasAulasBundle:Recurso')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Recurso entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->addFlash(
                'notice',
                'Recurso borrado con éxito!'
            );
        }

        return $this->redirect($this->generateUrl('recurso'));
    }

    /**
     * Creates a form to delete a Recurso entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recurso_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
}
