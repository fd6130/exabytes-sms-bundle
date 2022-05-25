<?php
declare(strict_types=1);

namespace Fd\ExabytesBundle\Service;

use Fd\ExabytesBundle\Exception\ExabytesException;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Exabytes implements ExabytesInterface
{
    private $client;
    private $config;

    public function __construct(array $config, HttpClientInterface $client)
    {
        $this->config = $config;
        $this->client = $client;
    }

    public function send(string $mobile, string $message, int $messageType)
    {
        $endpoint = sprintf(
            'https://smsportal.exabytes.my/isms_send.php?un=%s&pwd=%s&dstno=%s&msg=%s&type=%s&agreedterm=YES',
            urlencode($this->config['username']),
            urlencode($this->config['password']),
            urlencode($mobile), 
            urlencode($message), 
            $messageType
        );

        $response = $this->client->request('GET', $endpoint);
        
        try
        {
            $content = $response->getContent();
        }
        catch(TransportExceptionInterface $e)
        {
            throw new ExabytesException($content);
        }


        if($content != '2000 = SUCCESS')
        {
            throw new ExabytesException($content);
        }        
    }
}