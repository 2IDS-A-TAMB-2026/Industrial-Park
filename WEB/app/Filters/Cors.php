<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Cors implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {
        if ($request->getMethod() === 'OPTIONS') {
            return service('response')
                ->setStatusCode(200)
                ->setHeader('Access-Control-Allow-Origin', '*')
                ->setHeader(
                    'Access-Control-Allow-Methods',
                    'GET, POST, PUT, DELETE, OPTIONS'
                )
                ->setHeader(
                    'Access-Control-Allow-Headers',
                    'Content-Type, Authorization, Accept'
                );
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        $response->setHeader(
            'Access-Control-Allow-Origin',
            '*'
        );

        $response->setHeader(
            'Access-Control-Allow-Methods',
            'GET, POST, PUT, DELETE, OPTIONS'
        );

        $response->setHeader(
            'Access-Control-Allow-Headers',
            'Content-Type, Authorization, Accept'
        );

        return $response;
    }
}