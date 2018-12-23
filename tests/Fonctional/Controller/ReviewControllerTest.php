<?php 

namespace tests\Fonctional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * ReviewControllerTest
 *
 * @author Hounaida ZANNOUN <hounaida.zannoun@gmail.com>
 */
class ReviewControllerTest extends WebTestCase
{
    public function testGetAll()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $review = $em->getRepository("AppBundle:Review")->findOneBy([]);
        $client->request('GET', '/reviews/'.$review->getId());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}