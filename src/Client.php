<?php


namespace Cblink\AuthClient;


use Hanson\Foundation\Foundation;

class Client extends Foundation
{
    public function request(string $method, string $url, array $data = [])
    {
        $api = new Api($this['config']['app_id'], $this['config']['secret']);

        return $api->request($method, $url, $data);
    }
}