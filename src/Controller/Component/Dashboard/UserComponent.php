<?php

declare(strict_types=1);

namespace App\Controller\Component\Dashboard;

use App\Controller\Component\AppComponent;

class UserComponent extends AppComponent
{

    public function listUser()
    {
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
                'Users.delete_flag' => 0
            ])
            ->order(['Users.id' => 'desc']);
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
        $query->update()
            ->set([
                'cash' => $data['calculation'] == 'plus' ? $cash  + $data['cash'] : $cash  - $data['cash'],
                'modified' => date('Y-m-d H:i:s')
            ])
            ->where([
                'email' => $data['email'],
            ])
            ->execute();
    }
    public function saveCoinUser($data)
    {
        $coin = $this->getUserByEmail($data['email'])->coin;
        $query = $this->Users->query();
        $query->update()
            ->set([
                'coin' => $data['calculation'] == 'plus' ? $coin  + $data['coin'] : $coin  - $data['coin'],
                'modified' => date('Y-m-d H:i:s')
            ])
            ->where([
                'email' => $data['email'],
            ])
            ->execute();
    }

    public function getUserStatus($email)
    {
        $query = $this->UserStatus->find()
            ->where(['email' => $email])
            ->first();
        return $query;
    }

    public function saveStatusUser($data)
    {
        $getUser = $this->getUserStatus($data['email']);
        $query = $this->UserStatus->query();
        if ($getUser == null) {
            $query->insert(
                [
                    'email',
                    'lock_time',
                    'reason',
                    'created',
                    'modified'
                ]
            )
                ->values($data)
                ->execute();
        } else {
            $query->update()
                ->set([
                    'delete_flag' => 1,
                    'lock_time' => $data['lock_time'],
                    'reason' => $data['reason'],
                    'modified' => date('Y-m-d H:i:s')
                ])
                ->where([
                    'email' => $data['email'],
                ])
                ->execute();
        }
    }

    public function unlockUser($email)
    {
        $query = $this->UserStatus->query();
        $query->update()
            ->set([
                'delete_flag' => 0,
                'modified' => date('Y-m-d H:i:s')
            ])
            ->where([
                'email' => $email,
            ])
            ->execute();
    }

    public function changePasswordUser($data)
    {
        $query = $this->Users->query();
        $query->update()
            ->set([
                'password' => $data['password'],
                'modified' => date('Y-m-d H:i:s')
            ])
            ->where([
                'email' => $data['email']
            ])
            ->execute();
    }

    public function saveCashUser($data)
    {
        $cashUser = $this->getUserByEmail($data['email'])->cash;
        $query = $this->Users->query();
        $query->update()
            ->set([
                'cash' => $cashUser + $data['transaction_amount'],
                'modified' => date('Y-m-d H:i:s')
            ])
            ->where([
                'email' => $data['email']
            ])
            ->execute();
    }

    public function updateRoleUser($email)
    {
        $roleUser = $this->getUserByEmail($email)->role;
        $query = $this->Users->query();
        $query->update()
            ->set([
                'role' =>  $roleUser == 'user' ? 'admin' : 'user',
                'modified' => date('Y-m-d H:i:s')
            ])
            ->where([
                'email' => $email
            ])
            ->execute();
    }
}
