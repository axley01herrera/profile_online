<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('Home/index', 'Home::index');
$routes->get('Home', 'Home::index');
$routes->get('Home/signup', 'Home::signup');
$routes->post('Home/showTerms', 'Home::showTerms');
$routes->get('Home/loginAdmin', 'Home::loginAdmin');
$routes->post('Home/loginProcess', 'Home::loginProcess');
$routes->post('Home/showServiceDescription', 'Home::showServiceDescription');
$routes->post('Home/signupProcess', 'Home::signupProcess');
$routes->get('Home/login', 'Home::login');
$routes->post('Home/verifyCredentials', 'Home::verifyCredentials');
$routes->get('Home/confirmSignup', 'Home::confirmSignup');
$routes->get('Home/forgotPassword', 'Home::forgotPassword');
$routes->post('Home/sendRecoverPasswordEmail', 'Home::sendRecoverPasswordEmail');
$routes->get('Home/newPassword', 'Home::newPassword');
$routes->post('Home/setNewPassword', 'Home::setNewPassword');

$routes->get('Admin', 'Admin::index');
$routes->post('Admin/getTabContent', 'Admin::getTabContent');
$routes->post('Admin/dtBasket', 'Admin::dtBasket');
$routes->post('Admin/collectionDay', 'Admin::collectionDay');
$routes->post('Admin/chartMont', 'Admin::chartMont');
$routes->post('Admin/addServiceToBasket', 'Admin::addServiceToBasket');
$routes->post('Admin/removeServiceFromBasket', 'Admin::removeServiceFromBasket');
$routes->post('Admin/modalPayType', 'Admin::modalPayType');
$routes->post('Admin/charge', 'Admin::charge');
$routes->get('Admin/printPDF', 'Admin::printPDF');
$routes->get('Admin/printDayEnd', 'Admin::printDayEnd');
$routes->post('Admin/chartWeek', 'Admin::chartWeek');
$routes->post('Admin/dtProcessingHistory', 'Admin::dtProcessingHistory');
$routes->post('Admin/deleteBasket', 'Admin::deleteBasket');
$routes->post('Admin/calendar', 'Admin::calendar');
$routes->post('Admin/getServices', 'Admin::getServices');
$routes->post('Admin/modalService', 'Admin::modalService');
$routes->post('Admin/manageService', 'Admin::manageService');
$routes->post('Admin/deleteService', 'Admin::deleteService');
$routes->post('Admin/getCustomerDT', 'Admin::getCustomerDT');
$routes->post('Admin/newCustomer', 'Admin::newCustomer');
$routes->post('Admin/signupProcess', 'Admin::signupProcess');
$routes->post('Admin/updateCustomerStatus', 'Admin::updateCustomerStatus');
$routes->post('Admin/returnReportContent', 'Admin::returnReportContent');
$routes->post('Admin/dtReport', 'Admin::dtReport');
$routes->post('Admin/getCollectionReport', 'Admin::getCollectionReport');
$routes->post('Admin/updateScheduleBussinessDay', 'Admin::updateScheduleBussinessDay');
$routes->post('Admin/setSchedule', 'Admin::setSchedule');
$routes->post('Admin/updateProfile', 'Admin::updateProfile');
$routes->post('Admin/changePassword', 'Admin::changePassword');
$routes->post('Admin/changePasswordProcess', 'Admin::changePasswordProcess');

$routes->get('Customer', 'Customer::index');
$routes->post('Customer/editProfile', 'Customer::editProfile');
$routes->post('Customer/editProfileProcess', 'Customer::editProfileProcess');
$routes->post('Customer/sendEmailConfirmation', 'Customer::sendEmailConfirmation');
$routes->post('Customer/createAppointment', 'Customer::createAppointment');
$routes->post('Customer/getFreeAppointments', 'Customer::getFreeAppointments');
$routes->post('Customer/createAppointmentProcess', 'Customer::createAppointmentProcess');
$routes->post('Customer/removeAppointment', 'Customer::removeAppointment');
$routes->post('Customer/removeAppointmentProcess', 'Customer::removeAppointmentProcess');
$routes->post('Customer/calendar', 'Customer::calendar');
$routes->post('Customer/getMainCustomerAppointments', 'Customer::getMainCustomerAppointments');
$routes->post('Customer/changePassword', 'Customer::changePassword');
$routes->post('Customer/changePasswordProcess', 'Customer::changePasswordProcess');
$routes->post('Customer/deleteProfile', 'Customer::deleteProfile');



