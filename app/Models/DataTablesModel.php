<?php

namespace App\Models;

use CodeIgniter\Model;

class DataTablesModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    # DASHBOARD

    public function dtHistory($params)
    {
        $query = $this->db->table('t_basket')
            ->select('
        t_basket.id as basketID,
        t_basket.dateTime AS date,
        COUNT(t_basket.id) AS articles,
        t_basket.payType AS payType,
        SUM(t_basket_service.amount) AS amount
        ', FALSE)
            ->join('t_basket_service', 't_basket_service.fk_basket = t_basket.id');

        $query->where('status', 0);

        if (!empty($params['search'])) {
            $query->groupStart();
            $query->like('t_basket.id', $params['search']);
            $query->orLike('t_basket.dateTime', $params['search']);
            $query->orLike('payType', $params['search']);
            $query->groupEnd();
        }
        
        $query->offset($params['start']);
        $query->limit($params['length']);
        $query->orderBy($this->dtHistorySort($params['sortColumn'], $params['sortDir']));
        $query->groupBy('t_basket.id');

        return $query->get()->getResult();
    }

    public function dtHistorySort($column, $dir)
    {
        $sort = '';

        if ($column == 0) {
            if ($dir == 'asc')
                $sort = 't_basket.id ASC';
            else
                $sort = 't_basket.id DESC';
        } elseif ($column == 1) {
            if ($dir == 'asc')
                $sort = 't_basket.dateTime ASC';
            else
                $sort = 't_basket.dateTime DESC';
        } elseif ($column == 2) {
            if ($dir == 'asc')
                $sort = 'articles ASC';
            else
                $sort = 'articles DESC';
        } elseif ($column == 3) {
            if ($dir == 'asc')
                $sort = 'payType ASC';
            else
                $sort = 'payType DESC';
        } elseif ($column == 4) {
            if ($dir == 'asc')
                $sort = 'amount ASC';
            else
                $sort = 'amount DESC';
        }

        return $sort;
    }

    public function getTotalHistory()
    {
        $query = $this->db->table('t_basket')
            ->selectCount('id')
            ->where('status', 0)
            ->get()->getResult();

        return $query[0]->id;
    }
}
