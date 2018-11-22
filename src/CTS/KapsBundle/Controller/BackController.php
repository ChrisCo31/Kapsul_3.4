<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 23/10/2018
 * Time: 16:48
 */

namespace CTS\KapsBundle\Controller;



use CTS\KapsBundle\CTSKapsBundle;
use CTS\KapsBundle\Entity\Media;
use CTS\KapsBundle\Entity\Selector;
use CTS\KapsBundle\Entity\Tag;
use CTS\KapsBundle\Form\MediaSelectorType;
use CTS\KapsBundle\Form\MediaType;
use CTS\KapsBundle\Form\SelectorType;
use CTS\KapsBundle\Services\Scraping;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends Controller
{
    /**
     * Matches /admin
     * @route("/admin", name="Back_admin")
     */
    public function manageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $listMedia = $em->getRepository('CTSKapsBundle:Media')->findAll();

        $media = new Media();

        $tag1 = new Tag ();
        $tag1 -> setName ( 'tag1' );
        $media -> getTags () -> add ( $tag1 );
        $tag2 = new Tag ();
        $tag2 -> setName ( 'tag2' );
        $media -> getTags () -> add ( $tag2 );

        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();
        }
        return $this->render('@CTSKapsBundle/back/index.html.twig', ['form' => $form->createView(), 'listMedia' => $listMedia]);
    }
    /**
     * Matches /selector/*
     * @route("/selector/{id}", name="Back_selector")
     */
    public function selectorAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('CTSKapsBundle:Media')->find($id);

        if(!$selector = $em->getRepository('CTSKapsBundle:Selector')->findOneBy(array("media"=>$media)))
        {
            $selector = new Selector();
            $selector->setMedia($media);
        }

        $name= $selector->getMedia()->getName();

        $form = $this->createForm(SelectorType::class, $selector);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($selector);
            $em->flush();
        }
        return $this->render('@CTSKapsBundle/back/_FormSelector.html.twig',
            ['form' => $form->createView(),
            ]);
    }

    /**
     * Matches /scrap/*
     *
     * @route("/scrap/{id}", name="Back_scrap")
     */
    public function scrapingAction(Request $request,$id)

    {
        // 1. Retrieve the url of the media to scrap and this corresponding selectors
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('CTSKapsBundle:Media')->find($id);
        $url = $media->getUrl();
        // 2. Call scraping service
        $scraping = $this->get('cts_kaps.Scraping');
       // 3. Execute scraping service
        $result = $scraping->executeScraping($url, $media);
        // 4. Persist results in "Article"

        // 5. Message de reussite


        // 6. Render twig file
        return $this->render('@CTSKapsBundle/back/scrap.html.twig', ['result' => $result]);

    }

    /**
     * Matches /connexion
     * @route("/connexion", name="Back_connexion")
     */
    public function connectAction()
    {

        return $this->render('@CTSKapsBundle/back/connexion.html.twig');
    }

    /**
     * Matches /register
     * @route("/register", name="Back_register")
     */
    public function registerAction()
    {

        return $this->render('@CTSKapsBundle/back/register.html.twig');
    }

    /**
     * Matches /myspace
     * @route("/myspace", name="Back_mySpace")
     */
    public function mySpaceAction()
    {

        return $this->render('@CTSKapsBundle/back/mySpace.html.twig');
    }
}
