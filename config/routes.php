<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {

    $builder->connect('/', 'Client/Clients::home');
    $builder->connect('/client/register', 'Client/Clients::clientRegister');
    $builder->connect('/client/login', 'Client/Clients::clientLogin');
    $builder->connect('/client/logout', 'Client/Clients::clientLogout');
    $builder->connect('/client/forget', 'Client/Clients::clientForget');
    $builder->connect('/client/renew', 'Client/Clients::clientRenew');
    $builder->connect('/client/autologin', 'Client/Clients::clientAutoLogin');

    $builder->connect('/transfer', 'Client/Clients::clientTransfer');
    $builder->connect('/bank', 'Client/Clients::clientBank');
    $builder->connect('/withdraw', 'Client/Clients::clientWithdraw');
    $builder->connect('/transactionhistory', 'Client/Clients::clientTransactionHistory');
    $builder->connect('/profile', 'Client/Clients::profileUser');
    $builder->connect('/recharge', 'Client/Clients::clientRecharge');
    $builder->connect('/voucher', 'Client/Clients::clientVoucher');
    $builder->connect('/blog', 'Client/Clients::clientBlog');
    $builder->connect('/blog/:slug', 'Client/Clients::clientGetBlog', ['pass' => ['slug']]);


    Router::scope('/api', function (RouteBuilder $routes) {
        $routes->connect('/data', 'Api/Api::data');
        $routes->connect('/demo', 'Api/Api::demo');
        $routes->connect('/payment', 'Api/Api::apiPayment');
        $routes->connect('/request', 'Api/Api::sendRequest');

    });
    Router::scope('/client', function (RouteBuilder $routes) {
        $routes->connect('/requestajaxregister', 'Client/ClientRequestAjax::requestAjaxClientRegister');
        $routes->connect('/requestajaxlogin', 'Client/ClientRequestAjax::requestAjaxClientLogin');
        $routes->connect('/requestajaxfinduser', 'Client/ClientRequestAjax::requestAjaxClientFindUser');
        $routes->connect('/requestajaxtransfer', 'Client/ClientRequestAjax::requestAjaxClientTransfer');
        $routes->connect('/requestajaxbank', 'Client/ClientRequestAjax::requestAjaxClientBank');
        $routes->connect('/requestajaxdeletebank', 'Client/ClientRequestAjax::requestAjaxClientDeleteBank');
        $routes->connect('/requestajaxwithdraw', 'Client/ClientRequestAjax::requestAjaxClientWithdraw');
        $routes->connect('/requestajaxchangepass', 'Client/ClientRequestAjax::requestAjaxUserChangePassword');
        $routes->connect('/requestajaxrecharge', 'Client/ClientRequestAjax::requestAjaxUserReCharge');
        $routes->connect('/requestajaxbankhistory', 'Client/ClientRequestAjax::requestAjaxBankHistory');
        $routes->connect('/requestajaxforget', 'Client/ClientRequestAjax::requestAjaxForget');
        $routes->connect('/requestajaxrenewpass', 'Client/ClientRequestAjax::requestAjaxRenewPass');
        $routes->connect('/requestajaxattendance', 'Client/ClientRequestAjax::requestAjaxAttendance');
        $routes->connect('/requestajaxusergetvoucher', 'Client/ClientRequestAjax::requestAjaxUserGetVoucher');
        $routes->connect('/requestajaxuseraddapi', 'Client/ClientRequestAjax::requestAjaxUseraddApi');
        $routes->connect('/requestajaxautologin', 'Client/ClientRequestAjax::requestAjaxAutoLogin');
        $routes->connect('/requestajaxreadallnoti', 'Client/ClientRequestAjax::requestAjaxReadAllNoti');

    });

    Router::scope('/dashboard/requestajax', function (RouteBuilder $routes) {
        $routes->connect('/actionbank', 'Dashboard/DashboardRequestAjax::actionBank');
        $routes->connect('/getbank', 'Dashboard/DashboardRequestAjax::getBank');
        $routes->connect('/savemoneyuser', 'Dashboard/DashboardRequestAjax::saveMoneyUser');
        $routes->connect('/savecoinuser', 'Dashboard/DashboardRequestAjax::saveCoinUser');
        $routes->connect('/lockuser', 'Dashboard/DashboardRequestAjax::lockUser');
        $routes->connect('/unlockuser', 'Dashboard/DashboardRequestAjax::unlockUser');
        $routes->connect('/changepass', 'Dashboard/DashboardRequestAjax::changePass');
        $routes->connect('/acceptorder', 'Dashboard/DashboardRequestAjax::acceptOrder');
        $routes->connect('/cancelorder', 'Dashboard/DashboardRequestAjax::cancelOrder');
        $routes->connect('/updaterole', 'Dashboard/DashboardRequestAjax::updateRole');
        $routes->connect('/addvoucher', 'Dashboard/DashboardRequestAjax::addVoucher');
        $routes->connect('/deletevoucher', 'Dashboard/DashboardRequestAjax::deleteVoucher');
        $routes->connect('/saveblog', 'Dashboard/DashboardRequestAjax::saveBlog');
        $routes->connect('/getblog', 'Dashboard/DashboardRequestAjax::getBlog');
        $routes->connect('/deleteblog', 'Dashboard/DashboardRequestAjax::deleteBlog');
        $routes->connect('/search', 'Dashboard/DashboardRequestAjax::search');
    });
    Router::prefix('Dashboard', function (RouteBuilder $routes) {
        $routes->connect('/', 'Dashboard::dashboard');
        $routes->connect('/banks', 'Dashboard::listBank');
        $routes->connect('/users', 'Dashboard::listUser');
        $routes->connect('/withdrawalorder', 'Dashboard::listWithdrawalOrder');
        $routes->connect('/rechargeorder', 'Dashboard::listReChargeOrder');
        $routes->connect('/vouchers', 'Dashboard::listVoucher');
        $routes->connect('/blogs', 'Dashboard::listBlog');
        $routes->connect('/transitionhistory', 'Dashboard::listTransitionHistory');


        $routes->fallbacks(DashedRoute::class);
    });
    $builder->fallbacks();
});
