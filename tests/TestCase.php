<?php

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as BaseTestCase;
use TenantCloud\TenantTurner\Client\TenantTurnerClient;
use TenantCloud\TenantTurner\Client\TenantTurnerClientImpl;
use TenantCloud\TenantTurner\TenantTurnerSDKServiceProvider;

class TestCase extends BaseTestCase
{
	use WithFaker;

	protected function getPackageProviders($app): array
	{
		return [
			TenantTurnerSDKServiceProvider::class,
		];
	}

	protected function mockResponse(int $statusCode, ?string $responseBody = null): TenantTurnerClient
	{
		$mock = new MockHandler([
			new Response(
				$statusCode,
				[],
				$responseBody
			),
		]);

		$handlerStack = HandlerStack::create($mock);

		$client = new Client(['handler' => $handlerStack]);

		$config = $this->app->make(Repository::class);

		$this->app->bind(TenantTurnerClient::class, function () use ($config, $client) {
			return new TenantTurnerClientImpl(
				$config->get('tenant_turner.api_key') ?? '',
				$config->get('tenant_turner.base_url') ?? '',
				30,
				$client
			);
		});

		return $this->app->make(TenantTurnerClient::class);
	}
}
