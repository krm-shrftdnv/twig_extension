<?php


namespace App\Component\Client;


use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpClient\Retry\RetryStrategyInterface;
use Symfony\Component\HttpClient\RetryableHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class WeatherBitForecastClient extends RetryableHttpClient
{
    public function __construct(
        public ParameterBagInterface $parameterBag,
        HttpClientInterface $client,
        RetryStrategyInterface $strategy = null,
        int $maxRetries = 1,
        LoggerInterface $logger = null
    ) {
        parent::__construct($client, $strategy, $maxRetries, $logger);
    }

    public function request(string $method, string $url, array $options = [], array $query = []): ResponseInterface
    {
        $query['key'] = $this->parameterBag->get('weatherbit.api_key');
        $url = sprintf('%s?%s', $url, http_build_query($query));
        return parent::request($method, $url, $options);
    }
}