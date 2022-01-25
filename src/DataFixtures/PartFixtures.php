<?php

namespace App\DataFixtures;

use App\Entity\Part;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PartFixtures extends Fixture implements DependentFixtureInterface
{
    public const PARTS = [
        [
            'name' => 'Batterie',
            'lifespan' => 10,
            'vehicleReference' => 'vehicle_0',
            'partUseTime' => '0.00',
        ],
        [
            'name' => 'Echap',
            'lifespan' => 65,
            'vehicleReference' => 'vehicle_0',
            'partUseTime' => '0.00',
        ],
        [
            'name' => 'Pneu avant',
            'lifespan' => 5,
            'vehicleReference' => 'vehicle_0',
            'partUseTime' => '0.00',
        ],
        [
            'name' => 'Frein à main',
            'lifespan' => 23,
            'vehicleReference' => 'vehicle_0',
            'partUseTime' => '0.00',
        ],
        [
            'name' => 'Pédale de frein',
            'lifespan' => 35,
            'vehicleReference' => 'vehicle_0',
            'partUseTime' => '0.00',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PARTS as $partData) {
            $part = new Part();
            $part->setName($partData['name']);
            $part->setLifespan($partData['lifespan']);
            $part->setPartUseTime($partData['partUseTime']);
            $part->setVehicle(
                $this->getReference($partData['vehicleReference'])
            );

            $manager->persist($part);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            VehicleFixtures::class,
        ];
    }
}
