<?php declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Service\ProductService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ProductController
 *
 * @author Hounaida ZANNOUN <hounaida.zannoun@gmail.com>
 */
class ProductController extends Controller
{
    /**
     * @Route("/products", name="products")
     * @param ProductService $productService
     *
     */
    public function getAllAction(ProductService $productService)
    {
        $products = $productService->getAll();
        return $this->render('AppBundle:Product:list.html.twig', $products);
    }

    /**
     * @Route("/search-product/{idCategory}", name="search_product")
     * @param ProductService $productService
     * @param int $idCategory
     *
     * @return JsonResponse
     */
    public function findByCategory(ProductService $productService, int $idCategory)
    {
        $products = $productService->findByCriteria(array('category'=> $idCategory));
        $serializer = $this->get('jms_serializer');
        $products = $serializer->serialize($products, 'json');
        return new JsonResponse($products);
    }
}
