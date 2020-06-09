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
     * To get the message
     *
     * @param $code
     * @return string
     */
    public function msg (int $code): string
    {
        if ($code < self::MAX_SYS_CODE && isset(self::$SYS_MSG[$code])) {
            return self::$SYS_MSG[$code];
        }

        return $this->map()[$code];
    }

    /**
     * Gets an error code (prefix included) and a message
     *
     * @param int $code
     * @param string $msg
     * @return array
     */
    public function codeMsg (int $code, string $msg = ''): array
    {
        if (empty($msg)) {
            $msg = $this->msg($code);
        }
        //状态码前缀使用子类名称末尾数字定义
        if ($code > self::MAX_SYS_CODE) {
            $pre   = '';
            $class = static::class;
            $len   = strlen($class);
            for ($i = $len - 1; $i > 0; $i--) {
                if (is_numeric($class[$i])) {
                    $pre = $class[$i] . $pre;
                }
                break;
            }
            $code = $pre . $code;
        }

        return [$code, $msg];
    }


    /**
     * Error code => message key-value pair array
     *
     *
     * @return array
     */
    public function map (): array
    {
        return [];
    }

}