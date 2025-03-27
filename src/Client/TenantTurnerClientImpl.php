<?php

namespace TenantCloud\TenantTurner\Client;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use Psr\Log\LoggerInterface;
use TenantCloud\GuzzleHelper\DumpRequestBody\HeaderObfuscator;
use TenantCloud\GuzzleHelper\DumpRequestBody\JsonObfuscator;
use TenantCloud\GuzzleHelper\GuzzleMiddleware;
use TenantCloud\TenantTurner\Customers\CustomersApi;
use TenantCloud\TenantTurner\Customers\CustomersApiImpl;
use TenantCloud\TenantTurner\Properties\PropertiesApi;
use TenantCloud\TenantTurner\Properties\PropertiesApiImpl;

class TenantTurnerClientImpl implements TenantTurnerClient
{
	private readonly Client $httpClient;

	public function __construct(
		private readonly string $apiKey,
		string $baseUrl,
		int $timeout = 30,
		?LoggerInterface $logger = null,
		?Client $httpClient = null
	) {
		$stack = HandlerStack::create();

		// Return all response body.
		$stack->unshift(GuzzleMiddleware::fullErrorResponseBody());

		// Hide secret info from error responses.
		$stack->unshift(GuzzleMiddleware::dumpRequestBody([
			new JsonObfuscator([
				'Email',
				'Phone',
			]),
			new HeaderObfuscator(['Authorization']),
		]));

		if ($logger) {
			$stack->push(GuzzleMiddleware::tracingLog($logger));
		}

		$this->httpClient = $httpClient ?? new Client([
			'base_uri'                      => $baseUrl,
			'handler'                       => $stack,
			RequestOptions::CONNECT_TIMEOUT => $timeout,
			RequestOptions::TIMEOUT         => $timeout,
		]);
	}

	public function properties(): PropertiesApi
	{
		return new PropertiesApiImpl($this->httpClient);
	}

	public function customers(): CustomersApi
	{
		return new CustomersApiImpl($this->apiKey, $this->httpClient);
	}
}
