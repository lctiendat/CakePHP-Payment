<?php

declare(strict_types=1);

namespace App\Controller\Dashboard;

use App\Controller\AppController;
use Cake\Event\EventInterface;

/**
 * Clients Controller
 *
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
{

    public function sumMoneyByDay($type, $date)
    {
        $sum = '';
        $data = [
            'type' => $type,
            'date' => $date
        ];
        $result = $this->{'Dashboard/Statis'}->staticBankTransitionByDay($data);
        foreach ($result as $item) {
            $sum = $item->sum;
        }

        return $sum == null ? 1 : $sum;
    }

    public function sumMoneyByMonth($type, $date)
    {
        $sum = '';
        $data = [
            'type' => $type,
            'date' => $date
        ];
        $result = $this->{'Dashboard/Statis'}->staticBankTransitionByMonth($data);
        foreach ($result as $item) {
            $sum = $item->sum;
        }

        return $sum == null ? 1 : $sum;
    }

    public function dashboard()
    {
        $withdrawYesterday = $this->sumMoneyByDay('withdraw', date('Y-m-d', strtotime("yesterday")));
        $withdrawToday = $this->sumMoneyByDay('withdraw', date('Y-m-d'));
        $withdrawLastMonth = $this->sumMoneyByMonth('withdraw', date('Y-m', strtotime("-1 month")));
        $withdrawCurrentMonth = $this->sumMoneyByMonth('withdraw', date('Y-m'));
        $rechargeYesterday = $this->sumMoneyByDay('recharge', date('Y-m-d', strtotime("yesterday")));
        $rechargeToday = $this->sumMoneyByDay('recharge', date('Y-m-d'));
        $rechargeLastMonth = $this->sumMoneyByMonth('recharge', date('Y-m', strtotime("-1 month")));
        $rechargeCurrentMonth = $this->sumMoneyByMonth('recharge', date('Y-m'));
        $logs = $this->{'Dashboard/Statis'}->logs();
        $this->set(compact(
            'withdrawYesterday',
            'withdrawToday',
            'withdrawLastMonth',
            'withdrawCurrentMonth',
            'rechargeYesterday',
            'rechargeToday',
            'rechargeLastMonth',
            'rechargeCurrentMonth',
            'logs'
        ));
        $this->render('/Dashboard/dashboard');
    }

    public function beforeFilter(EventInterface $event)
    {
        $session = $this->request->getSession();
        if ($session->read('arrSessionUser')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $user = $this->{'Dashboard/User'}->getUserByEmail($email);
            if ($user->role == 'user') {
                $this->redirect('/');
            }
        } else {
            $this->redirect('/client/login');
        }
    }

    public function pageIncrement($model)
    {
        $dataPage = $this->request->getAttribute('paging');
        $pageStart = $dataPage[$model]['start'];
        $dataCount = $dataPage[$model]['count'];
        $this->set(compact('pageStart', 'dataCount'));
    }

    public function shortPaginate($list)
    {
        return $this->paginate($list, ['limit' => 10]);
    }

    public function listBank()
    {
        $listBank = $this->shortPaginate($this->{'Dashboard/Bank'}->listBank());
        $this->pageIncrement('Banks');
        $this->set(compact('listBank'));
        $this->render('/Dashboard/listBank');
    }
    public function listUser()
    {
        $listUser = $this->shortPaginate($this->{'Dashboard/User'}->listUser());
        $this->pageIncrement('Users');
        $this->set(compact('listUser'));
        $this->render('/Dashboard/listUser');
    }

    public function listWithdrawalOrder()
    {
        $listWithdrawalOrder = $this->shortPaginate($this->{'Dashboard/OrderReview'}->listWithdrawalOrder());
        $this->pageIncrement('BankTransactionHistories');
        $this->set(compact('listWithdrawalOrder'));
        $this->render('/Dashboard/listWithdrawalOrder');
    }
    public function listReChargeOrder()
    {
        $listReChargeOrder = $this->shortPaginate($this->{'Dashboard/OrderReview'}->listReChargeOrder());
        $this->pageIncrement('BankTransactionHistories');
        $this->set(compact('listReChargeOrder'));
        $this->render('/Dashboard/listReChargeOrder');
    }

    public function listVoucher()
    {
        $listVoucher = $this->shortPaginate($this->{'Dashboard/Voucher'}->listVoucher());
        $this->pageIncrement('Vouchers');
        $this->set(compact('listVoucher'));
        $this->render('/Dashboard/listVoucher');
    }

    public function listBlog()
    {
        $listBlog = $this->shortPaginate($this->{'Dashboard/Blog'}->listBlog());
        $this->pageIncrement('Blogs');
        $this->set(compact('listBlog'));
        $this->render('/Dashboard/listBlog');
    }

    public function listTransitionHistory()
    {
        $list = $this->shortPaginate($this->{'Dashboard/OrderReview'}->listTransitionHistory());
        $this->pageIncrement('TransactionHistories');
        // dd($this->request->getAttribute('paging'));
        $this->set(compact('list'));
        $this->render('/Dashboard/listTransitionHistory');
    }
}
