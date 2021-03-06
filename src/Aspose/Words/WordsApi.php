<?php
/*
 * --------------------------------------------------------------------------------
 * <copyright company="Aspose" file="WordsApi.php">
 *   Copyright (c) 2020 Aspose.Words for Cloud
 * </copyright>
 * <summary>
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 * 
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 * 
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 * </summary>
 * --------------------------------------------------------------------------------
 */

namespace Aspose\Words;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Aspose\Words\Model\Requests;

/*
 * WordsApi Aspose.Words for Cloud API.
 */
class WordsApi
{
    /*
     * Stores client instance
     * @var ClientInterface client for calling api
     */
    protected $client;

    /*
     * Stores configuration
     * @var Configuration configuration info
     */
    protected $config;

    /*
     * Initialize a new instance of WordsApi
     * @param string   $clientId client sid
     * @param string   $clientSecret client secret
     * @param string   $baseUrl base url for requests
     */
    public function __construct(string $clientId, string $clientSecret)
    {
        if (!isset($clientId) || trim($clientId) === '') {
            throw new ApiException('clientId could not be an empty string.');
        }

        if (!isset($clientSecret) || trim($clientSecret) === '') {
            throw new ApiException('clientSecret could not be an empty string.');
        }

        $this->client = new Client();
        $this->config = new Configuration($clientId, $clientSecret);
    }

    /*
     * Gets the config
     * @return Configuration
     */
    public function getConfig() 
    {
        return $this->config;
    }

    /*
     * Operation acceptAllRevisions
     *
     * Accepts all revisions in the document.
     *
     * @param Requests\acceptAllRevisionsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\RevisionsModificationResponse
     */
    public function acceptAllRevisions(Requests\acceptAllRevisionsRequest $request)
    {
        try {
            list($response) = $this->acceptAllRevisionsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->acceptAllRevisionsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation acceptAllRevisionsWithHttpInfo
     *
     * Accepts all revisions in the document.
     *
     * @param Requests\acceptAllRevisionsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\RevisionsModificationResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function acceptAllRevisionsWithHttpInfo(Requests\acceptAllRevisionsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\RevisionsModificationResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\RevisionsModificationResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation acceptAllRevisionsAsync
     *
     * Accepts all revisions in the document.
     *
     * @param Requests\acceptAllRevisionsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function acceptAllRevisionsAsync(Requests\acceptAllRevisionsRequest $request) 
    {
        return $this->acceptAllRevisionsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation acceptAllRevisionsAsyncWithHttpInfo
     *
     * Accepts all revisions in the document.
     *
     * @param Requests\acceptAllRevisionsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function acceptAllRevisionsAsyncWithHttpInfo(Requests\acceptAllRevisionsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\RevisionsModificationResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation appendDocument
     *
     * Appends documents to the original document.
     *
     * @param Requests\appendDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function appendDocument(Requests\appendDocumentRequest $request)
    {
        try {
            list($response) = $this->appendDocumentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->appendDocumentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation appendDocumentWithHttpInfo
     *
     * Appends documents to the original document.
     *
     * @param Requests\appendDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function appendDocumentWithHttpInfo(Requests\appendDocumentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation appendDocumentAsync
     *
     * Appends documents to the original document.
     *
     * @param Requests\appendDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function appendDocumentAsync(Requests\appendDocumentRequest $request) 
    {
        return $this->appendDocumentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation appendDocumentAsyncWithHttpInfo
     *
     * Appends documents to the original document.
     *
     * @param Requests\appendDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function appendDocumentAsyncWithHttpInfo(Requests\appendDocumentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation applyStyleToDocumentElement
     *
     * Applies a style to the document node.
     *
     * @param Requests\applyStyleToDocumentElementRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\WordsResponse
     */
    public function applyStyleToDocumentElement(Requests\applyStyleToDocumentElementRequest $request)
    {
        try {
            list($response) = $this->applyStyleToDocumentElementWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->applyStyleToDocumentElementWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation applyStyleToDocumentElementWithHttpInfo
     *
     * Applies a style to the document node.
     *
     * @param Requests\applyStyleToDocumentElementRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\WordsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function applyStyleToDocumentElementWithHttpInfo(Requests\applyStyleToDocumentElementRequest $request)
    {
        $returnType = '\Aspose\Words\Model\WordsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\WordsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation applyStyleToDocumentElementAsync
     *
     * Applies a style to the document node.
     *
     * @param Requests\applyStyleToDocumentElementRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function applyStyleToDocumentElementAsync(Requests\applyStyleToDocumentElementRequest $request) 
    {
        return $this->applyStyleToDocumentElementAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation applyStyleToDocumentElementAsyncWithHttpInfo
     *
     * Applies a style to the document node.
     *
     * @param Requests\applyStyleToDocumentElementRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function applyStyleToDocumentElementAsyncWithHttpInfo(Requests\applyStyleToDocumentElementRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\WordsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation buildReport
     *
     * Executes the report generation process using the specified document template and the external data source in XML, JSON or CSV format.
     *
     * @param Requests\buildReportRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function buildReport(Requests\buildReportRequest $request)
    {
        try {
            list($response) = $this->buildReportWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->buildReportWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation buildReportWithHttpInfo
     *
     * Executes the report generation process using the specified document template and the external data source in XML, JSON or CSV format.
     *
     * @param Requests\buildReportRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function buildReportWithHttpInfo(Requests\buildReportRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation buildReportAsync
     *
     * Executes the report generation process using the specified document template and the external data source in XML, JSON or CSV format.
     *
     * @param Requests\buildReportRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function buildReportAsync(Requests\buildReportRequest $request) 
    {
        return $this->buildReportAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation buildReportAsyncWithHttpInfo
     *
     * Executes the report generation process using the specified document template and the external data source in XML, JSON or CSV format.
     *
     * @param Requests\buildReportRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function buildReportAsyncWithHttpInfo(Requests\buildReportRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation buildReportOnline
     *
     * Executes the report generation process online using the specified document template and the external data source in XML, JSON or CSV format.
     *
     * @param Requests\buildReportOnlineRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function buildReportOnline(Requests\buildReportOnlineRequest $request)
    {
        try {
            list($response) = $this->buildReportOnlineWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->buildReportOnlineWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation buildReportOnlineWithHttpInfo
     *
     * Executes the report generation process online using the specified document template and the external data source in XML, JSON or CSV format.
     *
     * @param Requests\buildReportOnlineRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function buildReportOnlineWithHttpInfo(Requests\buildReportOnlineRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation buildReportOnlineAsync
     *
     * Executes the report generation process online using the specified document template and the external data source in XML, JSON or CSV format.
     *
     * @param Requests\buildReportOnlineRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function buildReportOnlineAsync(Requests\buildReportOnlineRequest $request) 
    {
        return $this->buildReportOnlineAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation buildReportOnlineAsyncWithHttpInfo
     *
     * Executes the report generation process online using the specified document template and the external data source in XML, JSON or CSV format.
     *
     * @param Requests\buildReportOnlineRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function buildReportOnlineAsyncWithHttpInfo(Requests\buildReportOnlineRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation classify
     *
     * Runs a multi-class text classification for the specified raw text.
     *
     * @param Requests\classifyRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ClassificationResponse
     */
    public function classify(Requests\classifyRequest $request)
    {
        try {
            list($response) = $this->classifyWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->classifyWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation classifyWithHttpInfo
     *
     * Runs a multi-class text classification for the specified raw text.
     *
     * @param Requests\classifyRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ClassificationResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function classifyWithHttpInfo(Requests\classifyRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ClassificationResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ClassificationResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation classifyAsync
     *
     * Runs a multi-class text classification for the specified raw text.
     *
     * @param Requests\classifyRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function classifyAsync(Requests\classifyRequest $request) 
    {
        return $this->classifyAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation classifyAsyncWithHttpInfo
     *
     * Runs a multi-class text classification for the specified raw text.
     *
     * @param Requests\classifyRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function classifyAsyncWithHttpInfo(Requests\classifyRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ClassificationResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation classifyDocument
     *
     * Runs a multi-class text classification for the document.
     *
     * @param Requests\classifyDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ClassificationResponse
     */
    public function classifyDocument(Requests\classifyDocumentRequest $request)
    {
        try {
            list($response) = $this->classifyDocumentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->classifyDocumentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation classifyDocumentWithHttpInfo
     *
     * Runs a multi-class text classification for the document.
     *
     * @param Requests\classifyDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ClassificationResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function classifyDocumentWithHttpInfo(Requests\classifyDocumentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ClassificationResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ClassificationResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation classifyDocumentAsync
     *
     * Runs a multi-class text classification for the document.
     *
     * @param Requests\classifyDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function classifyDocumentAsync(Requests\classifyDocumentRequest $request) 
    {
        return $this->classifyDocumentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation classifyDocumentAsyncWithHttpInfo
     *
     * Runs a multi-class text classification for the document.
     *
     * @param Requests\classifyDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function classifyDocumentAsyncWithHttpInfo(Requests\classifyDocumentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ClassificationResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation compareDocument
     *
     * Compares two documents.
     *
     * @param Requests\compareDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function compareDocument(Requests\compareDocumentRequest $request)
    {
        try {
            list($response) = $this->compareDocumentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->compareDocumentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation compareDocumentWithHttpInfo
     *
     * Compares two documents.
     *
     * @param Requests\compareDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function compareDocumentWithHttpInfo(Requests\compareDocumentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation compareDocumentAsync
     *
     * Compares two documents.
     *
     * @param Requests\compareDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function compareDocumentAsync(Requests\compareDocumentRequest $request) 
    {
        return $this->compareDocumentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation compareDocumentAsyncWithHttpInfo
     *
     * Compares two documents.
     *
     * @param Requests\compareDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function compareDocumentAsyncWithHttpInfo(Requests\compareDocumentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation convertDocument
     *
     * Converts a document on a local drive to the specified format.
     *
     * @param Requests\convertDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function convertDocument(Requests\convertDocumentRequest $request)
    {
        try {
            list($response) = $this->convertDocumentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->convertDocumentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation convertDocumentWithHttpInfo
     *
     * Converts a document on a local drive to the specified format.
     *
     * @param Requests\convertDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function convertDocumentWithHttpInfo(Requests\convertDocumentRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation convertDocumentAsync
     *
     * Converts a document on a local drive to the specified format.
     *
     * @param Requests\convertDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function convertDocumentAsync(Requests\convertDocumentRequest $request) 
    {
        return $this->convertDocumentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation convertDocumentAsyncWithHttpInfo
     *
     * Converts a document on a local drive to the specified format.
     *
     * @param Requests\convertDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function convertDocumentAsyncWithHttpInfo(Requests\convertDocumentRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation copyFile
     *
     * Copy file.
     *
     * @param Requests\copyFileRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function copyFile(Requests\copyFileRequest $request)
    {
        try {
    $this->copyFileWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->copyFileWithHttpInfo($request);
        } 
    }

    /*
     * Operation copyFileWithHttpInfo
     *
     * Copy file.
     *
     * @param Requests\copyFileRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function copyFileWithHttpInfo(Requests\copyFileRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation copyFileAsync
     *
     * Copy file.
     *
     * @param Requests\copyFileRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function copyFileAsync(Requests\copyFileRequest $request) 
    {
        return $this->copyFileAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation copyFileAsyncWithHttpInfo
     *
     * Copy file.
     *
     * @param Requests\copyFileRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function copyFileAsyncWithHttpInfo(Requests\copyFileRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation copyFolder
     *
     * Copy folder.
     *
     * @param Requests\copyFolderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function copyFolder(Requests\copyFolderRequest $request)
    {
        try {
    $this->copyFolderWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->copyFolderWithHttpInfo($request);
        } 
    }

    /*
     * Operation copyFolderWithHttpInfo
     *
     * Copy folder.
     *
     * @param Requests\copyFolderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function copyFolderWithHttpInfo(Requests\copyFolderRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation copyFolderAsync
     *
     * Copy folder.
     *
     * @param Requests\copyFolderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function copyFolderAsync(Requests\copyFolderRequest $request) 
    {
        return $this->copyFolderAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation copyFolderAsyncWithHttpInfo
     *
     * Copy folder.
     *
     * @param Requests\copyFolderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function copyFolderAsyncWithHttpInfo(Requests\copyFolderRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation copyStyle
     *
     * Makes a copy of the style in the document.
     *
     * @param Requests\copyStyleRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\StyleResponse
     */
    public function copyStyle(Requests\copyStyleRequest $request)
    {
        try {
            list($response) = $this->copyStyleWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->copyStyleWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation copyStyleWithHttpInfo
     *
     * Makes a copy of the style in the document.
     *
     * @param Requests\copyStyleRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\StyleResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function copyStyleWithHttpInfo(Requests\copyStyleRequest $request)
    {
        $returnType = '\Aspose\Words\Model\StyleResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\StyleResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation copyStyleAsync
     *
     * Makes a copy of the style in the document.
     *
     * @param Requests\copyStyleRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function copyStyleAsync(Requests\copyStyleRequest $request) 
    {
        return $this->copyStyleAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation copyStyleAsyncWithHttpInfo
     *
     * Makes a copy of the style in the document.
     *
     * @param Requests\copyStyleRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function copyStyleAsyncWithHttpInfo(Requests\copyStyleRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\StyleResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation createDocument
     *
     * Supported extensions: ".doc", ".docx", ".docm", ".dot", ".dotm", ".dotx", ".flatopc", ".fopc", ".flatopc_macro", ".fopc_macro", ".flatopc_template", ".fopc_template", ".flatopc_template_macro", ".fopc_template_macro", ".wordml", ".wml", ".rtf".
     *
     * @param Requests\createDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function createDocument(Requests\createDocumentRequest $request)
    {
        try {
            list($response) = $this->createDocumentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->createDocumentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation createDocumentWithHttpInfo
     *
     * Supported extensions: ".doc", ".docx", ".docm", ".dot", ".dotm", ".dotx", ".flatopc", ".fopc", ".flatopc_macro", ".fopc_macro", ".flatopc_template", ".fopc_template", ".flatopc_template_macro", ".fopc_template_macro", ".wordml", ".wml", ".rtf".
     *
     * @param Requests\createDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function createDocumentWithHttpInfo(Requests\createDocumentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation createDocumentAsync
     *
     * Supported extensions: ".doc", ".docx", ".docm", ".dot", ".dotm", ".dotx", ".flatopc", ".fopc", ".flatopc_macro", ".fopc_macro", ".flatopc_template", ".fopc_template", ".flatopc_template_macro", ".fopc_template_macro", ".wordml", ".wml", ".rtf".
     *
     * @param Requests\createDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createDocumentAsync(Requests\createDocumentRequest $request) 
    {
        return $this->createDocumentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation createDocumentAsyncWithHttpInfo
     *
     * Supported extensions: ".doc", ".docx", ".docm", ".dot", ".dotm", ".dotx", ".flatopc", ".fopc", ".flatopc_macro", ".fopc_macro", ".flatopc_template", ".fopc_template", ".flatopc_template_macro", ".fopc_template_macro", ".wordml", ".wml", ".rtf".
     *
     * @param Requests\createDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function createDocumentAsyncWithHttpInfo(Requests\createDocumentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation createFolder
     *
     * Create the folder.
     *
     * @param Requests\createFolderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function createFolder(Requests\createFolderRequest $request)
    {
        try {
    $this->createFolderWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->createFolderWithHttpInfo($request);
        } 
    }

    /*
     * Operation createFolderWithHttpInfo
     *
     * Create the folder.
     *
     * @param Requests\createFolderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function createFolderWithHttpInfo(Requests\createFolderRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation createFolderAsync
     *
     * Create the folder.
     *
     * @param Requests\createFolderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createFolderAsync(Requests\createFolderRequest $request) 
    {
        return $this->createFolderAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation createFolderAsyncWithHttpInfo
     *
     * Create the folder.
     *
     * @param Requests\createFolderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function createFolderAsyncWithHttpInfo(Requests\createFolderRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation createOrUpdateDocumentProperty
     *
     * Adds a new or updates an existing document property.
     *
     * @param Requests\createOrUpdateDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentPropertyResponse
     */
    public function createOrUpdateDocumentProperty(Requests\createOrUpdateDocumentPropertyRequest $request)
    {
        try {
            list($response) = $this->createOrUpdateDocumentPropertyWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->createOrUpdateDocumentPropertyWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation createOrUpdateDocumentPropertyWithHttpInfo
     *
     * Adds a new or updates an existing document property.
     *
     * @param Requests\createOrUpdateDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentPropertyResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function createOrUpdateDocumentPropertyWithHttpInfo(Requests\createOrUpdateDocumentPropertyRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentPropertyResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentPropertyResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation createOrUpdateDocumentPropertyAsync
     *
     * Adds a new or updates an existing document property.
     *
     * @param Requests\createOrUpdateDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createOrUpdateDocumentPropertyAsync(Requests\createOrUpdateDocumentPropertyRequest $request) 
    {
        return $this->createOrUpdateDocumentPropertyAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation createOrUpdateDocumentPropertyAsyncWithHttpInfo
     *
     * Adds a new or updates an existing document property.
     *
     * @param Requests\createOrUpdateDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function createOrUpdateDocumentPropertyAsyncWithHttpInfo(Requests\createOrUpdateDocumentPropertyRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentPropertyResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteAllParagraphTabStops
     *
     * Removes paragraph tab stops from the document node.
     *
     * @param Requests\deleteAllParagraphTabStopsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TabStopsResponse
     */
    public function deleteAllParagraphTabStops(Requests\deleteAllParagraphTabStopsRequest $request)
    {
        try {
            list($response) = $this->deleteAllParagraphTabStopsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->deleteAllParagraphTabStopsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation deleteAllParagraphTabStopsWithHttpInfo
     *
     * Removes paragraph tab stops from the document node.
     *
     * @param Requests\deleteAllParagraphTabStopsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TabStopsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteAllParagraphTabStopsWithHttpInfo(Requests\deleteAllParagraphTabStopsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TabStopsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TabStopsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation deleteAllParagraphTabStopsAsync
     *
     * Removes paragraph tab stops from the document node.
     *
     * @param Requests\deleteAllParagraphTabStopsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteAllParagraphTabStopsAsync(Requests\deleteAllParagraphTabStopsRequest $request) 
    {
        return $this->deleteAllParagraphTabStopsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteAllParagraphTabStopsAsyncWithHttpInfo
     *
     * Removes paragraph tab stops from the document node.
     *
     * @param Requests\deleteAllParagraphTabStopsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteAllParagraphTabStopsAsyncWithHttpInfo(Requests\deleteAllParagraphTabStopsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TabStopsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteBorder
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\deleteBorderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\BorderResponse
     */
    public function deleteBorder(Requests\deleteBorderRequest $request)
    {
        try {
            list($response) = $this->deleteBorderWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->deleteBorderWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation deleteBorderWithHttpInfo
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\deleteBorderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\BorderResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteBorderWithHttpInfo(Requests\deleteBorderRequest $request)
    {
        $returnType = '\Aspose\Words\Model\BorderResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\BorderResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation deleteBorderAsync
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\deleteBorderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteBorderAsync(Requests\deleteBorderRequest $request) 
    {
        return $this->deleteBorderAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteBorderAsyncWithHttpInfo
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\deleteBorderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteBorderAsyncWithHttpInfo(Requests\deleteBorderRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\BorderResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteBorders
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\deleteBordersRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\BordersResponse
     */
    public function deleteBorders(Requests\deleteBordersRequest $request)
    {
        try {
            list($response) = $this->deleteBordersWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->deleteBordersWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation deleteBordersWithHttpInfo
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\deleteBordersRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\BordersResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteBordersWithHttpInfo(Requests\deleteBordersRequest $request)
    {
        $returnType = '\Aspose\Words\Model\BordersResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\BordersResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation deleteBordersAsync
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\deleteBordersRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteBordersAsync(Requests\deleteBordersRequest $request) 
    {
        return $this->deleteBordersAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteBordersAsyncWithHttpInfo
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\deleteBordersRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteBordersAsyncWithHttpInfo(Requests\deleteBordersRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\BordersResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteComment
     *
     * Removes a comment from the document.
     *
     * @param Requests\deleteCommentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteComment(Requests\deleteCommentRequest $request)
    {
        try {
    $this->deleteCommentWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteCommentWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteCommentWithHttpInfo
     *
     * Removes a comment from the document.
     *
     * @param Requests\deleteCommentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteCommentWithHttpInfo(Requests\deleteCommentRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteCommentAsync
     *
     * Removes a comment from the document.
     *
     * @param Requests\deleteCommentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteCommentAsync(Requests\deleteCommentRequest $request) 
    {
        return $this->deleteCommentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteCommentAsyncWithHttpInfo
     *
     * Removes a comment from the document.
     *
     * @param Requests\deleteCommentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteCommentAsyncWithHttpInfo(Requests\deleteCommentRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteDocumentProperty
     *
     * Removes a document property.
     *
     * @param Requests\deleteDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteDocumentProperty(Requests\deleteDocumentPropertyRequest $request)
    {
        try {
    $this->deleteDocumentPropertyWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteDocumentPropertyWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteDocumentPropertyWithHttpInfo
     *
     * Removes a document property.
     *
     * @param Requests\deleteDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteDocumentPropertyWithHttpInfo(Requests\deleteDocumentPropertyRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteDocumentPropertyAsync
     *
     * Removes a document property.
     *
     * @param Requests\deleteDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDocumentPropertyAsync(Requests\deleteDocumentPropertyRequest $request) 
    {
        return $this->deleteDocumentPropertyAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteDocumentPropertyAsyncWithHttpInfo
     *
     * Removes a document property.
     *
     * @param Requests\deleteDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteDocumentPropertyAsyncWithHttpInfo(Requests\deleteDocumentPropertyRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteDrawingObject
     *
     * Removes a DrawingObject from the document node.
     *
     * @param Requests\deleteDrawingObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteDrawingObject(Requests\deleteDrawingObjectRequest $request)
    {
        try {
    $this->deleteDrawingObjectWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteDrawingObjectWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteDrawingObjectWithHttpInfo
     *
     * Removes a DrawingObject from the document node.
     *
     * @param Requests\deleteDrawingObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteDrawingObjectWithHttpInfo(Requests\deleteDrawingObjectRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteDrawingObjectAsync
     *
     * Removes a DrawingObject from the document node.
     *
     * @param Requests\deleteDrawingObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteDrawingObjectAsync(Requests\deleteDrawingObjectRequest $request) 
    {
        return $this->deleteDrawingObjectAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteDrawingObjectAsyncWithHttpInfo
     *
     * Removes a DrawingObject from the document node.
     *
     * @param Requests\deleteDrawingObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteDrawingObjectAsyncWithHttpInfo(Requests\deleteDrawingObjectRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteField
     *
     * Removes a field from the document node.
     *
     * @param Requests\deleteFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteField(Requests\deleteFieldRequest $request)
    {
        try {
    $this->deleteFieldWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteFieldWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteFieldWithHttpInfo
     *
     * Removes a field from the document node.
     *
     * @param Requests\deleteFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteFieldWithHttpInfo(Requests\deleteFieldRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteFieldAsync
     *
     * Removes a field from the document node.
     *
     * @param Requests\deleteFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteFieldAsync(Requests\deleteFieldRequest $request) 
    {
        return $this->deleteFieldAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteFieldAsyncWithHttpInfo
     *
     * Removes a field from the document node.
     *
     * @param Requests\deleteFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteFieldAsyncWithHttpInfo(Requests\deleteFieldRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteFields
     *
     * Removes fields from the document node.
     *
     * @param Requests\deleteFieldsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteFields(Requests\deleteFieldsRequest $request)
    {
        try {
    $this->deleteFieldsWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteFieldsWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteFieldsWithHttpInfo
     *
     * Removes fields from the document node.
     *
     * @param Requests\deleteFieldsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteFieldsWithHttpInfo(Requests\deleteFieldsRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteFieldsAsync
     *
     * Removes fields from the document node.
     *
     * @param Requests\deleteFieldsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteFieldsAsync(Requests\deleteFieldsRequest $request) 
    {
        return $this->deleteFieldsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteFieldsAsyncWithHttpInfo
     *
     * Removes fields from the document node.
     *
     * @param Requests\deleteFieldsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteFieldsAsyncWithHttpInfo(Requests\deleteFieldsRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteFile
     *
     * Delete file.
     *
     * @param Requests\deleteFileRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteFile(Requests\deleteFileRequest $request)
    {
        try {
    $this->deleteFileWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteFileWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteFileWithHttpInfo
     *
     * Delete file.
     *
     * @param Requests\deleteFileRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteFileWithHttpInfo(Requests\deleteFileRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteFileAsync
     *
     * Delete file.
     *
     * @param Requests\deleteFileRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteFileAsync(Requests\deleteFileRequest $request) 
    {
        return $this->deleteFileAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteFileAsyncWithHttpInfo
     *
     * Delete file.
     *
     * @param Requests\deleteFileRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteFileAsyncWithHttpInfo(Requests\deleteFileRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteFolder
     *
     * Delete folder.
     *
     * @param Requests\deleteFolderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteFolder(Requests\deleteFolderRequest $request)
    {
        try {
    $this->deleteFolderWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteFolderWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteFolderWithHttpInfo
     *
     * Delete folder.
     *
     * @param Requests\deleteFolderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteFolderWithHttpInfo(Requests\deleteFolderRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteFolderAsync
     *
     * Delete folder.
     *
     * @param Requests\deleteFolderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteFolderAsync(Requests\deleteFolderRequest $request) 
    {
        return $this->deleteFolderAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteFolderAsyncWithHttpInfo
     *
     * Delete folder.
     *
     * @param Requests\deleteFolderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteFolderAsyncWithHttpInfo(Requests\deleteFolderRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteFootnote
     *
     * Removes a footnote from the document node.
     *
     * @param Requests\deleteFootnoteRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteFootnote(Requests\deleteFootnoteRequest $request)
    {
        try {
    $this->deleteFootnoteWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteFootnoteWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteFootnoteWithHttpInfo
     *
     * Removes a footnote from the document node.
     *
     * @param Requests\deleteFootnoteRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteFootnoteWithHttpInfo(Requests\deleteFootnoteRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteFootnoteAsync
     *
     * Removes a footnote from the document node.
     *
     * @param Requests\deleteFootnoteRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteFootnoteAsync(Requests\deleteFootnoteRequest $request) 
    {
        return $this->deleteFootnoteAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteFootnoteAsyncWithHttpInfo
     *
     * Removes a footnote from the document node.
     *
     * @param Requests\deleteFootnoteRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteFootnoteAsyncWithHttpInfo(Requests\deleteFootnoteRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteFormField
     *
     * Removes a form field from the document node.
     *
     * @param Requests\deleteFormFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteFormField(Requests\deleteFormFieldRequest $request)
    {
        try {
    $this->deleteFormFieldWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteFormFieldWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteFormFieldWithHttpInfo
     *
     * Removes a form field from the document node.
     *
     * @param Requests\deleteFormFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteFormFieldWithHttpInfo(Requests\deleteFormFieldRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteFormFieldAsync
     *
     * Removes a form field from the document node.
     *
     * @param Requests\deleteFormFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteFormFieldAsync(Requests\deleteFormFieldRequest $request) 
    {
        return $this->deleteFormFieldAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteFormFieldAsyncWithHttpInfo
     *
     * Removes a form field from the document node.
     *
     * @param Requests\deleteFormFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteFormFieldAsyncWithHttpInfo(Requests\deleteFormFieldRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteHeaderFooter
     *
     * Removes a HeaderFooter object from the document section.
     *
     * @param Requests\deleteHeaderFooterRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteHeaderFooter(Requests\deleteHeaderFooterRequest $request)
    {
        try {
    $this->deleteHeaderFooterWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteHeaderFooterWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteHeaderFooterWithHttpInfo
     *
     * Removes a HeaderFooter object from the document section.
     *
     * @param Requests\deleteHeaderFooterRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteHeaderFooterWithHttpInfo(Requests\deleteHeaderFooterRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteHeaderFooterAsync
     *
     * Removes a HeaderFooter object from the document section.
     *
     * @param Requests\deleteHeaderFooterRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteHeaderFooterAsync(Requests\deleteHeaderFooterRequest $request) 
    {
        return $this->deleteHeaderFooterAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteHeaderFooterAsyncWithHttpInfo
     *
     * Removes a HeaderFooter object from the document section.
     *
     * @param Requests\deleteHeaderFooterRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteHeaderFooterAsyncWithHttpInfo(Requests\deleteHeaderFooterRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteHeadersFooters
     *
     * Removes HeaderFooter objects from the document section.
     *
     * @param Requests\deleteHeadersFootersRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteHeadersFooters(Requests\deleteHeadersFootersRequest $request)
    {
        try {
    $this->deleteHeadersFootersWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteHeadersFootersWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteHeadersFootersWithHttpInfo
     *
     * Removes HeaderFooter objects from the document section.
     *
     * @param Requests\deleteHeadersFootersRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteHeadersFootersWithHttpInfo(Requests\deleteHeadersFootersRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteHeadersFootersAsync
     *
     * Removes HeaderFooter objects from the document section.
     *
     * @param Requests\deleteHeadersFootersRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteHeadersFootersAsync(Requests\deleteHeadersFootersRequest $request) 
    {
        return $this->deleteHeadersFootersAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteHeadersFootersAsyncWithHttpInfo
     *
     * Removes HeaderFooter objects from the document section.
     *
     * @param Requests\deleteHeadersFootersRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteHeadersFootersAsyncWithHttpInfo(Requests\deleteHeadersFootersRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteMacros
     *
     * Removes macros from the document.
     *
     * @param Requests\deleteMacrosRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteMacros(Requests\deleteMacrosRequest $request)
    {
        try {
    $this->deleteMacrosWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteMacrosWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteMacrosWithHttpInfo
     *
     * Removes macros from the document.
     *
     * @param Requests\deleteMacrosRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteMacrosWithHttpInfo(Requests\deleteMacrosRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteMacrosAsync
     *
     * Removes macros from the document.
     *
     * @param Requests\deleteMacrosRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteMacrosAsync(Requests\deleteMacrosRequest $request) 
    {
        return $this->deleteMacrosAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteMacrosAsyncWithHttpInfo
     *
     * Removes macros from the document.
     *
     * @param Requests\deleteMacrosRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteMacrosAsyncWithHttpInfo(Requests\deleteMacrosRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteOfficeMathObject
     *
     * Removes an OfficeMath object from the document node.
     *
     * @param Requests\deleteOfficeMathObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteOfficeMathObject(Requests\deleteOfficeMathObjectRequest $request)
    {
        try {
    $this->deleteOfficeMathObjectWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteOfficeMathObjectWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteOfficeMathObjectWithHttpInfo
     *
     * Removes an OfficeMath object from the document node.
     *
     * @param Requests\deleteOfficeMathObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteOfficeMathObjectWithHttpInfo(Requests\deleteOfficeMathObjectRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteOfficeMathObjectAsync
     *
     * Removes an OfficeMath object from the document node.
     *
     * @param Requests\deleteOfficeMathObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteOfficeMathObjectAsync(Requests\deleteOfficeMathObjectRequest $request) 
    {
        return $this->deleteOfficeMathObjectAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteOfficeMathObjectAsyncWithHttpInfo
     *
     * Removes an OfficeMath object from the document node.
     *
     * @param Requests\deleteOfficeMathObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteOfficeMathObjectAsyncWithHttpInfo(Requests\deleteOfficeMathObjectRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteParagraph
     *
     * Removes a paragraph from the document node.
     *
     * @param Requests\deleteParagraphRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteParagraph(Requests\deleteParagraphRequest $request)
    {
        try {
    $this->deleteParagraphWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteParagraphWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteParagraphWithHttpInfo
     *
     * Removes a paragraph from the document node.
     *
     * @param Requests\deleteParagraphRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteParagraphWithHttpInfo(Requests\deleteParagraphRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteParagraphAsync
     *
     * Removes a paragraph from the document node.
     *
     * @param Requests\deleteParagraphRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteParagraphAsync(Requests\deleteParagraphRequest $request) 
    {
        return $this->deleteParagraphAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteParagraphAsyncWithHttpInfo
     *
     * Removes a paragraph from the document node.
     *
     * @param Requests\deleteParagraphRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteParagraphAsyncWithHttpInfo(Requests\deleteParagraphRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteParagraphListFormat
     *
     * Removes the formatting properties of a paragraph list from the document node.
     *
     * @param Requests\deleteParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ParagraphListFormatResponse
     */
    public function deleteParagraphListFormat(Requests\deleteParagraphListFormatRequest $request)
    {
        try {
            list($response) = $this->deleteParagraphListFormatWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->deleteParagraphListFormatWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation deleteParagraphListFormatWithHttpInfo
     *
     * Removes the formatting properties of a paragraph list from the document node.
     *
     * @param Requests\deleteParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ParagraphListFormatResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteParagraphListFormatWithHttpInfo(Requests\deleteParagraphListFormatRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ParagraphListFormatResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ParagraphListFormatResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation deleteParagraphListFormatAsync
     *
     * Removes the formatting properties of a paragraph list from the document node.
     *
     * @param Requests\deleteParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteParagraphListFormatAsync(Requests\deleteParagraphListFormatRequest $request) 
    {
        return $this->deleteParagraphListFormatAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteParagraphListFormatAsyncWithHttpInfo
     *
     * Removes the formatting properties of a paragraph list from the document node.
     *
     * @param Requests\deleteParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteParagraphListFormatAsyncWithHttpInfo(Requests\deleteParagraphListFormatRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ParagraphListFormatResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteParagraphTabStop
     *
     * Removes a paragraph tab stop from the document node.
     *
     * @param Requests\deleteParagraphTabStopRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TabStopsResponse
     */
    public function deleteParagraphTabStop(Requests\deleteParagraphTabStopRequest $request)
    {
        try {
            list($response) = $this->deleteParagraphTabStopWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->deleteParagraphTabStopWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation deleteParagraphTabStopWithHttpInfo
     *
     * Removes a paragraph tab stop from the document node.
     *
     * @param Requests\deleteParagraphTabStopRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TabStopsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteParagraphTabStopWithHttpInfo(Requests\deleteParagraphTabStopRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TabStopsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TabStopsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation deleteParagraphTabStopAsync
     *
     * Removes a paragraph tab stop from the document node.
     *
     * @param Requests\deleteParagraphTabStopRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteParagraphTabStopAsync(Requests\deleteParagraphTabStopRequest $request) 
    {
        return $this->deleteParagraphTabStopAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteParagraphTabStopAsyncWithHttpInfo
     *
     * Removes a paragraph tab stop from the document node.
     *
     * @param Requests\deleteParagraphTabStopRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteParagraphTabStopAsyncWithHttpInfo(Requests\deleteParagraphTabStopRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TabStopsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteRun
     *
     * Removes a Run object from the paragraph.
     *
     * @param Requests\deleteRunRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteRun(Requests\deleteRunRequest $request)
    {
        try {
    $this->deleteRunWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteRunWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteRunWithHttpInfo
     *
     * Removes a Run object from the paragraph.
     *
     * @param Requests\deleteRunRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteRunWithHttpInfo(Requests\deleteRunRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteRunAsync
     *
     * Removes a Run object from the paragraph.
     *
     * @param Requests\deleteRunRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteRunAsync(Requests\deleteRunRequest $request) 
    {
        return $this->deleteRunAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteRunAsyncWithHttpInfo
     *
     * Removes a Run object from the paragraph.
     *
     * @param Requests\deleteRunRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteRunAsyncWithHttpInfo(Requests\deleteRunRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteSection
     *
     * Removes a section from the document.
     *
     * @param Requests\deleteSectionRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteSection(Requests\deleteSectionRequest $request)
    {
        try {
    $this->deleteSectionWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteSectionWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteSectionWithHttpInfo
     *
     * Removes a section from the document.
     *
     * @param Requests\deleteSectionRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteSectionWithHttpInfo(Requests\deleteSectionRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteSectionAsync
     *
     * Removes a section from the document.
     *
     * @param Requests\deleteSectionRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteSectionAsync(Requests\deleteSectionRequest $request) 
    {
        return $this->deleteSectionAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteSectionAsyncWithHttpInfo
     *
     * Removes a section from the document.
     *
     * @param Requests\deleteSectionRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteSectionAsyncWithHttpInfo(Requests\deleteSectionRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteTable
     *
     * Removes a table from the document node.
     *
     * @param Requests\deleteTableRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteTable(Requests\deleteTableRequest $request)
    {
        try {
    $this->deleteTableWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteTableWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteTableWithHttpInfo
     *
     * Removes a table from the document node.
     *
     * @param Requests\deleteTableRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteTableWithHttpInfo(Requests\deleteTableRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteTableAsync
     *
     * Removes a table from the document node.
     *
     * @param Requests\deleteTableRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteTableAsync(Requests\deleteTableRequest $request) 
    {
        return $this->deleteTableAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteTableAsyncWithHttpInfo
     *
     * Removes a table from the document node.
     *
     * @param Requests\deleteTableRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteTableAsyncWithHttpInfo(Requests\deleteTableRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteTableCell
     *
     * Removes a cell from the table row.
     *
     * @param Requests\deleteTableCellRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteTableCell(Requests\deleteTableCellRequest $request)
    {
        try {
    $this->deleteTableCellWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteTableCellWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteTableCellWithHttpInfo
     *
     * Removes a cell from the table row.
     *
     * @param Requests\deleteTableCellRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteTableCellWithHttpInfo(Requests\deleteTableCellRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteTableCellAsync
     *
     * Removes a cell from the table row.
     *
     * @param Requests\deleteTableCellRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteTableCellAsync(Requests\deleteTableCellRequest $request) 
    {
        return $this->deleteTableCellAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteTableCellAsyncWithHttpInfo
     *
     * Removes a cell from the table row.
     *
     * @param Requests\deleteTableCellRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteTableCellAsyncWithHttpInfo(Requests\deleteTableCellRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteTableRow
     *
     * Removes a row from the table.
     *
     * @param Requests\deleteTableRowRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteTableRow(Requests\deleteTableRowRequest $request)
    {
        try {
    $this->deleteTableRowWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->deleteTableRowWithHttpInfo($request);
        } 
    }

    /*
     * Operation deleteTableRowWithHttpInfo
     *
     * Removes a row from the table.
     *
     * @param Requests\deleteTableRowRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteTableRowWithHttpInfo(Requests\deleteTableRowRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation deleteTableRowAsync
     *
     * Removes a row from the table.
     *
     * @param Requests\deleteTableRowRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteTableRowAsync(Requests\deleteTableRowRequest $request) 
    {
        return $this->deleteTableRowAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteTableRowAsyncWithHttpInfo
     *
     * Removes a row from the table.
     *
     * @param Requests\deleteTableRowRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteTableRowAsyncWithHttpInfo(Requests\deleteTableRowRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation deleteWatermark
     *
     * Removes a watermark from the document.
     *
     * @param Requests\deleteWatermarkRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function deleteWatermark(Requests\deleteWatermarkRequest $request)
    {
        try {
            list($response) = $this->deleteWatermarkWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->deleteWatermarkWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation deleteWatermarkWithHttpInfo
     *
     * Removes a watermark from the document.
     *
     * @param Requests\deleteWatermarkRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function deleteWatermarkWithHttpInfo(Requests\deleteWatermarkRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation deleteWatermarkAsync
     *
     * Removes a watermark from the document.
     *
     * @param Requests\deleteWatermarkRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteWatermarkAsync(Requests\deleteWatermarkRequest $request) 
    {
        return $this->deleteWatermarkAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation deleteWatermarkAsyncWithHttpInfo
     *
     * Removes a watermark from the document.
     *
     * @param Requests\deleteWatermarkRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function deleteWatermarkAsyncWithHttpInfo(Requests\deleteWatermarkRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation downloadFile
     *
     * Download file.
     *
     * @param Requests\downloadFileRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function downloadFile(Requests\downloadFileRequest $request)
    {
        try {
            list($response) = $this->downloadFileWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->downloadFileWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation downloadFileWithHttpInfo
     *
     * Download file.
     *
     * @param Requests\downloadFileRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function downloadFileWithHttpInfo(Requests\downloadFileRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation downloadFileAsync
     *
     * Download file.
     *
     * @param Requests\downloadFileRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function downloadFileAsync(Requests\downloadFileRequest $request) 
    {
        return $this->downloadFileAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation downloadFileAsyncWithHttpInfo
     *
     * Download file.
     *
     * @param Requests\downloadFileRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function downloadFileAsyncWithHttpInfo(Requests\downloadFileRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation executeMailMerge
     *
     * Executes a Mail Merge operation.
     *
     * @param Requests\executeMailMergeRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function executeMailMerge(Requests\executeMailMergeRequest $request)
    {
        try {
            list($response) = $this->executeMailMergeWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->executeMailMergeWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation executeMailMergeWithHttpInfo
     *
     * Executes a Mail Merge operation.
     *
     * @param Requests\executeMailMergeRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function executeMailMergeWithHttpInfo(Requests\executeMailMergeRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation executeMailMergeAsync
     *
     * Executes a Mail Merge operation.
     *
     * @param Requests\executeMailMergeRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function executeMailMergeAsync(Requests\executeMailMergeRequest $request) 
    {
        return $this->executeMailMergeAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation executeMailMergeAsyncWithHttpInfo
     *
     * Executes a Mail Merge operation.
     *
     * @param Requests\executeMailMergeRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function executeMailMergeAsyncWithHttpInfo(Requests\executeMailMergeRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation executeMailMergeOnline
     *
     * Executes a Mail Merge operation online.
     *
     * @param Requests\executeMailMergeOnlineRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function executeMailMergeOnline(Requests\executeMailMergeOnlineRequest $request)
    {
        try {
            list($response) = $this->executeMailMergeOnlineWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->executeMailMergeOnlineWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation executeMailMergeOnlineWithHttpInfo
     *
     * Executes a Mail Merge operation online.
     *
     * @param Requests\executeMailMergeOnlineRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function executeMailMergeOnlineWithHttpInfo(Requests\executeMailMergeOnlineRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation executeMailMergeOnlineAsync
     *
     * Executes a Mail Merge operation online.
     *
     * @param Requests\executeMailMergeOnlineRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function executeMailMergeOnlineAsync(Requests\executeMailMergeOnlineRequest $request) 
    {
        return $this->executeMailMergeOnlineAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation executeMailMergeOnlineAsyncWithHttpInfo
     *
     * Executes a Mail Merge operation online.
     *
     * @param Requests\executeMailMergeOnlineRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function executeMailMergeOnlineAsyncWithHttpInfo(Requests\executeMailMergeOnlineRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getAvailableFonts
     *
     * Reads available fonts from the document.
     *
     * @param Requests\getAvailableFontsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\AvailableFontsResponse
     */
    public function getAvailableFonts(Requests\getAvailableFontsRequest $request)
    {
        try {
            list($response) = $this->getAvailableFontsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getAvailableFontsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getAvailableFontsWithHttpInfo
     *
     * Reads available fonts from the document.
     *
     * @param Requests\getAvailableFontsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\AvailableFontsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getAvailableFontsWithHttpInfo(Requests\getAvailableFontsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\AvailableFontsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\AvailableFontsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getAvailableFontsAsync
     *
     * Reads available fonts from the document.
     *
     * @param Requests\getAvailableFontsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAvailableFontsAsync(Requests\getAvailableFontsRequest $request) 
    {
        return $this->getAvailableFontsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getAvailableFontsAsyncWithHttpInfo
     *
     * Reads available fonts from the document.
     *
     * @param Requests\getAvailableFontsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getAvailableFontsAsyncWithHttpInfo(Requests\getAvailableFontsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\AvailableFontsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getBookmarkByName
     *
     * Reads a bookmark, specified by name, from the document.
     *
     * @param Requests\getBookmarkByNameRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\BookmarkResponse
     */
    public function getBookmarkByName(Requests\getBookmarkByNameRequest $request)
    {
        try {
            list($response) = $this->getBookmarkByNameWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getBookmarkByNameWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getBookmarkByNameWithHttpInfo
     *
     * Reads a bookmark, specified by name, from the document.
     *
     * @param Requests\getBookmarkByNameRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\BookmarkResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getBookmarkByNameWithHttpInfo(Requests\getBookmarkByNameRequest $request)
    {
        $returnType = '\Aspose\Words\Model\BookmarkResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\BookmarkResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getBookmarkByNameAsync
     *
     * Reads a bookmark, specified by name, from the document.
     *
     * @param Requests\getBookmarkByNameRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBookmarkByNameAsync(Requests\getBookmarkByNameRequest $request) 
    {
        return $this->getBookmarkByNameAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getBookmarkByNameAsyncWithHttpInfo
     *
     * Reads a bookmark, specified by name, from the document.
     *
     * @param Requests\getBookmarkByNameRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getBookmarkByNameAsyncWithHttpInfo(Requests\getBookmarkByNameRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\BookmarkResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getBookmarks
     *
     * Reads bookmarks from the document.
     *
     * @param Requests\getBookmarksRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\BookmarksResponse
     */
    public function getBookmarks(Requests\getBookmarksRequest $request)
    {
        try {
            list($response) = $this->getBookmarksWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getBookmarksWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getBookmarksWithHttpInfo
     *
     * Reads bookmarks from the document.
     *
     * @param Requests\getBookmarksRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\BookmarksResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getBookmarksWithHttpInfo(Requests\getBookmarksRequest $request)
    {
        $returnType = '\Aspose\Words\Model\BookmarksResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\BookmarksResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getBookmarksAsync
     *
     * Reads bookmarks from the document.
     *
     * @param Requests\getBookmarksRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBookmarksAsync(Requests\getBookmarksRequest $request) 
    {
        return $this->getBookmarksAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getBookmarksAsyncWithHttpInfo
     *
     * Reads bookmarks from the document.
     *
     * @param Requests\getBookmarksRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getBookmarksAsyncWithHttpInfo(Requests\getBookmarksRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\BookmarksResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getBorder
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\getBorderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\BorderResponse
     */
    public function getBorder(Requests\getBorderRequest $request)
    {
        try {
            list($response) = $this->getBorderWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getBorderWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getBorderWithHttpInfo
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\getBorderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\BorderResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getBorderWithHttpInfo(Requests\getBorderRequest $request)
    {
        $returnType = '\Aspose\Words\Model\BorderResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\BorderResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getBorderAsync
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\getBorderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBorderAsync(Requests\getBorderRequest $request) 
    {
        return $this->getBorderAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getBorderAsyncWithHttpInfo
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\getBorderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getBorderAsyncWithHttpInfo(Requests\getBorderRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\BorderResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getBorders
     *
     * Reads borders from the document node.
     *
     * @param Requests\getBordersRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\BordersResponse
     */
    public function getBorders(Requests\getBordersRequest $request)
    {
        try {
            list($response) = $this->getBordersWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getBordersWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getBordersWithHttpInfo
     *
     * Reads borders from the document node.
     *
     * @param Requests\getBordersRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\BordersResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getBordersWithHttpInfo(Requests\getBordersRequest $request)
    {
        $returnType = '\Aspose\Words\Model\BordersResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\BordersResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getBordersAsync
     *
     * Reads borders from the document node.
     *
     * @param Requests\getBordersRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBordersAsync(Requests\getBordersRequest $request) 
    {
        return $this->getBordersAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getBordersAsyncWithHttpInfo
     *
     * Reads borders from the document node.
     *
     * @param Requests\getBordersRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getBordersAsyncWithHttpInfo(Requests\getBordersRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\BordersResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getComment
     *
     * Reads a comment from the document.
     *
     * @param Requests\getCommentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\CommentResponse
     */
    public function getComment(Requests\getCommentRequest $request)
    {
        try {
            list($response) = $this->getCommentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getCommentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getCommentWithHttpInfo
     *
     * Reads a comment from the document.
     *
     * @param Requests\getCommentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\CommentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getCommentWithHttpInfo(Requests\getCommentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\CommentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\CommentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getCommentAsync
     *
     * Reads a comment from the document.
     *
     * @param Requests\getCommentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getCommentAsync(Requests\getCommentRequest $request) 
    {
        return $this->getCommentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getCommentAsyncWithHttpInfo
     *
     * Reads a comment from the document.
     *
     * @param Requests\getCommentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getCommentAsyncWithHttpInfo(Requests\getCommentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\CommentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getComments
     *
     * Reads comments from the document.
     *
     * @param Requests\getCommentsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\CommentsResponse
     */
    public function getComments(Requests\getCommentsRequest $request)
    {
        try {
            list($response) = $this->getCommentsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getCommentsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getCommentsWithHttpInfo
     *
     * Reads comments from the document.
     *
     * @param Requests\getCommentsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\CommentsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getCommentsWithHttpInfo(Requests\getCommentsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\CommentsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\CommentsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getCommentsAsync
     *
     * Reads comments from the document.
     *
     * @param Requests\getCommentsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getCommentsAsync(Requests\getCommentsRequest $request) 
    {
        return $this->getCommentsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getCommentsAsyncWithHttpInfo
     *
     * Reads comments from the document.
     *
     * @param Requests\getCommentsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getCommentsAsyncWithHttpInfo(Requests\getCommentsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\CommentsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocument
     *
     * Reads common information from the document.
     *
     * @param Requests\getDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function getDocument(Requests\getDocumentRequest $request)
    {
        try {
            list($response) = $this->getDocumentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentWithHttpInfo
     *
     * Reads common information from the document.
     *
     * @param Requests\getDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentWithHttpInfo(Requests\getDocumentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentAsync
     *
     * Reads common information from the document.
     *
     * @param Requests\getDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentAsync(Requests\getDocumentRequest $request) 
    {
        return $this->getDocumentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentAsyncWithHttpInfo
     *
     * Reads common information from the document.
     *
     * @param Requests\getDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentAsyncWithHttpInfo(Requests\getDocumentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentDrawingObjectByIndex
     *
     * Reads a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectByIndexRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DrawingObjectResponse
     */
    public function getDocumentDrawingObjectByIndex(Requests\getDocumentDrawingObjectByIndexRequest $request)
    {
        try {
            list($response) = $this->getDocumentDrawingObjectByIndexWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentDrawingObjectByIndexWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentDrawingObjectByIndexWithHttpInfo
     *
     * Reads a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectByIndexRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DrawingObjectResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentDrawingObjectByIndexWithHttpInfo(Requests\getDocumentDrawingObjectByIndexRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DrawingObjectResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DrawingObjectResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentDrawingObjectByIndexAsync
     *
     * Reads a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectByIndexRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentDrawingObjectByIndexAsync(Requests\getDocumentDrawingObjectByIndexRequest $request) 
    {
        return $this->getDocumentDrawingObjectByIndexAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentDrawingObjectByIndexAsyncWithHttpInfo
     *
     * Reads a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectByIndexRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentDrawingObjectByIndexAsyncWithHttpInfo(Requests\getDocumentDrawingObjectByIndexRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DrawingObjectResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentDrawingObjectImageData
     *
     * Reads image data of a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectImageDataRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function getDocumentDrawingObjectImageData(Requests\getDocumentDrawingObjectImageDataRequest $request)
    {
        try {
            list($response) = $this->getDocumentDrawingObjectImageDataWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentDrawingObjectImageDataWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentDrawingObjectImageDataWithHttpInfo
     *
     * Reads image data of a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectImageDataRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentDrawingObjectImageDataWithHttpInfo(Requests\getDocumentDrawingObjectImageDataRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentDrawingObjectImageDataAsync
     *
     * Reads image data of a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectImageDataRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentDrawingObjectImageDataAsync(Requests\getDocumentDrawingObjectImageDataRequest $request) 
    {
        return $this->getDocumentDrawingObjectImageDataAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentDrawingObjectImageDataAsyncWithHttpInfo
     *
     * Reads image data of a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectImageDataRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentDrawingObjectImageDataAsyncWithHttpInfo(Requests\getDocumentDrawingObjectImageDataRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentDrawingObjectOleData
     *
     * Reads OLE data of a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectOleDataRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function getDocumentDrawingObjectOleData(Requests\getDocumentDrawingObjectOleDataRequest $request)
    {
        try {
            list($response) = $this->getDocumentDrawingObjectOleDataWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentDrawingObjectOleDataWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentDrawingObjectOleDataWithHttpInfo
     *
     * Reads OLE data of a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectOleDataRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentDrawingObjectOleDataWithHttpInfo(Requests\getDocumentDrawingObjectOleDataRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentDrawingObjectOleDataAsync
     *
     * Reads OLE data of a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectOleDataRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentDrawingObjectOleDataAsync(Requests\getDocumentDrawingObjectOleDataRequest $request) 
    {
        return $this->getDocumentDrawingObjectOleDataAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentDrawingObjectOleDataAsyncWithHttpInfo
     *
     * Reads OLE data of a DrawingObject from the document node.
     *
     * @param Requests\getDocumentDrawingObjectOleDataRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentDrawingObjectOleDataAsyncWithHttpInfo(Requests\getDocumentDrawingObjectOleDataRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentDrawingObjects
     *
     * Reads DrawingObjects from the document node.
     *
     * @param Requests\getDocumentDrawingObjectsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DrawingObjectsResponse
     */
    public function getDocumentDrawingObjects(Requests\getDocumentDrawingObjectsRequest $request)
    {
        try {
            list($response) = $this->getDocumentDrawingObjectsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentDrawingObjectsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentDrawingObjectsWithHttpInfo
     *
     * Reads DrawingObjects from the document node.
     *
     * @param Requests\getDocumentDrawingObjectsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DrawingObjectsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentDrawingObjectsWithHttpInfo(Requests\getDocumentDrawingObjectsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DrawingObjectsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DrawingObjectsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentDrawingObjectsAsync
     *
     * Reads DrawingObjects from the document node.
     *
     * @param Requests\getDocumentDrawingObjectsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentDrawingObjectsAsync(Requests\getDocumentDrawingObjectsRequest $request) 
    {
        return $this->getDocumentDrawingObjectsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentDrawingObjectsAsyncWithHttpInfo
     *
     * Reads DrawingObjects from the document node.
     *
     * @param Requests\getDocumentDrawingObjectsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentDrawingObjectsAsyncWithHttpInfo(Requests\getDocumentDrawingObjectsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DrawingObjectsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentFieldNames
     *
     * Reads merge field names from the document.
     *
     * @param Requests\getDocumentFieldNamesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FieldNamesResponse
     */
    public function getDocumentFieldNames(Requests\getDocumentFieldNamesRequest $request)
    {
        try {
            list($response) = $this->getDocumentFieldNamesWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentFieldNamesWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentFieldNamesWithHttpInfo
     *
     * Reads merge field names from the document.
     *
     * @param Requests\getDocumentFieldNamesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FieldNamesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentFieldNamesWithHttpInfo(Requests\getDocumentFieldNamesRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FieldNamesResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FieldNamesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentFieldNamesAsync
     *
     * Reads merge field names from the document.
     *
     * @param Requests\getDocumentFieldNamesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentFieldNamesAsync(Requests\getDocumentFieldNamesRequest $request) 
    {
        return $this->getDocumentFieldNamesAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentFieldNamesAsyncWithHttpInfo
     *
     * Reads merge field names from the document.
     *
     * @param Requests\getDocumentFieldNamesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentFieldNamesAsyncWithHttpInfo(Requests\getDocumentFieldNamesRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FieldNamesResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentFieldNamesOnline
     *
     * Reads merge field names from the document.
     *
     * @param Requests\getDocumentFieldNamesOnlineRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FieldNamesResponse
     */
    public function getDocumentFieldNamesOnline(Requests\getDocumentFieldNamesOnlineRequest $request)
    {
        try {
            list($response) = $this->getDocumentFieldNamesOnlineWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentFieldNamesOnlineWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentFieldNamesOnlineWithHttpInfo
     *
     * Reads merge field names from the document.
     *
     * @param Requests\getDocumentFieldNamesOnlineRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FieldNamesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentFieldNamesOnlineWithHttpInfo(Requests\getDocumentFieldNamesOnlineRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FieldNamesResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FieldNamesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentFieldNamesOnlineAsync
     *
     * Reads merge field names from the document.
     *
     * @param Requests\getDocumentFieldNamesOnlineRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentFieldNamesOnlineAsync(Requests\getDocumentFieldNamesOnlineRequest $request) 
    {
        return $this->getDocumentFieldNamesOnlineAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentFieldNamesOnlineAsyncWithHttpInfo
     *
     * Reads merge field names from the document.
     *
     * @param Requests\getDocumentFieldNamesOnlineRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentFieldNamesOnlineAsyncWithHttpInfo(Requests\getDocumentFieldNamesOnlineRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FieldNamesResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentHyperlinkByIndex
     *
     * Reads a hyperlink from the document.
     *
     * @param Requests\getDocumentHyperlinkByIndexRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\HyperlinkResponse
     */
    public function getDocumentHyperlinkByIndex(Requests\getDocumentHyperlinkByIndexRequest $request)
    {
        try {
            list($response) = $this->getDocumentHyperlinkByIndexWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentHyperlinkByIndexWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentHyperlinkByIndexWithHttpInfo
     *
     * Reads a hyperlink from the document.
     *
     * @param Requests\getDocumentHyperlinkByIndexRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\HyperlinkResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentHyperlinkByIndexWithHttpInfo(Requests\getDocumentHyperlinkByIndexRequest $request)
    {
        $returnType = '\Aspose\Words\Model\HyperlinkResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\HyperlinkResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentHyperlinkByIndexAsync
     *
     * Reads a hyperlink from the document.
     *
     * @param Requests\getDocumentHyperlinkByIndexRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentHyperlinkByIndexAsync(Requests\getDocumentHyperlinkByIndexRequest $request) 
    {
        return $this->getDocumentHyperlinkByIndexAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentHyperlinkByIndexAsyncWithHttpInfo
     *
     * Reads a hyperlink from the document.
     *
     * @param Requests\getDocumentHyperlinkByIndexRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentHyperlinkByIndexAsyncWithHttpInfo(Requests\getDocumentHyperlinkByIndexRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\HyperlinkResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentHyperlinks
     *
     * Reads hyperlinks from the document.
     *
     * @param Requests\getDocumentHyperlinksRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\HyperlinksResponse
     */
    public function getDocumentHyperlinks(Requests\getDocumentHyperlinksRequest $request)
    {
        try {
            list($response) = $this->getDocumentHyperlinksWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentHyperlinksWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentHyperlinksWithHttpInfo
     *
     * Reads hyperlinks from the document.
     *
     * @param Requests\getDocumentHyperlinksRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\HyperlinksResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentHyperlinksWithHttpInfo(Requests\getDocumentHyperlinksRequest $request)
    {
        $returnType = '\Aspose\Words\Model\HyperlinksResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\HyperlinksResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentHyperlinksAsync
     *
     * Reads hyperlinks from the document.
     *
     * @param Requests\getDocumentHyperlinksRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentHyperlinksAsync(Requests\getDocumentHyperlinksRequest $request) 
    {
        return $this->getDocumentHyperlinksAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentHyperlinksAsyncWithHttpInfo
     *
     * Reads hyperlinks from the document.
     *
     * @param Requests\getDocumentHyperlinksRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentHyperlinksAsyncWithHttpInfo(Requests\getDocumentHyperlinksRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\HyperlinksResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentProperties
     *
     * Reads document properties.
     *
     * @param Requests\getDocumentPropertiesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentPropertiesResponse
     */
    public function getDocumentProperties(Requests\getDocumentPropertiesRequest $request)
    {
        try {
            list($response) = $this->getDocumentPropertiesWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentPropertiesWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentPropertiesWithHttpInfo
     *
     * Reads document properties.
     *
     * @param Requests\getDocumentPropertiesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentPropertiesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentPropertiesWithHttpInfo(Requests\getDocumentPropertiesRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentPropertiesResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentPropertiesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentPropertiesAsync
     *
     * Reads document properties.
     *
     * @param Requests\getDocumentPropertiesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentPropertiesAsync(Requests\getDocumentPropertiesRequest $request) 
    {
        return $this->getDocumentPropertiesAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentPropertiesAsyncWithHttpInfo
     *
     * Reads document properties.
     *
     * @param Requests\getDocumentPropertiesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentPropertiesAsyncWithHttpInfo(Requests\getDocumentPropertiesRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentPropertiesResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentProperty
     *
     * Reads a document property.
     *
     * @param Requests\getDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentPropertyResponse
     */
    public function getDocumentProperty(Requests\getDocumentPropertyRequest $request)
    {
        try {
            list($response) = $this->getDocumentPropertyWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentPropertyWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentPropertyWithHttpInfo
     *
     * Reads a document property.
     *
     * @param Requests\getDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentPropertyResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentPropertyWithHttpInfo(Requests\getDocumentPropertyRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentPropertyResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentPropertyResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentPropertyAsync
     *
     * Reads a document property.
     *
     * @param Requests\getDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentPropertyAsync(Requests\getDocumentPropertyRequest $request) 
    {
        return $this->getDocumentPropertyAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentPropertyAsyncWithHttpInfo
     *
     * Reads a document property.
     *
     * @param Requests\getDocumentPropertyRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentPropertyAsyncWithHttpInfo(Requests\getDocumentPropertyRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentPropertyResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentProtection
     *
     * Reads protection properties from the document.
     *
     * @param Requests\getDocumentProtectionRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ProtectionDataResponse
     */
    public function getDocumentProtection(Requests\getDocumentProtectionRequest $request)
    {
        try {
            list($response) = $this->getDocumentProtectionWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentProtectionWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentProtectionWithHttpInfo
     *
     * Reads protection properties from the document.
     *
     * @param Requests\getDocumentProtectionRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ProtectionDataResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentProtectionWithHttpInfo(Requests\getDocumentProtectionRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ProtectionDataResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ProtectionDataResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentProtectionAsync
     *
     * Reads protection properties from the document.
     *
     * @param Requests\getDocumentProtectionRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentProtectionAsync(Requests\getDocumentProtectionRequest $request) 
    {
        return $this->getDocumentProtectionAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentProtectionAsyncWithHttpInfo
     *
     * Reads protection properties from the document.
     *
     * @param Requests\getDocumentProtectionRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentProtectionAsyncWithHttpInfo(Requests\getDocumentProtectionRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ProtectionDataResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentStatistics
     *
     * Reads document statistics.
     *
     * @param Requests\getDocumentStatisticsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\StatDataResponse
     */
    public function getDocumentStatistics(Requests\getDocumentStatisticsRequest $request)
    {
        try {
            list($response) = $this->getDocumentStatisticsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentStatisticsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentStatisticsWithHttpInfo
     *
     * Reads document statistics.
     *
     * @param Requests\getDocumentStatisticsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\StatDataResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentStatisticsWithHttpInfo(Requests\getDocumentStatisticsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\StatDataResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\StatDataResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentStatisticsAsync
     *
     * Reads document statistics.
     *
     * @param Requests\getDocumentStatisticsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentStatisticsAsync(Requests\getDocumentStatisticsRequest $request) 
    {
        return $this->getDocumentStatisticsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentStatisticsAsyncWithHttpInfo
     *
     * Reads document statistics.
     *
     * @param Requests\getDocumentStatisticsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentStatisticsAsyncWithHttpInfo(Requests\getDocumentStatisticsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\StatDataResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getDocumentWithFormat
     *
     * Converts a document in cloud storage to the specified format.
     *
     * @param Requests\getDocumentWithFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function getDocumentWithFormat(Requests\getDocumentWithFormatRequest $request)
    {
        try {
            list($response) = $this->getDocumentWithFormatWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getDocumentWithFormatWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getDocumentWithFormatWithHttpInfo
     *
     * Converts a document in cloud storage to the specified format.
     *
     * @param Requests\getDocumentWithFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function getDocumentWithFormatWithHttpInfo(Requests\getDocumentWithFormatRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getDocumentWithFormatAsync
     *
     * Converts a document in cloud storage to the specified format.
     *
     * @param Requests\getDocumentWithFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDocumentWithFormatAsync(Requests\getDocumentWithFormatRequest $request) 
    {
        return $this->getDocumentWithFormatAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getDocumentWithFormatAsyncWithHttpInfo
     *
     * Converts a document in cloud storage to the specified format.
     *
     * @param Requests\getDocumentWithFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getDocumentWithFormatAsyncWithHttpInfo(Requests\getDocumentWithFormatRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getField
     *
     * Reads a field from the document node.
     *
     * @param Requests\getFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FieldResponse
     */
    public function getField(Requests\getFieldRequest $request)
    {
        try {
            list($response) = $this->getFieldWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getFieldWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getFieldWithHttpInfo
     *
     * Reads a field from the document node.
     *
     * @param Requests\getFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FieldResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getFieldWithHttpInfo(Requests\getFieldRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FieldResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FieldResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getFieldAsync
     *
     * Reads a field from the document node.
     *
     * @param Requests\getFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFieldAsync(Requests\getFieldRequest $request) 
    {
        return $this->getFieldAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getFieldAsyncWithHttpInfo
     *
     * Reads a field from the document node.
     *
     * @param Requests\getFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getFieldAsyncWithHttpInfo(Requests\getFieldRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FieldResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getFields
     *
     * Reads fields from the document node.
     *
     * @param Requests\getFieldsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FieldsResponse
     */
    public function getFields(Requests\getFieldsRequest $request)
    {
        try {
            list($response) = $this->getFieldsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getFieldsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getFieldsWithHttpInfo
     *
     * Reads fields from the document node.
     *
     * @param Requests\getFieldsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FieldsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getFieldsWithHttpInfo(Requests\getFieldsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FieldsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FieldsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getFieldsAsync
     *
     * Reads fields from the document node.
     *
     * @param Requests\getFieldsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFieldsAsync(Requests\getFieldsRequest $request) 
    {
        return $this->getFieldsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getFieldsAsyncWithHttpInfo
     *
     * Reads fields from the document node.
     *
     * @param Requests\getFieldsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getFieldsAsyncWithHttpInfo(Requests\getFieldsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FieldsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getFilesList
     *
     * Get all files and folders within a folder.
     *
     * @param Requests\getFilesListRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FilesList
     */
    public function getFilesList(Requests\getFilesListRequest $request)
    {
        try {
            list($response) = $this->getFilesListWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getFilesListWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getFilesListWithHttpInfo
     *
     * Get all files and folders within a folder.
     *
     * @param Requests\getFilesListRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FilesList, HTTP status code, HTTP response headers (array of strings)
     */
    private function getFilesListWithHttpInfo(Requests\getFilesListRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FilesList';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FilesList', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getFilesListAsync
     *
     * Get all files and folders within a folder.
     *
     * @param Requests\getFilesListRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFilesListAsync(Requests\getFilesListRequest $request) 
    {
        return $this->getFilesListAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getFilesListAsyncWithHttpInfo
     *
     * Get all files and folders within a folder.
     *
     * @param Requests\getFilesListRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getFilesListAsyncWithHttpInfo(Requests\getFilesListRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FilesList';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getFootnote
     *
     * Reads a footnote from the document node.
     *
     * @param Requests\getFootnoteRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FootnoteResponse
     */
    public function getFootnote(Requests\getFootnoteRequest $request)
    {
        try {
            list($response) = $this->getFootnoteWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getFootnoteWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getFootnoteWithHttpInfo
     *
     * Reads a footnote from the document node.
     *
     * @param Requests\getFootnoteRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FootnoteResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getFootnoteWithHttpInfo(Requests\getFootnoteRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FootnoteResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FootnoteResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getFootnoteAsync
     *
     * Reads a footnote from the document node.
     *
     * @param Requests\getFootnoteRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFootnoteAsync(Requests\getFootnoteRequest $request) 
    {
        return $this->getFootnoteAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getFootnoteAsyncWithHttpInfo
     *
     * Reads a footnote from the document node.
     *
     * @param Requests\getFootnoteRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getFootnoteAsyncWithHttpInfo(Requests\getFootnoteRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FootnoteResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getFootnotes
     *
     * Reads footnotes from the document node.
     *
     * @param Requests\getFootnotesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FootnotesResponse
     */
    public function getFootnotes(Requests\getFootnotesRequest $request)
    {
        try {
            list($response) = $this->getFootnotesWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getFootnotesWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getFootnotesWithHttpInfo
     *
     * Reads footnotes from the document node.
     *
     * @param Requests\getFootnotesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FootnotesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getFootnotesWithHttpInfo(Requests\getFootnotesRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FootnotesResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FootnotesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getFootnotesAsync
     *
     * Reads footnotes from the document node.
     *
     * @param Requests\getFootnotesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFootnotesAsync(Requests\getFootnotesRequest $request) 
    {
        return $this->getFootnotesAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getFootnotesAsyncWithHttpInfo
     *
     * Reads footnotes from the document node.
     *
     * @param Requests\getFootnotesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getFootnotesAsyncWithHttpInfo(Requests\getFootnotesRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FootnotesResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getFormField
     *
     * Reads a form field from the document node.
     *
     * @param Requests\getFormFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FormFieldResponse
     */
    public function getFormField(Requests\getFormFieldRequest $request)
    {
        try {
            list($response) = $this->getFormFieldWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getFormFieldWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getFormFieldWithHttpInfo
     *
     * Reads a form field from the document node.
     *
     * @param Requests\getFormFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FormFieldResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getFormFieldWithHttpInfo(Requests\getFormFieldRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FormFieldResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FormFieldResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getFormFieldAsync
     *
     * Reads a form field from the document node.
     *
     * @param Requests\getFormFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFormFieldAsync(Requests\getFormFieldRequest $request) 
    {
        return $this->getFormFieldAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getFormFieldAsyncWithHttpInfo
     *
     * Reads a form field from the document node.
     *
     * @param Requests\getFormFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getFormFieldAsyncWithHttpInfo(Requests\getFormFieldRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FormFieldResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getFormFields
     *
     * Reads form fields from the document node.
     *
     * @param Requests\getFormFieldsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FormFieldsResponse
     */
    public function getFormFields(Requests\getFormFieldsRequest $request)
    {
        try {
            list($response) = $this->getFormFieldsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getFormFieldsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getFormFieldsWithHttpInfo
     *
     * Reads form fields from the document node.
     *
     * @param Requests\getFormFieldsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FormFieldsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getFormFieldsWithHttpInfo(Requests\getFormFieldsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FormFieldsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FormFieldsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getFormFieldsAsync
     *
     * Reads form fields from the document node.
     *
     * @param Requests\getFormFieldsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFormFieldsAsync(Requests\getFormFieldsRequest $request) 
    {
        return $this->getFormFieldsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getFormFieldsAsyncWithHttpInfo
     *
     * Reads form fields from the document node.
     *
     * @param Requests\getFormFieldsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getFormFieldsAsyncWithHttpInfo(Requests\getFormFieldsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FormFieldsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getHeaderFooter
     *
     * Reads a HeaderFooter object from the document.
     *
     * @param Requests\getHeaderFooterRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\HeaderFooterResponse
     */
    public function getHeaderFooter(Requests\getHeaderFooterRequest $request)
    {
        try {
            list($response) = $this->getHeaderFooterWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getHeaderFooterWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getHeaderFooterWithHttpInfo
     *
     * Reads a HeaderFooter object from the document.
     *
     * @param Requests\getHeaderFooterRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\HeaderFooterResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getHeaderFooterWithHttpInfo(Requests\getHeaderFooterRequest $request)
    {
        $returnType = '\Aspose\Words\Model\HeaderFooterResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\HeaderFooterResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getHeaderFooterAsync
     *
     * Reads a HeaderFooter object from the document.
     *
     * @param Requests\getHeaderFooterRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getHeaderFooterAsync(Requests\getHeaderFooterRequest $request) 
    {
        return $this->getHeaderFooterAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getHeaderFooterAsyncWithHttpInfo
     *
     * Reads a HeaderFooter object from the document.
     *
     * @param Requests\getHeaderFooterRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getHeaderFooterAsyncWithHttpInfo(Requests\getHeaderFooterRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\HeaderFooterResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getHeaderFooterOfSection
     *
     * Reads a HeaderFooter object from the document section.
     *
     * @param Requests\getHeaderFooterOfSectionRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\HeaderFooterResponse
     */
    public function getHeaderFooterOfSection(Requests\getHeaderFooterOfSectionRequest $request)
    {
        try {
            list($response) = $this->getHeaderFooterOfSectionWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getHeaderFooterOfSectionWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getHeaderFooterOfSectionWithHttpInfo
     *
     * Reads a HeaderFooter object from the document section.
     *
     * @param Requests\getHeaderFooterOfSectionRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\HeaderFooterResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getHeaderFooterOfSectionWithHttpInfo(Requests\getHeaderFooterOfSectionRequest $request)
    {
        $returnType = '\Aspose\Words\Model\HeaderFooterResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\HeaderFooterResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getHeaderFooterOfSectionAsync
     *
     * Reads a HeaderFooter object from the document section.
     *
     * @param Requests\getHeaderFooterOfSectionRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getHeaderFooterOfSectionAsync(Requests\getHeaderFooterOfSectionRequest $request) 
    {
        return $this->getHeaderFooterOfSectionAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getHeaderFooterOfSectionAsyncWithHttpInfo
     *
     * Reads a HeaderFooter object from the document section.
     *
     * @param Requests\getHeaderFooterOfSectionRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getHeaderFooterOfSectionAsyncWithHttpInfo(Requests\getHeaderFooterOfSectionRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\HeaderFooterResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getHeaderFooters
     *
     * Reads HeaderFooter objects from the document section.
     *
     * @param Requests\getHeaderFootersRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\HeaderFootersResponse
     */
    public function getHeaderFooters(Requests\getHeaderFootersRequest $request)
    {
        try {
            list($response) = $this->getHeaderFootersWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getHeaderFootersWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getHeaderFootersWithHttpInfo
     *
     * Reads HeaderFooter objects from the document section.
     *
     * @param Requests\getHeaderFootersRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\HeaderFootersResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getHeaderFootersWithHttpInfo(Requests\getHeaderFootersRequest $request)
    {
        $returnType = '\Aspose\Words\Model\HeaderFootersResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\HeaderFootersResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getHeaderFootersAsync
     *
     * Reads HeaderFooter objects from the document section.
     *
     * @param Requests\getHeaderFootersRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getHeaderFootersAsync(Requests\getHeaderFootersRequest $request) 
    {
        return $this->getHeaderFootersAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getHeaderFootersAsyncWithHttpInfo
     *
     * Reads HeaderFooter objects from the document section.
     *
     * @param Requests\getHeaderFootersRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getHeaderFootersAsyncWithHttpInfo(Requests\getHeaderFootersRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\HeaderFootersResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getList
     *
     * Reads a list from the document.
     *
     * @param Requests\getListRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ListResponse
     */
    public function getList(Requests\getListRequest $request)
    {
        try {
            list($response) = $this->getListWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getListWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getListWithHttpInfo
     *
     * Reads a list from the document.
     *
     * @param Requests\getListRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getListWithHttpInfo(Requests\getListRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ListResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ListResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getListAsync
     *
     * Reads a list from the document.
     *
     * @param Requests\getListRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getListAsync(Requests\getListRequest $request) 
    {
        return $this->getListAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getListAsyncWithHttpInfo
     *
     * Reads a list from the document.
     *
     * @param Requests\getListRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getListAsyncWithHttpInfo(Requests\getListRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ListResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getLists
     *
     * Reads lists from the document.
     *
     * @param Requests\getListsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ListsResponse
     */
    public function getLists(Requests\getListsRequest $request)
    {
        try {
            list($response) = $this->getListsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getListsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getListsWithHttpInfo
     *
     * Reads lists from the document.
     *
     * @param Requests\getListsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ListsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getListsWithHttpInfo(Requests\getListsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ListsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ListsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getListsAsync
     *
     * Reads lists from the document.
     *
     * @param Requests\getListsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getListsAsync(Requests\getListsRequest $request) 
    {
        return $this->getListsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getListsAsyncWithHttpInfo
     *
     * Reads lists from the document.
     *
     * @param Requests\getListsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getListsAsyncWithHttpInfo(Requests\getListsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ListsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getOfficeMathObject
     *
     * Reads an OfficeMath object from the document node.
     *
     * @param Requests\getOfficeMathObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\OfficeMathObjectResponse
     */
    public function getOfficeMathObject(Requests\getOfficeMathObjectRequest $request)
    {
        try {
            list($response) = $this->getOfficeMathObjectWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getOfficeMathObjectWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getOfficeMathObjectWithHttpInfo
     *
     * Reads an OfficeMath object from the document node.
     *
     * @param Requests\getOfficeMathObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\OfficeMathObjectResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getOfficeMathObjectWithHttpInfo(Requests\getOfficeMathObjectRequest $request)
    {
        $returnType = '\Aspose\Words\Model\OfficeMathObjectResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\OfficeMathObjectResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getOfficeMathObjectAsync
     *
     * Reads an OfficeMath object from the document node.
     *
     * @param Requests\getOfficeMathObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOfficeMathObjectAsync(Requests\getOfficeMathObjectRequest $request) 
    {
        return $this->getOfficeMathObjectAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getOfficeMathObjectAsyncWithHttpInfo
     *
     * Reads an OfficeMath object from the document node.
     *
     * @param Requests\getOfficeMathObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getOfficeMathObjectAsyncWithHttpInfo(Requests\getOfficeMathObjectRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\OfficeMathObjectResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getOfficeMathObjects
     *
     * Reads OfficeMath objects from the document node.
     *
     * @param Requests\getOfficeMathObjectsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\OfficeMathObjectsResponse
     */
    public function getOfficeMathObjects(Requests\getOfficeMathObjectsRequest $request)
    {
        try {
            list($response) = $this->getOfficeMathObjectsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getOfficeMathObjectsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getOfficeMathObjectsWithHttpInfo
     *
     * Reads OfficeMath objects from the document node.
     *
     * @param Requests\getOfficeMathObjectsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\OfficeMathObjectsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getOfficeMathObjectsWithHttpInfo(Requests\getOfficeMathObjectsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\OfficeMathObjectsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\OfficeMathObjectsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getOfficeMathObjectsAsync
     *
     * Reads OfficeMath objects from the document node.
     *
     * @param Requests\getOfficeMathObjectsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOfficeMathObjectsAsync(Requests\getOfficeMathObjectsRequest $request) 
    {
        return $this->getOfficeMathObjectsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getOfficeMathObjectsAsyncWithHttpInfo
     *
     * Reads OfficeMath objects from the document node.
     *
     * @param Requests\getOfficeMathObjectsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getOfficeMathObjectsAsyncWithHttpInfo(Requests\getOfficeMathObjectsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\OfficeMathObjectsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getParagraph
     *
     * Reads a paragraph from the document node.
     *
     * @param Requests\getParagraphRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ParagraphResponse
     */
    public function getParagraph(Requests\getParagraphRequest $request)
    {
        try {
            list($response) = $this->getParagraphWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getParagraphWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getParagraphWithHttpInfo
     *
     * Reads a paragraph from the document node.
     *
     * @param Requests\getParagraphRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ParagraphResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getParagraphWithHttpInfo(Requests\getParagraphRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ParagraphResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ParagraphResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getParagraphAsync
     *
     * Reads a paragraph from the document node.
     *
     * @param Requests\getParagraphRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getParagraphAsync(Requests\getParagraphRequest $request) 
    {
        return $this->getParagraphAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getParagraphAsyncWithHttpInfo
     *
     * Reads a paragraph from the document node.
     *
     * @param Requests\getParagraphRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getParagraphAsyncWithHttpInfo(Requests\getParagraphRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ParagraphResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getParagraphFormat
     *
     * Reads the formatting properties of a paragraph from the document node.
     *
     * @param Requests\getParagraphFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ParagraphFormatResponse
     */
    public function getParagraphFormat(Requests\getParagraphFormatRequest $request)
    {
        try {
            list($response) = $this->getParagraphFormatWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getParagraphFormatWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getParagraphFormatWithHttpInfo
     *
     * Reads the formatting properties of a paragraph from the document node.
     *
     * @param Requests\getParagraphFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ParagraphFormatResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getParagraphFormatWithHttpInfo(Requests\getParagraphFormatRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ParagraphFormatResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ParagraphFormatResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getParagraphFormatAsync
     *
     * Reads the formatting properties of a paragraph from the document node.
     *
     * @param Requests\getParagraphFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getParagraphFormatAsync(Requests\getParagraphFormatRequest $request) 
    {
        return $this->getParagraphFormatAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getParagraphFormatAsyncWithHttpInfo
     *
     * Reads the formatting properties of a paragraph from the document node.
     *
     * @param Requests\getParagraphFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getParagraphFormatAsyncWithHttpInfo(Requests\getParagraphFormatRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ParagraphFormatResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getParagraphListFormat
     *
     * Reads the formatting properties of a paragraph list from the document node.
     *
     * @param Requests\getParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ParagraphListFormatResponse
     */
    public function getParagraphListFormat(Requests\getParagraphListFormatRequest $request)
    {
        try {
            list($response) = $this->getParagraphListFormatWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getParagraphListFormatWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getParagraphListFormatWithHttpInfo
     *
     * Reads the formatting properties of a paragraph list from the document node.
     *
     * @param Requests\getParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ParagraphListFormatResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getParagraphListFormatWithHttpInfo(Requests\getParagraphListFormatRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ParagraphListFormatResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ParagraphListFormatResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getParagraphListFormatAsync
     *
     * Reads the formatting properties of a paragraph list from the document node.
     *
     * @param Requests\getParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getParagraphListFormatAsync(Requests\getParagraphListFormatRequest $request) 
    {
        return $this->getParagraphListFormatAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getParagraphListFormatAsyncWithHttpInfo
     *
     * Reads the formatting properties of a paragraph list from the document node.
     *
     * @param Requests\getParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getParagraphListFormatAsyncWithHttpInfo(Requests\getParagraphListFormatRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ParagraphListFormatResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getParagraphs
     *
     * Reads paragraphs from the document node.
     *
     * @param Requests\getParagraphsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ParagraphLinkCollectionResponse
     */
    public function getParagraphs(Requests\getParagraphsRequest $request)
    {
        try {
            list($response) = $this->getParagraphsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getParagraphsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getParagraphsWithHttpInfo
     *
     * Reads paragraphs from the document node.
     *
     * @param Requests\getParagraphsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ParagraphLinkCollectionResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getParagraphsWithHttpInfo(Requests\getParagraphsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ParagraphLinkCollectionResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ParagraphLinkCollectionResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getParagraphsAsync
     *
     * Reads paragraphs from the document node.
     *
     * @param Requests\getParagraphsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getParagraphsAsync(Requests\getParagraphsRequest $request) 
    {
        return $this->getParagraphsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getParagraphsAsyncWithHttpInfo
     *
     * Reads paragraphs from the document node.
     *
     * @param Requests\getParagraphsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getParagraphsAsyncWithHttpInfo(Requests\getParagraphsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ParagraphLinkCollectionResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getParagraphTabStops
     *
     * Reads paragraph tab stops from the document node.
     *
     * @param Requests\getParagraphTabStopsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TabStopsResponse
     */
    public function getParagraphTabStops(Requests\getParagraphTabStopsRequest $request)
    {
        try {
            list($response) = $this->getParagraphTabStopsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getParagraphTabStopsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getParagraphTabStopsWithHttpInfo
     *
     * Reads paragraph tab stops from the document node.
     *
     * @param Requests\getParagraphTabStopsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TabStopsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getParagraphTabStopsWithHttpInfo(Requests\getParagraphTabStopsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TabStopsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TabStopsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getParagraphTabStopsAsync
     *
     * Reads paragraph tab stops from the document node.
     *
     * @param Requests\getParagraphTabStopsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getParagraphTabStopsAsync(Requests\getParagraphTabStopsRequest $request) 
    {
        return $this->getParagraphTabStopsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getParagraphTabStopsAsyncWithHttpInfo
     *
     * Reads paragraph tab stops from the document node.
     *
     * @param Requests\getParagraphTabStopsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getParagraphTabStopsAsyncWithHttpInfo(Requests\getParagraphTabStopsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TabStopsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getRangeText
     *
     * Reads range text from the document.
     *
     * @param Requests\getRangeTextRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\RangeTextResponse
     */
    public function getRangeText(Requests\getRangeTextRequest $request)
    {
        try {
            list($response) = $this->getRangeTextWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getRangeTextWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getRangeTextWithHttpInfo
     *
     * Reads range text from the document.
     *
     * @param Requests\getRangeTextRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\RangeTextResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getRangeTextWithHttpInfo(Requests\getRangeTextRequest $request)
    {
        $returnType = '\Aspose\Words\Model\RangeTextResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\RangeTextResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getRangeTextAsync
     *
     * Reads range text from the document.
     *
     * @param Requests\getRangeTextRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getRangeTextAsync(Requests\getRangeTextRequest $request) 
    {
        return $this->getRangeTextAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getRangeTextAsyncWithHttpInfo
     *
     * Reads range text from the document.
     *
     * @param Requests\getRangeTextRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getRangeTextAsyncWithHttpInfo(Requests\getRangeTextRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\RangeTextResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getRun
     *
     * Reads a Run object from the paragraph.
     *
     * @param Requests\getRunRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\RunResponse
     */
    public function getRun(Requests\getRunRequest $request)
    {
        try {
            list($response) = $this->getRunWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getRunWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getRunWithHttpInfo
     *
     * Reads a Run object from the paragraph.
     *
     * @param Requests\getRunRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\RunResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getRunWithHttpInfo(Requests\getRunRequest $request)
    {
        $returnType = '\Aspose\Words\Model\RunResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\RunResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getRunAsync
     *
     * Reads a Run object from the paragraph.
     *
     * @param Requests\getRunRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getRunAsync(Requests\getRunRequest $request) 
    {
        return $this->getRunAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getRunAsyncWithHttpInfo
     *
     * Reads a Run object from the paragraph.
     *
     * @param Requests\getRunRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getRunAsyncWithHttpInfo(Requests\getRunRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\RunResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getRunFont
     *
     * Reads the font properties of a Run object from the paragraph.
     *
     * @param Requests\getRunFontRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FontResponse
     */
    public function getRunFont(Requests\getRunFontRequest $request)
    {
        try {
            list($response) = $this->getRunFontWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getRunFontWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getRunFontWithHttpInfo
     *
     * Reads the font properties of a Run object from the paragraph.
     *
     * @param Requests\getRunFontRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FontResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getRunFontWithHttpInfo(Requests\getRunFontRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FontResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FontResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getRunFontAsync
     *
     * Reads the font properties of a Run object from the paragraph.
     *
     * @param Requests\getRunFontRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getRunFontAsync(Requests\getRunFontRequest $request) 
    {
        return $this->getRunFontAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getRunFontAsyncWithHttpInfo
     *
     * Reads the font properties of a Run object from the paragraph.
     *
     * @param Requests\getRunFontRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getRunFontAsyncWithHttpInfo(Requests\getRunFontRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FontResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getRuns
     *
     * Reads Run objects from the paragraph.
     *
     * @param Requests\getRunsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\RunsResponse
     */
    public function getRuns(Requests\getRunsRequest $request)
    {
        try {
            list($response) = $this->getRunsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getRunsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getRunsWithHttpInfo
     *
     * Reads Run objects from the paragraph.
     *
     * @param Requests\getRunsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\RunsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getRunsWithHttpInfo(Requests\getRunsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\RunsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\RunsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getRunsAsync
     *
     * Reads Run objects from the paragraph.
     *
     * @param Requests\getRunsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getRunsAsync(Requests\getRunsRequest $request) 
    {
        return $this->getRunsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getRunsAsyncWithHttpInfo
     *
     * Reads Run objects from the paragraph.
     *
     * @param Requests\getRunsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getRunsAsyncWithHttpInfo(Requests\getRunsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\RunsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getSection
     *
     * Reads a section from the document.
     *
     * @param Requests\getSectionRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\SectionResponse
     */
    public function getSection(Requests\getSectionRequest $request)
    {
        try {
            list($response) = $this->getSectionWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getSectionWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getSectionWithHttpInfo
     *
     * Reads a section from the document.
     *
     * @param Requests\getSectionRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\SectionResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getSectionWithHttpInfo(Requests\getSectionRequest $request)
    {
        $returnType = '\Aspose\Words\Model\SectionResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\SectionResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getSectionAsync
     *
     * Reads a section from the document.
     *
     * @param Requests\getSectionRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getSectionAsync(Requests\getSectionRequest $request) 
    {
        return $this->getSectionAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getSectionAsyncWithHttpInfo
     *
     * Reads a section from the document.
     *
     * @param Requests\getSectionRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getSectionAsyncWithHttpInfo(Requests\getSectionRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\SectionResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getSectionPageSetup
     *
     * Reads the page setup of a section from the document.
     *
     * @param Requests\getSectionPageSetupRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\SectionPageSetupResponse
     */
    public function getSectionPageSetup(Requests\getSectionPageSetupRequest $request)
    {
        try {
            list($response) = $this->getSectionPageSetupWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getSectionPageSetupWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getSectionPageSetupWithHttpInfo
     *
     * Reads the page setup of a section from the document.
     *
     * @param Requests\getSectionPageSetupRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\SectionPageSetupResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getSectionPageSetupWithHttpInfo(Requests\getSectionPageSetupRequest $request)
    {
        $returnType = '\Aspose\Words\Model\SectionPageSetupResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\SectionPageSetupResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getSectionPageSetupAsync
     *
     * Reads the page setup of a section from the document.
     *
     * @param Requests\getSectionPageSetupRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getSectionPageSetupAsync(Requests\getSectionPageSetupRequest $request) 
    {
        return $this->getSectionPageSetupAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getSectionPageSetupAsyncWithHttpInfo
     *
     * Reads the page setup of a section from the document.
     *
     * @param Requests\getSectionPageSetupRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getSectionPageSetupAsyncWithHttpInfo(Requests\getSectionPageSetupRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\SectionPageSetupResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getSections
     *
     * Reads sections from the document.
     *
     * @param Requests\getSectionsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\SectionLinkCollectionResponse
     */
    public function getSections(Requests\getSectionsRequest $request)
    {
        try {
            list($response) = $this->getSectionsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getSectionsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getSectionsWithHttpInfo
     *
     * Reads sections from the document.
     *
     * @param Requests\getSectionsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\SectionLinkCollectionResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getSectionsWithHttpInfo(Requests\getSectionsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\SectionLinkCollectionResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\SectionLinkCollectionResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getSectionsAsync
     *
     * Reads sections from the document.
     *
     * @param Requests\getSectionsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getSectionsAsync(Requests\getSectionsRequest $request) 
    {
        return $this->getSectionsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getSectionsAsyncWithHttpInfo
     *
     * Reads sections from the document.
     *
     * @param Requests\getSectionsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getSectionsAsyncWithHttpInfo(Requests\getSectionsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\SectionLinkCollectionResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getStyle
     *
     * Reads a style from the document.
     *
     * @param Requests\getStyleRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\StyleResponse
     */
    public function getStyle(Requests\getStyleRequest $request)
    {
        try {
            list($response) = $this->getStyleWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getStyleWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getStyleWithHttpInfo
     *
     * Reads a style from the document.
     *
     * @param Requests\getStyleRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\StyleResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getStyleWithHttpInfo(Requests\getStyleRequest $request)
    {
        $returnType = '\Aspose\Words\Model\StyleResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\StyleResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getStyleAsync
     *
     * Reads a style from the document.
     *
     * @param Requests\getStyleRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getStyleAsync(Requests\getStyleRequest $request) 
    {
        return $this->getStyleAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getStyleAsyncWithHttpInfo
     *
     * Reads a style from the document.
     *
     * @param Requests\getStyleRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getStyleAsyncWithHttpInfo(Requests\getStyleRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\StyleResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getStyleFromDocumentElement
     *
     * Reads a style from the document node.
     *
     * @param Requests\getStyleFromDocumentElementRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\StyleResponse
     */
    public function getStyleFromDocumentElement(Requests\getStyleFromDocumentElementRequest $request)
    {
        try {
            list($response) = $this->getStyleFromDocumentElementWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getStyleFromDocumentElementWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getStyleFromDocumentElementWithHttpInfo
     *
     * Reads a style from the document node.
     *
     * @param Requests\getStyleFromDocumentElementRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\StyleResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getStyleFromDocumentElementWithHttpInfo(Requests\getStyleFromDocumentElementRequest $request)
    {
        $returnType = '\Aspose\Words\Model\StyleResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\StyleResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getStyleFromDocumentElementAsync
     *
     * Reads a style from the document node.
     *
     * @param Requests\getStyleFromDocumentElementRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getStyleFromDocumentElementAsync(Requests\getStyleFromDocumentElementRequest $request) 
    {
        return $this->getStyleFromDocumentElementAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getStyleFromDocumentElementAsyncWithHttpInfo
     *
     * Reads a style from the document node.
     *
     * @param Requests\getStyleFromDocumentElementRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getStyleFromDocumentElementAsyncWithHttpInfo(Requests\getStyleFromDocumentElementRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\StyleResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getStyles
     *
     * Reads styles from the document.
     *
     * @param Requests\getStylesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\StylesResponse
     */
    public function getStyles(Requests\getStylesRequest $request)
    {
        try {
            list($response) = $this->getStylesWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getStylesWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getStylesWithHttpInfo
     *
     * Reads styles from the document.
     *
     * @param Requests\getStylesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\StylesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getStylesWithHttpInfo(Requests\getStylesRequest $request)
    {
        $returnType = '\Aspose\Words\Model\StylesResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\StylesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getStylesAsync
     *
     * Reads styles from the document.
     *
     * @param Requests\getStylesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getStylesAsync(Requests\getStylesRequest $request) 
    {
        return $this->getStylesAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getStylesAsyncWithHttpInfo
     *
     * Reads styles from the document.
     *
     * @param Requests\getStylesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getStylesAsyncWithHttpInfo(Requests\getStylesRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\StylesResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getTable
     *
     * Reads a table from the document node.
     *
     * @param Requests\getTableRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TableResponse
     */
    public function getTable(Requests\getTableRequest $request)
    {
        try {
            list($response) = $this->getTableWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getTableWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getTableWithHttpInfo
     *
     * Reads a table from the document node.
     *
     * @param Requests\getTableRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TableResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getTableWithHttpInfo(Requests\getTableRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TableResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TableResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getTableAsync
     *
     * Reads a table from the document node.
     *
     * @param Requests\getTableRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTableAsync(Requests\getTableRequest $request) 
    {
        return $this->getTableAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getTableAsyncWithHttpInfo
     *
     * Reads a table from the document node.
     *
     * @param Requests\getTableRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getTableAsyncWithHttpInfo(Requests\getTableRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TableResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getTableCell
     *
     * Reads a cell from the table row.
     *
     * @param Requests\getTableCellRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TableCellResponse
     */
    public function getTableCell(Requests\getTableCellRequest $request)
    {
        try {
            list($response) = $this->getTableCellWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getTableCellWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getTableCellWithHttpInfo
     *
     * Reads a cell from the table row.
     *
     * @param Requests\getTableCellRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TableCellResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getTableCellWithHttpInfo(Requests\getTableCellRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TableCellResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TableCellResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getTableCellAsync
     *
     * Reads a cell from the table row.
     *
     * @param Requests\getTableCellRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTableCellAsync(Requests\getTableCellRequest $request) 
    {
        return $this->getTableCellAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getTableCellAsyncWithHttpInfo
     *
     * Reads a cell from the table row.
     *
     * @param Requests\getTableCellRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getTableCellAsyncWithHttpInfo(Requests\getTableCellRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TableCellResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getTableCellFormat
     *
     * Reads the formatting properties of a table cell.
     *
     * @param Requests\getTableCellFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TableCellFormatResponse
     */
    public function getTableCellFormat(Requests\getTableCellFormatRequest $request)
    {
        try {
            list($response) = $this->getTableCellFormatWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getTableCellFormatWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getTableCellFormatWithHttpInfo
     *
     * Reads the formatting properties of a table cell.
     *
     * @param Requests\getTableCellFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TableCellFormatResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getTableCellFormatWithHttpInfo(Requests\getTableCellFormatRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TableCellFormatResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TableCellFormatResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getTableCellFormatAsync
     *
     * Reads the formatting properties of a table cell.
     *
     * @param Requests\getTableCellFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTableCellFormatAsync(Requests\getTableCellFormatRequest $request) 
    {
        return $this->getTableCellFormatAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getTableCellFormatAsyncWithHttpInfo
     *
     * Reads the formatting properties of a table cell.
     *
     * @param Requests\getTableCellFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getTableCellFormatAsyncWithHttpInfo(Requests\getTableCellFormatRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TableCellFormatResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getTableProperties
     *
     * Reads properties of a table from the document node.
     *
     * @param Requests\getTablePropertiesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TablePropertiesResponse
     */
    public function getTableProperties(Requests\getTablePropertiesRequest $request)
    {
        try {
            list($response) = $this->getTablePropertiesWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getTablePropertiesWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getTablePropertiesWithHttpInfo
     *
     * Reads properties of a table from the document node.
     *
     * @param Requests\getTablePropertiesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TablePropertiesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getTablePropertiesWithHttpInfo(Requests\getTablePropertiesRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TablePropertiesResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TablePropertiesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getTablePropertiesAsync
     *
     * Reads properties of a table from the document node.
     *
     * @param Requests\getTablePropertiesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTablePropertiesAsync(Requests\getTablePropertiesRequest $request) 
    {
        return $this->getTablePropertiesAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getTablePropertiesAsyncWithHttpInfo
     *
     * Reads properties of a table from the document node.
     *
     * @param Requests\getTablePropertiesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getTablePropertiesAsyncWithHttpInfo(Requests\getTablePropertiesRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TablePropertiesResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getTableRow
     *
     * Reads a row from the table.
     *
     * @param Requests\getTableRowRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TableRowResponse
     */
    public function getTableRow(Requests\getTableRowRequest $request)
    {
        try {
            list($response) = $this->getTableRowWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getTableRowWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getTableRowWithHttpInfo
     *
     * Reads a row from the table.
     *
     * @param Requests\getTableRowRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TableRowResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getTableRowWithHttpInfo(Requests\getTableRowRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TableRowResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TableRowResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getTableRowAsync
     *
     * Reads a row from the table.
     *
     * @param Requests\getTableRowRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTableRowAsync(Requests\getTableRowRequest $request) 
    {
        return $this->getTableRowAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getTableRowAsyncWithHttpInfo
     *
     * Reads a row from the table.
     *
     * @param Requests\getTableRowRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getTableRowAsyncWithHttpInfo(Requests\getTableRowRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TableRowResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getTableRowFormat
     *
     * Reads the formatting properties of a table row.
     *
     * @param Requests\getTableRowFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TableRowFormatResponse
     */
    public function getTableRowFormat(Requests\getTableRowFormatRequest $request)
    {
        try {
            list($response) = $this->getTableRowFormatWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getTableRowFormatWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getTableRowFormatWithHttpInfo
     *
     * Reads the formatting properties of a table row.
     *
     * @param Requests\getTableRowFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TableRowFormatResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getTableRowFormatWithHttpInfo(Requests\getTableRowFormatRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TableRowFormatResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TableRowFormatResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getTableRowFormatAsync
     *
     * Reads the formatting properties of a table row.
     *
     * @param Requests\getTableRowFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTableRowFormatAsync(Requests\getTableRowFormatRequest $request) 
    {
        return $this->getTableRowFormatAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getTableRowFormatAsyncWithHttpInfo
     *
     * Reads the formatting properties of a table row.
     *
     * @param Requests\getTableRowFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getTableRowFormatAsyncWithHttpInfo(Requests\getTableRowFormatRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TableRowFormatResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation getTables
     *
     * Reads tables from the document node.
     *
     * @param Requests\getTablesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TableLinkCollectionResponse
     */
    public function getTables(Requests\getTablesRequest $request)
    {
        try {
            list($response) = $this->getTablesWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->getTablesWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation getTablesWithHttpInfo
     *
     * Reads tables from the document node.
     *
     * @param Requests\getTablesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TableLinkCollectionResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function getTablesWithHttpInfo(Requests\getTablesRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TableLinkCollectionResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TableLinkCollectionResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation getTablesAsync
     *
     * Reads tables from the document node.
     *
     * @param Requests\getTablesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTablesAsync(Requests\getTablesRequest $request) 
    {
        return $this->getTablesAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation getTablesAsyncWithHttpInfo
     *
     * Reads tables from the document node.
     *
     * @param Requests\getTablesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function getTablesAsyncWithHttpInfo(Requests\getTablesRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TableLinkCollectionResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertComment
     *
     * Inserts a new comment to the document.
     *
     * @param Requests\insertCommentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\CommentResponse
     */
    public function insertComment(Requests\insertCommentRequest $request)
    {
        try {
            list($response) = $this->insertCommentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertCommentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertCommentWithHttpInfo
     *
     * Inserts a new comment to the document.
     *
     * @param Requests\insertCommentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\CommentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertCommentWithHttpInfo(Requests\insertCommentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\CommentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\CommentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertCommentAsync
     *
     * Inserts a new comment to the document.
     *
     * @param Requests\insertCommentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertCommentAsync(Requests\insertCommentRequest $request) 
    {
        return $this->insertCommentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertCommentAsyncWithHttpInfo
     *
     * Inserts a new comment to the document.
     *
     * @param Requests\insertCommentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertCommentAsyncWithHttpInfo(Requests\insertCommentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\CommentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertDrawingObject
     *
     * Inserts a new DrawingObject to the document node.
     *
     * @param Requests\insertDrawingObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DrawingObjectResponse
     */
    public function insertDrawingObject(Requests\insertDrawingObjectRequest $request)
    {
        try {
            list($response) = $this->insertDrawingObjectWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertDrawingObjectWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertDrawingObjectWithHttpInfo
     *
     * Inserts a new DrawingObject to the document node.
     *
     * @param Requests\insertDrawingObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DrawingObjectResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertDrawingObjectWithHttpInfo(Requests\insertDrawingObjectRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DrawingObjectResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DrawingObjectResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertDrawingObjectAsync
     *
     * Inserts a new DrawingObject to the document node.
     *
     * @param Requests\insertDrawingObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertDrawingObjectAsync(Requests\insertDrawingObjectRequest $request) 
    {
        return $this->insertDrawingObjectAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertDrawingObjectAsyncWithHttpInfo
     *
     * Inserts a new DrawingObject to the document node.
     *
     * @param Requests\insertDrawingObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertDrawingObjectAsyncWithHttpInfo(Requests\insertDrawingObjectRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DrawingObjectResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertField
     *
     * Inserts a new field to the document node.
     *
     * @param Requests\insertFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FieldResponse
     */
    public function insertField(Requests\insertFieldRequest $request)
    {
        try {
            list($response) = $this->insertFieldWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertFieldWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertFieldWithHttpInfo
     *
     * Inserts a new field to the document node.
     *
     * @param Requests\insertFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FieldResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertFieldWithHttpInfo(Requests\insertFieldRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FieldResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FieldResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertFieldAsync
     *
     * Inserts a new field to the document node.
     *
     * @param Requests\insertFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertFieldAsync(Requests\insertFieldRequest $request) 
    {
        return $this->insertFieldAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertFieldAsyncWithHttpInfo
     *
     * Inserts a new field to the document node.
     *
     * @param Requests\insertFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertFieldAsyncWithHttpInfo(Requests\insertFieldRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FieldResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertFootnote
     *
     * Inserts a new footnote to the document node.
     *
     * @param Requests\insertFootnoteRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FootnoteResponse
     */
    public function insertFootnote(Requests\insertFootnoteRequest $request)
    {
        try {
            list($response) = $this->insertFootnoteWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertFootnoteWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertFootnoteWithHttpInfo
     *
     * Inserts a new footnote to the document node.
     *
     * @param Requests\insertFootnoteRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FootnoteResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertFootnoteWithHttpInfo(Requests\insertFootnoteRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FootnoteResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FootnoteResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertFootnoteAsync
     *
     * Inserts a new footnote to the document node.
     *
     * @param Requests\insertFootnoteRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertFootnoteAsync(Requests\insertFootnoteRequest $request) 
    {
        return $this->insertFootnoteAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertFootnoteAsyncWithHttpInfo
     *
     * Inserts a new footnote to the document node.
     *
     * @param Requests\insertFootnoteRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertFootnoteAsyncWithHttpInfo(Requests\insertFootnoteRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FootnoteResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertFormField
     *
     * Inserts a new form field to the document node.
     *
     * @param Requests\insertFormFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FormFieldResponse
     */
    public function insertFormField(Requests\insertFormFieldRequest $request)
    {
        try {
            list($response) = $this->insertFormFieldWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertFormFieldWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertFormFieldWithHttpInfo
     *
     * Inserts a new form field to the document node.
     *
     * @param Requests\insertFormFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FormFieldResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertFormFieldWithHttpInfo(Requests\insertFormFieldRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FormFieldResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FormFieldResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertFormFieldAsync
     *
     * Inserts a new form field to the document node.
     *
     * @param Requests\insertFormFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertFormFieldAsync(Requests\insertFormFieldRequest $request) 
    {
        return $this->insertFormFieldAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertFormFieldAsyncWithHttpInfo
     *
     * Inserts a new form field to the document node.
     *
     * @param Requests\insertFormFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertFormFieldAsyncWithHttpInfo(Requests\insertFormFieldRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FormFieldResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertHeaderFooter
     *
     * Inserts a new HeaderFooter object to the document section.
     *
     * @param Requests\insertHeaderFooterRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\HeaderFooterResponse
     */
    public function insertHeaderFooter(Requests\insertHeaderFooterRequest $request)
    {
        try {
            list($response) = $this->insertHeaderFooterWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertHeaderFooterWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertHeaderFooterWithHttpInfo
     *
     * Inserts a new HeaderFooter object to the document section.
     *
     * @param Requests\insertHeaderFooterRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\HeaderFooterResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertHeaderFooterWithHttpInfo(Requests\insertHeaderFooterRequest $request)
    {
        $returnType = '\Aspose\Words\Model\HeaderFooterResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\HeaderFooterResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertHeaderFooterAsync
     *
     * Inserts a new HeaderFooter object to the document section.
     *
     * @param Requests\insertHeaderFooterRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertHeaderFooterAsync(Requests\insertHeaderFooterRequest $request) 
    {
        return $this->insertHeaderFooterAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertHeaderFooterAsyncWithHttpInfo
     *
     * Inserts a new HeaderFooter object to the document section.
     *
     * @param Requests\insertHeaderFooterRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertHeaderFooterAsyncWithHttpInfo(Requests\insertHeaderFooterRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\HeaderFooterResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertList
     *
     * Inserts a new list to the document.
     *
     * @param Requests\insertListRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ListResponse
     */
    public function insertList(Requests\insertListRequest $request)
    {
        try {
            list($response) = $this->insertListWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertListWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertListWithHttpInfo
     *
     * Inserts a new list to the document.
     *
     * @param Requests\insertListRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertListWithHttpInfo(Requests\insertListRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ListResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ListResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertListAsync
     *
     * Inserts a new list to the document.
     *
     * @param Requests\insertListRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertListAsync(Requests\insertListRequest $request) 
    {
        return $this->insertListAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertListAsyncWithHttpInfo
     *
     * Inserts a new list to the document.
     *
     * @param Requests\insertListRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertListAsyncWithHttpInfo(Requests\insertListRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ListResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertOrUpdateParagraphTabStop
     *
     * Inserts a new or updates an existing paragraph tab stop in the document node.
     *
     * @param Requests\insertOrUpdateParagraphTabStopRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TabStopsResponse
     */
    public function insertOrUpdateParagraphTabStop(Requests\insertOrUpdateParagraphTabStopRequest $request)
    {
        try {
            list($response) = $this->insertOrUpdateParagraphTabStopWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertOrUpdateParagraphTabStopWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertOrUpdateParagraphTabStopWithHttpInfo
     *
     * Inserts a new or updates an existing paragraph tab stop in the document node.
     *
     * @param Requests\insertOrUpdateParagraphTabStopRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TabStopsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertOrUpdateParagraphTabStopWithHttpInfo(Requests\insertOrUpdateParagraphTabStopRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TabStopsResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TabStopsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertOrUpdateParagraphTabStopAsync
     *
     * Inserts a new or updates an existing paragraph tab stop in the document node.
     *
     * @param Requests\insertOrUpdateParagraphTabStopRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertOrUpdateParagraphTabStopAsync(Requests\insertOrUpdateParagraphTabStopRequest $request) 
    {
        return $this->insertOrUpdateParagraphTabStopAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertOrUpdateParagraphTabStopAsyncWithHttpInfo
     *
     * Inserts a new or updates an existing paragraph tab stop in the document node.
     *
     * @param Requests\insertOrUpdateParagraphTabStopRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertOrUpdateParagraphTabStopAsyncWithHttpInfo(Requests\insertOrUpdateParagraphTabStopRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TabStopsResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertPageNumbers
     *
     * Inserts page numbers to the document.
     *
     * @param Requests\insertPageNumbersRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function insertPageNumbers(Requests\insertPageNumbersRequest $request)
    {
        try {
            list($response) = $this->insertPageNumbersWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertPageNumbersWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertPageNumbersWithHttpInfo
     *
     * Inserts page numbers to the document.
     *
     * @param Requests\insertPageNumbersRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertPageNumbersWithHttpInfo(Requests\insertPageNumbersRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertPageNumbersAsync
     *
     * Inserts page numbers to the document.
     *
     * @param Requests\insertPageNumbersRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertPageNumbersAsync(Requests\insertPageNumbersRequest $request) 
    {
        return $this->insertPageNumbersAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertPageNumbersAsyncWithHttpInfo
     *
     * Inserts page numbers to the document.
     *
     * @param Requests\insertPageNumbersRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertPageNumbersAsyncWithHttpInfo(Requests\insertPageNumbersRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertParagraph
     *
     * Inserts a new paragraph to the document node.
     *
     * @param Requests\insertParagraphRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ParagraphResponse
     */
    public function insertParagraph(Requests\insertParagraphRequest $request)
    {
        try {
            list($response) = $this->insertParagraphWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertParagraphWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertParagraphWithHttpInfo
     *
     * Inserts a new paragraph to the document node.
     *
     * @param Requests\insertParagraphRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ParagraphResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertParagraphWithHttpInfo(Requests\insertParagraphRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ParagraphResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ParagraphResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertParagraphAsync
     *
     * Inserts a new paragraph to the document node.
     *
     * @param Requests\insertParagraphRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertParagraphAsync(Requests\insertParagraphRequest $request) 
    {
        return $this->insertParagraphAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertParagraphAsyncWithHttpInfo
     *
     * Inserts a new paragraph to the document node.
     *
     * @param Requests\insertParagraphRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertParagraphAsyncWithHttpInfo(Requests\insertParagraphRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ParagraphResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertRun
     *
     * Inserts a new Run object to the paragraph.
     *
     * @param Requests\insertRunRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\RunResponse
     */
    public function insertRun(Requests\insertRunRequest $request)
    {
        try {
            list($response) = $this->insertRunWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertRunWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertRunWithHttpInfo
     *
     * Inserts a new Run object to the paragraph.
     *
     * @param Requests\insertRunRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\RunResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertRunWithHttpInfo(Requests\insertRunRequest $request)
    {
        $returnType = '\Aspose\Words\Model\RunResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\RunResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertRunAsync
     *
     * Inserts a new Run object to the paragraph.
     *
     * @param Requests\insertRunRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertRunAsync(Requests\insertRunRequest $request) 
    {
        return $this->insertRunAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertRunAsyncWithHttpInfo
     *
     * Inserts a new Run object to the paragraph.
     *
     * @param Requests\insertRunRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertRunAsyncWithHttpInfo(Requests\insertRunRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\RunResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertStyle
     *
     * Inserts a new style to the document.
     *
     * @param Requests\insertStyleRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\StyleResponse
     */
    public function insertStyle(Requests\insertStyleRequest $request)
    {
        try {
            list($response) = $this->insertStyleWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertStyleWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertStyleWithHttpInfo
     *
     * Inserts a new style to the document.
     *
     * @param Requests\insertStyleRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\StyleResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertStyleWithHttpInfo(Requests\insertStyleRequest $request)
    {
        $returnType = '\Aspose\Words\Model\StyleResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\StyleResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertStyleAsync
     *
     * Inserts a new style to the document.
     *
     * @param Requests\insertStyleRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertStyleAsync(Requests\insertStyleRequest $request) 
    {
        return $this->insertStyleAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertStyleAsyncWithHttpInfo
     *
     * Inserts a new style to the document.
     *
     * @param Requests\insertStyleRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertStyleAsyncWithHttpInfo(Requests\insertStyleRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\StyleResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertTable
     *
     * Inserts a new table to the document node.
     *
     * @param Requests\insertTableRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TableResponse
     */
    public function insertTable(Requests\insertTableRequest $request)
    {
        try {
            list($response) = $this->insertTableWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertTableWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertTableWithHttpInfo
     *
     * Inserts a new table to the document node.
     *
     * @param Requests\insertTableRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TableResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertTableWithHttpInfo(Requests\insertTableRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TableResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TableResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertTableAsync
     *
     * Inserts a new table to the document node.
     *
     * @param Requests\insertTableRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertTableAsync(Requests\insertTableRequest $request) 
    {
        return $this->insertTableAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertTableAsyncWithHttpInfo
     *
     * Inserts a new table to the document node.
     *
     * @param Requests\insertTableRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertTableAsyncWithHttpInfo(Requests\insertTableRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TableResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertTableCell
     *
     * Inserts a new cell to the table row.
     *
     * @param Requests\insertTableCellRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TableCellResponse
     */
    public function insertTableCell(Requests\insertTableCellRequest $request)
    {
        try {
            list($response) = $this->insertTableCellWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertTableCellWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertTableCellWithHttpInfo
     *
     * Inserts a new cell to the table row.
     *
     * @param Requests\insertTableCellRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TableCellResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertTableCellWithHttpInfo(Requests\insertTableCellRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TableCellResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TableCellResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertTableCellAsync
     *
     * Inserts a new cell to the table row.
     *
     * @param Requests\insertTableCellRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertTableCellAsync(Requests\insertTableCellRequest $request) 
    {
        return $this->insertTableCellAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertTableCellAsyncWithHttpInfo
     *
     * Inserts a new cell to the table row.
     *
     * @param Requests\insertTableCellRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertTableCellAsyncWithHttpInfo(Requests\insertTableCellRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TableCellResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertTableRow
     *
     * Inserts a new row to the table.
     *
     * @param Requests\insertTableRowRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TableRowResponse
     */
    public function insertTableRow(Requests\insertTableRowRequest $request)
    {
        try {
            list($response) = $this->insertTableRowWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertTableRowWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertTableRowWithHttpInfo
     *
     * Inserts a new row to the table.
     *
     * @param Requests\insertTableRowRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TableRowResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertTableRowWithHttpInfo(Requests\insertTableRowRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TableRowResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TableRowResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertTableRowAsync
     *
     * Inserts a new row to the table.
     *
     * @param Requests\insertTableRowRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertTableRowAsync(Requests\insertTableRowRequest $request) 
    {
        return $this->insertTableRowAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertTableRowAsyncWithHttpInfo
     *
     * Inserts a new row to the table.
     *
     * @param Requests\insertTableRowRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertTableRowAsyncWithHttpInfo(Requests\insertTableRowRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TableRowResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertWatermarkImage
     *
     * Inserts a new watermark image to the document.
     *
     * @param Requests\insertWatermarkImageRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function insertWatermarkImage(Requests\insertWatermarkImageRequest $request)
    {
        try {
            list($response) = $this->insertWatermarkImageWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertWatermarkImageWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertWatermarkImageWithHttpInfo
     *
     * Inserts a new watermark image to the document.
     *
     * @param Requests\insertWatermarkImageRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertWatermarkImageWithHttpInfo(Requests\insertWatermarkImageRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertWatermarkImageAsync
     *
     * Inserts a new watermark image to the document.
     *
     * @param Requests\insertWatermarkImageRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertWatermarkImageAsync(Requests\insertWatermarkImageRequest $request) 
    {
        return $this->insertWatermarkImageAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertWatermarkImageAsyncWithHttpInfo
     *
     * Inserts a new watermark image to the document.
     *
     * @param Requests\insertWatermarkImageRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertWatermarkImageAsyncWithHttpInfo(Requests\insertWatermarkImageRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation insertWatermarkText
     *
     * Inserts a new watermark text to the document.
     *
     * @param Requests\insertWatermarkTextRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function insertWatermarkText(Requests\insertWatermarkTextRequest $request)
    {
        try {
            list($response) = $this->insertWatermarkTextWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->insertWatermarkTextWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation insertWatermarkTextWithHttpInfo
     *
     * Inserts a new watermark text to the document.
     *
     * @param Requests\insertWatermarkTextRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function insertWatermarkTextWithHttpInfo(Requests\insertWatermarkTextRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation insertWatermarkTextAsync
     *
     * Inserts a new watermark text to the document.
     *
     * @param Requests\insertWatermarkTextRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function insertWatermarkTextAsync(Requests\insertWatermarkTextRequest $request) 
    {
        return $this->insertWatermarkTextAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation insertWatermarkTextAsyncWithHttpInfo
     *
     * Inserts a new watermark text to the document.
     *
     * @param Requests\insertWatermarkTextRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function insertWatermarkTextAsyncWithHttpInfo(Requests\insertWatermarkTextRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation loadWebDocument
     *
     * Downloads a document from the Web using URL and saves it to cloud storage in the specified format.
     *
     * @param Requests\loadWebDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\SaveResponse
     */
    public function loadWebDocument(Requests\loadWebDocumentRequest $request)
    {
        try {
            list($response) = $this->loadWebDocumentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->loadWebDocumentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation loadWebDocumentWithHttpInfo
     *
     * Downloads a document from the Web using URL and saves it to cloud storage in the specified format.
     *
     * @param Requests\loadWebDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\SaveResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function loadWebDocumentWithHttpInfo(Requests\loadWebDocumentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\SaveResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\SaveResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation loadWebDocumentAsync
     *
     * Downloads a document from the Web using URL and saves it to cloud storage in the specified format.
     *
     * @param Requests\loadWebDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function loadWebDocumentAsync(Requests\loadWebDocumentRequest $request) 
    {
        return $this->loadWebDocumentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation loadWebDocumentAsyncWithHttpInfo
     *
     * Downloads a document from the Web using URL and saves it to cloud storage in the specified format.
     *
     * @param Requests\loadWebDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function loadWebDocumentAsyncWithHttpInfo(Requests\loadWebDocumentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\SaveResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation moveFile
     *
     * Move file.
     *
     * @param Requests\moveFileRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function moveFile(Requests\moveFileRequest $request)
    {
        try {
    $this->moveFileWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->moveFileWithHttpInfo($request);
        } 
    }

    /*
     * Operation moveFileWithHttpInfo
     *
     * Move file.
     *
     * @param Requests\moveFileRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function moveFileWithHttpInfo(Requests\moveFileRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation moveFileAsync
     *
     * Move file.
     *
     * @param Requests\moveFileRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function moveFileAsync(Requests\moveFileRequest $request) 
    {
        return $this->moveFileAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation moveFileAsyncWithHttpInfo
     *
     * Move file.
     *
     * @param Requests\moveFileRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function moveFileAsyncWithHttpInfo(Requests\moveFileRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation moveFolder
     *
     * Move folder.
     *
     * @param Requests\moveFolderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function moveFolder(Requests\moveFolderRequest $request)
    {
        try {
    $this->moveFolderWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->moveFolderWithHttpInfo($request);
        } 
    }

    /*
     * Operation moveFolderWithHttpInfo
     *
     * Move folder.
     *
     * @param Requests\moveFolderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function moveFolderWithHttpInfo(Requests\moveFolderRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation moveFolderAsync
     *
     * Move folder.
     *
     * @param Requests\moveFolderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function moveFolderAsync(Requests\moveFolderRequest $request) 
    {
        return $this->moveFolderAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation moveFolderAsyncWithHttpInfo
     *
     * Move folder.
     *
     * @param Requests\moveFolderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function moveFolderAsyncWithHttpInfo(Requests\moveFolderRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation optimizeDocument
     *
     * Applies document content optimization options, specific to a particular versions of Microsoft Word.
     *
     * @param Requests\optimizeDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function optimizeDocument(Requests\optimizeDocumentRequest $request)
    {
        try {
    $this->optimizeDocumentWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->optimizeDocumentWithHttpInfo($request);
        } 
    }

    /*
     * Operation optimizeDocumentWithHttpInfo
     *
     * Applies document content optimization options, specific to a particular versions of Microsoft Word.
     *
     * @param Requests\optimizeDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function optimizeDocumentWithHttpInfo(Requests\optimizeDocumentRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation optimizeDocumentAsync
     *
     * Applies document content optimization options, specific to a particular versions of Microsoft Word.
     *
     * @param Requests\optimizeDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function optimizeDocumentAsync(Requests\optimizeDocumentRequest $request) 
    {
        return $this->optimizeDocumentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation optimizeDocumentAsyncWithHttpInfo
     *
     * Applies document content optimization options, specific to a particular versions of Microsoft Word.
     *
     * @param Requests\optimizeDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function optimizeDocumentAsyncWithHttpInfo(Requests\optimizeDocumentRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation protectDocument
     *
     * Adds protection to the document.
     *
     * @param Requests\protectDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ProtectionDataResponse
     */
    public function protectDocument(Requests\protectDocumentRequest $request)
    {
        try {
            list($response) = $this->protectDocumentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->protectDocumentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation protectDocumentWithHttpInfo
     *
     * Adds protection to the document.
     *
     * @param Requests\protectDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ProtectionDataResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function protectDocumentWithHttpInfo(Requests\protectDocumentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ProtectionDataResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ProtectionDataResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation protectDocumentAsync
     *
     * Adds protection to the document.
     *
     * @param Requests\protectDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function protectDocumentAsync(Requests\protectDocumentRequest $request) 
    {
        return $this->protectDocumentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation protectDocumentAsyncWithHttpInfo
     *
     * Adds protection to the document.
     *
     * @param Requests\protectDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function protectDocumentAsyncWithHttpInfo(Requests\protectDocumentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ProtectionDataResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation rejectAllRevisions
     *
     * Rejects all revisions in the document.
     *
     * @param Requests\rejectAllRevisionsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\RevisionsModificationResponse
     */
    public function rejectAllRevisions(Requests\rejectAllRevisionsRequest $request)
    {
        try {
            list($response) = $this->rejectAllRevisionsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->rejectAllRevisionsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation rejectAllRevisionsWithHttpInfo
     *
     * Rejects all revisions in the document.
     *
     * @param Requests\rejectAllRevisionsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\RevisionsModificationResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function rejectAllRevisionsWithHttpInfo(Requests\rejectAllRevisionsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\RevisionsModificationResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\RevisionsModificationResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation rejectAllRevisionsAsync
     *
     * Rejects all revisions in the document.
     *
     * @param Requests\rejectAllRevisionsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rejectAllRevisionsAsync(Requests\rejectAllRevisionsRequest $request) 
    {
        return $this->rejectAllRevisionsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation rejectAllRevisionsAsyncWithHttpInfo
     *
     * Rejects all revisions in the document.
     *
     * @param Requests\rejectAllRevisionsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function rejectAllRevisionsAsyncWithHttpInfo(Requests\rejectAllRevisionsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\RevisionsModificationResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation removeRange
     *
     * Removes a range from the document.
     *
     * @param Requests\removeRangeRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function removeRange(Requests\removeRangeRequest $request)
    {
        try {
            list($response) = $this->removeRangeWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->removeRangeWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation removeRangeWithHttpInfo
     *
     * Removes a range from the document.
     *
     * @param Requests\removeRangeRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function removeRangeWithHttpInfo(Requests\removeRangeRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation removeRangeAsync
     *
     * Removes a range from the document.
     *
     * @param Requests\removeRangeRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function removeRangeAsync(Requests\removeRangeRequest $request) 
    {
        return $this->removeRangeAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation removeRangeAsyncWithHttpInfo
     *
     * Removes a range from the document.
     *
     * @param Requests\removeRangeRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function removeRangeAsyncWithHttpInfo(Requests\removeRangeRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation renderDrawingObject
     *
     * Renders a DrawingObject to the specified format.
     *
     * @param Requests\renderDrawingObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function renderDrawingObject(Requests\renderDrawingObjectRequest $request)
    {
        try {
            list($response) = $this->renderDrawingObjectWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->renderDrawingObjectWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation renderDrawingObjectWithHttpInfo
     *
     * Renders a DrawingObject to the specified format.
     *
     * @param Requests\renderDrawingObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function renderDrawingObjectWithHttpInfo(Requests\renderDrawingObjectRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation renderDrawingObjectAsync
     *
     * Renders a DrawingObject to the specified format.
     *
     * @param Requests\renderDrawingObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function renderDrawingObjectAsync(Requests\renderDrawingObjectRequest $request) 
    {
        return $this->renderDrawingObjectAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation renderDrawingObjectAsyncWithHttpInfo
     *
     * Renders a DrawingObject to the specified format.
     *
     * @param Requests\renderDrawingObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function renderDrawingObjectAsyncWithHttpInfo(Requests\renderDrawingObjectRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation renderMathObject
     *
     * Renders an OfficeMath object to the specified format.
     *
     * @param Requests\renderMathObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function renderMathObject(Requests\renderMathObjectRequest $request)
    {
        try {
            list($response) = $this->renderMathObjectWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->renderMathObjectWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation renderMathObjectWithHttpInfo
     *
     * Renders an OfficeMath object to the specified format.
     *
     * @param Requests\renderMathObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function renderMathObjectWithHttpInfo(Requests\renderMathObjectRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation renderMathObjectAsync
     *
     * Renders an OfficeMath object to the specified format.
     *
     * @param Requests\renderMathObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function renderMathObjectAsync(Requests\renderMathObjectRequest $request) 
    {
        return $this->renderMathObjectAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation renderMathObjectAsyncWithHttpInfo
     *
     * Renders an OfficeMath object to the specified format.
     *
     * @param Requests\renderMathObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function renderMathObjectAsyncWithHttpInfo(Requests\renderMathObjectRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation renderPage
     *
     * Renders a page to the specified format.
     *
     * @param Requests\renderPageRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function renderPage(Requests\renderPageRequest $request)
    {
        try {
            list($response) = $this->renderPageWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->renderPageWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation renderPageWithHttpInfo
     *
     * Renders a page to the specified format.
     *
     * @param Requests\renderPageRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function renderPageWithHttpInfo(Requests\renderPageRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation renderPageAsync
     *
     * Renders a page to the specified format.
     *
     * @param Requests\renderPageRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function renderPageAsync(Requests\renderPageRequest $request) 
    {
        return $this->renderPageAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation renderPageAsyncWithHttpInfo
     *
     * Renders a page to the specified format.
     *
     * @param Requests\renderPageRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function renderPageAsyncWithHttpInfo(Requests\renderPageRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation renderParagraph
     *
     * Renders a paragraph to the specified format.
     *
     * @param Requests\renderParagraphRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function renderParagraph(Requests\renderParagraphRequest $request)
    {
        try {
            list($response) = $this->renderParagraphWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->renderParagraphWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation renderParagraphWithHttpInfo
     *
     * Renders a paragraph to the specified format.
     *
     * @param Requests\renderParagraphRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function renderParagraphWithHttpInfo(Requests\renderParagraphRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation renderParagraphAsync
     *
     * Renders a paragraph to the specified format.
     *
     * @param Requests\renderParagraphRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function renderParagraphAsync(Requests\renderParagraphRequest $request) 
    {
        return $this->renderParagraphAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation renderParagraphAsyncWithHttpInfo
     *
     * Renders a paragraph to the specified format.
     *
     * @param Requests\renderParagraphRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function renderParagraphAsyncWithHttpInfo(Requests\renderParagraphRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation renderTable
     *
     * Renders a table to the specified format.
     *
     * @param Requests\renderTableRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \SplFileObject
     */
    public function renderTable(Requests\renderTableRequest $request)
    {
        try {
            list($response) = $this->renderTableWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->renderTableWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation renderTableWithHttpInfo
     *
     * Renders a table to the specified format.
     *
     * @param Requests\renderTableRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \SplFileObject, HTTP status code, HTTP response headers (array of strings)
     */
    private function renderTableWithHttpInfo(Requests\renderTableRequest $request)
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\SplFileObject', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation renderTableAsync
     *
     * Renders a table to the specified format.
     *
     * @param Requests\renderTableRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function renderTableAsync(Requests\renderTableRequest $request) 
    {
        return $this->renderTableAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation renderTableAsyncWithHttpInfo
     *
     * Renders a table to the specified format.
     *
     * @param Requests\renderTableRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function renderTableAsyncWithHttpInfo(Requests\renderTableRequest $request) 
    {
        $returnType = '\SplFileObject';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation replaceText
     *
     * Replaces text in the document.
     *
     * @param Requests\replaceTextRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ReplaceTextResponse
     */
    public function replaceText(Requests\replaceTextRequest $request)
    {
        try {
            list($response) = $this->replaceTextWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->replaceTextWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation replaceTextWithHttpInfo
     *
     * Replaces text in the document.
     *
     * @param Requests\replaceTextRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ReplaceTextResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function replaceTextWithHttpInfo(Requests\replaceTextRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ReplaceTextResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ReplaceTextResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation replaceTextAsync
     *
     * Replaces text in the document.
     *
     * @param Requests\replaceTextRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function replaceTextAsync(Requests\replaceTextRequest $request) 
    {
        return $this->replaceTextAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation replaceTextAsyncWithHttpInfo
     *
     * Replaces text in the document.
     *
     * @param Requests\replaceTextRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function replaceTextAsyncWithHttpInfo(Requests\replaceTextRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ReplaceTextResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation replaceWithText
     *
     * Replaces a range with text in the document.
     *
     * @param Requests\replaceWithTextRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function replaceWithText(Requests\replaceWithTextRequest $request)
    {
        try {
            list($response) = $this->replaceWithTextWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->replaceWithTextWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation replaceWithTextWithHttpInfo
     *
     * Replaces a range with text in the document.
     *
     * @param Requests\replaceWithTextRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function replaceWithTextWithHttpInfo(Requests\replaceWithTextRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation replaceWithTextAsync
     *
     * Replaces a range with text in the document.
     *
     * @param Requests\replaceWithTextRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function replaceWithTextAsync(Requests\replaceWithTextRequest $request) 
    {
        return $this->replaceWithTextAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation replaceWithTextAsyncWithHttpInfo
     *
     * Replaces a range with text in the document.
     *
     * @param Requests\replaceWithTextRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function replaceWithTextAsyncWithHttpInfo(Requests\replaceWithTextRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation resetCache
     *
     * Clears the font cache.
     *
     * @param Requests\resetCacheRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function resetCache(Requests\resetCacheRequest $request)
    {
        try {
    $this->resetCacheWithHttpInfo($request);
        }
        catch(RepeatRequestException $e) {
    $this->resetCacheWithHttpInfo($request);
        } 
    }

    /*
     * Operation resetCacheWithHttpInfo
     *
     * Clears the font cache.
     *
     * @param Requests\resetCacheRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    private function resetCacheWithHttpInfo(Requests\resetCacheRequest $request)
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            throw $e;
        }
    }

    /*
     * Operation resetCacheAsync
     *
     * Clears the font cache.
     *
     * @param Requests\resetCacheRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resetCacheAsync(Requests\resetCacheRequest $request) 
    {
        return $this->resetCacheAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation resetCacheAsyncWithHttpInfo
     *
     * Clears the font cache.
     *
     * @param Requests\resetCacheRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function resetCacheAsyncWithHttpInfo(Requests\resetCacheRequest $request) 
    {
        $returnType = 'null';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation saveAs
     *
     * Converts a document in cloud storage to the specified format.
     *
     * @param Requests\saveAsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\SaveResponse
     */
    public function saveAs(Requests\saveAsRequest $request)
    {
        try {
            list($response) = $this->saveAsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->saveAsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation saveAsWithHttpInfo
     *
     * Converts a document in cloud storage to the specified format.
     *
     * @param Requests\saveAsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\SaveResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function saveAsWithHttpInfo(Requests\saveAsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\SaveResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\SaveResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation saveAsAsync
     *
     * Converts a document in cloud storage to the specified format.
     *
     * @param Requests\saveAsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function saveAsAsync(Requests\saveAsRequest $request) 
    {
        return $this->saveAsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation saveAsAsyncWithHttpInfo
     *
     * Converts a document in cloud storage to the specified format.
     *
     * @param Requests\saveAsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function saveAsAsyncWithHttpInfo(Requests\saveAsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\SaveResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation saveAsRange
     *
     * Saves a range as a new document.
     *
     * @param Requests\saveAsRangeRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function saveAsRange(Requests\saveAsRangeRequest $request)
    {
        try {
            list($response) = $this->saveAsRangeWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->saveAsRangeWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation saveAsRangeWithHttpInfo
     *
     * Saves a range as a new document.
     *
     * @param Requests\saveAsRangeRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function saveAsRangeWithHttpInfo(Requests\saveAsRangeRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation saveAsRangeAsync
     *
     * Saves a range as a new document.
     *
     * @param Requests\saveAsRangeRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function saveAsRangeAsync(Requests\saveAsRangeRequest $request) 
    {
        return $this->saveAsRangeAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation saveAsRangeAsyncWithHttpInfo
     *
     * Saves a range as a new document.
     *
     * @param Requests\saveAsRangeRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function saveAsRangeAsyncWithHttpInfo(Requests\saveAsRangeRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation saveAsTiff
     *
     * Converts a document in cloud storage to TIFF format using detailed conversion settings.
     *
     * @param Requests\saveAsTiffRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\SaveResponse
     */
    public function saveAsTiff(Requests\saveAsTiffRequest $request)
    {
        try {
            list($response) = $this->saveAsTiffWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->saveAsTiffWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation saveAsTiffWithHttpInfo
     *
     * Converts a document in cloud storage to TIFF format using detailed conversion settings.
     *
     * @param Requests\saveAsTiffRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\SaveResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function saveAsTiffWithHttpInfo(Requests\saveAsTiffRequest $request)
    {
        $returnType = '\Aspose\Words\Model\SaveResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\SaveResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation saveAsTiffAsync
     *
     * Converts a document in cloud storage to TIFF format using detailed conversion settings.
     *
     * @param Requests\saveAsTiffRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function saveAsTiffAsync(Requests\saveAsTiffRequest $request) 
    {
        return $this->saveAsTiffAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation saveAsTiffAsyncWithHttpInfo
     *
     * Converts a document in cloud storage to TIFF format using detailed conversion settings.
     *
     * @param Requests\saveAsTiffRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function saveAsTiffAsyncWithHttpInfo(Requests\saveAsTiffRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\SaveResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation search
     *
     * Searches text, specified by the regular expression, in the document.
     *
     * @param Requests\searchRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\SearchResponse
     */
    public function search(Requests\searchRequest $request)
    {
        try {
            list($response) = $this->searchWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->searchWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation searchWithHttpInfo
     *
     * Searches text, specified by the regular expression, in the document.
     *
     * @param Requests\searchRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\SearchResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function searchWithHttpInfo(Requests\searchRequest $request)
    {
        $returnType = '\Aspose\Words\Model\SearchResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\SearchResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation searchAsync
     *
     * Searches text, specified by the regular expression, in the document.
     *
     * @param Requests\searchRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchAsync(Requests\searchRequest $request) 
    {
        return $this->searchAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation searchAsyncWithHttpInfo
     *
     * Searches text, specified by the regular expression, in the document.
     *
     * @param Requests\searchRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function searchAsyncWithHttpInfo(Requests\searchRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\SearchResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation splitDocument
     *
     * Splits a document into parts and saves them in the specified format.
     *
     * @param Requests\splitDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\SplitDocumentResponse
     */
    public function splitDocument(Requests\splitDocumentRequest $request)
    {
        try {
            list($response) = $this->splitDocumentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->splitDocumentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation splitDocumentWithHttpInfo
     *
     * Splits a document into parts and saves them in the specified format.
     *
     * @param Requests\splitDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\SplitDocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function splitDocumentWithHttpInfo(Requests\splitDocumentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\SplitDocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\SplitDocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation splitDocumentAsync
     *
     * Splits a document into parts and saves them in the specified format.
     *
     * @param Requests\splitDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function splitDocumentAsync(Requests\splitDocumentRequest $request) 
    {
        return $this->splitDocumentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation splitDocumentAsyncWithHttpInfo
     *
     * Splits a document into parts and saves them in the specified format.
     *
     * @param Requests\splitDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function splitDocumentAsyncWithHttpInfo(Requests\splitDocumentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\SplitDocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation unprotectDocument
     *
     * Removes protection from the document.
     *
     * @param Requests\unprotectDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ProtectionDataResponse
     */
    public function unprotectDocument(Requests\unprotectDocumentRequest $request)
    {
        try {
            list($response) = $this->unprotectDocumentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->unprotectDocumentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation unprotectDocumentWithHttpInfo
     *
     * Removes protection from the document.
     *
     * @param Requests\unprotectDocumentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ProtectionDataResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function unprotectDocumentWithHttpInfo(Requests\unprotectDocumentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ProtectionDataResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ProtectionDataResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation unprotectDocumentAsync
     *
     * Removes protection from the document.
     *
     * @param Requests\unprotectDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function unprotectDocumentAsync(Requests\unprotectDocumentRequest $request) 
    {
        return $this->unprotectDocumentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation unprotectDocumentAsyncWithHttpInfo
     *
     * Removes protection from the document.
     *
     * @param Requests\unprotectDocumentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function unprotectDocumentAsyncWithHttpInfo(Requests\unprotectDocumentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ProtectionDataResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateBookmark
     *
     * Updates a bookmark in the document.
     *
     * @param Requests\updateBookmarkRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\BookmarkResponse
     */
    public function updateBookmark(Requests\updateBookmarkRequest $request)
    {
        try {
            list($response) = $this->updateBookmarkWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateBookmarkWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateBookmarkWithHttpInfo
     *
     * Updates a bookmark in the document.
     *
     * @param Requests\updateBookmarkRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\BookmarkResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateBookmarkWithHttpInfo(Requests\updateBookmarkRequest $request)
    {
        $returnType = '\Aspose\Words\Model\BookmarkResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\BookmarkResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateBookmarkAsync
     *
     * Updates a bookmark in the document.
     *
     * @param Requests\updateBookmarkRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateBookmarkAsync(Requests\updateBookmarkRequest $request) 
    {
        return $this->updateBookmarkAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateBookmarkAsyncWithHttpInfo
     *
     * Updates a bookmark in the document.
     *
     * @param Requests\updateBookmarkRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateBookmarkAsyncWithHttpInfo(Requests\updateBookmarkRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\BookmarkResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateBorder
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\updateBorderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\BorderResponse
     */
    public function updateBorder(Requests\updateBorderRequest $request)
    {
        try {
            list($response) = $this->updateBorderWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateBorderWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateBorderWithHttpInfo
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\updateBorderRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\BorderResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateBorderWithHttpInfo(Requests\updateBorderRequest $request)
    {
        $returnType = '\Aspose\Words\Model\BorderResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\BorderResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateBorderAsync
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\updateBorderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateBorderAsync(Requests\updateBorderRequest $request) 
    {
        return $this->updateBorderAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateBorderAsyncWithHttpInfo
     *
     * The 'nodePath' parameter should refer to a paragraph, a cell or a row.
     *
     * @param Requests\updateBorderRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateBorderAsyncWithHttpInfo(Requests\updateBorderRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\BorderResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateComment
     *
     * Updates a comment in the document.
     *
     * @param Requests\updateCommentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\CommentResponse
     */
    public function updateComment(Requests\updateCommentRequest $request)
    {
        try {
            list($response) = $this->updateCommentWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateCommentWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateCommentWithHttpInfo
     *
     * Updates a comment in the document.
     *
     * @param Requests\updateCommentRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\CommentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateCommentWithHttpInfo(Requests\updateCommentRequest $request)
    {
        $returnType = '\Aspose\Words\Model\CommentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\CommentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateCommentAsync
     *
     * Updates a comment in the document.
     *
     * @param Requests\updateCommentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateCommentAsync(Requests\updateCommentRequest $request) 
    {
        return $this->updateCommentAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateCommentAsyncWithHttpInfo
     *
     * Updates a comment in the document.
     *
     * @param Requests\updateCommentRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateCommentAsyncWithHttpInfo(Requests\updateCommentRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\CommentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateDrawingObject
     *
     * Updates a DrawingObject in the document node.
     *
     * @param Requests\updateDrawingObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DrawingObjectResponse
     */
    public function updateDrawingObject(Requests\updateDrawingObjectRequest $request)
    {
        try {
            list($response) = $this->updateDrawingObjectWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateDrawingObjectWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateDrawingObjectWithHttpInfo
     *
     * Updates a DrawingObject in the document node.
     *
     * @param Requests\updateDrawingObjectRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DrawingObjectResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateDrawingObjectWithHttpInfo(Requests\updateDrawingObjectRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DrawingObjectResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DrawingObjectResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateDrawingObjectAsync
     *
     * Updates a DrawingObject in the document node.
     *
     * @param Requests\updateDrawingObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateDrawingObjectAsync(Requests\updateDrawingObjectRequest $request) 
    {
        return $this->updateDrawingObjectAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateDrawingObjectAsyncWithHttpInfo
     *
     * Updates a DrawingObject in the document node.
     *
     * @param Requests\updateDrawingObjectRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateDrawingObjectAsyncWithHttpInfo(Requests\updateDrawingObjectRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DrawingObjectResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateField
     *
     * Updates a field in the document node.
     *
     * @param Requests\updateFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FieldResponse
     */
    public function updateField(Requests\updateFieldRequest $request)
    {
        try {
            list($response) = $this->updateFieldWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateFieldWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateFieldWithHttpInfo
     *
     * Updates a field in the document node.
     *
     * @param Requests\updateFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FieldResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateFieldWithHttpInfo(Requests\updateFieldRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FieldResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FieldResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateFieldAsync
     *
     * Updates a field in the document node.
     *
     * @param Requests\updateFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateFieldAsync(Requests\updateFieldRequest $request) 
    {
        return $this->updateFieldAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateFieldAsyncWithHttpInfo
     *
     * Updates a field in the document node.
     *
     * @param Requests\updateFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateFieldAsyncWithHttpInfo(Requests\updateFieldRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FieldResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateFields
     *
     * Reevaluates field values in the document.
     *
     * @param Requests\updateFieldsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\DocumentResponse
     */
    public function updateFields(Requests\updateFieldsRequest $request)
    {
        try {
            list($response) = $this->updateFieldsWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateFieldsWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateFieldsWithHttpInfo
     *
     * Reevaluates field values in the document.
     *
     * @param Requests\updateFieldsRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\DocumentResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateFieldsWithHttpInfo(Requests\updateFieldsRequest $request)
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\DocumentResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateFieldsAsync
     *
     * Reevaluates field values in the document.
     *
     * @param Requests\updateFieldsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateFieldsAsync(Requests\updateFieldsRequest $request) 
    {
        return $this->updateFieldsAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateFieldsAsyncWithHttpInfo
     *
     * Reevaluates field values in the document.
     *
     * @param Requests\updateFieldsRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateFieldsAsyncWithHttpInfo(Requests\updateFieldsRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\DocumentResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateFootnote
     *
     * Updates a footnote in the document node.
     *
     * @param Requests\updateFootnoteRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FootnoteResponse
     */
    public function updateFootnote(Requests\updateFootnoteRequest $request)
    {
        try {
            list($response) = $this->updateFootnoteWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateFootnoteWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateFootnoteWithHttpInfo
     *
     * Updates a footnote in the document node.
     *
     * @param Requests\updateFootnoteRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FootnoteResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateFootnoteWithHttpInfo(Requests\updateFootnoteRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FootnoteResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FootnoteResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateFootnoteAsync
     *
     * Updates a footnote in the document node.
     *
     * @param Requests\updateFootnoteRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateFootnoteAsync(Requests\updateFootnoteRequest $request) 
    {
        return $this->updateFootnoteAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateFootnoteAsyncWithHttpInfo
     *
     * Updates a footnote in the document node.
     *
     * @param Requests\updateFootnoteRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateFootnoteAsyncWithHttpInfo(Requests\updateFootnoteRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FootnoteResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateFormField
     *
     * Updates a form field in the document node.
     *
     * @param Requests\updateFormFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FormFieldResponse
     */
    public function updateFormField(Requests\updateFormFieldRequest $request)
    {
        try {
            list($response) = $this->updateFormFieldWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateFormFieldWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateFormFieldWithHttpInfo
     *
     * Updates a form field in the document node.
     *
     * @param Requests\updateFormFieldRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FormFieldResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateFormFieldWithHttpInfo(Requests\updateFormFieldRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FormFieldResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FormFieldResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateFormFieldAsync
     *
     * Updates a form field in the document node.
     *
     * @param Requests\updateFormFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateFormFieldAsync(Requests\updateFormFieldRequest $request) 
    {
        return $this->updateFormFieldAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateFormFieldAsyncWithHttpInfo
     *
     * Updates a form field in the document node.
     *
     * @param Requests\updateFormFieldRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateFormFieldAsyncWithHttpInfo(Requests\updateFormFieldRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FormFieldResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateList
     *
     * Updates a list in the document.
     *
     * @param Requests\updateListRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ListResponse
     */
    public function updateList(Requests\updateListRequest $request)
    {
        try {
            list($response) = $this->updateListWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateListWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateListWithHttpInfo
     *
     * Updates a list in the document.
     *
     * @param Requests\updateListRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateListWithHttpInfo(Requests\updateListRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ListResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ListResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateListAsync
     *
     * Updates a list in the document.
     *
     * @param Requests\updateListRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateListAsync(Requests\updateListRequest $request) 
    {
        return $this->updateListAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateListAsyncWithHttpInfo
     *
     * Updates a list in the document.
     *
     * @param Requests\updateListRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateListAsyncWithHttpInfo(Requests\updateListRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ListResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateListLevel
     *
     * Updates the level of a List element in the document.
     *
     * @param Requests\updateListLevelRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ListResponse
     */
    public function updateListLevel(Requests\updateListLevelRequest $request)
    {
        try {
            list($response) = $this->updateListLevelWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateListLevelWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateListLevelWithHttpInfo
     *
     * Updates the level of a List element in the document.
     *
     * @param Requests\updateListLevelRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateListLevelWithHttpInfo(Requests\updateListLevelRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ListResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ListResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateListLevelAsync
     *
     * Updates the level of a List element in the document.
     *
     * @param Requests\updateListLevelRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateListLevelAsync(Requests\updateListLevelRequest $request) 
    {
        return $this->updateListLevelAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateListLevelAsyncWithHttpInfo
     *
     * Updates the level of a List element in the document.
     *
     * @param Requests\updateListLevelRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateListLevelAsyncWithHttpInfo(Requests\updateListLevelRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ListResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateParagraphFormat
     *
     * Updates the formatting properties of a paragraph in the document node.
     *
     * @param Requests\updateParagraphFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ParagraphFormatResponse
     */
    public function updateParagraphFormat(Requests\updateParagraphFormatRequest $request)
    {
        try {
            list($response) = $this->updateParagraphFormatWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateParagraphFormatWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateParagraphFormatWithHttpInfo
     *
     * Updates the formatting properties of a paragraph in the document node.
     *
     * @param Requests\updateParagraphFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ParagraphFormatResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateParagraphFormatWithHttpInfo(Requests\updateParagraphFormatRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ParagraphFormatResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ParagraphFormatResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateParagraphFormatAsync
     *
     * Updates the formatting properties of a paragraph in the document node.
     *
     * @param Requests\updateParagraphFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateParagraphFormatAsync(Requests\updateParagraphFormatRequest $request) 
    {
        return $this->updateParagraphFormatAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateParagraphFormatAsyncWithHttpInfo
     *
     * Updates the formatting properties of a paragraph in the document node.
     *
     * @param Requests\updateParagraphFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateParagraphFormatAsyncWithHttpInfo(Requests\updateParagraphFormatRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ParagraphFormatResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateParagraphListFormat
     *
     * Updates the formatting properties of a paragraph list in the document node.
     *
     * @param Requests\updateParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\ParagraphListFormatResponse
     */
    public function updateParagraphListFormat(Requests\updateParagraphListFormatRequest $request)
    {
        try {
            list($response) = $this->updateParagraphListFormatWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateParagraphListFormatWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateParagraphListFormatWithHttpInfo
     *
     * Updates the formatting properties of a paragraph list in the document node.
     *
     * @param Requests\updateParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\ParagraphListFormatResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateParagraphListFormatWithHttpInfo(Requests\updateParagraphListFormatRequest $request)
    {
        $returnType = '\Aspose\Words\Model\ParagraphListFormatResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\ParagraphListFormatResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateParagraphListFormatAsync
     *
     * Updates the formatting properties of a paragraph list in the document node.
     *
     * @param Requests\updateParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateParagraphListFormatAsync(Requests\updateParagraphListFormatRequest $request) 
    {
        return $this->updateParagraphListFormatAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateParagraphListFormatAsyncWithHttpInfo
     *
     * Updates the formatting properties of a paragraph list in the document node.
     *
     * @param Requests\updateParagraphListFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateParagraphListFormatAsyncWithHttpInfo(Requests\updateParagraphListFormatRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\ParagraphListFormatResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateRun
     *
     * Updates a Run object in the paragraph.
     *
     * @param Requests\updateRunRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\RunResponse
     */
    public function updateRun(Requests\updateRunRequest $request)
    {
        try {
            list($response) = $this->updateRunWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateRunWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateRunWithHttpInfo
     *
     * Updates a Run object in the paragraph.
     *
     * @param Requests\updateRunRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\RunResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateRunWithHttpInfo(Requests\updateRunRequest $request)
    {
        $returnType = '\Aspose\Words\Model\RunResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\RunResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateRunAsync
     *
     * Updates a Run object in the paragraph.
     *
     * @param Requests\updateRunRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateRunAsync(Requests\updateRunRequest $request) 
    {
        return $this->updateRunAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateRunAsyncWithHttpInfo
     *
     * Updates a Run object in the paragraph.
     *
     * @param Requests\updateRunRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateRunAsyncWithHttpInfo(Requests\updateRunRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\RunResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateRunFont
     *
     * Updates the font properties of a Run object in the paragraph.
     *
     * @param Requests\updateRunFontRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FontResponse
     */
    public function updateRunFont(Requests\updateRunFontRequest $request)
    {
        try {
            list($response) = $this->updateRunFontWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateRunFontWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateRunFontWithHttpInfo
     *
     * Updates the font properties of a Run object in the paragraph.
     *
     * @param Requests\updateRunFontRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FontResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateRunFontWithHttpInfo(Requests\updateRunFontRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FontResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FontResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateRunFontAsync
     *
     * Updates the font properties of a Run object in the paragraph.
     *
     * @param Requests\updateRunFontRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateRunFontAsync(Requests\updateRunFontRequest $request) 
    {
        return $this->updateRunFontAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateRunFontAsyncWithHttpInfo
     *
     * Updates the font properties of a Run object in the paragraph.
     *
     * @param Requests\updateRunFontRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateRunFontAsyncWithHttpInfo(Requests\updateRunFontRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FontResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateSectionPageSetup
     *
     * Updates the page setup of a section in the document.
     *
     * @param Requests\updateSectionPageSetupRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\SectionPageSetupResponse
     */
    public function updateSectionPageSetup(Requests\updateSectionPageSetupRequest $request)
    {
        try {
            list($response) = $this->updateSectionPageSetupWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateSectionPageSetupWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateSectionPageSetupWithHttpInfo
     *
     * Updates the page setup of a section in the document.
     *
     * @param Requests\updateSectionPageSetupRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\SectionPageSetupResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateSectionPageSetupWithHttpInfo(Requests\updateSectionPageSetupRequest $request)
    {
        $returnType = '\Aspose\Words\Model\SectionPageSetupResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\SectionPageSetupResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateSectionPageSetupAsync
     *
     * Updates the page setup of a section in the document.
     *
     * @param Requests\updateSectionPageSetupRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateSectionPageSetupAsync(Requests\updateSectionPageSetupRequest $request) 
    {
        return $this->updateSectionPageSetupAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateSectionPageSetupAsyncWithHttpInfo
     *
     * Updates the page setup of a section in the document.
     *
     * @param Requests\updateSectionPageSetupRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateSectionPageSetupAsyncWithHttpInfo(Requests\updateSectionPageSetupRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\SectionPageSetupResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateStyle
     *
     * Updates a style in the document.
     *
     * @param Requests\updateStyleRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\StyleResponse
     */
    public function updateStyle(Requests\updateStyleRequest $request)
    {
        try {
            list($response) = $this->updateStyleWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateStyleWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateStyleWithHttpInfo
     *
     * Updates a style in the document.
     *
     * @param Requests\updateStyleRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\StyleResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateStyleWithHttpInfo(Requests\updateStyleRequest $request)
    {
        $returnType = '\Aspose\Words\Model\StyleResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\StyleResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateStyleAsync
     *
     * Updates a style in the document.
     *
     * @param Requests\updateStyleRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateStyleAsync(Requests\updateStyleRequest $request) 
    {
        return $this->updateStyleAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateStyleAsyncWithHttpInfo
     *
     * Updates a style in the document.
     *
     * @param Requests\updateStyleRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateStyleAsyncWithHttpInfo(Requests\updateStyleRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\StyleResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateTableCellFormat
     *
     * Updates the formatting properties of a cell in the table row.
     *
     * @param Requests\updateTableCellFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TableCellFormatResponse
     */
    public function updateTableCellFormat(Requests\updateTableCellFormatRequest $request)
    {
        try {
            list($response) = $this->updateTableCellFormatWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateTableCellFormatWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateTableCellFormatWithHttpInfo
     *
     * Updates the formatting properties of a cell in the table row.
     *
     * @param Requests\updateTableCellFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TableCellFormatResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateTableCellFormatWithHttpInfo(Requests\updateTableCellFormatRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TableCellFormatResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TableCellFormatResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateTableCellFormatAsync
     *
     * Updates the formatting properties of a cell in the table row.
     *
     * @param Requests\updateTableCellFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateTableCellFormatAsync(Requests\updateTableCellFormatRequest $request) 
    {
        return $this->updateTableCellFormatAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateTableCellFormatAsyncWithHttpInfo
     *
     * Updates the formatting properties of a cell in the table row.
     *
     * @param Requests\updateTableCellFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateTableCellFormatAsyncWithHttpInfo(Requests\updateTableCellFormatRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TableCellFormatResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateTableProperties
     *
     * Updates properties of a table in the document node.
     *
     * @param Requests\updateTablePropertiesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TablePropertiesResponse
     */
    public function updateTableProperties(Requests\updateTablePropertiesRequest $request)
    {
        try {
            list($response) = $this->updateTablePropertiesWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateTablePropertiesWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateTablePropertiesWithHttpInfo
     *
     * Updates properties of a table in the document node.
     *
     * @param Requests\updateTablePropertiesRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TablePropertiesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateTablePropertiesWithHttpInfo(Requests\updateTablePropertiesRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TablePropertiesResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TablePropertiesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateTablePropertiesAsync
     *
     * Updates properties of a table in the document node.
     *
     * @param Requests\updateTablePropertiesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateTablePropertiesAsync(Requests\updateTablePropertiesRequest $request) 
    {
        return $this->updateTablePropertiesAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateTablePropertiesAsyncWithHttpInfo
     *
     * Updates properties of a table in the document node.
     *
     * @param Requests\updateTablePropertiesRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateTablePropertiesAsyncWithHttpInfo(Requests\updateTablePropertiesRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TablePropertiesResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation updateTableRowFormat
     *
     * Updates the formatting properties of a table row.
     *
     * @param Requests\updateTableRowFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\TableRowFormatResponse
     */
    public function updateTableRowFormat(Requests\updateTableRowFormatRequest $request)
    {
        try {
            list($response) = $this->updateTableRowFormatWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->updateTableRowFormatWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation updateTableRowFormatWithHttpInfo
     *
     * Updates the formatting properties of a table row.
     *
     * @param Requests\updateTableRowFormatRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\TableRowFormatResponse, HTTP status code, HTTP response headers (array of strings)
     */
    private function updateTableRowFormatWithHttpInfo(Requests\updateTableRowFormatRequest $request)
    {
        $returnType = '\Aspose\Words\Model\TableRowFormatResponse';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\TableRowFormatResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation updateTableRowFormatAsync
     *
     * Updates the formatting properties of a table row.
     *
     * @param Requests\updateTableRowFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateTableRowFormatAsync(Requests\updateTableRowFormatRequest $request) 
    {
        return $this->updateTableRowFormatAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation updateTableRowFormatAsyncWithHttpInfo
     *
     * Updates the formatting properties of a table row.
     *
     * @param Requests\updateTableRowFormatRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function updateTableRowFormatAsyncWithHttpInfo(Requests\updateTableRowFormatRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\TableRowFormatResponse';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation uploadFile
     *
     * Upload file.
     *
     * @param Requests\uploadFileRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Words\Model\FilesUploadResult
     */
    public function uploadFile(Requests\uploadFileRequest $request)
    {
        try {
            list($response) = $this->uploadFileWithHttpInfo($request);
            return $response;
        }
        catch(RepeatRequestException $e) {
            list($response) = $this->uploadFileWithHttpInfo($request);
            return $response;
        } 
    }

    /*
     * Operation uploadFileWithHttpInfo
     *
     * Upload file.
     *
     * @param Requests\uploadFileRequest $request is a request object for operation
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Words\Model\FilesUploadResult, HTTP status code, HTTP response headers (array of strings)
     */
    private function uploadFileWithHttpInfo(Requests\uploadFileRequest $request)
    {
        $returnType = '\Aspose\Words\Model\FilesUploadResult';
        $request = $request->createRequest($this->config);

        try {
            $options = $this->_createHttpClientOption();
            $this->_checkAuthToken();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    $this->_requestToken();
                    throw new RepeatRequestException("Request must be retried", 401, null, null);
                }
                else if ($e->getCode() < 200 || $e->getCode() > 299) {
                    throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $request->getUri()), $e->getCode(), null, null);
                }
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            if ($this->config->getDebug()) {
                $this->_writeResponseLog($statusCode, $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Words\Model\FilesUploadResult', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                break;
            }
            throw $e;
        }
    }

    /*
     * Operation uploadFileAsync
     *
     * Upload file.
     *
     * @param Requests\uploadFileRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function uploadFileAsync(Requests\uploadFileRequest $request) 
    {
        return $this->uploadFileAsyncWithHttpInfo($request)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /*
     * Operation uploadFileAsyncWithHttpInfo
     *
     * Upload file.
     *
     * @param Requests\uploadFileRequest $request is a request object for operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function uploadFileAsyncWithHttpInfo(Requests\uploadFileRequest $request) 
    {
        $returnType = '\Aspose\Words\Model\FilesUploadResult';
        $request = $request->createRequest($this->config);

        return $this->client
            ->sendAsync($request, $this->_createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    if ($this->config->getDebug()) {
                        $this->_writeResponseLog($response->getStatusCode(), $response->getHeaders(), ObjectSerializer::deserialize($content, $returnType, []));
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {        
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();

                    if ($exception instanceof RepeatRequestException) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }

                    throw new ApiException(
                        sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody()
                    );
                }
            );
    }

    /*
     * Operation bacth requests
     *
     * @param array of requests
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of response objects
     */
    public function batch($requests)
    {
        try {
            return $this->batchWithHttpInfo($requests);
        }
        catch(RepeatRequestException $e) {
            return $this->batchWithHttpInfo($requests);
        }
    }

    /*
     * Operation bacth requests
     *
     * @param array of requests
     *
     * @throws \Aspose\Words\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of response objects
     */
    private function batchWithHttpInfo($requests)
    {
        return $this->batchAsyncWithHttpInfo($requests)->wait();
    }

    /*
     * Async operation bacth requests
     *
     * @param array of requests
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function batchAsync($requests) 
    {
        return $this->batchAsyncWithHttpInfo($requests)
            ->then(
                function ($response) {
                    return $response;
                }
            );
    }

    /*
     * Async operation bacth requests
     *
     * @param array of requests
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    private function batchAsyncWithHttpInfo($requests) 
    {
        if (count($requests) == 0)
        {
            return array();
        }

        $options = $this->_createHttpClientOption();
        $this->_checkAuthToken();

        $multipartContents = [];
        foreach ($requests as $request)
        {
            $partData = ObjectSerializer::createBatchPart($this->config, $request);
            $multipartContents[] = [
                'name' => sha1(uniqid('', true)),
                'contents' => $partData,
                'headers' => ['Content-Type' => 'application/http; msgtype=request']
            ];
        }

        $headers = [];
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        if ($this->config->getUserAgent()) {
            $headers['x-aspose-client'] = $this->config->getUserAgent();
        }

        $headers['x-aspose-client-version'] = $this->config->getClientVersion();
        $httpBody = new MultipartStream($multipartContents);
        $headers['Content-Type'] = "multipart/form-data; boundary=" . $httpBody->getBoundary();

        $method = 'PUT';
        $url = ObjectSerializer::parseURL($this->config, '/words/batch', array());
        $batchRequest = new Request(
            $method,
            $url,
            $headers,
            $httpBody
        );

        if ($this->config->getDebug()) {
            $this->_writeRequestLog($method, $url, $headers, $httpBody);
        }

        return $this->client
            ->sendAsync($batchRequest, $options)
            ->then(
                function ($response) use ($requests) {
                    return ObjectSerializer::parseBatchResponse($response, $requests);
                },
                function ($e) use ($batchRequest) {
                    if ($e->getCode() == 401) {
                        $this->_requestToken();
                        throw new RepeatRequestException("Request must be retried", 401, null, null);
                    }
                    else if ($e->getCode() < 200 || $e->getCode() > 299) {
                        print($e);
                        throw new ApiException(sprintf('[%d] Error connecting to the API (%s)', $e->getCode(), $batchRequest->getUri()), $e->getCode(), null, null);
                    }
                }
            );
    }

    /*
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    private function _createHttpClientOption() 
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }

    /*
     * Executes response logging
     */
    private function _writeResponseLog($statusCode, $headers, $body)
    {
        $logInfo = "\nResponse: $statusCode \n";
        echo $logInfo . $this->_writeHeadersAndBody($logInfo, $headers, $body);
    }

    /*
     * Executes request logging
     */
    private function _writeRequestLog($method, $url, $headers, $body)
    {
        $logInfo = "\n$method: $url \n";
        echo $logInfo . $this->_writeHeadersAndBody($logInfo, $headers, $body);
    }

    /*
     * Executes header and boy formatting
     */
    private function _writeHeadersAndBody($logInfo, $headers, $body)
    {
        foreach ($headers as $name => $value) {
            $logInfo .= $name . ': ' . $value . "\n";
        }

        return $logInfo .= "Body: " . $body . "\n";
    }

    /*
     * Gets a request token from server
     */
    private function _requestToken() 
    {
        $requestUrl = $this->config->getHost() . "connect/token";
        $params = array(
            "grant_type"=>'client_credentials',
            "client_id" => $this->config->getClientId(),
            "client_secret" => $this->config->getClientSecret()
        );
        $multipartContents = [];
        foreach ($params as $paramName => $paramValue) {
            $multipartContents[] = [
                'name' => $paramName,
                'contents' => $paramValue
            ];
        }
        // for HTTP post (form)
        $httpBody = new MultipartStream($multipartContents);
        $response = $this->client->send(new Request('POST', $requestUrl, [], $httpBody));
        $result = json_decode($response->getBody()->getContents(), true);
        $this->config->setAccessToken($result["access_token"]);
    }

    private function _checkAuthToken()
    {
        if ($this->config->getAccessToken() === "") {
            $this->_requestToken();
        }
    }
}
