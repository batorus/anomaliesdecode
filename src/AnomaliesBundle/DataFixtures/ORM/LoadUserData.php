<?php
namespace AnomaliesBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AnomaliesBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface{
    
    private $container;
    
    public function load(ObjectManager $manager) {
        $user = new User();
        $user->setUsername("admin");
        $user->setEmail("admin@admin.com");
        $encoder = $this->container->get("security.password_encoder");
        $password = $encoder->encodePassword($user, "1234");
        $user->setPassword($password);
        
        $manager->persist($user);
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

}

