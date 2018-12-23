<?php 

namespace tests\Unit\Service;

use AppBundle\Manager\ProductManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * ProductServiceTest
 *
 * @author Hounaida ZANNOUN <hounaida.zannoun@gmail.com>
 */
class ProductServiceTest extends kernelTestCase
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this->container = self::$kernel->getContainer();
        $this->em = $this->container->get('doctrine.orm.entity_manager');
    }

    public function testGetAll()
    {
        $productManager= new ProductManager($this->em);
        $products = $productManager->getAll();

        $this->assertNotNull(sizeof($products));
    }

    public function testFindByCategory()
    {
        $productManager= new ProductManager($this->em);
        $category = $this->em->getRepository("AppBundle:Category")->findOneBy([]);
        $products = $productManager->findByCriteria(['category' => $category->getId()]);

        $this->assertNotNull($products);
    }
}