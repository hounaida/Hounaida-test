<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\Review;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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

            $categoryData = $this->createCategory($object, $arrayCategory, $manager);
            $arrayCategory = reset($categoryData);

            $product->setCategory($this->getReference('_'.end($categoryData).'_'));
            $manager->persist($product);
            $this->addReference('_product'.$key.'_', $product);

            //create review
            $this->createReview($object, $key, $manager);
        }
        $manager->flush();
    }


    /**
     * createCategory
     * @param $object
     * @param array $arrayCategory
     * @param ObjectManager $manager
     *
     * @return array
     */
    private function createCategory($object, array $arrayCategory, $manager)
    {
        $categoryName = $object['category'];
        if (!in_array($categoryName, $arrayCategory)) {
            //create category
            $category = new Category();
            $category->setName($object['category']);
            $manager->persist($category);
            $this->addReference('_'.$categoryName.'_', $category);
            array_push($arrayCategory, $categoryName);
        }

        return [$arrayCategory, $categoryName];
    }

    /**
     * createReview
     * @param $object
     * @param int $key
     * @param ObjectManager $manager
     *
     * @return Review
     */
    private function createReview($object, $key, $manager)
    {
        foreach ($object['reviews'] as $objectReview)
        {
            $review = new Review();
            $review->setContent($objectReview['content']);
            $review->setRating($objectReview['rating']);
            $review->setProduct($this->getReference('_product'.$key.'_'));
            $manager->persist($review);
        }
    }
}
