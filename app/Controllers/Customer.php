<?php

namespace App\Controllers;

use App\Models\MainModel;

class Customer extends BaseController
{
    protected $objSession;
    protected $objMainModel;
    protected $objEmail;
    protected $objRequest;

    function  __construct()
    {
        $this->objSession = session();
        $this->objMainModel = new MainModel;

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
        if (empty($this->objSession->get('user'))) 
            return view('errorPage/sessionExpired');
        
        $data = array();
        $data['customer'] = $this->objMainModel->objData('t_customer', 'id', $this->objSession->get('user')->id)[0];
        $data['initialDate'] = date('Y-m-d');
        $data['title'] = 'Inicio';
        $data['page'] = 'customer/mainCustomer';

        return view('main', $data);
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

        $customerID = $this->objSession->get('user')->id;
        $date = $this->objRequest->getPost('date');
        $getEvents = $this->objMainModel->getEvents($customerID, $date);

        $data = array();
        $data['events'] = $getEvents;
        $data['hiddenDays'] = $hiddenDays;

        return view('customer/mainCalendar', $data);
    }

    public function createAppointment()
    {
        if (empty($this->objSession->get('user')))
            return view('errorPage/sessionExpired');
        
        $admin = 0;

        if (empty($this->objSession->get('user')->id))
            $admin = 1;

        $data = array();
        $data['dateSelected'] = $this->objRequest->getPost('date');
        $data['dateFormat'] = $this->dateFormat($this->objRequest->getPost('date'));
        $data['services'] = $this->objMainModel->objData('t_service');
        $data['admin'] = $admin;

        if (!empty($data['admin']))
            $data['customers'] = $this->objMainModel->getActiveCustomers();

        return view('modals/createAppointment', $data);
    }

    public function getFreeAppointments()
    {
        if (empty($this->objSession->get('user'))) 
            return view('errorPage/sessionExpired');
        
        $date = $this->objRequest->getPost('date');

        $data = array();
        $data['date'] = $date;
        $data['appointments'] = $this->objMainModel->objData('t_appointment', 'date', $date);
        $data['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];

        return view('customer/mainFreeAppointments', $data);
    }

    public function createAppointmentProcess()
    {
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';

            return json_encode($result);
        }

        if (empty($this->objRequest->getPost('customerID'))) 
            $customerID = $this->objSession->get('user')->id;
        else
            $customerID = $this->objRequest->getPost('customerID'); 

        $date = $this->objRequest->getPost('date');
        $time = $this->objRequest->getPost('time');

        $checkAppointment = $this->objMainModel->checkAppointment(date('Y-m-d', strtotime($date)), date('H:i:s', strtotime($time)));

        if (empty($checkAppointment)) {

            $data = array();
            $data['customerID'] = $customerID;
            $data['date'] = date('Y-m-d', strtotime($date));
            $data['time'] = date('H:i:s', strtotime($time));
            $data['description'] = htmlspecialchars(trim($this->objRequest->getPost('description')));
            $data['service'] = '';

            if (!empty($this->objRequest->getPost('service')))
                $data['service'] = $this->objMainModel->objData('t_service', 'id', $this->objRequest->getPost('service'))[0]->title;

            $result = $this->objMainModel->objCreate('t_appointment', $data);
            $config = $this->objMainModel->objData('t_config', 'id', 1)[0];
            $customer = $this->objMainModel->objData('t_customer', 'id', $customerID)[0];

            $setTo = array();
            $setTo[] = $config->email;

            if ($customer->emailVerified == 1 && $customer->emailSubscription == 1)
                $setTo[] = $customer->email;

            $emailData = array();
            $emailData['companyName'] = $config->companyName;
            $emailData['customer'] = $customer;
            $emailData['date'] = $this->objRequest->getPost('dateFormated') . ' a las ' . date('g:i a', strtotime($time));
            $emailData['service'] = $data['service'];
            $emailData['description'] = $data['description'];

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $config->companyName);
            $this->objEmail->setTo($setTo);
            $this->objEmail->setSubject($config->companyName);
            $this->objEmail->setMessage(view('email/newAppointment', $emailData));
            $this->objEmail->send();

            return json_encode($result);
        }
    }

    public function removeAppointment()
    {
        if (empty($this->objSession->get('user'))) 
            return view('errorPage/sessionExpired');

        $appointment = $this->objMainModel->objData('t_appointment', 'id', $this->objRequest->getPost('id'))[0];

        if (strtotime(date('Y-m-d H:i:s')) < strtotime($appointment->date . ' ' . $appointment->time)) {
            $data = array();
            $data['appointmentID'] = $this->objRequest->getPost('id');

            if (!empty($this->objSession->get('user')->id))
                $data['customer'] = true;

            return view('modals/removeAppointment', $data);
        } else
            return view('customer/alertNoCancelAppointment');
    }

    public function removeAppointmentProcess()
    {
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';

            return json_encode($result);
        }

        $appointment = $this->objMainModel->objData('t_appointment', 'id', $this->objRequest->getPost('id'))[0];
        $config = $this->objMainModel->objData('t_config', 'id', 1)[0];
        $customer = $this->objMainModel->objData('t_customer', 'id', $appointment->customerID)[0];

        $setTo = array();
        $setTo[] = $config->email;

        if ($customer->emailVerified == 1 && $customer->emailSubscription == 1)
            $setTo[] = $customer->email;

        $emailData = array();
        $emailData['companyName'] = $config->companyName;
        $emailData['customer'] = $customer;
        $emailData['date'] = $this->dateFormat($appointment->date) . ' a las ' . date('g:i a', strtotime($appointment->time));
        $emailData['service'] = $appointment->service;
        $emailData['description'] = $appointment->service;
        $emailData['note'] = htmlspecialchars(trim($this->objRequest->getPost('note')));

        $this->objEmail->setFrom(EMAIL_SMTP_USER, $config->companyName);
        $this->objEmail->setTo($setTo);
        $this->objEmail->setSubject($config->companyName);
        $this->objEmail->setMessage(view('email/cancelAppointment', $emailData));
        $this->objEmail->send();

        $result = $this->objMainModel->objDelete('t_appointment', $this->objRequest->getPost('id'));

        return json_encode($result);
    }

    public function changePassword()
    {
        if (empty($this->objSession->get('user'))) 
            return view('errorPage/sessionExpired');
        
        return view('modals/changePassword');
    }

    public function changePasswordProcess()
    {
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';

            return json_encode($result);
        }

        $customerID = $this->objSession->get('user')->id;

        $data = array();
        $data['password'] = htmlspecialchars(trim(password_hash($this->objRequest->getPost('pass'), PASSWORD_DEFAULT)));

        $result = $this->objMainModel->objUpdate('t_customer', $data, $customerID);

        return json_encode($result);
    }

    public function dateFormat($date)
    {
        $day = date('l', strtotime($date));

        if ($day == 'Monday') $day = 'Lunes';
        if ($day == 'Tuesday') $day = 'Martes';
        if ($day == 'Wednesday') $day = 'Miércoles';
        if ($day == 'Thursday') $day = 'Jueves';
        if ($day == 'Friday') $day = 'Viernes';
        if ($day == 'Saturday') $day = 'Sábado';
        if ($day == 'Sunday') $day = 'Domingo';

        $mont = date('m', strtotime($date));

        if ($mont == '01') $mont = 'Enero';
        if ($mont == '02') $mont = 'Febrero';
        if ($mont == '03') $mont = 'Marzo';
        if ($mont == '04') $mont = 'Abril';
        if ($mont == '05') $mont = 'Mayo';
        if ($mont == '06') $mont = 'Junio';
        if ($mont == '07') $mont = 'Julio';
        if ($mont == '08') $mont = 'Agosto';
        if ($mont == '09') $mont = 'Septiembre';
        if ($mont == '10') $mont = 'Octubre';
        if ($mont == '11') $mont = 'Noviembre';
        if ($mont == '12') $mont = 'Diciembre';

        return $day . ' ' . date('d', strtotime($date)) . ' de ' . $mont . ' del ' . date('Y', strtotime($date));
    }

    public function getMainCustomerAppointments()
    {
        $customerID = $this->objSession->get('user')->id;
        $result = $this->objMainModel->getMainCustomerAppointments($customerID);
        $appointments = array();

        foreach ($result as $appointment) {
            if (strtotime(date('Y-m-d H:i:s')) < strtotime($appointment->date . ' ' . $appointment->time)) {
                $record = array();
                $record['id'] = $appointment->id;
                $record['date'] = $this->dateFormat($appointment->date);
                $record['time'] = date('g:i a', strtotime($appointment->time));
                $appointments[] = $record;
            }
        }

        $data = array();
        $data['appointments'] = $appointments;

        return view('customer/mainAppointments', $data);
    }

    public function editProfile()
    {
        if (empty($this->objSession->get('user'))) 
            return view('errorPage/sessionExpired');

        $data = array();
        $data['customer'] = $this->objMainModel->objData('t_customer', 'id', $this->objRequest->getPost('customerID'))[0];
        $data['admin'] = $this->objRequest->getPost('admin');

        return view('modals/editProfile', $data);
    }

    public function editProfileProcess()
    {
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';

            return json_encode($result);
        }

        $data = array();
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['lastName'] = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $data['email'] = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $data['phone'] = htmlspecialchars(trim($this->objRequest->getPost('phone')));

        $checkDuplicate = $this->objMainModel->objcheckDuplicate('t_customer', 'email', $data['email'], $this->objRequest->getPost('customerID'));

        if (empty($checkDuplicate))
            $result = $this->objMainModel->objUpdate('t_customer', $data, $this->objRequest->getPost('customerID'));
        else {
            $result = array();
            $result['error'] = 3;
            $result['msg'] = 'duplicate record';
        }

        return json_encode($result);
    }

    public function sendEmailConfirmation()
    {
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $data = array();
        $data['token'] = md5(uniqid());

        $this->objMainModel->objUpdate('t_customer', $data, $this->objRequest->getPost('customerID'));

        $emailData = array();
        $customer = $this->objMainModel->objData('t_customer', 'id', $this->objRequest->getPost('customerID'))[0];
        $emailData['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
        $emailData['url'] = base_url('Home/confirmSignup') . '?token=' . $data['token'];

        $this->objEmail->setFrom(EMAIL_SMTP_USER, $emailData['config']->companyName);
        $this->objEmail->setTo($customer->email);
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

        return json_encode($result);
    }

    public function updateEmailSubscription()
    {
        if (empty($this->objSession->get('user'))) {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = 'session expired';
            return json_encode($result);
        }

        $data = array();
        $data['emailSubscription'] = $this->objRequest->getPost('emailSubscription');

        return json_encode($this->objMainModel->objUpdate('t_customer', $data, $this->objRequest->getPost('customerID')));
    }

    public function deleteProfile()
    {
        return json_encode($this->objMainModel->deleteCustomerProfile($this->objSession->get('user')->id));
    }
}
