<?php

namespace App\Controllers;

use App\Models\MainModel;

class Home extends BaseController
{
    protected $objSession;
    protected $objMainModel;
    protected $objEmail;
    protected $objRequest;

    function  __construct()
    {
        $this->objSession = session();
        $this->objSession->set('user', []);
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
        $data = array();
        $data['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
        $data['confirmation'] = $this->objRequest->getPostGet('confirmation');
        $data['sessionExpired'] = $this->objRequest->getPostGet('sessionExpired');
        $data['services'] = $this->objMainModel->objData('t_service');
        $data['title'] = 'Inicio';
        $data['page'] = 'home/mainHome';

        return view('main', $data);
    }

    public function signup()
    {
        $data = array();
        $data['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
        $data['title'] = 'Registro';
        $data['page'] = 'signup/mainSignup';

        return view('main', $data);
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

    public function confirmSignup()
    {
        $token = $this->objRequest->getPostGet('token');

        if (empty($token))
            return view('errorPage/emptyToken');

        $result = $this->objMainModel->objData('t_customer', 'token', $token);

        if (!empty($result)) {
            $data = array();
            $data['emailVerified'] = 1;
            $data['token'] = '';
            $this->objMainModel->objUpdate('t_customer', $data, $result[0]->id);
            return redirect()->to(base_url('Home/index?confirmation=true'));
        } else
            return view('errorPage/tokenExpired');
    }

    public function showTerms()
    {
        return view('modals/modalTerm');
    }

    public function login()
    {
        $data = array();
        $data['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
        $data['title'] = 'Inicio de Sesión';
        $data['page'] = 'login/mainLogin';

        return view('main', $data);
    }

    public function verifyCredentials()
    {
        $email = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $pass = htmlspecialchars(trim($this->objRequest->getPost('pass')));

        $result = $this->objMainModel->objVerifyCredentials($email, $pass);

        if ($result['error'] == 0) {
            $this->objSession->set('user', $result['data'][0]);
        }

        return json_encode($result);
    }

    public function forgotPassword()
    {
        $data = array();
        $data['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
        $data['title'] = 'Recuperar Contraseña';
        $data['page'] = 'forgotPassword/mainForgotPassword';

        return view('main', $data);
    }

    public function sendRecoverPasswordEmail()
    {
        $email = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $checkEmail = $this->objMainModel->objData('t_customer', 'email', $email);

        if (!empty($checkEmail)) {

            $data = array();
            $data['token'] = md5(uniqid());

            $this->objMainModel->objUpdate('t_customer', $data, $checkEmail[0]->id);

            $emailData = array();
            $emailData['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
            $emailData['url'] = base_url('Home/newPassword') . '?token=' . $data['token'];

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $emailData['config']->companyName);
            $this->objEmail->setTo($email);
            $this->objEmail->setSubject($emailData['config']->companyName);
            $this->objEmail->setMessage(view('email/mailRecoverPassword', $emailData));

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
            $result['error'] = 500;
            $result['msg'] = 'email not found';
        }

        return json_encode($result);
    }

    public function newPassword()
    {
        $token = $this->objRequest->getPostGet('token');

        if (empty($token))
            return view('errorPage/emptyToken');

        $result = $this->objMainModel->objData('t_customer', 'token', $token);

        if (!empty($result)) {
            $data = array();
            $data['token'] = '';

            $this->objMainModel->objUpdate('t_customer', $data, $result[0]->id);

            $data = array();
            $data['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
            $data['customer'] = $result[0];
            $data['title'] = 'Nueva Contraseña';
            $data['page'] = 'forgotPassword/mainNewPassword';

            return view('main', $data);
        } else
            return view('errorPage/tokenExpired');
    }

    public function setNewPassword()
    {
        $data = array();
        $data['password'] = htmlspecialchars(trim(password_hash($this->objRequest->getPost('pass'), PASSWORD_DEFAULT)));

        $this->objMainModel->objUpdate('t_customer', $data, $this->objRequest->getPost('customer_id'));

        $result = array();
        $result['error'] = 0;
        $result['msg'] = 'success';

        return json_encode($result);
    }

    public function loginAdmin()
    {
        $data = array();
        $data['config'] = $this->objMainModel->objData('t_config', 'id', 1)[0];
        $data['sessionExpired'] = $this->objRequest->getPostGet('sessionExpired');
        $data['title'] = 'Administración';
        $data['page'] = 'admin/login';

        return view('main', $data);
    }

    public function loginProcess()
    {
        $pass = htmlspecialchars(trim($this->objRequest->getPost('pass')));
        $result = $this->objMainModel->objLoginAdmin($pass);

        if ($result['error'] == 0) {
            $this->objSession->set('user', $result['data'][0]);
        }

        return json_encode($result);
    }

    public function showServiceDescription()
    {
        $data = array();
        $data['service'] = $this->objMainModel->objData('t_service', 'id', $this->objRequest->getPost('id'))[0];

        return view('modals/serviceDetail', $data);
    }
}
