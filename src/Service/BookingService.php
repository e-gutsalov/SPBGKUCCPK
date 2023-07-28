<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Car;
use App\Entity\User;
use App\Repository\CarRepository;
use App\Repository\UserRepository;
use PHPUnit\Util\Exception;

class BookingService
{
    /**
     * @param CarRepository $carRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        private readonly CarRepository $carRepository,
        private readonly UserRepository $userRepository
    )
    {
    }

    /**
     * @param array $data
     * @return array
     */
    public function bookingCar(array $data): array
    {
        $car = $this->carRepository->find($data['carId']);
        $user = $this->userRepository->find($data['userId']);

        if (!$car instanceof Car) {
            throw new Exception('Запрашиваемая машина не найдена!');
        }

        if (!$user instanceof User) {
            throw new Exception('Пользователь не найден!');
        }

        $userStr = ($user->getPosition() ?? '') . ' ' . ($user->getName() ?? '') . ' ' . ($user->getSurname() ?? '');
        if ($user->getCar() instanceof Car) {
            throw new Exception("У пользователя $userStr, уже есть бронь на машину");
        }

        if ($car->getUser() instanceof User) {
            throw new Exception("Машина забронирована пользователем $userStr");
        }

        $car->setUser($user);
        $this->carRepository->flush();

        return [
            'booking' => true,
            'car' => ($car->getBrand() ?? '') . ' ' . ($car->getLicensePlate() ?? ''),
            'user' => $userStr
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function unbandCar(array $data): array
    {
        $car = $this->carRepository->find($data['carId']);

        if (!$car instanceof Car) {
            throw new Exception('Запрашиваемая машина не найдена!');
        }

        $car->setUser(null);
        $this->carRepository->flush();

        return [
            'unband' => true,
        ];
    }
}