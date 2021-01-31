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
        for ($i=0; $i < 5; $i++) { 
            $user->setEmail("Ibrahim@gmail.com");
            $user->setPassword('ibrahim');
            
        }
        // $user->setPassword($this->passwordEncoder->encodePassword(
        //                 $user,
        //                 'the_new_password'
        //             ));
        $manager->persist($user);
        $manager->flush();
    }
}
