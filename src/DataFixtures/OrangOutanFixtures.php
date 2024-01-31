<?php

namespace App\DataFixtures;

use App\Entity\OrangOutan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use DateTime;

class OrangOutanFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger)
    {
    }
    public const ORANGOUTANS = [
        [
            'name' => 'Pippa',
            'birth' => '2022/12/31',
            'story' => 'Orpheline pleine de vivacité, Pippa a été sauvée des mains des braconniers à l\'âge tendre 
            de trois mois. 
            Son caractère espiègle et sa joie de vivre sont contagieux, faisant d\'elle une source infinie de bonheur 
            pour ses compagnons de jeu au sein du centre de réhabilitation.',
            'picture' => 'pippa.6788f919.jpg',
        ],
        [
            'name' => 'Zara',
            'birth' => '2021/11/25',
            'story' => 'Anciennement victime de la déforestation, Zara a été recueillie après avoir perdu sa mère. 
            Son esprit indépendant et son intelligence impressionnante en font une candidate prometteuse pour la 
            réintroduction, une fois qu\'elle aura développé les compétences nécessaires.',
            'picture' => 'zara.8faf296d.jpg',
        ],
        [
            'name' => 'Milo',
            'birth' => '2021/09/20',
            'story' => 'Arrivé au refuge à seulement quelques mois, Milo a survécu à la destruction de sa forêt natale. 
            Sa douce timidité se mêle à une curiosité insatiable, reflétant la résilience innée de ces incroyables 
            primates confrontés à des débuts de vie difficiles.',
            'picture' => 'milo.1611868c.jpg',
        ],
        [
            'name' => 'Lila',
            'birth' => '2023/11/28',
            'story' => 'Née au sein du refuge, Lila est le symbole de l\'espoir et de la nouvelle vie 
            que Les Amis de la Forêt offrent.  
            Sa mère adoptive humaine, attentive et aimante, guide ses premiers pas dans un monde rempli de 
            découvertes.',
            'picture' => 'lila.737f31bc.jpg',
        ],
        [
            'name' => 'Oscar',
            'birth' => '2020/01/05',
            'story' => 'Rescapé d\'une tentative de trafic d\'animaux, Oscar a trouvé refuge après une période de 
            traumatisme. 
            Sa nature joueuse et sa capacité à tisser des liens profonds avec ses soigneurs témoignent de la 
            guérison possible, même après des débuts difficiles.',
            'picture' => 'oscar.c9b62b71.jpg',
        ],
        [
            'name' => 'Ravi',
            'birth' => '2023/07/31',
            'story' => 'Orphelin à la naissance, Ravi a trouvé une nouvelle famille aimante au refuge. 
            Ses explorations maladroites et son amour pour les câlins en font un petit être attachant, 
            symbolisant la nécessité de préserver les habitats naturels pour les générations futures.',
            'picture' => 'Ravi.6e152f82.jpg',
        ],
        [
            'name' => 'Kai',
            'birth' => '2018/10/16',
            'story' => 'Sauvé d\'un marché illégal d\'animaux exotiques, Kai a développé une forte connexion avec 
            les soigneurs qui l\'ont aidé à surmonter son passé difficile. 
            Son esprit joueur et son aptitude à apprendre font de lui un compagnon idéal pour les activités de 
            réhabilitation.',
            'picture' => 'kai.9aeb3efe.jpg',
        ],
        [
            'name' => 'Lulu',
            'birth' => '2019/08/03',
            'story' => 'Lulu, rescapée d\'une région touchée par la déforestation, a conservé un certain air 
            de mystère. 
            Son calme apparent cache une profonde sensibilité, faisant d\'elle une observatrice silencieuse de la 
            vie au sein du refuge.',
            'picture' => 'lulu.127fd99f.jpg',
        ],
        [
            'name' => 'Sofia',
            'birth' => '2013/09/26',
            'story' => 'Adulte et incapable de retourner en forêt en raison de blessures antérieures, Sofia est 
            devenue une matriarche protectrice pour les plus jeunes du refuge. 
            Son comportement attentionné et sa sagesse contribuent à maintenir une harmonie au sein de la communauté.',
            'picture' => 'Sofia.dd878535.jpg',
        ],
        [
            'name' => 'Raja',
            'birth' => '2011/12/31',
            'story' => 'Avec une expérience de vie variée, Raja est un autre adulte du refuge dont les compétences 
            en matière d\'adaptation sont précieuses. 
            Bien qu\'elle ne puisse pas être réintroduite, sa présence apporte stabilité et réconfort à ses compagnons 
            de refuge.',
            'picture' => 'pippa.6788f919.jpg',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ORANGOUTANS as $orangOutanFixture) {
            $orangOutan = new OrangOutan();
            $orangOutan->setName($orangOutanFixture['name']);
            $slug = $this->slugger->slug($orangOutanFixture['name']);
            $orangOutan->setSlug($slug);
            $birthDate = new DateTime($orangOutanFixture['birth']);
            $orangOutan->setBirth($birthDate);
            $orangOutan->setStory($orangOutanFixture['story']);
            $orangOutan->setPicture($orangOutanFixture['picture']);
            $manager->persist($orangOutan);

            $manager->flush();
        }
    }
}
