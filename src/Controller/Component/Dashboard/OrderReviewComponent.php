<?php

declare(strict_types=1);

namespace App\Controller\Component\Dashboard;

use App\Controller\Component\AppComponent;

class OrderReviewComponent extends AppComponent
{

    public function listWithdrawalOrder()
    {
        $query = $this->BankTransactionHistories->find()
            ->where([
                'transaction_type' => 'withdraw'
            ])
            ->order([
                'id' => 'desc'
            ]);
        return $query;
    }

    public function listReChargeOrder()
    {
        $query = $this->BankTransactionHistories->find()
            ->where([
                'transaction_type' => 'recharge'
            ])
            ->order([
                'id' => 'desc'
            ]);
        return $query;
    }

    public function listTransitionHistory()
    {
        $query = $this->TransactionHistories->find()
            ->order([
                'id' => 'desc'
            ]);
        return $query;
    }

    public function acceptOrder($code)
    {
        $query = $this->BankTransactionHistories->query();
        $query->update()
            ->set([
                'status' => 'accept',
                'reason' => 'Rút tiền thành công',
                'modified' => date('Y-m-d H:i:s')

            ])
            ->where([
                'tranding_code' => $code
            ])
            ->execute();
    }
    public function cancelOrder($data)
    {
        $query = $this->BankTransactionHistories->query();
        $query->update()
            ->set([
                'status' => 'cancel',
                'reason' => $data['reason'],
                'modified' => date('Y-m-d H:i:s')

            ])
            ->where([
                'tranding_code' => $data['code']
            ])
            ->execute();
    }

    public function getUserByTradingCode($code)
    {
        $query = $this->BankTransactionHistories->find()
            ->where([
                'tranding_code' => $code
            ])
            ->first();
        return $query;
    }
}
