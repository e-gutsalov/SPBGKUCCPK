<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Car;
use App\Repository\CarRepository;

class CarService
{
    /**
     * @param CarRepository $carRepository
     */
    public function __construct(
        private readonly CarRepository $carRepository
    )
    {
    }

    /**
     * @param array $data
     * @return true[]
     */
    public function addCar(array $data): array
    {
        $car = (new Car())
            ->setBrand($data['brand'])
            ->setLicensePlate($data['license_plate']);

        $this->carRepository->add($car);

        return ['addCar' => true];
    }
}