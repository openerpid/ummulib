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

class UmmuHazardReportAchievement
{
    public function __construct()
    {
        $this->kode = "she_hazard_report_achievement";

        $this->curli = new CurlHelper();
        $this->gHelp = new GlobalHelper();
        $this->umHelp = new UmmuHelper();
        
        $this->umHelp->autoHelper($this->kode);
        $this->urli = 'api/she/hazard_report_achievement/';
    }

    public function show($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli . "show",
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }
}
