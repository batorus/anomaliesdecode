<?php
namespace AnomaliesBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AnomaliesBundle\Entity\User;
use AnomaliesBundle\Entity\Typecontrole;
use AnomaliesBundle\Entity\Typesociete;
use AnomaliesBundle\Entity\Typetaches;

class LoadUserData implements FixtureInterface, ContainerAwareInterface{
    
    private $container;
    
    public function load(ObjectManager $manager) {
//        $user = new User();
//        $user->setUsername("sadmin");
//        $user->setEmail("sadmin@sadmin.com");
//        $encoder = $this->container->get("security.password_encoder");
//        $password = $encoder->encodePassword($user, "1234");
//        $user->setPassword($password);
//        $user->addRole('ROLE_SUPER_ADMIN');
//        $user->setEnabled(true);
//        $manager->persist($user);
//        $manager->flush();
//        
//        $user = new User();
//        $user->setUsername("admin");
//        $user->setEmail("admin@admin.com");
//        $encoder = $this->container->get("security.password_encoder");
//        $password = $encoder->encodePassword($user, "1234");
//        $user->setPassword($password);
//        $user->addRole('ROLE_ADMIN');
//        $user->setEnabled(true);
//        $manager->persist($user);
//        $manager->flush();
//        
//        $user = new User();
//        $user->setUsername("user");
//        $user->setEmail("user@user.com");
//        $encoder = $this->container->get("security.password_encoder");
//        $password = $encoder->encodePassword($user, "1234");
//        $user->setPassword($password);
//        $user->addRole('ROLE_USER_DEFAULT');
//        $user->setEnabled(true);
//        $manager->persist($user);
//        $manager->flush();
//        
//        $user = new User();
//        $user->setUsername("normaluser");
//        $user->setEmail("normaluser@normaluser.com");
//        $encoder = $this->container->get("security.password_encoder");
//        $password = $encoder->encodePassword($user, "1234");
//        $user->setPassword($password);
//        $user->addRole('ROLE_USER_DEFAULT');
//        $user->setEnabled(true);
//        $manager->persist($user);
//        $manager->flush();
               
//        $tc = new Typecontrole();
//        $tc->setTypecontrole("Typecontrole 9");
//        $tc->setEnabled(true);
//        $manager->persist($tc);
//        $manager->flush();
        
//        $tc = new Typesociete();
//        $tc->setTypesociete("Typesociete 5");
//        $tc->setEnabled(true);
//        $manager->persist($tc);
//        $manager->flush(); 
        
        $tc = new Typetaches();
        $tc->setTypetache("Typetaches 1");
        $tc->setEnabled(true);
        $manager->persist($tc);
        $manager->flush();        
        
        $tc = new Typetaches();
        $tc->setTypetache("Typetaches 2");
        $tc->setEnabled(true);
        $manager->persist($tc);
        $manager->flush();
        
        $tc = new Typetaches();
        $tc->setTypetache("Typetaches 3");
        $tc->setEnabled(true);
        $manager->persist($tc);
        $manager->flush();
        
        $tc = new Typetaches();
        $tc->setTypetache("Typetaches 4");
        $tc->setEnabled(true);
        $manager->persist($tc);
        $manager->flush();       
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

}

