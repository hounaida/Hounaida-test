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
        $reviews = $reviewManager->findByCriteria(['product' => '501']);

        $this->assertEquals('501', reset($reviews)->getProduct()->getId());
    }

}