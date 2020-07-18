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
            'code' => CodeMsg::OK,
            'msg'  => CodeMsg::$SYS_MSG[CodeMsg::OK],
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
    public static function err (int $code = CodeMsg::SYS, string $msg = ''): array
    {
        [$code, $msg] = CodeMsg::codeMsg($code, $msg);
        return compact('code', 'msg');
    }



}