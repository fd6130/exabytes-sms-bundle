<?php

namespace Fd\ExabytesBundle\Service;

use Fd\ExabytesBundle\Exception\ExabytesException;

interface ExabytesInterface
{
    const ASCII = 1;
    const UNICODE = 2;

    /**
     * @param string $mobile Mobile number
     * @param string $message Message
     * @param int $messageType Message Type (1 - ASCII, 2 - Unicode)
     * 
     * @throws ExabytesException
     */
    public function send(string $mobile, string $message, int $messageType);
}