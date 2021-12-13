<?php

declare(strict_types=1);

namespace App\Controller\Component\Api;

use App\Controller\Component\AppComponent;

class ApiComponent extends AppComponent
{
    function checkReceiver($data)
    {
        $query = $this->ApiConnect->find()
            ->where([
                'public_key' => $data['receive'],
            ])->first();
        return $query;
    }

    function checkKey($data)
    {
        $query = $this->ApiConnect->find()
            ->where([
                'public_key' => $data['public_key'],
                'security_key' => $data['security_key']
            ])->first();
        return $query;
    }

    function checkVoucher($data)
    {
        $query = $this->VoucherOfUsers->find()
            ->where([
                'email' => $data['email'],
                'code' => $data['code'],
               // 'delete_flag' => 0
            ])->first();
        return $query;
    }

    public function getVoucherByCode($code)
    {
        $query = $this->Vouchers->find()
            ->where([
                'code' => $code,
                'delete_flag' => 0,
                'expired_time >' => date('Y-m-d')
            ])
            ->first();
        return $query;
    }

    public function getUserByEmail($email)
    {
        $query = $this->Users->find()
            ->where([
                'delete_flag' => 0,
                'email' => $email
            ])
            ->first();
        return $query;
    }

    public function saveMoneyUser($data)
    {
        $cash = $this->getUserByEmail($data['email'])->cash;
        $query = $this->Users->query();
        if ($data['type'] == 'plus') {
            $query->update()
                ->set([
                    'cash' => $cash + $data['money'],
                    'modified' => date('Y-m-d H:i:s')
                ])
                ->where([
                    'email' => $data['email'],
                ])
                ->execute();
        } else {
            $query->update()
                ->set([
                    'cash' => $cash - $data['money'],
                    'modified' => date('Y-m-d H:i:s')
                ])
                ->where([
                    'email' => $data['email'],
                ])
                ->execute();
        }
    }

    public function updateVoucherUser($data)
    {
        $query = $this->VoucherOfUsers->query();
        $query->update()
            ->set([
                'delete_flag' => 1
            ])
            ->where([
                'email' => $data['email'],
                'code' => $data['code']
            ])
            ->execute();
    }
}
