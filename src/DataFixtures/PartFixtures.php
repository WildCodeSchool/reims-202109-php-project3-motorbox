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
            'name' => 'Battery',
            'lifespan' => 10,
            'vehicleReference' => 'vehicle_0',
        ],
        [
            'name' => 'Gas tank',
            'lifespan' => 10,
            'vehicleReference' => 'vehicle_0',
        ],
        [
            'name' => 'Front tire',
            'lifespan' => 10,
            'vehicleReference' => 'vehicle_0',
        ],
        [
            'name' => 'Handle Bar',
            'lifespan' => 10,
            'vehicleReference' => 'vehicle_0',
        ],
        [
            'name' => 'Brake pedal',
            'lifespan' => 10,
            'vehicleReference' => 'vehicle_0',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PARTS as $partData) {
            $part = new Part();
            $part->setName($partData['name']);
            $part->setLifespan($partData['lifespan']);
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
