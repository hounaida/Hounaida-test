<?php declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Service\ReviewService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * ReviewController
 *
 * @author Hounaida ZANNOUN <hounaida.zannoun@gmail.com>
 */
class ReviewController extends Controller
{
    /**
     * @Route("/reviews/{idProduct}", name="reviews_by_product")
     * @param ReviewService $reviewService
     * @param int $idProduct
     *
     */
    public function findByProductAction(ReviewService $reviewService, $idProduct)
    {
        $reviews = $reviewService->findByCriteria(["product" => $idProduct]);
        if($reviews === null){
            throw $this->createNotFoundException('Review does not exist');
        }

        return $this->render('AppBundle:Review:list.html.twig', array('reviews' => $reviews,'productName'=> reset($reviews)->getProduct()->getProductName()));
    }
}
