<?php
/**
 * Created by PhpStorm.
 * User: mishi
 * Date: 19/10/2018
 * Time: 18:36
 */

namespace CTS\KapsBundle\Controller;


use CTS\KapsBundle\Entity\Picture;
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
     * @route("/medias/{direction}", name="Front_medias", defaults={"direction"=null})
     */
    public function showAllMediasAction(Request $request, $direction)
    {
        $em = $this->getDoctrine()->getManager();
        if($direction==null) $direction = 'ASC';
        $medias = $em->getRepository('CTSKapsBundle:Media')->findBy([], ['name'=> $direction]);
        $universes = $em->getRepository('CTSKapsBundle:Media')->findUniverses();
        $nameAZ = $em->getRepository('CTSKapsBundle:Media')->sortByNameAZ();

        return $this->render('@CTSKapsBundle/front/medias.html.twig', [
            'medias' => $medias,
            'universes' => $universes,
            'nameAZ' => $nameAZ
        ]);
    }

    /**
     * @route("/media/{id}/{page}", name="Front_oneMedia", requirements={"page"="\d+"})
     *
     */
    public function showMediaAction(Request $request, $id, $page = 1)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('CTSKapsBundle:Media')->find($id);
        $picture =$media->getPicture();

        $pagination = $this->get('cts_kaps.Paginator');
        $pagination = $pagination->paginate($media, $page);

        return $this->render('@CTSKapsBundle/front/media.html.twig', [
            'media' => $media,
            'picture' => $picture,
            'pagination' => $pagination
        ]);
    }

    /**
 * @route("/search", name="Front_search")
 */
    public function searchAction(Request $request)
    {

        return $this->render('@CTSKapsBundle/front/search.html.twig');
    }
    /**
     * @route("/ajax", name="Front_ajax")
     */
    public function ajaxAction(Request $request)
    {

            $data=$request->request->get('search');
            $em = $this->getDoctrine()->getManager();
            $results = $em->getRepository('CTSKapsBundle:Article')->findArticleWith($data);
            return $this->render('@CTSKapsBundle/front/ajax.html.twig', [
                'results' => $results
            ]);


    }

    /**
     * @route("/contact", name="Front_contact")
     */
    public function contactAction()
    {
        return $this->render('@CTSKapsBundle/front/contact.html.twig');
    }


    /**
     * @route("/contribute", name="Front_contribute")
     */
    public function contributeAction()
    {
        return $this->render('@CTSKapsBundle/front/contribute.html.twig');
    }

}