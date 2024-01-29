<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function collectionDay()
    {
        $query = $this->db->table('t_basket')
            ->select('t_basket_service.amount AS amount, t_basket.payType AS payType')
            ->join('t_basket_service', 't_basket_service.fk_basket = t_basket.id')
            ->where('date', date("Y-m-d"))
            ->where('status', 0);

        $data = $query->get()->getResult();

        $cash = 0;
        $card = 0;

        foreach ($data as $index) {
            if ($index->payType == 1)
                $cash = $cash + $index->amount;
            elseif ($index->payType == 2)
                $card = $card + $index->amount;
        }

        $return = array();
        $return['cash'] = $cash;
        $return['card'] = $card;
        $return['total'] = $card + $cash;

        return $return;
    }

    public function chartWeek()
    {
        $firstDayOfWeek = date('Y-m-d', strtotime('monday this week'));
        $lastDayOfWeek = date('Y-m-d', strtotime('sunday this week'));

        $query = $this->db->table('t_basket')
            ->select('
            t_basket.date AS date,
            t_basket_service.amount AS amount,
            t_basket.payType AS payType,
        ')
            ->join('t_basket_service', 't_basket_service.fk_basket = t_basket.id')
            ->where('date >=', $firstDayOfWeek)
            ->where('date <=', $lastDayOfWeek)
            ->where('status', 0);

        $data = $query->get()->getResult();

        $countData = sizeof($data);

        $serie['mon'] = 0;
        $serie['tue'] = 0;
        $serie['wed'] = 0;
        $serie['thu'] = 0;
        $serie['fri'] = 0;
        $serie['sat'] = 0;
        $serie['sun'] = 0;
        $serie['total'] = 0;

        $firstDay = date('Y-m-d', strtotime($firstDayOfWeek));

        for ($i = 0; $i < $countData; $i++) {

            if ($firstDay == $data[$i]->date) $serie['mon'] = $serie['mon'] + $data[$i]->amount;
            elseif (date('Y-m-d', strtotime($firstDay . '+1 day')) == $data[$i]->date) $serie['tue'] = $serie['tue'] + $data[$i]->amount;
            elseif (date('Y-m-d', strtotime($firstDay . '+2 day')) == $data[$i]->date) $serie['wed'] = $serie['wed'] + $data[$i]->amount;
            elseif (date('Y-m-d', strtotime($firstDay . '+3 day')) == $data[$i]->date) $serie['thu'] = $serie['thu'] + $data[$i]->amount;
            elseif (date('Y-m-d', strtotime($firstDay . '+4 day')) == $data[$i]->date) $serie['fri'] = $serie['fri'] + $data[$i]->amount;
            elseif (date('Y-m-d', strtotime($firstDay . '+5 day')) == $data[$i]->date) $serie['sat'] = $serie['sat'] + $data[$i]->amount;
            elseif (date('Y-m-d', strtotime($firstDay . '+6 day')) == $data[$i]->date) $serie['sun'] = $serie['sun'] + $data[$i]->amount;
        }

        $serie['total'] = $serie['total'] + $serie['mon'] + $serie['tue'] + $serie['wed'] + $serie['thu'] + $serie['fri'] + $serie['sat'] + $serie['sun'];

        return $serie;
    }

    public function chartMont($year)
    {
        $firstDay = date('Y-m-d', strtotime("$year-01-01"));
        $lastDay = date('Y-m-d', strtotime("$year-12-31"));

        $query = $this->db->table('t_basket')
            ->select('
            t_basket.date AS date,
            t_basket_service.amount AS amount,
            t_basket.payType AS payType,
        ')
            ->join('t_basket_service', 't_basket_service.fk_basket = t_basket.id')
            ->where('date >=', $firstDay)
            ->where('date <=', $lastDay)
            ->where('status', 0);

        $data = $query->get()->getResult();
        $countData = sizeof($data);
        $total = 0;

        for ($month = 1; $month <= 12; $month++) {

            $serie[$month] = 0;
            $mont = date("F", mktime(0, 0, 0, $month, 1, $year));
            $daysInMonth = date("t", mktime(0, 0, 0, $month, 1, $year));

            for ($day = 1; $day <= $daysInMonth; $day++) {

                for ($i = 0; $i < $countData; $i++) {
                    if (date('Y-m-d', strtotime($day . '-' . $mont . '-' . $year)) == $data[$i]->date)
                        $serie[$month] = $serie[$month] + $data[$i]->amount;
                }
            }
            $total = $total + $serie[$month];
        }

        $serie['total'] = $total;

        return $serie;
    }

    public function getCollectionReport($dateStart, $dateEnd)
    {
        $query = $this->db->table('t_basket')
            ->select('
            t_basket_service.amount AS amount,
            t_basket.payType AS payType,
        ')
            ->join('t_basket_service', 't_basket_service.fk_basket = t_basket.id')
            ->where('date >=', date("Y-m-d", strtotime($dateStart)))
            ->where('date <=', date("Y-m-d", strtotime($dateEnd)))
            ->where('status', 0);

        $data = $query->get()->getResult();

        $cash = 0;
        $card = 0;

        foreach ($data as $index) {
            if ($index->payType == 1)
                $cash = $cash + $index->amount;
            elseif ($index->payType == 2)
                $card = $card + $index->amount;
        }

        $return = array();
        $return['cash'] = $cash;
        $return['card'] = $card;
        $return['total'] = $card + $cash;

        return $return;
    }

    public function dtReport($dateStart, $dateEnd)
    {
        $query = $this->db->table('t_basket')
            ->select('
            t_basket.date,
            SUM(CASE WHEN t_basket.payType = 1 THEN t_basket_service.amount ELSE 0 END) as cashAmount,
            SUM(CASE WHEN t_basket.payType = 2 THEN t_basket_service.amount ELSE 0 END) as cardAmount,
            SUM(t_basket_service.amount) as totalAmount
        ', false)
            ->join('t_basket_service', 't_basket_service.fk_basket = t_basket.id')
            ->where('date >=', date("Y-m-d", strtotime($dateStart)))
            ->where('date <=', date("Y-m-d", strtotime($dateEnd)))
            ->groupBy('t_basket.date');

        return $query->get()->getResult();
    }

    public function endDay()
    {
        $query = $this->db->table('t_basket')
            ->select('t_basket_service.amount AS amount, t_basket.payType AS payType')
            ->join('t_basket_service', 't_basket_service.fk_basket = t_basket.id')
            ->where('date', date("Y-m-d"))
            ->where('status', 0);

        return $query->get()->getResult();
    }
}
