<?php 

namespace tests\Fonctional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * ProductControllerTest
 *
 * @author Hounaida ZANNOUN <hounaida.zannoun@gmail.com>
 */
class ProductControllerTest extends WebTestCase
{
    public function testGetAll()
    {
        $client = static::createClient();

        $client->request('GET', '/products');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testFindByCategory()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $product = $em->getRepository("AppBundle:Product")->findOneBy([]);
        $client->request('GET', '/search-product/'.$product->getId());

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}