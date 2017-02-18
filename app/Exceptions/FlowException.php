<?php

namespace App\Exceptions;

use League\Flysystem\Exception;
use Illuminate\Http\JsonResponse;

class FlowException extends Exception
{
    /**
     * The recommended response to send to the client.
     *
     * @var \Symfony\Component\HttpFoundation\Response|null
     */
    public $response;

    /**
     * Create a new exception instance.
     *
     * @param  array  $message
     * @return void
     */
    public function __construct(array $message, $code)
    {
        parent::__construct('Terjadi Kesalahan.');

        $this->response = new JsonResponse($message, $code);
    }

    /**
     * Get the underlying response instance.
     *
     * @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}
