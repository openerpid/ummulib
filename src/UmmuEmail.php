<?php

namespace Dorbitt;

/**
* =============================================
* Author: Ummu
* Website: https://ummukhairiyahyusna.com/
* App: DORBITT LIB
* Description: 
* =============================================
*/

use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\UmmuHelper;
use Dorbitt\Helpers\GlobalHelper;

class UmmuEmail
{
    public function __construct()
    {
        $this->kode = "email";

        $this->curli = new CurlHelper();
        $this->gHelp = new GlobalHelper();
        $this->umHelp = new UmmuHelper();
        
        $this->umHelp->autoHelper($this->kode);
        $this->urli = 'api/lib/email/';
    }

    // public function show($params)
    // {
    //     $response = $this->curli->request4(
    //         [
    //             "path"           => $this->urli . "show",
    //             "method"         => "GET",
    //             "payload"        => $params['payload'],
    //             "module_code"    => $this->kode,
    //             "token"          => $params['token']
    //         ]
    //     );

    //     return json_decode($response, false);
    // }

    // public function insert($params)
    // {
    //     $response = $this->curli->request4([
    //         "path"           => $this->urli. "create",
    //         "method"         => "POST",
    //         "payload"        => $params["payload"],
    //         "module_code"    => $this->kode,
    //         "token"          => $params["token"]
    //     ]);

    //     return json_decode($response, false);
    // }

    // public function delete($params)
    // {
    //     $response = $this->curli->request4(
    //         [
    //             "path"           => $this->urli. "delete",
    //             "method"         => "DELETE",
    //             "payload"        => $params['payload'],
    //             "module_code"    => $this->kode,
    //             "token"          => $params['token']
    //         ]
    //     );

    //     return json_decode($response, false);
    // }

    // public function update($params)
    // {
    //     $id = $params['id'];

    //     $response = $this->curli->request4(
    //         [
    //             "path"           => $this->urli. "update/". $id,
    //             "method"         => "PUT",
    //             "payload"        => $params['payload'],
    //             "module_code"    => $this->kode,
    //             "token"          => $params['token']
    //         ]
    //     );

    //     return json_decode($response, false);
    // }

    public function send($params)
    {
        $response = $this->curli->request4([
            "path"           => $this->urli. "send",
            "method"         => "POST",
            "payload"        => $params["payload"],
            "module_code"    => $this->kode,
            "token"          => $params["token"]
        ]);

        return json_decode($response, false);
    }    
}
