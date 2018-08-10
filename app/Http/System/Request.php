<?php

namespace System;


use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\ParameterBag;

use Illuminate\Http\Request as BaseRequest;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use System\UID\UID;

class Request extends BaseRequest
{


    /**
     * Prepares the path info.
     *
     * @return string path info
     */
    protected function preparePathInfo()
    {
        $baseUrl = $this->getBaseUrl();

        if (null === ($requestUri = $this->getRequestUri())) {
            return '/';
        }

        // Remove the query string from REQUEST_URI
        if ($pos = strpos($requestUri, '?')) {
            $requestUri = substr($requestUri, 0, $pos);
        }

        $pathInfo = substr($requestUri, strlen($baseUrl));
        if (null !== $baseUrl && (false === $pathInfo || '' === $pathInfo)) {
            // If substr() returns false then PATH_INFO is set to an empty string
            return '/';
        } elseif (null === $baseUrl) {
            return $requestUri;
        }
        return (string)  UID::translator($pathInfo);
    }

    /**
     * Get the JSON payload for the request.
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    public function json($key = null, $default = null)
    {
        if (!isset($this->json)) {
            $content = UID::translator($this->getContent());
            $this->json = new ParameterBag((array)json_decode($content, true));
        }

        if (is_null($key)) {
            return $this->json;
        }

        return Arr::get($this->json->all(), $key, $default);
    }

    /**
     * Create an Illuminate request from a Symfony instance.
     *
     * @param  \Symfony\Component\HttpFoundation\Request $request
     * @return \Illuminate\Http\Request
     */
    public static function createFromBase(SymfonyRequest $request)
    {
        if ($request instanceof static) {
            return $request;
        }

        $content = $request->content;

        $query = UID::translator($request->query->all());

        $request = (new static)->duplicate(

            $query , $request->request->all(), $request->attributes->all(),

            $request->cookies->all(), $request->files->all(), $request->server->all()
        );

        $request->content = $content;

        $request->request = $request->getInputSource();

        return $request;
    }


}
