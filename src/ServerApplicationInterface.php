<?php

namespace Thruster\Component\ServerApplication;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Thruster\Component\Promise\ExtendedPromiseInterface;

/**
 * Interface ServerApplicationInterface
 *
 * @package Thruster\Component\ServerApplication
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
interface ServerApplicationInterface
{
    public function preloadApplication();

    /**
     * @param ServerRequestInterface $request
     *
     * @return ExtendedPromiseInterface A promise which will return ResponseInterface
     */
    public function processRequest(ServerRequestInterface $request) : ExtendedPromiseInterface;

    /**
     * @param array $headers
     * @param       $httpMethod
     * @param       $uri
     * @param       $protocolVersion
     *
     * @return ResponseInterface|null
     */
    public function processHead(array $headers, $httpMethod, $uri, $protocolVersion);
}
