<?php

namespace bikeBundle\Controller;

use bikeBundle\Entity\Livreur;
use bikeBundle\Form\LivreurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User;

class LivreurController extends Controller
{
    public function indexAction(Request $request)
    {
        $livreur=new Livreur();
        $form=$this->createForm(LivreurType::class,$livreur);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $userManager = $this->container->get('fos_user.user_manager');
            $livreur->setLivDispo(1);
            $livreur->setNbrlivraisonParjour(0);
            $livreur->setRoles(array('ROLE_LIVREUR'));
            $livreur->setEnabled(true);

            $user = $userManager->createUser();
            $user->setUsername($livreur->getUsername());
            $user->setRoles(array('ROLE_LIVREUR'));
            $user->setEmail($livreur->getEmail());
            $user->setPlainPassword($livreur->getPassword());
            $user->setEnabled(true);
            $userManager->updateUser($user);
            $em= $this->getDoctrine()->getManager();
            $em->persist($livreur);
            $em->flush();

            return $this->redirectToRoute('livreur_affich');
        }
        return $this->render('@bike/Default/formulairelivreur.html.twig',array('form'=>$form->createView()));
    }

    public function affichlivreurAction()
    {
        $em = $this->getDoctrine()->getManager();

        $livreurs = $em->getRepository('bikeBundle:Livreur')->findAll();

        return $this->render('@bike/Default/tablelivreur.html.twig', array(
            'livreurs' => $livreurs,
        ));

    }


    /**
     * Displays a form to edit an existing livreur entity.
     *
     * @Route("/{id}/edit", name="livreur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Livreur $livreur)
    {
        $deleteForm = $this->createDeleteForm($livreur);
        $editForm = $this->createForm('bikeBundle\Form\LivreurType', $livreur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livreur_affich', array('id' => $livreur->getId()));
        }

        return $this->render('livreur/edit.html.twig', array(
            'livreur' => $livreur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a livreur entity.
     *
     * @Route("delete/{id}", name="livreur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Livreur $livreur)
    {
        $form = $this->createDeleteForm($livreur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($livreur);
            $em->flush();
        }

        return $this->redirectToRoute('livreur_affich');
    }

    /**
     * Creates a form to delete a livreur entity.
     *
     * @param Livreur $livreur The livreur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Livreur $livreur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('livreur_delete', array('id' => $livreur->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }




}
