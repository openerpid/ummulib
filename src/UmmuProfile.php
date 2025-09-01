<?php

namespace Ummulib;

/**
* =============================================
* Author: Ummu
* Website: https://ummukhairiyahyusna.com/
* App: Ummulib LIB
* Description: 
* =============================================
*/

use Ummulib\Helpers\CurlHelper;
use Ummulib\Helpers\UmmuHelper;
use Ummulib\Helpers\GlobalHelper;

class UmmuProfile
{
    public function __construct()
    {
        $this->kode = "config_profile";
        $this->curli = new CurlHelper();
        $this->gHelp = new GlobalHelper();
        $this->path = 'api/config/profile/';
    }

    public function show($params)
    {
        $id = $params['id'];

        if ($id) {
            $show = "show/".$id;
        }else{
            $show = "show";
        }

        $response = $this->curli->request4(
            [
                "path"           => $this->path . $show,
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function update($params)
    {
        $id = $params['id'];
        
        if ($id) {
            $update = "update/" . $id;
        }else{
            $update = "update";
        }

        $response = $this->curli->request4(
            [
                "path"           => $this->path. $update,
                "method"         => "PUT",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }
}
