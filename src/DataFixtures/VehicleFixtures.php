<?php

namespace App\DataFixtures;

use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VehicleFixtures extends Fixture implements DependentFixtureInterface
{
    public const VEHICLES = [
        [
            'name' => 'Baptiste',
            'brand' => 'moto',
            'model' => 'Suzuki',
            'productYear' => 1920,
            'usedHour' => '5',
            'ownerReference' => 'contributor',
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::VEHICLES as $key => $vehicleData) {
            $vehicle = new Vehicle();
            $vehicle->setName($vehicleData['name']);
            $vehicle->setBrand($vehicleData['brand']);
            $vehicle->setModel($vehicleData['model']);
            $vehicle->setProductYear($vehicleData['productYear']);
            $vehicle->setUsedHour($vehicleData['usedHour']);
            $vehicle->setOwner($this->getReference($vehicleData['ownerReference']));
            $this->addReference('vehicle_' . $key, $vehicle);

            $manager->persist($vehicle);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
