<?php

namespace Globe\Http\Enum;

enum Status: int
{
    case CONTINUE = 100;
    case SWITCHING_PROTOCOLS = 101;
    case PROCESSING = 102;
    case EARLY_HINTS = 103;

    case OK = 200;
    case CREATED = 201;
    case ACCEPTED = 202;
    case NON_AUTHORITATIVE_INFORMATION = 203;
    case NO_CONTENT = 204;
    case RESET_CONTENT = 205;
    case PARTIAL_CONTENT = 206;
    case MULTI_STATUS = 207;
    case ALREADY_REPORTED = 208;
    case IM_USED = 226;

    case MULTIPLE_CHOICES = 300;
    case MOVED_PERMANENTLY = 301;
    case FOUND = 302;
    case SEE_OTHER = 303;
    case NOT_MODIFIED = 304;
    case USE_PROXY = 305;
    case SWITCH_PROXY = 306;
    case TEMPORARY_REDIRECT = 307;
    case PERMANENT_REDIRECT = 308;

    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case PAYMENT_REQUIRED = 402;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;
    case NOT_ACCEPTABLE = 406;
    case PROXY_AUTHENTICATION_REQUIRED = 407;
    case REQUEST_TIMEOUT = 408;
    case CONFLICT = 409;
    case GONE = 410;
    case LENGTH_REQUIRED = 411;
    case PRECONDITION_FAILED = 412;
    case PAYLOAD_TOO_LARGE = 413;
    case URI_TOO_LONG = 414;
    case UNSUPPORTED_MEDIA_TYPE = 415;
    case RANGE_NOT_SATISFIABLE = 416;
    case EXPECTATION_FAILED = 417;
    case IM_A_TEAPOT = 418;
    case ENHANCE_YOUR_CALM = 420;
    case MISDIRECTED_REQUEST = 421;
    case UNPROCESSABLE_ENTITY = 422;
    case LOCKED = 423;
    case FAILED_DEPENDENCY = 424;
    case TOO_EARLY = 425;
    case UPGRADE_REQUIRED = 426;
    case PRECONDITION_REQUIRED = 428;
    case TOO_MANY_REQUESTS = 429;
    case REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    case UNAVAILABLE_FOR_LEGAL_REASONS = 451;

    case INTERNAL_SERVER_ERROR = 500;
    case NOT_IMPLEMENTED = 501;
    case BAD_GATEWAY = 502;
    case SERVICE_UNAVAILABLE = 503;
    case GATEWAY_TIMEOUT = 504;
    case HTTP_VERSION_NOT_SUPPORTED = 505;
    case VARIANT_ALSO_NEGOTIATES = 506;
    case INSUFFICIENT_STORAGE = 507;
    case LOOP_DETECTED = 508;
    case NOT_EXTENDED = 510;
    case NETWORK_AUTHORIZATION_REQUIRED = 511;

    public function message(): string
    {
        return match($this) {
            Status::CONTINUE => 'Continue.',
            Status::SWITCHING_PROTOCOLS => 'Switching protocols.',
            Status::PROCESSING => 'Processing.',
            Status::EARLY_HINTS => 'Early hints.',

            Status::OK => 'OK.',
            Status::CREATED => 'Created.',
            Status::ACCEPTED => 'Accepted.',
            Status::NON_AUTHORITATIVE_INFORMATION => 'Non-authoritative information.',
            Status::NO_CONTENT => 'No content.',
            Status::RESET_CONTENT => 'Reset content.',
            Status::PARTIAL_CONTENT => 'Partial content.',
            Status::MULTI_STATUS => 'Multi-status.',
            Status::ALREADY_REPORTED => 'Already reported.',
            Status::IM_USED => 'IM used.',

            Status::MULTIPLE_CHOICES => 'Multiple choices.',
            Status::MOVED_PERMANENTLY => 'Moved permanently.',
            Status::FOUND => 'Found.',
            Status::SEE_OTHER => 'See other.',
            Status::NOT_MODIFIED => 'Not modified.',
            Status::USE_PROXY => 'Use proxy.',
            Status::SWITCH_PROXY => 'Switch proxy.',
            Status::TEMPORARY_REDIRECT => 'Temporary redirect.',
            Status::PERMANENT_REDIRECT => 'Permanent redirect.',

            Status::BAD_REQUEST => 'Bad request.',
            Status::UNAUTHORIZED => 'Unauthorized.',
            Status::PAYMENT_REQUIRED => 'Payment required.',
            Status::FORBIDDEN => 'Forbidden.',
            Status::NOT_FOUND => 'Not found.',
            Status::METHOD_NOT_ALLOWED => 'Method not allowed.',
            Status::NOT_ACCEPTABLE => 'Not acceptable.',
            Status::PROXY_AUTHENTICATION_REQUIRED => 'Proxy authentication required.',
            Status::REQUEST_TIMEOUT => 'Request timeout.',
            Status::CONFLICT => 'Conflict.',
            Status::GONE => 'Gone.',
            Status::LENGTH_REQUIRED => 'Length required.',
            Status::PRECONDITION_FAILED => 'Precondition failed.',
            Status::PAYLOAD_TOO_LARGE => 'Payload too large.',
            Status::URI_TOO_LONG => 'URI too long.',
            Status::UNSUPPORTED_MEDIA_TYPE => 'Unsupported media type.',
            Status::RANGE_NOT_SATISFIABLE => 'Range not satisfiable.',
            Status::EXPECTATION_FAILED => 'Expectation failed.',
            Status::IM_A_TEAPOT => 'I\'m a teapot.',
            Status::ENHANCE_YOUR_CALM => 'Enhance your calm.',
            Status::MISDIRECTED_REQUEST => 'Misdirected request.',
            Status::UNPROCESSABLE_ENTITY => 'Unprocessable entity.',
            Status::LOCKED => 'Locked.',
            Status::FAILED_DEPENDENCY => 'Failed dependency.',
            Status::TOO_EARLY => 'Too early.',
            Status::UPGRADE_REQUIRED => 'Upgrade required.',
            Status::PRECONDITION_REQUIRED => 'Precondition required.',
            Status::TOO_MANY_REQUESTS => 'Too many requests.',
            Status::REQUEST_HEADER_FIELDS_TOO_LARGE => 'Request header fields too large.',
            Status::UNAVAILABLE_FOR_LEGAL_REASONS => 'Unavailable for legal reasons.',

            Status::INTERNAL_SERVER_ERROR => 'Internal server error.',
            Status::NOT_IMPLEMENTED => 'Not implemented.',
            Status::BAD_GATEWAY => 'Bad gateway.',
            Status::SERVICE_UNAVAILABLE => 'Service unavailable.',
            Status::GATEWAY_TIMEOUT => 'Gateway timeout.',
            Status::HTTP_VERSION_NOT_SUPPORTED => 'HTTP version not supported.',
            Status::VARIANT_ALSO_NEGOTIATES => 'Variant also negotiates.',
            Status::INSUFFICIENT_STORAGE => 'Insufficient storage.',
            Status::LOOP_DETECTED => 'Loop detected.',
            Status::NOT_EXTENDED => 'Not extended.',
            Status::NETWORK_AUTHORIZATION_REQUIRED => 'Network authorization required.',
        };
    }
}
