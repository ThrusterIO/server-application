<?php

namespace Thruster\Component\ServerApplication;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Thruster\Component\Promise\ExtendedPromiseInterface;
use Thruster\Component\Promise\FulfilledPromise;
use Thruster\Component\Promise\RejectedPromise;

/**
 * Class SynchronousServerApplication
 *
 * @package Thruster\Component\ServerApplication
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
abstract class SynchronousServerApplication implements ServerApplicationInterface
{
    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    abstract public function processRequestSynchronously(ServerRequestInterface $request) : ResponseInterface;

    /**
     * @inheritDoc
     */
    public function processRequest(ServerRequestInterface $request) : ExtendedPromiseInterface
    {
        try {
            $response = $this->processRequestSynchronously($request);

            return new FulfilledPromise($response);
        } catch (\Throwable $e) {
            return new RejectedPromise($e);
        }
    }

    /**
     * @inheritDoc
     */
    public function processHead(array $headers, $httpMethod, $uri, $protocolVersion)
    {
    }
}
