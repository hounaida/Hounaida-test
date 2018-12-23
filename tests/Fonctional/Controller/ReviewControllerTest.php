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

        $client->request('GET', '/reviews/501');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}