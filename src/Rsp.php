<?php

namespace ApiRsp;

/**
 * Class Rsp
 * @package ApiRsp
 */
class Rsp
{

    /**
     * @param array|null $data
     * @return array
     */
    public static function ok (array $data = null): array
    {
        $response = [
            'code' => Code::OK,
            'msg'  => Code::$SYS_MSG[Code::OK],
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return $response;
    }


    /**
     * @param int $code
     * @param string $msg
     * @return array
     */
    public static function err (int $code = Code::ERR_SYS, string $msg = ''): array
    {
        if ($code > Code::MAX_SYS_CODE) {
            [$code, $msg] = (self::code())->codeMsg($code, $msg);
        } else {
            $msg = empty($msg) ? Code::$SYS_MSG[$code] : $msg;
        }
        return compact('code', 'msg');
    }


    /**
     * @return Code
     */
    public static function code (): Code
    {
        return new Code();
    }

}