<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\Editeur;
use App\Entity\Auteur;
use App\Entity\Livre;
use App\Factory\LivreFactory;
use App\Factory\AuteurFactory;
use App\Factory\CategorieFactory;
use App\Factory\EditeurFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
      // --- admin user ---
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin123'));
        // image du user
        $admin->setImage('admin.png');
        $manager->persist($admin);

        // --- catégories ---
        $c1 = (new Categorie())
            ->setDesignation('Informatique')
            ->setDescription('Dev & BD');
            
        $c2 = (new Categorie())
            ->setDesignation('Histoire')
            ->setDescription('...');
           
        $manager->persist($c1);
        $manager->persist($c2);

        // --- éditeurs ---
        $e1 = (new Editeur())
            ->setNomEditeur('OReilly')
            ->setPays('US')
            ->setAdresse('...')
            ->setTelephone('123456')
            ->setImage('oreilly.png');
        $e2 = (new Editeur())
            ->setNomEditeur('Dunod')
            ->setPays('FR')
            ->setAdresse('...')
            ->setTelephone('987654')
            ->setImage('dunod.png');
        $manager->persist($e1);
        $manager->persist($e2);

        // --- auteurs ---
        $a = (new Auteur())
            ->setPrenom('John')
            ->setNom('Doe')
            ->setBiographie('...')
            ->setImage('john_doe.png');
        $manager->persist($a);

        // --- livres ---
        $l = (new Livre())
            ->setTitre('Apprendre Symfony')
            ->setNbPages(300)
            ->setDateEdition(new \DateTime('2024-01-01'))
            ->setNbExemplaires(5)
            ->setPrix(29.9)
            ->setIsbn('978-123')
            ->setEditeur($e1)
            ->setCategorie($c1)
            ->setImage('symfony_book.png');
        $l->getAuteurs()->add($a);
        $manager->persist($l);

        $manager->flush();
    }
}
