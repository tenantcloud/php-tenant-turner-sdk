<?php

namespace TenantCloud\TenantTurner;

use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;
use TenantCloud\TenantTurner\Client\TenantTurnerClient;
use TenantCloud\TenantTurner\Client\TenantTurnerClientImpl;

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

		$this->app->bind(TenantTurnerClient::class, function () use ($config) {
			return new TenantTurnerClientImpl(
				$config->get('tenant_turner.api_key'),
				$config->get('tenant_turner.base_url'),
			);
		});
	}
}
