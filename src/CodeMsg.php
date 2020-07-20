<?php

namespace ApiRsp;

/**
 * Class CodeMsg
 * @package ApiRsp
 */
class CodeMsg
{
    /**
     * Code prefix name for environment
     * Save in $_ENV
     */
    const PREFIX_ENV_NAME    = 'API_RSP_FRE';

    /**
     * Save in $_REQUEST
     */
    const CURRENT_CLASS_NAME = 'API_RSP_CLASS';

    const OK           = 200;
    const BAD_REQUEST  = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN    = 403;
    const NOT_FOUND    = 404;
    const FREQUENCY    = 405;
    const SYS          = 500;


    /**
     * The system retains error code messages
     *
     * @var array
     */
    public static array $SYS_MSG = [
        self::OK           => 'OK.',
        self::BAD_REQUEST  => 'Bad request.',
        self::UNAUTHORIZED => 'Unauthorized.',
        self::FORBIDDEN    => 'Forbidden.',
        self::NOT_FOUND    => 'Not Found.',
        self::FREQUENCY    => 'Requests are too frequent, please try again later!',
        self::SYS          => 'System busy, please try again later!',
    ];

    /**
     *
     * @var array
     */
    public static array $MSG = [];


    /**
     * The system keeps the maximum error code
     */
    const MAX_SYS_CODE = 999;


    /**
     * @param int $code
     * @return string
     */
    public static function msg (int $code): string
    {
        return self::$SYS_MSG[$code] ?? self::$MSG[$code];
    }

    /**
     * @param int $code
     * @param string $msg
     * @return array
     */
    public static function codeMsg (int $code, string $msg = ''): array
    {
        if ($code > self::MAX_SYS_CODE) {
            if ($pre = self::pre()) {
                $code = $pre . $code;
            } else {
                throw new \ErrorException(static::class . ' has no code prefix');
            }
        }
        empty($msg) && $msg = self::msg($code);
        return [$code, $msg];
    }

    /**
     * Code prefix
     *
     * @return int
     */
    public static function pre (): ?int
    {
        if ($pre = array_search(static::class, (array)$_ENV[self::PREFIX_ENV_NAME], true)) {
            return $pre;
        }

        return null;
    }

}