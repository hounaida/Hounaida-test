<?php declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\Manager\ReviewManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Service class for Review entities
 *
 * @author Hounaida ZANNOUN <hounaida.zannoun@gmail.com>
 */
class ReviewService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ReviewManager
     */
    private $reviewManager;

    /**
     * Constructor
     *
     * @param EntityManagerInterface $entityManager
     * @param ReviewManager $reviewManager
     */
    public function __construct(EntityManagerInterface $entityManager, ReviewManager $reviewManager)
    {
        $this->entityManager = $entityManager;
        $this->reviewManager = $reviewManager;
    }

    /**
     * Get specific reviews
     *
     * @param array $criteria
     *
     * @return array
     */
    public function findByCriteria(array $criteria = [])
    {
        $reviews = $this->reviewManager->findByCriteria($criteria);
        return $reviews;
    }
}