<?php

declare(strict_types=1);

namespace App\Controller\Component\Dashboard;

use App\Controller\Component\AppComponent;

class VoucherComponent extends AppComponent
{

    public function listVoucher()
    {
        $query = $this->Vouchers->find()
            ->where([
                'delete_flag' => 0,
                'expired_time >' => date('Y-m-d'),
                
            ])
            ->order(['id' => 'desc']);
        return $query;
    }

    public function saveVoucher($data)
    {
        $query = $this->Vouchers->query();
        $query->insert([
            'title',
            'description',
            'code',
            'money',
            'amount',
            'coin',
            'type',
            'created',
            'expired_time'
        ])
            ->values($data)
            ->execute();
    }
    public function deleteVoucher($code)
    {
        $query = $this->Vouchers->query();
        $query->update()
            ->set(['delete_flag' => 1])
            ->where(['code' => $code])
            ->execute();
        $queryUser = $this->VoucherOfUsers->query();
        $queryUser->update()
            ->set(['delete_flag' => 1])
            ->where(['code' => $code])
            ->execute();
    }

    public function checkVoucher($code)
    {
        $query = $this->Vouchers->find()
            ->where([
                'code' => $code,
                'delete_flag' => 0
            ])
            ->first();
        return $query;
    }
}
