<?php

declare(strict_types=1);

namespace App\Controller\Component\Dashboard;

use App\Controller\Component\AppComponent;

class StatisComponent extends AppComponent
{
    public function staticBankTransitionByDay($data)
    {
        $query = $this->BankTransactionHistories->find()
            ->select([
                'sum' => 'SUM(transaction_amount)'
            ])
            ->where([
                'transaction_type' => $data['type'],
                'date_format(created,"%Y-%m-%d")' => $data['date']
            ]);
        return $query;
    }

    public function staticBankTransitionByMonth($data)
    {
        $query = $this->BankTransactionHistories->find()
            ->select([
                'sum' => 'SUM(transaction_amount)'
            ])
            ->where([
                'transaction_type' => $data['type'],
                'date_format(created,"%Y-%m")' => $data['date']
            ]);
        return $query;
    }

    public function logs()
    {
        $query = $this->Logs->find()
            ->order(['id' => 'desc'])
            ->limit(10);
        return $query;
    }

    public function search($key, $model)
    {

        switch ($model) {
            case 'Users':
                $query = $this->Users->find()
                    ->select([
                        'id' => 'Users.id',
                        'email' => 'Users.email',
                        'cash',
                        'coin',
                        'UserStatus.lock_time',
                        'role' => 'Users.role',
                        'status' => 'UserStatus.delete_flag'
                    ])
                    ->join([
                        'table' => 'user_status',
                        'alias' => 'UserStatus',
                        'type' => 'left',
                        'conditions' =>
                        [
                            'Users.email = UserStatus.email',
                        ]
                    ])
                    ->where([
                        'Users.email LIKE' => '%' . $key . '%',
                        'Users.delete_flag' => 0
                    ])
                    ->order(['Users.id' => 'desc'])
                    ->toArray();
                return $query;
                break;
            case 'Withdraw':
                $query = $this->BankTransactionHistories->find()
                    ->where([
                        'transaction_type' => 'withdraw',
                        'OR' => [
                            'tranding_code LIKE' => '%' . $key . '%',
                            'email LIKE' => '%' . $key . '%',
                        ]
                    ])
                    ->order([
                        'id' => 'desc'
                    ]);
                return $query;
                break;
            case 'Recharge':
                $query = $this->BankTransactionHistories->find()
                    ->where([
                        'transaction_type' => 'recharge',
                        'OR' => [
                            'tranding_code LIKE' => '%' . $key . '%',
                            'email LIKE' => '%' . $key . '%',
                        ]
                    ])
                    ->order([
                        'id' => 'desc'
                    ]);
                return $query;
                break;
            case 'Vouchers':
                $query = $this->Vouchers->find()
                    ->where([
                        'delete_flag' => 0,
                        'code LIKE' => '%' . $key . '%',
                    ])
                    ->order(['id' => 'desc']);
                return $query;
                break;
            case 'TransitionHistory':
                $query = $this->TransactionHistories->find()
                    ->where([
                        'OR' => [
                            'tranding_code LIKE' => '%' . $key . '%',
                            'transmitter LIKE' => '%' . $key . '%',
                            'receiver LIKE' => '%' . $key . '%',
                        ]
                    ])
                    ->order([
                        'id' => 'desc',
                    ]);
                return $query;
                break;
            default:

                break;
        }
    }
}
