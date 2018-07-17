<?php


namespace Cblink\AuthClient;


use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{

    /**
     * @var string
     */
    private $appId;

    /**
     * @var string
     */
    private $secret;

    public function __construct(string $appId, string $secret)
    {
        $this->appId = $appId;
        $this->secret = $secret;
    }

    public function request(string $method, string $url, array $data = [])
    {
        $params = array_merge($data, ['app_id' => $this->appId, 'secret' => $this->secret]);

        ksort($params);

        $sign = strtolower(md5(http_build_query($params)));

        $response = $this->getHttp()->request($url, $method, ['form_params' => array_merge($params, ['app_id' => $this->appId, 'sign' => $sign])]);

        return json_decode($response->getBody()->getContents(), true);
    }
}