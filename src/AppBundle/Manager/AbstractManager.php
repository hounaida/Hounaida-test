<?php declare(strict_types=1);

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;

/**
 * AbstractManager
 *
 * @author Hounaida ZANNOUN <hounaida.zannoun@gmail.com>
 */
abstract class AbstractManager
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
        $this->em = $em;
        $this->entityClass = $entityClass;
    }

    /**
     * List all
     *
     * @return array
     */
    public function getAll()
    {
        return $this->em->getRepository($this->entityClass)->findProduct();
    }

    /**
     *  Get specific
     * @param array @criteria
     *
     * @return array
     */
    public function findByCriteria($criteria)
    {
        return $this->em->getRepository($this->entityClass)->findBy($criteria);
    }
}