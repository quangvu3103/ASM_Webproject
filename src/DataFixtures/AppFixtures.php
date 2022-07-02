<?php

namespace App\DataFixtures;
use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $ecnoder;

    public function __construct(UserPasswordEncoderInterface $ecnoder)
    {
        $this->encoder =$ecnoder;
    }

    public function load(ObjectManager $manager)
    {

        // create 20 products! Bam!
            $admin = new Admin();
            $admin->setEmail('admin@gmail.com');    
            $admin->setRoles(["ROLE_USER"]);
            $admin->setPassword($this -> encoder ->encodePassword($admin,'adminmm'));

            $manager->persist($admin);
        $manager->flush();
    }
}
