<?php

namespace Key\AdminBundle\Controller;

use Key\AdminBundle\Entity\Cocktail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Cocktail controller.
 *
 * @Route("cocktail")
 */
class CocktailController extends Controller
{
    /**
     * Lists all cocktail entities.
     *
     * @Route("/", name="cocktail_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cocktails = $em->getRepository('KeyAdminBundle:Cocktail')->findAll();

        return $this->render('cocktail/index.html.twig', array(
            'cocktails' => $cocktails,
        ));
    }

    /**
     * Creates a new cocktail entity.
     *
     * @Route("/new", name="cocktail_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cocktail = new Cocktail();
        $form = $this->createForm('Key\AdminBundle\Form\CocktailType', $cocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cocktail);
            $em->flush();

            return $this->redirectToRoute('cocktail_show', array('id' => $cocktail->getId()));
        }

        return $this->render('cocktail/new.html.twig', array(
            'cocktail' => $cocktail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cocktail entity.
     *
     * @Route("/{id}", name="cocktail_show")
     * @Method("GET")
     */
    public function showAction(Cocktail $cocktail)
    {
        $deleteForm = $this->createDeleteForm($cocktail);

        return $this->render('cocktail/show.html.twig', array(
            'cocktail' => $cocktail,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cocktail entity.
     *
     * @Route("/{id}/edit", name="cocktail_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cocktail $cocktail)
    {
        $deleteForm = $this->createDeleteForm($cocktail);
        $editForm = $this->createForm('Key\AdminBundle\Form\CocktailType', $cocktail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cocktail_edit', array('id' => $cocktail->getId()));
        }

        return $this->render('cocktail/edit.html.twig', array(
            'cocktail' => $cocktail,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cocktail entity.
     *
     * @Route("/{id}", name="cocktail_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cocktail $cocktail)
    {
        $form = $this->createDeleteForm($cocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cocktail);
            $em->flush();
        }

        return $this->redirectToRoute('cocktail_index');
    }

    /**
     * Creates a form to delete a cocktail entity.
     *
     * @param Cocktail $cocktail The cocktail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cocktail $cocktail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cocktail_delete', array('id' => $cocktail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
