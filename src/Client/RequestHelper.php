<?php

namespace TenantCloud\TenantTurner\Client;

trait RequestHelper
{
	public function setAuthHeader(string $apiKey): array
	{
		return [
			'Authorization' => 'Basic ' . base64_encode($apiKey),
		];
	}
}
