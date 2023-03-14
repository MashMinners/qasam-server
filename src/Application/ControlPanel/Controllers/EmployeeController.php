<?php

declare(strict_types=1);

namespace Application\ControlPanel\Controllers;

use Application\Collector\Models\Employee;
use Application\ControlPanel\Models\EmployeeManager;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EmployeeController
{
    public function __construct(private EmployeeManager $manager){

    }

    public function get(ServerRequestInterface $request) : ResponseInterface {
        $employeeId = file_get_contents('php://input');
        $result = $this->manager->getEmployee($employeeId);
        return new JsonResponse(($result));
    }

    public function getAll(ServerRequestInterface $request) : ResponseInterface {
        $result = $this->manager->getEmployees();
        return new JsonResponse($result);
    }

    public function getByFullName(ServerRequestInterface $request) : ResponseInterface {
        $search = file_get_contents('php://input');
        $result = $this->manager->getEmployeeByFullName($search);
        return new JsonResponse($result);
    }

    public function add(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $employeeId = $this->manager->insert(new Employee($json));
        $response = (new JsonResponse($employeeId));
        return $response;
    }

    public function save(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $result = $this->manager->update(new Employee($json));
        $response = (new JsonResponse($result));
        return $response;
    }

    public function remove(ServerRequestInterface $request) : ResponseInterface {
        $json = file_get_contents('php://input');
        $result = $this->manager->delete($json);
        $response = (new JsonResponse($result));
        return $response;
    }

}