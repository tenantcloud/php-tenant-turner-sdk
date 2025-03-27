<?php

namespace TenantCloud\TenantTurner;

use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;
use TenantCloud\TenantTurner\Client\TenantTurnerClient;
use TenantCloud\TenantTurner\Client\TenantTurnerClientImpl;
use TenantCloud\TenantTurner\Fake\FakeTenantTurnerClient;

/**
 * Provides Tenant Turner SDK.
 */
final class TenantTurnerSDKServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../resources/tenant_turner.php',
			'tenant_turner'
		);

		$this->bindDefaultClient();
	}

	/**
	 * Binds default implementation of {@see TenantTurnerClient}.
	 */
	private function bindDefaultClient(): void
	{
		$config = $this->app->make(Repository::class);
		$logger = $this->app->make(LoggerInterface::class);

		if (!$config->get('tenant_turner.fake_client')) {
			$this->app->bind(TenantTurnerClient::class, fn () => new TenantTurnerClientImpl(
				$config->get('tenant_turner.api_key'),
				$config->get('tenant_turner.base_url'),
				30,
				$logger,
			));
		} else {
			$this->app->bind(TenantTurnerClient::class, FakeTenantTurnerClient::class);
		}
	}
}
