<?php

namespace App\Repository;

use App\Entity\pessoa;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method pessoa|null find($id, $lockMode = null, $lockVersion = null)
 * @method pessoa|null findOneBy(array $criteria, array $orderBy = null)
 * @method pessoa[]    findAll()
 * @method pessoa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class pessoaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, pessoa::class);
    }
}
