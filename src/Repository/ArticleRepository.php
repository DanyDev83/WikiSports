<?php

namespace App\Repository;

use DateTimeImmutable;
use App\Entity\Article;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        $entity->setCreatedAt(new DateTimeImmutable('now'));
        $entity->setUpdatedAt(new DateTimeImmutable('now'));

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function randomArticles(array $articles): array
    {
        $array = $articles;
        shuffle($array);
        return array_slice($array, 0, 2);
    }
    public function listingArticle()
    {
        return $this->createQueryBuilder('a')
            ->getQuery()
            ->setMaxResults(5)
            ->getResult();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function countArticlesUser($user) {

        return $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->where('a.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function allCategoriesWithCountNbArticles() {
        return $this->createQueryBuilder('a')
            ->select('COUNT(a.id) AS nbArticles, c.name, c.id, c.description, c.urlPicture')
            ->innerJoin('a.category', 'c')
            ->groupBy('c.name, c.id, c.description, c.urlPicture')
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function lastArticle()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }

//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
