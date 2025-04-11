<?php

namespace Dorbitt\Helpers;

/**
* =============================================
* Author: Ummu
* Website: https://ummukhairiyahyusna.com/
* App: DORBITT LIB
* Description: 
* =============================================
*/

use Dorbitt\GlobalHelper;

class BuilderHelper
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->gHelp = new GlobalHelper();

        /**
         * Vars*/
        $this->limit      = $this->request->getJsonVar('limit');
        $this->offset     = $this->request->getJsonVar('offset');
        $this->sort       = $this->request->getJsonVar('sort');
        $this->withCreatedBy = $this->request->getJsonVar('created_by');

        if (strpos($this->sort, ".")) {
            // $sort = explode(".",$sort);
            // $sortCount = count($sort);
            // $sort = $sort[$sortCount-1];
            $this->sort = null;
        }

        $this->order      = $this->request->getJsonVar('order');
        $this->search     = $this->request->getJsonVar('search');

        $this->from_date  = $this->request->getJsonVar('from_date');
        $this->to_date    = $this->request->getJsonVar('to_date');
        $this->date       = $this->request->getJsonVar('date');
        $this->datetime   = $this->request->getJsonVar('datetime');

        $this->selects    = $this->request->getJsonVar('selects');
        $this->where      = $this->request->getJsonVar('where');
    }

    public function conditions($params)
    {
        $builder        = $params['builder'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        if ($this->selects and $this->selects != '*') {
            $builder->select($this->selects);
        }

        if (isset($params['company_id'])) {
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('company_id', $company_id);
            }
        }

        if (isset($params['account_id'])) {
            $account_id = $params['account_id'];
            if ($account_id) {
                $builder->where('created_by', $account_id);
            }
        }

        if (isset($params['plant_id'])) {
            $plant_id = $params['plant_id'];
            if ($plant_id) {
                $builder->where('plant_id', $plant_id);
            }
        }

        if (isset($params['site_project_id'])) {
            $site_project_id = $params['site_project_id'];
            if ($site_project_id) {
                $builder->where('site_project_id', $site_project_id);
            }
        }

        if ($id) {
            $builder->where('id',$id);
        }

        else{
            if ($this->where) {
                foreach ($this->where as $key => $value) {
                    if ($value != "") {
                        $builder->where($key,$value);
                    }
                }
            }

            if ($this->search AND $search_params) {
                // if ($search_params) {
                    $builder->groupStart();
                        $builder->like($search_params[0],$this->search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$this->search);
                                }
                            }
                        }
                    $builder->groupEnd();
                // }
            }

            if ($this->from_date) {
                $builder->where('created_at >= ', $this->gHelp->dtfFormatter($this->from_date));
            }

            if ($this->to_date) {
                $builder->where('created_at <= ', $this->gHelp->dttFormatter($this->to_date));
            }

            if ($this->date) {
                if ($this->date->from) {
                    $builder->where('created_at >= ', $this->gHelp->dtfFormatter($this->date->from));
                }

                if ($this->date->to) {
                    $builder->where('created_at <= ', $this->gHelp->dttFormatter($this->date->to));
                }
            }

            if ($this->datetime) {
                if ($this->datetime->from) {
                    $builder->where('created_at >= ', $this->gHelp->dtfFormatter($this->datetime->from));
                }

                if ($this->datetime->to) {
                    $builder->where('created_at <= ', $this->gHelp->dttFormatter($this->datetime->to));
                }
            }
        }

        $builder->where('deleted_at', null);
        $builder->where('deleted_at IS NULL');

        return $builder;
    }

    public function conditions2($params)
    {
        $builder        = $params['builder'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        if ($this->selects and $this->selects != '*') {
            $builder->select($selects);
        }

        if (isset($params['company_id'])) {
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('company_id', $company_id);
            }
        }

        if (isset($params['account_id'])) {
            $account_id = $params['account_id'];
            $builder->where('created_by', $account_id);
        }

        if (isset($params['plant_id'])) {
            $plant_id = $params['plant_id'];
            if ($plant_id) {
                $builder->where('plant_id', $plant_id);
            }
        }

        if (isset($params['site_project_id'])) {
            $site_project_id = $params['site_project_id'];
            if ($site_project_id) {
                $builder->where('site_project_id', $site_project_id);
            }
        }

        if ($id) {
            $builder->where('id',$id);
        }

        else{
            if ($this->where) {
                foreach ($this->where as $key => $value) {
                    if ($value != "") {
                        $builder->where($key,$value);
                    }
                }
            }

            if ($this->search AND $search_params) {
                // if ($search_params) {
                    $builder->groupStart();
                        $builder->like($search_params[0],$this->search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$this->search);
                                }
                            }
                        }
                    $builder->groupEnd();
                // }
            }

            if ($this->from_date) {
                $builder->where('created_at >=', $this->gHelp->dtfFormatter($this->from_date));
            }

            if ($this->to_date) {
                $builder->where('created_at <=', $this->gHelp->dttFormatter($this->to_date));
            }

            if ($this->date) {
                if ($this->date->from) {
                    $builder->where('created_at >=', $this->gHelp->dtfFormatter($this->date->from));
                }

                if ($this->date->to) {
                    $builder->where('created_at <=', $this->gHelp->dttFormatter($this->date->to));
                }
            }
        }

        $builder->where('deleted_at', null);
        $builder->where('deleted_at IS NULL');

        return $builder;
    }

    public function withJoin($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');
        $withCreatedBy = $this->request->getJsonVar('created_by');

        if (strpos($sort, ".")) {
            // $sort = explode(".",$sort);
            // $sortCount = count($sort);
            // $sort = $sort[$sortCount-1];
            $sort = null;
        }

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $from_date  = $this->request->getJsonVar('from_date');
        $to_date    = $this->request->getJsonVar('to_date');
        $date       = $this->request->getJsonVar('date');

        $builder            = $params['builder'];
        $id                 = $params['id'];
        $search_params      = $params['search_params'];

        if (isset($params['company_id'])) {
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('a.company_id', $company_id);
            }
        }

        if (isset($withCreatedBy) AND $withCreatedBy == true AND isset($params['account_id'])) {
            $builder->where('a.created_by', $params['account_id']);
        }

        if ($id) {

            $builder->where('a.id',$id);

        }else{

            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        $builder->like($search_params[0],$search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$search);
                                }
                            }
                        }
                    $builder->groupEnd();
                }
            }

            if ($from_date) {
                $builder->where('a.created_at >=', $this->gHelp->dtfFormatter($from_date));
            }

            if ($to_date) {
                $builder->where('a.created_at <=', $this->gHelp->dttFormatter($to_date));
            }

            if ($date) {
                if ($date->from) {
                    $builder->where('a.created_at >=', $this->gHelp->dtfFormatter($date->from));
                }

                if ($date->to) {
                    $builder->where('a.created_at <=', $this->gHelp->dttFormatter($date->to));
                }
            }
        }
        
        $builder->where('a.deleted_at', null);

        return $builder;
    }

    public function conditions0($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $date       = $this->request->getJsonVar('date');

        $where      = $this->request->getJsonVar('where');
        $selects    = $this->request->getJsonVar('selects');

        $builder        = $params['builder'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        if ($selects) {
            $builder->select($selects);
        }

        if (isset($params['company_id'])) {
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('company_id', $company_id);
            }
        }

        if ($id) {

            $builder->where('id',$id);

        }

        else{

            if ($where) {
                foreach ($where as $key => $value) {
                    if ($value != "") {
                        $builder->where($key,$value);
                    }
                }
            }

            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        $builder->like($search_params[0],$search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$search);
                                }
                            }
                        }
                    $builder->groupEnd();
                }
            }

            if ($date) {
                if ($date->from) {
                    $builder->where('tanggal >=', $this->gHelp->dtfFormatter($date->from));
                }

                if ($date->to) {
                    $builder->where('tanggal <=', $this->gHelp->dttFormatter($date->to));
                }
            }
        }

        return $builder;
    }

    public function withJoin0($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        if (strpos($sort, ".")) {
            $sort = null;
        }

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');
        $date       = $this->request->getJsonVar('date');

        $builder            = $params['builder'];
        $id                 = $params['id'];
        $search_params      = $params['search_params'];

        if (isset($params['company_id'])) {
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('a.company_id', $company_id);
            }
        }

        if ($id) {

            $builder->where('a.id',$id);

        }else{

            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        $builder->like($search_params[0],$search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$search);
                                }
                            }
                        }
                    $builder->groupEnd();
                }
            }

            if ($from_date) {
                $builder->where('a.created_at >=', $this->gHelp->dtfFormatter($from_date));
            }

            if ($to_date) {
                $builder->where('a.created_at <=', $this->gHelp->dttFormatter($to_date));
            }

            if ($date) {
                if ($date->from) {
                    $builder->where('a.created_at >=', $this->gHelp->dtfFormatter($date->from));
                }

                if ($date->to) {
                    $builder->where('a.created_at <=', $this->gHelp->dttFormatter($date->to));
                }
            }
        }
        
        return $builder;
    }




    /**
     * ================================================
     * FOR HILLCON
     * ================================================
     * */
    public function conditions_hill($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        $date       = $this->request->getJsonVar('date');
        $where      = $this->request->getJsonVar('where');

        $builder        = $params['builder'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        if (isset($params['company_id'])) {
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('company_id', $company_id);
            }
        }

        if ($id) {

            $builder->where('id',$id);

        }else{

            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        $builder->like($search_params[0],$search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$search);
                                }
                            }
                        }
                    $builder->groupEnd();
                }
            }

            if ($date) {
                if ($date->from) {
                    $builder->where('tanggal >=', $this->gHelp->dtfFormatter($date->from));
                }

                if ($date->to) {
                    $builder->where('tanggal <=', $this->gHelp->dttFormatter($date->to));
                }
            }
        }

        return $builder;
    }

    public function withJoin_hill($params)
    {
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');

        if (strpos($sort, ".")) {
            $sort = null;
        }

        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');
        $date       = $this->request->getJsonVar('date');

        $builder            = $params['builder'];
        $id                 = $params['id'];
        $search_params      = $params['search_params'];

        if (isset($params['company_id'])) {
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('a.company_id', $company_id);
            }
        }

        if ($id) {

            $builder->where('a.id',$id);

        }else{

            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        $builder->like($search_params[0],$search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$search);
                                }
                            }
                        }
                    $builder->groupEnd();
                }
            }

            if ($from_date) {
                $builder->where('a.created_at >=', $this->gHelp->dtfFormatter($from_date));
            }

            if ($to_date) {
                $builder->where('a.created_at <=', $this->gHelp->dttFormatter($to_date));
            }

            if ($date) {
                if ($date->from) {
                    $builder->where('a.created_at >=', $this->gHelp->dtfFormatter($date->from));
                }

                if ($date->to) {
                    $builder->where('a.created_at <=', $this->gHelp->dttFormatter($date->to));
                }
            }
        }
        
        return $builder;
    }
    /**
     * ================================================
     * END FOR HILLCON
     * ================================================
     * */


    public function dt_conditions($params)
    {
        $length      = $this->request->getJsonVar('length');
        $limit      = $this->request->getJsonVar('limit');
        $offset     = $this->request->getJsonVar('offset');
        $sort       = $this->request->getJsonVar('sort');
        $order      = $this->request->getJsonVar('order');
        $search     = $this->request->getJsonVar('search');

        if (isset($search['value'])) {
            $search = $search['value'];
        }else{
            $search = "";
        }

        $date       = $this->request->getJsonVar('date');

        $builder        = $params['builder'];
        $id             = $params['id'];
        $search_params  = $params['search_params'];

        if (isset($params['company_id'])) {
            $company_id = $params['company_id'];
            if ($company_id) {
                $builder->where('company_id', $company_id);
            }
        }

        if ($id) {
            $builder->where('id',$id);
        }

        else{
            if ($this->where) {
                foreach ($this->where as $key => $value) {
                    if ($value != "") {
                        $builder->where($key,$value);
                    }
                }
            }
            
            if ($search) {
                if ($search_params) {
                    $builder->groupStart();
                        $builder->like($search_params[0],$search);
                        if (count($search_params) > 1) {
                            foreach ($search_params as $key => $value) {
                                if ($key != 0) {
                                    $builder->orLike($value,$search);
                                }
                            }
                        }
                    $builder->groupEnd();
                }
            }

            if ($date) {
                if ($date->from) {
                    $builder->where('tanggal >=', $this->gHelp->dtfFormatter($date->from));
                }

                if ($date->to) {
                    $builder->where('tanggal <=', $this->gHelp->dttFormatter($date->to));
                }
            }
        }

        return $builder;
    }
}
