<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\UserService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/add/user', name: 'api_add_user')]
    public function addUser(Request $request, UserService $userService): JsonResponse
    {
        $response = new JsonResponse();

        try {
            $data = $request->toArray();

            if (!isset($data['name'])) {
                throw new Exception('Не указан параметр name');
            }

            if (!isset($data['surname'])) {
                throw new Exception('Не указан параметр surname');
            }

            if (!isset($data['position'])) {
                throw new Exception('Не указан параметр position');
            }

            $result = $userService->addUser($data);
            $response->setContent(json_encode($result));
            $response->headers->set('Content-Type', 'application/json');

        } catch (Exception $e) {
            $response->setContent(json_encode(['error' => $e->getMessage()]));
        }

        return $response;
    }
}
