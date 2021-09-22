<?php
declare(strict_types=1);

namespace Fd\Exabytes;

use Fd\Exabytes\Exception\ExabytesException;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * @author fd6130
 */
class Exabytes implements ExabytesInterface
{
    private $client;
    private $params;
    private $messageType = 1;

    public function __construct(string $username, string $password, int $messageType, HttpClientInterface $client)
    {
        $this->messageType = $messageType;
        $this->client = $client;
    }

    public function send(string $mobile, string $message, int $messageType)
    {
        $username = $this->params->get('exabytes.username');
        $password = $this->params->get('exabytes.password');

        $endpoint = sprintf(
            'https://smsportal.exabytes.my/isms_send.php?un=%s&pwd=%s&dstno=%s&msg=%s&type=%s&agreedterm=YES',
            urlencode($username),
            urlencode($password),
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