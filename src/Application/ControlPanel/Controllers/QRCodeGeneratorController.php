<?php

declare(strict_types=1);

namespace Application\ControlPanel\Controllers;

use Application\ControlPanel\Models\QRCodeGenerator;
use Psr\Http\Message\ServerRequestInterface;

class QRCodeGeneratorController
{
    public function __construct(private QRCodeGenerator $generator){

    }

    public function index(ServerRequestInterface $request){
        $this->generator->generate();
    }

}