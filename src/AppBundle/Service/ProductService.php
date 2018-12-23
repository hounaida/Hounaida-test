<?php declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\Manager\ProductManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface as Paginator;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Service class for Product entities
 *
 * @author Hounaida ZANNOUN <hounaida.zannoun@gmail.com>
 */
class ProductService
{
    /**
     * @var ProductManager
     */
    private $productManager;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * Constructor
     *
     * @param Paginator $paginator
     * @param ProductManager $productManager
     * @param EntityManagerInterface $entityManager
     * @param RequestStack $requestStack
     */
    public function __construct(Paginator $paginator, ProductManager $productManager, EntityManagerInterface $entityManager, RequestStack $requestStack)
    {
        $this->productManager = $productManager;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->paginator = $paginator;
    }

    /**
     * List all products
     *
     * @return array
     */
    public function getAll()
    {
        $products = $this->productManager->getAll();
        $products = $this->paginator->paginate($products, $this->requestStack->getCurrentRequest()->query->getInt('page',1), 20);

        $categoryList =  $this->entityManager->getRepository("AppBundle:Category")->findAll();
        return array('products' => $products, 'categoryList' => $categoryList);
    }

    /**
     * Get specific products
     * @param array $criteria
     *
     * @return array
     */
    public function findByCriteria(array $criteria = [])
    {
        $products = $this->productManager->findByCriteria($criteria);
        return $products;
    }

}