<?php

namespace Ummulib\Routes;

/**
* =============================================
* Author: Ummu
* Website: https://ummukhairiyahyusna.com/
* App: DORBITT LIB
* Description: 
* =============================================
*/

use Ummulib\Curl;
use Ummulib\GlobalHelper;

class UmmuHazardReportAchievement
{
    public function __construct()
    {
        $this->curli = new Curl();
        $this->gHelp = new GlobalHelper();
        $this->urli = 'api/she/hazard_report_achievement/';
    }

    public function show($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli . "show",
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => "she_hazard_report_achievement",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }
}
