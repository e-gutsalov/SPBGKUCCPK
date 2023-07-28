<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\BookingService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookCarController extends AbstractController
{
    #[Route('/api/book/car', name: 'api_book_car')]
    public function toBook(Request $request, BookingService $bookingService): Response
    {
        $response = new JsonResponse();

        try {
            $data = $request->toArray();

            if (!isset($data['userId'])) {
                throw new Exception('Не указан параметр userId');
            }

            if (!isset($data['carId'])) {
                throw new Exception('Не указан параметр carId');
            }

            $result = $bookingService->bookingCar($data);
            $response->setContent(json_encode($result));
            $response->headers->set('Content-Type', 'application/json');

        } catch (Exception $e) {
            $response->setContent(json_encode(['error' => $e->getMessage()]));
        }

        return $response;
    }

    #[Route('/api/unband/car', name: 'api_unband_car')]
    public function unband(Request $request, BookingService $bookingService): Response
    {
        $response = new JsonResponse();

        try {
            $data = $request->toArray();

            if (!isset($data['carId'])) {
                throw new Exception('Не указан параметр carId');
            }

            $result = $bookingService->unbandCar($data);
            $response->setContent(json_encode($result));
            $response->headers->set('Content-Type', 'application/json');

        } catch (Exception $e) {
            $response->setContent(json_encode(['error' => $e->getMessage()]));
        }

        return $response;
    }
}
