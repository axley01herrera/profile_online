<?php

namespace App\Models;

use CodeIgniter\Model;

class MainModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function objCreate($table, $data)
    {
        $this->db->table($table)
            ->insert($data);

        $result = array();
        if ($this->db->resultID) {
            $result['error'] = 0;
            $result['id'] = $this->db->connID->insert_id;
        } else
            $result['error'] = 1;

        return $result;
    }

    public function objUpdate($table, $data, $id)
    {
        $query = $this->db->table($table)
            ->where('id', $id)
            ->update($data);

        $result = array();

        if ($query == true) {
            $result['error'] = 0;
            $result['id'] = $id;
        } else
            $result['error'] = 1;

        return $result;
    }

    public function objDelete($table, $id)
    {
        $return = array();

        $query = $this->db->table($table)
            ->where('id', $id)
            ->delete();

        if ($query == true) {
            $return['error'] = 0;
            $return['msg'] = 'success';
        } else {
            $return['error'] = 0;
            $return['msg'] = 'error on delete record';
        }

        return $return;
    }

    public function objData($table, $field = null, $value = null)
    {
        $query = $this->db->table($table);

        if (!empty($field))
            $query->where($field, $value);

        return $query->get()->getResult();
    }

    public function objcheckDuplicate($table, $field, $value, $id = null)
    {
        $query = $this->db->table($table)
            ->where($field, $value);

        if (!empty($id))
            $query->whereNotIn('id', [0 => $id]);

        return $query->get()->getResult();
    }

    public function uploadFile($table, $id, $field, $file)
    {
        $fileContent = file_get_contents($file['tmp_name']);

        $data = array(
            $field => $fileContent
        );

        $query = $this->db->table($table)
            ->where('id', $id)
            ->update($data);

        $result = array();

        if ($query == true) {
            $result['error'] = 0;
            $result['msg'] = 'success';
        } else {
            $result['error'] = 1;
            $result['msg'] = 'fail upload file';
        }

        return $result;
    }

    public function objVerifyCredentials($email, $password)
    {
        $query = $this->db->table('t_customer')
            ->where('email', $email);

        $data = $query->get()->getResult();

        if (!empty($data)) {
            if ($data[0]->status == 1) {
                if (password_verify($password, $data[0]->password)) {
                    $result = array();
                    $result['error'] = 0;
                    $result['msg'] = 'success';
                    $result['data'] = $data;
                } else {
                    $result['error'] = 1;
                    $result['msg'] = 'invalid password';
                }
            } else {
                $result = array();
                $result['error'] = 403;
                $result['msg'] = 'user disabled';
            }
        } else {
            $result = array();
            $result['error'] = 500;
            $result['msg'] = 'email not found';
        }

        return $result;
    }

    public function objLoginAdmin($password)
    {
        $query = $this->db->table('t_config')
            ->select('password')
            ->where('id', 1);

        $data = $query->get()->getResult();

        if (password_verify($password, $data[0]->password)) {
            $result = array();
            $result['error'] = 0;
            $result['msg'] = 'success';
            $result['data'][0]['role'] = 'admin';
        } else {
            $result['error'] = 1;
            $result['msg'] = 'invalid password';
        }

        return $result;
    }

    public function getEvents($customerID = null, $date)
    {
        $start = date('Y-m-d', strtotime($date . "-90 days"));
        $end = date('Y-m-d', strtotime($date . "+90 days"));

        $query = $this->db->table('t_appointment')
            ->select('name as title, t_appointment.id as id, customerID, date, time, service, description')
            ->join('t_customer', 't_customer.id = t_appointment.customerID')
            ->where('date >=', $start)
            ->where('date <=', $end);

        if (!empty($customerID))
            $query->where('customerID', $customerID);

        $data = $query->get()->getResult();
        $countData = sizeof($data);

        $events = array();

        for ($i = 0; $i < $countData; $i++) {
            $events[$i]['id'] = $data[$i]->id;
            $events[$i]['title'] = $data[$i]->title . ' ' . date('g:i a', strtotime($data[$i]->time));
            $events[$i]['start'] = $data[$i]->date . 'T' . $data[$i]->time;
            $events[$i]['end'] = $data[$i]->date . 'T' . $data[$i]->time;
            if (!empty($data[$i]->service))
                $events[$i]['service'] = $data[$i]->service;
            else
                $events[$i]['service'] = 'No seleccionado';
            if (!empty($data[$i]->description))
                $events[$i]['description'] = $data[$i]->description;
            else
                $events[$i]['description'] = 'Sin descripción';
        }

        return $events;
    }

    public function getMainCustomerAppointments($customerID)
    {

        $query = $this->db->table('t_appointment')
            ->select('name as title, t_appointment.id as id, customerID, date, time, service, description')
            ->join('t_customer', 't_customer.id = t_appointment.customerID')
            ->where('date >=', date('Y-m-d'))
            ->where('customerID', $customerID);

        return $query->get()->getResult();
    }

    public function checkAppointment($date, $time)
    {
        $query = $this->db->table('t_appointment')
            ->where('date', $date)
            ->where('time', $time);

        return $query->get()->getResult();
    }

    public function getActiveCustomers()
    {
        $query = $this->db->table('t_customer')
            ->where('status', 1);

        return $query->get()->getResult();
    }

    public function deleteCustomerProfile($id)
    {
        $this->db->table('t_appointment')
            ->where('customerID', $id)
            ->delete();

        $this->db->table('t_customer')
            ->where('id', $id)
            ->delete();

        $result = array();
        $result['error'] = 0;
        $result['msg'] = 'success';

        return $result;
    }

    public function dtBasket($basketID)
    {
        $query = $this->db->table('t_basket_service tbs')
            ->select('tbs.id AS id, tbs.amount AS amount,ts.title AS title')
            ->join('t_service ts', 'ts.id = tbs.fk_service')
            ->where('fk_basket', $basketID);

        return $query->get()->getResult();
    }

    public function deleteShopBasketService($basketID)
    {
        $query = $this->db->table('t_basket_service')
            ->where('fk_basket', $basketID)
            ->delete();

        if ($query == true) {
            $return['error'] = 0;
            $return['msg'] = 'success';
        } else {
            $return['error'] = 0;
            $return['msg'] = 'error on delete record';
        }

        return $return;
    }
}
