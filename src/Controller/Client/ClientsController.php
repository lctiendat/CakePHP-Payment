<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Controller\AppController;
use Cake\Event\EventInterface;

/**
 * Clients Controller
 *
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{

    public function checkLogin()
    {
        $session = $this->request->getSession();
        if ($session->check('arrSessionUser') == false) {
            $this->redirect('/client/login');
        }
    }

    public function showNoti()
    {
        $session = $this->request->getSession();
        if ($session->check('arrSessionUser')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $noti = $this->{'Client/Client'}->getNoti($email);
            $this->set(compact('noti'));
        }
    }
    public function home()
    {
        $session = $this->request->getSession();
        if ($session->check('arrSessionUser')) {
            $this->showNoti();
            $this->fectchUser();
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $today = date('Y-m-d');
            $data = [
                'email' => $email,
                'today' => $today
            ];
            $attendance = $this->{'Client/Client'}->getAttendanceUser($data);
            $blogs = $this->{'Client/Client'}->getBlogInHome();
            $this->set(compact('attendance', 'blogs'));
        } else {
            $this->redirect('/client/login');
        }
        $this->render('/Client/Home');
    }
    public function clientRegister()
    {
        $this->render('/Client/clientRegister');
    }
    public function clientLogin()
    {
        $session = $this->request->getSession();
        if ($session->check('arrSessionUser')) {
            $this->redirect('/');
        }
        $this->render('/Client/clientLogin');
    }

    public function clientLogout()
    {
        $session = $this->request->getSession();
        $session->destroy();
        $this->redirect('/client/login');
    }

    public function fectchUser()
    {
        $session = $this->request->getSession();
        if ($session->check('arrSessionUser')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $user = $this->{'Client/Client'}->getUserByEmail($email);
            $this->set(compact('user'));
        } else {
            $this->redirect('/client/login');
        }
    }

    public function clientTransfer()
    {
        $this->checkLogin();
        $this->fectchUser();
        $this->showNoti();
        $this->render('/Client/clientTransfer');
    }
    public function clientBank()
    {
        $session = $this->request->getSession();
        if ($session->check('arrSessionUser')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $banks = $this->{'Client/Client'}->getAllBank();
            $bankOfUser = $this->{'Client/Client'}->getBankUser($email);
            $this->showNoti();
            if ($bankOfUser != null) {
                $cardHide = substr($bankOfUser->card_number, 12);
                $this->set(compact('banks', 'bankOfUser', 'cardHide'));
            }
            $this->set(compact('banks', 'bankOfUser'));
        } else {
            $this->redirect('/client/login');
        }
        $this->render('/Client/clientBank');
    }
    public function clientWithdraw()
    {
        $session = $this->request->getSession();
        if ($session->check('arrSessionUser')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $bankOfUser = $this->{'Client/Client'}->getBankUser($email);
            $user = $this->{'Client/Client'}->getUserByEmail($email);
            $this->showNoti();
            if ($bankOfUser != null) {
                $cardHide = substr($bankOfUser->card_number, 12);
                $this->set(compact('bankOfUser', 'cardHide', 'user'));
            }
            $this->set(compact('bankOfUser', 'user'));
        } else {
            $this->redirect('/client/login');
        }
        $this->render('/Client/clientWithdraw');
    }

    public function clientTransactionHistory()
    {
        $session = $this->request->getSession();
        if ($session->check('arrSessionUser')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $this->showNoti();
            $email = $arrSessionUser['email'];
            $data = [
                'email' => $email,
                'type' => 'transfers'
            ];
            $listTransfers = $this->{'Client/Client'}->getListTransitionHistory($data);
            $data = [
                'email' => $email,
                'type' => 'receive'
            ];
            $listReceive = $this->{'Client/Client'}->getListTransitionHistory($data);
            $data = [
                'email' => $email,
                'type' => 'withdraw'
            ];
            $listWithdraw = $this->{'Client/Client'}->getListTransitionHistory($data);
            $data = [
                'email' => $email,
                'type' => 'recharge'
            ];
            $listReCharge = $this->{'Client/Client'}->getListTransitionHistory($data);
            $this->set(compact('listTransfers', 'listReceive', 'listWithdraw', 'listReCharge'));
        } else {
            $this->redirect('/client/login');
        }
        $this->render('/Client/clientTransactionHistory');
    }

    public function profileUser()
    {
        $session = $this->request->getSession();
        if ($session->check('arrSessionUser')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $user = $this->{'Client/Client'}->getUserByEmail($email);
            $api = $this->{'Client/Client'}->getApiUser($email);
            $this->showNoti();
            $this->set(compact('user', 'api'));
        } else {
            $this->redirect('/client/login');
        }
        $this->render('/Client/clientProfile');
    }

    public function clientRecharge()
    {
        $this->checkLogin();
        $this->showNoti();
        $this->fectchUser();
        $this->render('/Client/clientRecharge');
    }

    public function clientForget()
    {
        $this->render('/Client/clientForget');
    }
    public function clientRenew()
    {
        $this->render('/Client/clientRenew');
    }

    public function clientVoucher()
    {
        $this->checkLogin();
        $session = $this->request->getSession();
        if ($session->check('arrSessionUser')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $this->showNoti();
            $listVoucherReduce = $this->{'Client/Client'}->listVoucher('reduce', $email);
            $listVoucherRefund = $this->{'Client/Client'}->listVoucher('refund', $email);
            $listVoucherOfUser = $this->{'Client/Client'}->listVoucherOfUser($email);
            $this->set(compact('listVoucherReduce', 'listVoucherRefund', 'listVoucherOfUser'));
        } else {
            $this->redirect('/client/login');
        }
        $this->render('/Client/clientVoucher');
    }

    public function clientAutoLogin()
    {
        $this->render('/Client/clientAutoLogin');
    }

    public function clientBlog()
    {
        $this->checkLogin();
        $this->showNoti();
        $blogs = $this->{'Client/Client'}->getAllBlog();
        $this->set(compact('blogs'));
        $this->render('/Client/clientBlog');
    }

    public function clientGetBlog($slug)
    {
        $this->checkLogin();
        $this->showNoti();
        $blog = $this->{'Client/Client'}->getBlogBySlug($slug);
        $blogRandom = $this->{'Client/Client'}->getRandomBlog();
       // dd($blogRandom);
        $this->set(compact('blog','blogRandom'));
        $this->render('/Client/clientShowBlog');
    }
}
