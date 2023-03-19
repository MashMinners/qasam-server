<?php

declare(strict_types=1);

namespace Application\ControlPanel\Controllers;

use Application\ControlPanel\Models\RatingRecordsManager;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RatingRecordsController
{
    public function __construct(private RatingRecordsManager $manager){}

    public function getAll(ServerRequestInterface $request) : ResponseInterface {
        $result = $this->manager->getAll();
        return new JsonResponse(($result));
    }

    public function getByEmployee(ServerRequestInterface $request) : ResponseInterface {
        $employeeId = file_get_contents('php://input');
        $result = $this->manager->getByEmployee($employeeId);
        return new JsonResponse(($result));
    }

    public function add(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $employeeId = $this->manager->insert($json);
        $response = (new JsonResponse($employeeId));
        return $response;
    }

    public function remove(ServerRequestInterface $request) : ResponseInterface {
        $result = $this->manager->delete('command');
        $response = (new JsonResponse($result));
        return $response;
    }

}