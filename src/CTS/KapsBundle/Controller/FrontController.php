<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 19/10/2018
 * Time: 18:36
 */

namespace CTS\KapsBundle\Controller;


use CTS\KapsBundle\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CTS\KapsBundle\Services\Scraping;
use CTS\KapsBundle\Entity\Tag;



class FrontController extends Controller
{
    /**
     * @route("/", name="Front_home")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $medias = $em->getRepository('CTSKapsBundle:Media')->findLast();
        //$medias = $repository->findLast();
        return $this->render('@CTSKapsBundle/front/index.html.twig', [
            'medias' => $medias,
         ]);
    }

    /**
     * @route("/medias", name="Front_medias")
     */
    public function showAllMediasAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $medias = $em->getRepository('CTSKapsBundle:Media')->findAll();
        return $this->render('@CTSKapsBundle/front/medias.html.twig', [
            'medias' => $medias
        ]);

    }

    /**
     * @route("/media/{id}", name="Front_oneMedia")
     */
    public function showMediaAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('CTSKapsBundle:Media')->find($id);
        $articles = $em->getRepository('CTSKapsBundle:Article')->findAll($media);
        $picture =$media->getPicture();

        return $this->render('@CTSKapsBundle/front/media.html.twig', [
            'media' => $media,
            'picture' => $picture,
            'articles' => $articles
        ]);
    }

    /**
     * @route("/article", name="Front_showArticles")
     */
    public function showArticle()
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('CTSKapsBundle:Article')->find(217);

        foreach($article->getTags() as $tag)
        {
            echo $tag->getName();
        }
        exit();
        $tag = $em->getRepository('CTSKapsBundle:Tag')->findOneBy(['name' => 'espace']);
        //var_dump($tag);
        foreach($tag->getArticles() as $article)
        {
            echo $article->getTitle();
        }
        //var_dump($article->getTags());

    }
    /**
     * @route("/search", name="Front_search")
     */
    public function searchAction()
    {
        return $this->render('@CTSKapsBundle/front/search.html.twig');
    }

    /**
     * @route("/contact", name="Front_contact")
     */
    public function contactAction()
    {
        return $this->render('@CTSKapsBundle/front/contact.html.twig');
    }

    /**
     * @route("/pickup", name="Front_pickup")
     */
    public function pickupAction()
    {
        return new Response ("la page des capsules thematiques");
    }

    /**
     * @route("/contribute", name="Front_contribute")
     */
    public function contributeAction()
    {
        return $this->render('@CTSKapsBundle/front/contribute.html.twig');
    }

}