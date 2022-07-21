<?php

namespace Globe\Http;

use Globe\Http\Enum\Status;

class HttpException extends \RuntimeException
{
    public function __construct(Status $code, string $message = '', \Throwable $previous = null)
    {
        if (!$message) {
            $message = $code->message();
        }

        parent::__construct($message, $code->value, $previous);
    }
}
