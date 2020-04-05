<?php

namespace bikeBundle\Controller;

use AppBundle\Entity\Notification;
use bikeBundle\bikeBundle;
use bikeBundle\Entity\Livraison;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use bikeBundle\Entity\Livreur;
use AppBundle\Entity\User;
/**
 * Livraison controller.
 *
 * @Route("livraison")
 */
class LivraisonController extends Controller
{
    /**
     * Lists all livraison entities.
     *
     * @Route("/", name="livraison_index")
     * @Method("GET")
     */

    /**
     * Lists all livraison entities.
     *
     */
    public function indexxAction(Request $request)
    {
        $user = $this->getUser();
        $user->getId();
        $em = $this->getDoctrine()->getManager();

        $livraisons = $em->getRepository('bikeBundle:Livraison')->filterr($user);
        /**
         * @var $paginator \knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $result = $paginator->paginate(
            $livraisons,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)
        );

        return $this->render('@bike/Back/livreur.html.twig', array(
            'livraisons' => $result,
        ));

    }
    public function affichAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $livraison = $em->getRepository("bikeBundle:Livraison")->findAll();
        $queryBuilder = $em->getRepository('bikeBundle:Livraison')->createQueryBuilder('livraison');
        if($request->query->getAlnum('filter')){
            $queryBuilder
                ->WHERE('livraison.livraisonAdresse LIKE :livraisonAdresse')
                ->setparameter('livraisonAdresse','%'.$request->query->getAlnum('filter').'%');
        }
        $query=$queryBuilder->getQuery();


        return $this->render('@bike/Back/tablelivraison.html.twig', array(
            'livraisons' => $livraison,
        ));

    }

    public function tableAction()
    {
        return $this->render('@bike/back/tablelivraison.html.twig');
    }

    public function tablelivreurAction()
    {
        return $this->render('@bike/back/tablelivreur.html.twig');
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $livraisons = $em->getRepository('bikeBundle:Livraison')->findAll();

        return $this->render('livraison/index.html.twig', array(
            'livraisons' => $livraisons,
        ));
    }

    /**
     * Creates a new livraison entity.
     *
     * @Route("/new", name="livraison_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $livraison = new Livraison();
        $form = $this->createForm('bikeBundle\Form\LivraisonType', $livraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($livraison);
            $em->flush();
            $liv=$em->getRepository('bikeBundle:Livreur')->find($livraison->getLivreur()->getId());
            $liv->setNbrlivraisonParjour(($liv->getNbrlivraisonParjour())+1);
            $em->flush();
            if(($liv->getNbrlivraisonParjour())>10){
                $liv->setLivDispo(0);
                $em->flush();
            }

            return $this->redirectToRoute('table_content', array('id' => $livraison->getId()));
        }

        return $this->render('livraison/new.html.twig', array(
            'livraison' => $livraison,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a livraison entity.
     *
     * @Route("/{id}", name="livraison_show")
     * @Method("GET")
     */
    public function showAction(Livraison $livraison)
    {
        $deleteForm = $this->createDeleteForm($livraison);

        return $this->render('livraison/show.html.twig', array(
            'livraison' => $livraison,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing livraison entity.
     *
     * @Route("/{id}/edit", name="livraison_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Livraison $livraison)
    {

        // Create the Transport
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername('velotndirection@gmail.com')
            ->setPassword('nafapuztwclvehrq');

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);



        $em=$this->getDoctrine()->getManager();
        $liv=$em->getRepository('bikeBundle:Livreur')->find($livraison->getLivreur()->getId());
        $liv1=$em->getRepository('bikeBundle:Livreur')->find($livraison->getLivreur()->getId());
        $liv->setNbrlivraisonParjour(($liv->getNbrlivraisonParjour())-1);






        $deleteForm = $this->createDeleteForm($livraison);
        $editForm = $this->createForm('bikeBundle\Form\LivraisonType', $livraison);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $liv=$em->getRepository('bikeBundle:Livreur')->find($livraison->getLivreur()->getId());
            $liv->setNbrlivraisonParjour(($liv->getNbrlivraisonParjour())+1);
            $em->flush();



            if(($liv->getNbrlivraisonParjour())>10){
                $liv->setLivDispo(0);
                $em->flush();
            }else {
                $liv->setLivDispo(1);
                $em->flush();
            }
            return $this->redirectToRoute('table_content', array('id' => $livraison->getId()));
        }

        return $this->render('livraison/edit.html.twig', array(
            'livraison' => $livraison,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a livraison entity.
     *
     * @Route("/{id}", name="livraison_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Livraison $livraison)
    {
        $form = $this->createDeleteForm($livraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($livraison);
            $em->flush();
            $liv=$em->getRepository('bikeBundle:Livreur')->find($livraison->getLivreur()->getId());
            $liv->setNbrlivraisonParjour(($liv->getNbrlivraisonParjour())-1);
            $em->flush();
            if(($liv->getNbrlivraisonParjour())>10){
                $liv->setLivDispo(0);
                $em->flush();
            }else {
                $liv->setLivDispo(1);
                $em->flush();
            }
        }

        return $this->redirectToRoute('table_content');
    }


    /**
     * Deletes a livraison entity.
     *
     * @Route("/{id}", name="livraison1_delete")
     * @Method("DELETE")
     */
    public function suppAction(Request $request, Livraison $livraison)
    {
        // $form = $this->createDeleteForm($livraison);
        //// $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($livraison);
        $em->flush();
        $liv=$em->getRepository('bikeBundle:Livreur')->find($livraison->getLivreur()->getId());
        $liv->setNbrlivraisonParjour(($liv->getNbrlivraisonParjour())-1);
        $em->flush();
        if(($liv->getNbrlivraisonParjour())>10){
            $liv->setLivDispo(0);
            $em->flush();
        }else {
            $liv->setLivDispo(1);
            $em->flush();
        }
        // }

        return $this->redirectToRoute('livraison_show');
    }

    /**
     * Creates a form to delete a livraison entity.
     *
     * @param Livraison $livraison The livraison entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Livraison $livraison)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('livraison_delete', array('id' => $livraison->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }




    /*serach dynamiqueee*/
//    public function searchAction(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $requestString = $request->get('q');
//        $posts = $em->getRepository('bikeBundle:Livraison')->findEntitiesByString($requestString);
//        if (!$posts)
//        {
//            $result=['Livraison']['Livraison'] = "Not Found";
//
//        }else{
//            $result['posts']=$this->getEntities($posts);
//        }
//        return new Response(json_encode($result));
//
//    }
//
//    public function getRealEntities($posts)
//    {
//        foreach ($posts as $posts){
//            $realEntities[$posts->getId()] = [$posts->getPhoto(),$posts->getTitle()];
//        }
//        return $realEntities;
//    }
}
