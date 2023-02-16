<?php

namespace App\Repository;

use App\Entity\produto;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method produto|null find($id, $lockMode = null, $lockVersion = null)
 * @method produto|null findOneBy(array $criteria, array $orderBy = null)
 * @method produto[]    findAll()
 * @method produto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class produtoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, produto::class);
    }
}
