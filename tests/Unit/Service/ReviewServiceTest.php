<?php 

namespace tests\Unit\Service;

use AppBundle\Manager\ReviewManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * ReviewServiceTest
 *
 * @author Hounaida ZANNOUN <hounaida.zannoun@gmail.com>
 */
class ReviewServiceTest extends WebTestCase
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

    public function testFindByCriteria()
    {
        $reviewManager= new ReviewManager($this->em);
        $product = $this->em->getRepository("AppBundle:Product")->findOneBy([]);
        $reviews = $reviewManager->findByCriteria(['product' => $product->getId()]);

        $this->assertNotNull($reviews);
    }
}