<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 19/10/2018
 * Time: 18:36
 */

namespace CTS\KapsBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use CTS\KapsBundle\Services\Scraping;



class FrontController extends Controller
{
    /**
     * Matches /
     *
     * @route("/", name="Front_home")
     */
    public function indexAction()
    {
        return $this->render('@CTSKapsBundle/front/index.html.twig');
    }

    /**
     * Matches /medias
     *
     * @route("/medias", name="Front_medias")
     */
    public function discoverAction(Request $request)
    {
        return $this->render('@CTSKapsBundle/front/media.html.twig');

    }

    /**
     * Matches /medias/articles
     *
     * @route("/medias/articles", name="Front_articles")
     */
    public function discoverArticlesAction()
    {
        return $this->render('@CTSKapsBundle/front/article.html.twig');
    }

    /**
     * Matches /search
     *
     * @route("/search", name="Front_search")
     */
    public function searchAction()
    {
        return $this->render('@CTSKapsBundle/front/search.html.twig');
    }

    /**
     * Matches /contact
     *
     * @route("/contact", name="Front_contact")
     */
    public function contactAction()
    {
        return $this->render('@CTSKapsBundle/front/contact.html.twig');
    }

    /**
     * Matches /pickup
     *
     * @route("/pickup", name="Front_pickup")
     */
    public function pickupAction()
    {
        return new Response ("la page des capsules thematiques");
    }

    /**
     * Matches /contribute
     *
     * @route("/contribute", name="Front_contribute")
     */
    public function contributeAction()
    {
        return $this->render('@CTSKapsBundle/front/contribute.html.twig');
    }

}