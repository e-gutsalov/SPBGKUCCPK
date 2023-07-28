<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\CarService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/api/add/car', name: 'api_add_car')]
    public function addCar(Request $request, CarService $carService): JsonResponse
    {
        $response = new JsonResponse();

        try {
            $data = $request->toArray();

            if (!isset($data['brand'])) {
                throw new Exception('Не указан параметр brand');
            }

            if (!isset($data['license_plate'])) {
                throw new Exception('Не указан параметр license_plate');
            }

            $result = $carService->addCar($data);
            $response->setContent(json_encode($result));
            $response->headers->set('Content-Type', 'application/json');

        } catch (Exception $e) {
            $response->setContent(json_encode(['error' => $e->getMessage()]));
        }

        return $response;
    }
}
