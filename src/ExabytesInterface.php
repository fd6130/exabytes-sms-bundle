<?php

namespace Fd\Exabytes;

interface ExabytesInterface
{
    /**
     * @param string $mobile Mobile number
     * @param string $message Message
     * @param int $messageType Message Type (1 - ASCII, 2 - Unicode)
     */
    public function send(string $mobile, string $message, int $messageType);
}