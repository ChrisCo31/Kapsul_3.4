<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 23/10/2018
 * Time: 16:48
 */

namespace CTS\KapsBundle\Controller;



use CTS\KapsBundle\CTSKapsBundle;
use CTS\KapsBundle\Entity\Article;
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
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class BackController extends Controller
{
    /**
     * @route("/admin", name="Back_admin")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $listMedia = $em->getRepository('CTSKapsBundle:Media')->findAll();
        $media = new Media();

        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();
            $this->addFlash('success', 'La revue est en base');
            return $this->redirectToRoute('Back_admin');
        }
        return $this->render('@CTSKapsBundle/back/index.html.twig', ['form' => $form->createView(), 'listMedia' => $listMedia]);
    }
    /**
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
        return $this->render('@CTSKapsBundle/back/Selector.html.twig',
            ['form' => $form->createView(),
             'media'=> $media
            ]);
    }

    /**
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
       // 3. Execute scraping service and return an object array
        $scraping->executeScraping($url, $media);
        // 4. Persist results

        // 5. success message
        $this->addFlash('success', 'Le scraping est à jour pour ce média');
        // 6. Render twig file
        return $this->render('@CTSKapsBundle/back/scrap.html.twig');

    }
    /**
     * @route("/edit/{id}", name="Back_edit")
     */
    public function EditAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('CTSKapsBundle:Media')->find($id);



        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();
        }
        return $this->render('@CTSKapsBundle/back/edit.html.twig',
            ['form' => $form->createView(),
             'media'=> $media
            ]);
    }
    /**
     * @Route("/delete/{id}", name="Back_delete")
     */
    public function delete(Media $media, Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('CTSKapsBundle:Media')->find($id);
        $em->remove($media);
        $em->flush();
        $this->addFlash('success', 'Suppression réussie');

        return $this->redirectToRoute('Back_admin');
    }

    /**
     * @route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@CTSKapsBundle/back/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @route("/logout", name="logout")
     */
    public function logoutAction()
    {

        return $this->redirectToRoute('Front_home');
    }

}
