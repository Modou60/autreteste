<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="demarrage")
     */
    public function demarrage(): Response
    {
        return $this->render('article/index.html.twig', []);
    }


    /**
     * @Route("/", name="livre")
     */
    // première méthode
    public function livre(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findAll();
        return $this->render('article/livre.html.twig', [
            'produit' => $articles,

        ]);
    }


    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function formulairePage(Request $request): Response
    {
        $livre = new Articles;
        // créer mon formulaire à partir du type existant
        $formarticle = $this->createForm(ArticlesType::class, $livre);
        $formarticle->handleRequest($request);

// test pour la validité du formulaire et sa persistance
        if ($formarticle->isSubmitted() && $formarticle->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($livre);
            $manager->flush();
            
// redirection
            return $this->redirectToRoute('livre');
            

        }

       // envoie du formulaire à la page twig
       return $this->render('article/livreformulaire.html.twig', [
           'nouvlivre' => $livre,
           'Articleform' => $formarticle->createView(),
       ]);   
    }


    /**
     * @Route("/nouvelarticle", name="article.nouvelarticle")
     */
    // Ici on Fait un Enregistrement avec une Formulaire

    public function pageForm(Request $request, EntityManagerInterface $manager)
    {
        $articles = new Articles(); // Instanciation


        // Creation de mon Formulaire
        $form = $this->createFormBuilder($articles)
            ->add('titre')
             ->add('resume')
            ->add('contenu')
            ->add('createdAt')
            ->add('image')

            // Demande le résultat
            ->getForm();

        // Analyse des Requetes & Traitement des information 
        $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $manager->persist($articles); 
             $manager->flush();

             return $this->redirectToRoute('article.nouvelarticle', 
             ['id'=>$articles->getId()]); // Redirection vers la page
         }

        $manager->persist($articles);
        $manager->flush();

        // Redirection du Formulaire vers le TWIG pour l’affichage avec
        return $this->render('article/new2.html.twig', [
            'formArticle' => $form->createView()
        ]);
    }


    // /**
    //  * @Route("/nouveau", name="articles_nouveau")
    //  */
    // public function nouveau(Request $request, EntityManagerInterface $em): Response
    // {
    //    $articles = new Articles();

    //    // Ici je fais un enregistrement Manuel, on verra la suite avec le  Formulaire
    //    $articles->setTitre(" Titre de mon Article");
    // //    $articles->setImage("");
    //    $articles->setResumé(" Titre de mon Article");
    //    $articles->setDate(new  \DateTime());
    //    $articles->setContenu(" Contenu de mon Article Contenu de mon ArticleContenu de mon ArticleContenu de mon ArticleContenu de mon Article");

    //    // Je persiste Mon Enregistrement
    //    $em->persist($articles);
    //    $em->flush();

    //    // J'envoie au niveau du temple pour l'enregistrement
    //    return $this->render('article/artnouveau.html.twig', [
    //        'article' => $articles,
    //    ]);
    // }

    /**
     * @Route("/{id}", name="art_affichage",methods={"GET"})
     */
    public function montrer(Articles $articles, ArticlesRepository $articlesRepository, Request $request, EntityManagerInterface $manager): Response
    {
        return $this->render('article/affichage.html.twig', [
            'id' => $articles->getId(),
            'prod' => $articles,
        ]);
    }
}
