<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
    private $passwordEncoder;
   

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;

    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setNom("Ibrahim");
        $user->setPrenom("Ahamada");
        $user->setEmail("admin@gmail.com");
        $user->setSex("M");
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $user->setDateNaiss(new \DateTime());
        $user->setLieuNaiss("Dakar");
        $user->setDateCreation(new \DateTime());
        $user->setTel("+221 77 823 63 34");
        $user->setPassword($this->passwordEncoder->encodePassword(
                            $user,
                            'admin'
                        ));
                        
         
        // $user->setPassword($this->passwordEncoder->encodePassword(
        //                 $user,
        //                 'the_new_password'
        //             ));
        $manager->persist($user);
        $manager->flush();
    }
}
