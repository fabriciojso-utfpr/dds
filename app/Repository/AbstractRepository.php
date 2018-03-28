<?php

namespace DDS\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use LaravelDoctrine\ORM\Facades\EntityManager;

abstract class AbstractRepository extends EntityRepository {

    protected $em;
    protected $class = null;

    private function getClass(){
        return $this->class;
    }

    public function __construct() {
        parent::__construct(app('em'), EntityManager::getClassMetadata($this->getClass()));
        $this->em = $this->getEntityManager();
    }

    public function save(object $entity){
        if($this->em()->getUnitOfWork()->getEntityState($entity) == $this->em()->getUnitOfWork()::STATE_NEW) {
            $this->getEntityManager()->persist($entity);
        }
        $this->getEntityManager()->flush();
    }

    private function em(){
        return $this->em;
    }


}