<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\Review;

/**
 * LoadFixtureData
 *
 * @author Hounaida ZANNOUN <hounaida.zannoun@gmail.com>
 */
class LoadFixtureData extends AbstractFixture
{

    public function load(ObjectManager $manager)
    {
        $arrayCategory = [];
        $url = "http://internal.ats-digital.com:3066/api/products";
        $contents = file_get_contents($url);
        $contents = utf8_encode($contents);
        $json = json_decode($contents, true);
        foreach ($json as $key=>$object) {
            //Create product
            $product = new Product();
            $product->setProductName($object['productName']);
            $product->setBasePrice($object['basePrice']);
            $product->setBrand($object['brand']);
            $product->setProductMaterial($object['productMaterial']);
            $product->setImageUrl($object['imageUrl']);
            $product->setDelivery(new \DateTime($object['delivery']));
            $product->setDetails($object['details']);

            $categoryName = $object['category'];
            if (!in_array($categoryName, $arrayCategory)) {
                //create category
                $category = new Category();
                $category->setName($object['category']);
                $manager->persist($category);
                $this->addReference('_'.$categoryName.'_', $category);
                array_push($arrayCategory, $categoryName);
            }
            $product->setCategory($this->getReference('_'.$categoryName.'_'));
            $manager->persist($product);
            $this->addReference('_product'.$key.'_', $product);

            //create review
            foreach ($object['reviews'] as $objectReview)
            {
                $review = new Review();
                $review->setContent($objectReview['content']);
                $review->setRating($objectReview['rating']);
                $review->setProduct($this->getReference('_product'.$key.'_'));
                $manager->persist($review);
            }
        }
        $manager->flush();
    }
}
