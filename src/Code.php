<?php

namespace ApiRsp;

/**
 * Class Code
 * @package ApiRsp
 */
class Code
{

    const OK               = 0;
    const ERR_SYS          = 1;
    const ERR_BAD_REQUEST  = 3;
    const ERR_UNAUTHORIZED = 4;
    const ERR_FORBIDDEN    = 5;
    const ERR_NOT_FOUND    = 6;
    const ERR_FREQUENCY    = 7;


    /**
     * @var string
     */
    public static string $PRE = '';

    /**
     * @var array
     */
    public static array $MAP = [];


    /**
     * The system keeps the maximum error code
     */
    const MAX_SYS_CODE = 999;

    /**
     * The system retains error code messages
     *
     * @var array
     */
    public static array $SYS_MSG = [
        self::OK               => 'OK.',
        self::ERR_SYS          => 'System busy, please try again later!',
        self::ERR_BAD_REQUEST  => 'Bad request.',
        self::ERR_UNAUTHORIZED => 'Unauthorized.',
        self::ERR_FORBIDDEN    => 'Forbidden.',
        self::ERR_NOT_FOUND    => 'Not Found.',
        self::ERR_FREQUENCY    => 'Requests are too frequent, please try again later!',
    ];

    /**
     * @param int $code
     * @return string
     */
    public static function msg (int $code): string
    {
        if (isset(self::$SYS_MSG[$code])) {
            return self::$SYS_MSG[$code];
        }

        return self::$MAP[$code];
    }


    /**
     * @param int $code
     * @param string $msg
     * @return array
     */
    public static function response (int $code, string $msg = ''): array
    {
        if (empty($msg)) {
            $msg = self::msg($code);
        }
        if ($code > self::MAX_SYS_CODE) {
            $code = self::$PRE . $code;
        }
        return [$code, $msg];
    }

}