<?php


namespace AnomaliesBundle\Entity;
//use Symfony\Bridge\Doctrine\Security\User\EntityUserProvider;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\ORM\EntityRepository;


//class UserRepository extends EntityRepository implements UserProviderInterface{
//   public function loadUserByUsername($param){
//       return $this->createQueryBuilder("u")
//            ->where("username = :username OR email = :email")
//            ->setParameter("username", $param)
//            ->setParameter("email", $param)  
//            ->getQuery()
//            ->getOneOrNullResult();
//   }
//
//    public function refreshUser(\Symfony\Component\Security\Core\User\UserInterface $user) {
//        
//    }
//
//    public function supportsClass($class) {
//        
//    }
//
////    public function refreshUser(\Symfony\Component\Security\Core\User\UserInterface $user) {
////        
////    }
////
////    public function supportsClass($class) {
////        
////    }
//
//}
