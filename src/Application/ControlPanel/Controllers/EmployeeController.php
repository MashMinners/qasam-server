<?php

declare(strict_types=1);

namespace Application\ControlPanel\Controllers;

use Application\ControlPanel\Models\EmployeeManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EmployeeController
{
    public function __construct(EmployeeManager $manager){

    }

    public function show(ServerRequestInterface $request) : ResponseInterface {

    }

    public function create(ServerRequestInterface $request) : ResponseInterface {

    }

    public function edit(ServerRequestInterface $request) : ResponseInterface {

    }

    public function delete(ServerRequestInterface $request) : ResponseInterface {

    }

}