<?php

namespace App\Controllers;

use App\Models\MainModel;
use App\Models\ReportModel;
use App\Models\DataTablesModel;

class Admin extends BaseController
{
    protected $objSession;
    protected $objMainModel;
    protected $objReportModel;
    protected $objDataTablesModel;
    protected $objEmail;
    protected $objRequest;

    function  __construct()
    {
        $this->objSession = session();
        $this->objMainModel = new MainModel;
        $this->objReportModel = new ReportModel;
        $this->objDataTablesModel = new DataTablesModel;

        $emailConfig = array();
        $emailConfig['protocol'] = EMAIL_PROTOCOL;
        $emailConfig['SMTPHost'] = EMAIL_SMTP_HOST;
        $emailConfig['SMTPUser'] = EMAIL_SMTP_USER;
        $emailConfig['SMTPPass'] = EMAIL_SMTP_PASSWORD;
        $emailConfig['SMTPPort'] = EMAIL_SMTP_PORT;
        $emailConfig['SMTPCrypto'] = EMAIL_SMTP_CRYPTO;
        $emailConfig['mailType'] = EMAIL_MAIL_TYPE;

        $this->objEmail = \Config\Services::email($emailConfig);
        $this->objRequest = \Config\Services::request();
    }

    public function index()
    {
        if (empty($this->objSession->get('user')['role']))
            return view('admin/sessionExpired');

        $data = array();
        $data['title'] = 'Administración';
        $data['page'] = 'admin/controlPanel';

        return view('main', $data);
    }

    public function updateProfile()
    {
        if (empty($this->objSession->get('user')['role'])) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';

            return json_encode($result);
        }

        $data = array();
        $data['companyName'] = htmlspecialchars(trim($this->objRequest->getPost('companyName')));
        $data['cif'] = htmlspecialchars(trim($this->objRequest->getPost('cif')));
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['lastName'] = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $data['profession'] = htmlspecialchars(trim($this->objRequest->getPost('profession')));
        $data['phone'] = htmlspecialchars(trim($this->objRequest->getPost('phone')));
        $data['phone2'] = htmlspecialchars(trim($this->objRequest->getPost('phone2')));
        $data['email'] = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $data['bussinessAddress'] = htmlspecialchars(trim($this->objRequest->getPost('bussinessAddress')));
        $data['bussinessAddress2'] = htmlspecialchars(trim($this->objRequest->getPost('bussinessAddress2')));
        $data['bussinessCity'] = htmlspecialchars(trim($this->objRequest->getPost('bussinessCity')));
        $data['bussinessState'] = htmlspecialchars(trim($this->objRequest->getPost('bussinessState')));
        $data['bussinessPostalCode'] = htmlspecialchars(trim($this->objRequest->getPost('bussinessPostalCode')));
        $data['bussinessCountry'] = htmlspecialchars(trim($this->objRequest->getPost('bussinessCountry')));
        $data['facebookLink'] = htmlspecialchars(trim($this->objRequest->getPost('facebook')));
        $data['instagramLink'] = htmlspecialchars(trim($this->objRequest->getPost('instagram')));

        $result = $this->objMainModel->objUpdate('t_config', $data, 1);

        return json_encode($result);
    }

    public function updateScheduleBussinessDay()
    {
        if (empty($this->objSession->get('user')['role'])) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';

            return json_encode($result);
        }

        $field = $this->objRequest->getPost('field');
        $value = $this->objRequest->getPost('value');

        $data = array();
        $data[$field] = $value;

        $result = $this->objMainModel->objUpdate('t_config', $data, 1);

        return json_encode($result);
    }

    public function setSchedule()
    {
        if (empty($this->objSession->get('user')['role'])) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';

            return json_encode($result);
        }

        $field1 = $this->objRequest->getPost('field1');
        $value1 = htmlspecialchars(trim(date('H:i:s', strtotime($this->objRequest->getPost('value1')))));

        $field2 = $this->objRequest->getPost('field2');
        $value2 = htmlspecialchars(trim(date('H:i:s', strtotime($this->objRequest->getPost('value2')))));

        $field3 = $this->objRequest->getPost('field3');
        if (empty($this->objRequest->getPost('value3')))
            $value3 = NULL;
        else
            $value3 = htmlspecialchars(trim(date('H:i:s', strtotime($this->objRequest->getPost('value3')))));

        $field4 = $this->objRequest->getPost('field4');
        if (empty($this->objRequest->getPost('value4')))
            $value4 = NULL;
        else
            $value4 = htmlspecialchars(trim(date('H:i:s', strtotime($this->objRequest->getPost('value4')))));

        $data = array();
        $data[$field1] = $value1;
        $data[$field2] = $value2;
        $data[$field3] = $value3;
        $data[$field4] = $value4;

        $result = $this->objMainModel->objUpdate('t_config', $data, 1);

        return json_encode($result);
    }

    public function changePassword()
    {
        if (empty($this->objSession->get('user')))
            return view('errorPage/sessionExpired');

        return view('admin/changePassword');
    }

    public function changePasswordProcess()
    {
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $data = array();
        $data['password'] = htmlspecialchars(trim(password_hash($this->objRequest->getPost('pass'), PASSWORD_DEFAULT)));

        $result = $this->objMainModel->objUpdate('t_config', $data, 1);

        return json_encode($result);
    }

    public function getServices()
    {
        $data = array();
        $data['services'] = $this->objMainModel->objData('t_service');

        return view('admin/mainServices', $data);
    }

    public function modalService()
    {
        if (empty($this->objSession->get('user')['role']))
            return view('admin/sessionExpired');

        $action = $this->objRequest->getPost('action');
        $data = array();
        $data['action'] = $action;

        if ($action == 'create')
            $data['modalTitle'] = 'Nuevo Servicio';
        else {
            $data['modalTitle'] = 'Actualizando Servicio';
            $data['id'] = $this->objRequest->getPost('id');
            $data['service'] = $this->objMainModel->objData('t_service', 'id', $data['id'])[0];
        }

        return view('admin/createService', $data);
    }

    public function manageService()
    {
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $data = array();
        $data['title'] = htmlspecialchars(trim($this->objRequest->getPost('title')));
        $data['price'] = htmlspecialchars(trim($this->objRequest->getPost('price')));
        $data['description'] = htmlspecialchars(trim($this->objRequest->getPost('description')));

        if ($this->objRequest->getPost('action') == 'create')
            $result = $this->objMainModel->objCreate('t_service', $data);
        else
            $result = $this->objMainModel->objUpdate('t_service', $data, $this->objRequest->getPost('id'));

        return json_encode($result);
    }

    public function uploadPhoto()
    {
        return json_encode($this->objMainModel->uploadFile('t_config', 1, 'avatar', $_FILES['file']));
    }

    public function deleteService()
    {
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $result = $this->objMainModel->objData('t_basket_service', 'fk_service', $this->objRequest->getPost('id'));

        if (empty($result)) {
            return json_encode($this->objMainModel->objDelete('t_service', $this->objRequest->getPost('id')));
        } else {
            $result = array();
            $result['error'] = 3;
            return json_encode($result);
        }
    }

    public function calendar()
    {
        if (empty($this->objSession->get('user')))
            return view('errorPage/sessionExpired');

        $config = $this->objMainModel->objData('t_config', 'id', 1)[0];
        $hiddenDays = array();

        if (empty($config->monday))
            $hiddenDays[] = 1;

        if (empty($config->tuesday))
            $hiddenDays[] = 2;

        if (empty($config->wednesday))
            $hiddenDays[] = 3;

        if (empty($config->thursday))
            $hiddenDays[] = 4;

        if (empty($config->friday))
            $hiddenDays[] = 5;

        if (empty($config->saturday))
            $hiddenDays[] = 6;

        if (empty($config->sunday))
            $hiddenDays[] = 0;

        $date = $this->objRequest->getPost('date');
        $getEvents = $this->objMainModel->getEvents($date, null);

        $data = array();
        $data['events'] = $getEvents;
        $data['hiddenDays'] = $hiddenDays;

        return view('customer/mainCalendar', $data);
    }

    public function getCustomerDT()
    {
        if (empty($this->objSession->get('user')))
            return view('errorPage/sessionExpired');

        $data = array();
        $data['customers'] = $this->objMainModel->objData('t_customer');

        return view('admin/dtCustomers', $data);
    }

    public function updateCustomerStatus()
    {
        return json_encode($this->objMainModel->objUpdate('t_customer', ['status' => $this->objRequest->getPost('status')], $this->objRequest->getPost('id')));
    }

    public function getTabContent()
    {
        if (empty($this->objSession->get('user')))
            return view('errorPage/sessionExpired');

        $tab = $this->objRequest->getPost('tab');

        switch ($tab) {
            case 'profile':
                $data = array();
                $data['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
                return view('admin/tabProfile', $data);
                break;
            case 'schedule':
                $data = array();
                $data['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
                return view('admin/tabSchedule', $data);
                break;
            case 'services':
                return view('admin/tabServices');
                break;
            case 'appointments':
                $data = array();
                $data['initialDate'] = date('Y-m-d');
                return view('admin/tabAppointments', $data);
                break;
            case 'customers':
                return view('admin/tabCustomers');
                break;
            case 'tpv':
                $data = array();
                $data['services'] = $this->objMainModel->objData('t_service');
                $basket = $this->objMainModel->objData('t_basket', 'status', 1);
                if (empty($basket)) {
                    $insert = array();
                    $insert['status'] = 1;
                    $result = $this->objMainModel->objCreate('t_basket', $insert);
                    $data['basketID'] = $result['id'];
                } else
                    $data['basketID'] = $basket[0]->id;
                $data['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
                return view('admin/tabTpv', $data);
                break;
            case 'statistics':
                return view('admin/tabStatistics');
                break;
            case 'report':
                return view('admin/tabReport');
                break;
        }
    }

    public function newCustomer()
    {
        if (empty($this->objSession->get('user')))
            return view('errorPage/sessionExpired');

        return view('admin/createCustomer');
    }

    public function signupProcess()
    {
        $email = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $checkDuplicate = $this->objMainModel->objcheckDuplicate('t_customer', 'email', $email, '');

        if (empty($checkDuplicate)) {
            $data = array();
            $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
            $data['lastName'] = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
            $data['email'] = $email;
            $data['password'] = htmlspecialchars(trim(password_hash($this->objRequest->getPost('pass'), PASSWORD_DEFAULT)));
            $data['term'] = $this->objRequest->getPost('term');
            $data['token'] = md5(uniqid());

            $this->objMainModel->objCreate('t_customer', $data);

            $emailData = array();
            $emailData['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
            $emailData['url'] = base_url('Home/confirmSignup') . '?token=' . $data['token'];

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $emailData['config']->companyName);
            $this->objEmail->setTo($email);
            $this->objEmail->setSubject($emailData['config']->companyName);
            $this->objEmail->setMessage(view('email/mailSignup', $emailData));

            if ($this->objEmail->send(false)) {
                $result = array();
                $result['error'] = 0;
                $result['msg'] = 'success';
            } else {
                $result = array();
                $result['error'] = 1;
                $result['msg'] = 'error send email';
            }
        } else {
            $result = array();
            $result['error'] = 100;
            $result['msg'] = 'duplicate email';
        }

        return json_encode($result);
    }

    public function dtBasket()
    {
        $data = array();
        $data['basket'] = $this->objMainModel->dtBasket($this->objRequest->getPost('basketID'));
        return view('admin/mainBasket', $data);
    }

    public function addServiceToBasket()
    {
        $result = $this->objMainModel->objData('t_service', 'id', $this->objRequest->getPost('serviceID'));
        $data = array();
        $data['fk_basket'] = $this->objRequest->getPost('basketID');
        $data['fk_service'] = $this->objRequest->getPost('serviceID');
        $data['amount'] = $result[0]->price;
        $result = $this->objMainModel->objCreate('t_basket_service', $data);
        return json_encode($result);
    }

    public function removeServiceFromBasket()
    {
        return json_encode($this->objMainModel->objDelete('t_basket_service', $this->objRequest->getPost('id')));
    }

    public function modalPayType()
    {
        if (empty($this->objSession->get('user')['role']))
            return view('admin/sessionExpired');

        $data = array();
        $data['basketID'] = $this->objRequest->getPost('basketID');

        return view('admin/modalPayType', $data);
    }

    public function charge()
    {
        $basketID = $this->objRequest->getPost('basketID');
        $payType = $this->objRequest->getPost('payType');

        $data = array();
        $data['status'] = 0;
        $data['dateTime'] = date("Y-m-d H:i:s");
        $data['date'] = date("Y-m-d");
        $data['payType'] = (int) $payType;

        $result = $this->objMainModel->objUpdate('t_basket', $data, $basketID);

        if ($result['error'] == 0) {
            $response['error'] = $result['error'];
            $response['basketID'] = $basketID;
            $response['dateTime'] = $data['dateTime'];
            $response['payType'] = $data['payType'];
            return json_encode($response);
        } else
            return json_encode($result);
    }

    public function printPDF()
    {
        $basketID = $this->objRequest->getPostGet('basketID');
        $config = $this->objMainModel->objData('t_config', 'id', 1)[0];
        $tiketInfo = $this->objMainModel->dtBasket($basketID);
        $basket = $this->objMainModel->objData('t_basket', 'id', $basketID)[0];

        $data = array();
        $data['companyName'] = $config->companyName;
        $data['cif'] = $config->cif;
        $data['bussinessAddress'] = $config->bussinessAddress;
        $data['bussinessAddress2'] = $config->bussinessAddress2;
        $data['bussinessCity'] = $config->bussinessCity;
        $data['bussinessState'] = $config->bussinessState;
        $data['bussinessPostalCode'] = $config->bussinessPostalCode;
        $data['bussinessCountry'] = $config->bussinessCountry;
        $data['date'] = $basket->dateTime;
        $data['tiketInfo'] = array();

        $total = 0;
        $count = sizeof($tiketInfo);

        for ($i = 0; $i < $count; $i++) {
            $item = array();
            $item['title'] = $tiketInfo[$i]->title;
            $item['Precio'] = number_format($tiketInfo[$i]->amount, 2, ".", ',');
            $total = $total + $tiketInfo[$i]->amount;

            $data['tiketInfo'][$i] = $item;
        }

        $data['total'] = number_format($total, 2, ".", ',');

        if ($basket->payType == 1)
            $data['payType'] = 'Efectivo';
        else
            $data['payType'] = 'Tarjeta';

        return view('print/ticket', $data);
    }

    public function printDayEnd()
    {
        $config = $this->objMainModel->objData('t_config', 'id', 1)[0];
        $result = $this->objReportModel->endDay();

        $data = array();
        $data['companyName'] = $config->companyName;
        $data['cif'] = $config->cif;
        $data['dateTime'] = date("Y-m-d H:i:s");
        $data['bussinessAddress'] = $config->bussinessAddress;
        $data['bussinessAddress2'] = $config->bussinessAddress2;
        $data['bussinessCity'] = $config->bussinessCity;
        $data['bussinessState'] = $config->bussinessState;
        $data['bussinessPostalCode'] = $config->bussinessPostalCode;
        $data['bussinessCountry'] = $config->bussinessCountry;
        $data['tickets'] = array();
        $data['totalTickets'] = sizeof($result);

        $index = 1;
        $total = 0;

        foreach ($result as $r) {
            $item = array();
            $item['index'] = $index;
            if ($r->payType == 1)
                $item['payType'] = "Efectivo";
            else
                $item['payType'] = "Tarjeta";

            $item['amount'] = number_format($r->amount, 2, ".", ',');

            $data['tickets'][] = $item;
            $total = $total + $r->amount;
            $index++;
        }

        $data['total'] = number_format($total, 2, ".", ',');;
        return view('print/endDay', $data);
    }

    public function collectionDay()
    {
        $data = array();
        $data['collectionDay'] = $this->objReportModel->collectionDay();
        return view('admin/collectionDay', $data);
    }

    public function chartWeek()
    {
        $data = array();
        $data['chartWeek'] = $this->objReportModel->chartWeek();
        return view('admin/chartWeek', $data);
    }

    public function chartMont()
    {
        if (!empty($this->objRequest->getPostGet('year')))
            $year = $this->objRequest->getPostGet('year');
        else
            $year = date('Y');

        $data = array();
        $data['chartMont'] = $this->objReportModel->chartMont($year);
        $data['year'] = $year;
        $data['currentYear'] = date('Y');

        return view('admin/chartMont', $data);
    }

    public function dtProcessingHistory()
    {
        $dataTableRequest = $_REQUEST;

        $params = array();
        $params['draw'] = $dataTableRequest['draw'];
        $params['start'] = $dataTableRequest['start'];
        $params['length'] = $dataTableRequest['length'];
        $params['search'] = $dataTableRequest['search']['value'];
        $params['sortColumn'] = $dataTableRequest['order'][0]['column'];
        $params['sortDir'] = $dataTableRequest['order'][0]['dir'];

        $row = array();
        $totalRecords = 0;

        $result = $this->objDataTablesModel->dtHistory($params);

        $totalRows = sizeof($result);

        for ($i = 0; $i < $totalRows; $i++) {
            $payType = '';

            if ($result[$i]->payType == 1)
                $payType = '<span class="badge badge-soft-success">Efectivo</span>';
            elseif ($result[$i]->payType == 2)
                $payType = '<span class="badge badge-soft-primary">Tarjeta</span>';

            $btnPrint = '<button type="button" class="btn-print btn btn-sm btn-secondary" data-id="' . $result[$i]->basketID . '">Imprimir</button>';
            $btnDelete = '<button type="button" class="btn-del btn btn-sm btn-danger" data-id="' . $result[$i]->basketID . '">Eliminar</button>';

            $col = array();
            $col['id'] = $result[$i]->basketID;
            $col['date'] = $result[$i]->date;
            $col['articles'] = $result[$i]->articles;
            $col['payType'] = $payType;
            $col['amount'] = '€ ' . number_format($result[$i]->amount, 2, ".", ',');
            $col['action'] = $btnPrint . ' ' . $btnDelete;

            $row[$i] =  $col;
        }

        if ($totalRows > 0) {
            if (empty($params['search']))
                $totalRecords = $this->objDataTablesModel->getTotalHistory();
            else
                $totalRecords = $totalRows;
        }

        $data = array();
        $data['draw'] = $dataTableRequest['draw'];
        $data['recordsTotal'] = intval($totalRecords);
        $data['recordsFiltered'] = intval($totalRecords);
        $data['data'] = $row;

        return json_encode($data);
    }

    public function deleteBasket()
    {
        $basketID = $this->objRequest->getPost('basketID');

        $this->objMainModel->deleteShopBasketService($basketID);
        $result = $this->objMainModel->objDelete('t_basket', $basketID);

        return json_encode($result);
    }

    public function returnReportContent()
    {
        $data = array();
        $data['dateStart'] = $this->objRequest->getPost('dateStart');
        $data['dateEnd'] = $this->objRequest->getPost('dateEnd');

        return view('report/content', $data);
    }

    public function getCollectionReport()
    {
        $dateStart = $this->objRequest->getPost('dateStart');
        $dateEnd = $this->objRequest->getPost('dateEnd');

        $result = $this->objReportModel->getCollectionReport($dateStart, $dateEnd);

        $data = array();
        $data['collectionDay'] = $result;

        return view('report/collection', $data);
    }

    public function dtReport()
    {
        $dateStart = $this->objRequest->getPost('dateStart');
        $dateEnd = $this->objRequest->getPost('dateEnd');
        $results = $this->objReportModel->dtReport($dateStart, $dateEnd);
        $rows = array();

        foreach ($results as $result) {
            $col = array();
            $col['date'] =  '<h5>' . date('d/m/Y', strtotime($result->date)) . '</h5>';
            $col['cash'] = '€ ' . number_format($result->cashAmount, 2, ".", ',');
            $col['card'] = '€ ' . number_format($result->cardAmount, 2, ".", ',');
            $col['total'] = '€ ' . number_format($result->totalAmount, 2, ".", ',');

            $rows[] = $col;
        }

        $data = array();
        $data['dtReport'] = $rows;

        return view('report/dtReport', $data);
    }
}
