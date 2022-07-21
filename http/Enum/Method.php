<?php

namespace Globe\Http\Enum;

enum Method: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PATCH = 'PATCH';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
    case OPTIONS = 'OPTIONS';
    case HEAD = 'HEAD';
    case CONNECT = 'CONNECT';
    case TRACE = 'TRACE';
}
