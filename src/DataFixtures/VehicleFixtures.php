<?php

namespace App\DataFixtures;

use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleFixtures extends Fixture
{
    public const VEHICLES = [
        [
            'name' => 'Kitt',
            'brand' => 'moto',
            'model' => 'moto',
            'productYear' => 1920,
            'usedHour' => '10',
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
            $this->addReference('vehicle_' . $key, $vehicle);

            $manager->persist($vehicle);
        }
        $manager->flush();
    }
}
