<?php

declare(strict_types=1);

namespace App\Controller\Component\Dashboard;

use App\Controller\Component\AppComponent;
use PHPMailer\PHPMailer\PHPMailer;

class BankComponent extends AppComponent
{

    public function listBank()
    {
        $query = $this->Banks->find()
            ->where([
                'delete_flag' => 0
            ])
            ->order(['id' => 'desc']);
        return $query;
    }

    public function saveBank($data)
    {
        // if (!empty($data['id'])) {
        //     $query = $this->Banks->get($data['id']);
        //     $query = $this->Banks->patchEntity($query, $data);
        // } else {
        //     $query = $this->Banks->newEntity($data);
        // }
        // $this->Banks->save($query);
        // return $query->hasErrors()
        //     ?
        //     [
        //         'status' => false,
        //         'message' => $query->getErrors()
        //     ]
        //     :
        //     [
        //         'status' => true
        //     ];

        $query = $this->Banks->query();
        if (empty($data['id'])) {
            $query->insert([
                'name',
                'logo',
                'created',
                'modified'
            ])->values($data)
                ->execute();
        } else {
            $query->update()
                ->set([
                    'name' => $data['name'],
                    'logo' => $data['logo'],
                    'modified' => $data['modified'],
                ])
                ->where([
                    'id' => $data['id']
                ])
                ->execute();
        }
    }
    public function deleteBank($id)
    {
        $query = $this->Banks->query();
        $query->update()
            ->set(['delete_flag' => 1])
            ->where(['id' => $id])
            ->execute();
    }

    public function getBankById($id)
    {
        $query = $this->Banks->find()
            ->where([
                'delete_flag' => 0,
                'id' => $id
            ])
            ->first();
        return $query;
    }
}
