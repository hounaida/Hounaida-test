<?php declare(strict_types=1);

namespace AppBundle\Manager;

use AppBundle\Entity\Review;
use AppBundle\Manager\AbstractManager as AbstractManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * ReviewManager
 *
 * @author Hounaida ZANNOUN <hounaida.zannoun@gmail.com>
 */
class ReviewManager extends AbstractManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var string
     */
    private $entityClass;

    /**
     * Constructor
     * @param EntityManagerInterface $em
     * @param string $entityClass
     */
    public function __construct(EntityManagerInterface $em, $entityClass = '')
    {
        parent::__construct($em, Review::class);
    }
}