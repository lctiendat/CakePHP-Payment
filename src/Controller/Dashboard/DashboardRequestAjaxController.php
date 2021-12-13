<?php

declare(strict_types=1);

namespace App\Controller\Dashboard;

use App\Controller\AppController;

/**
 * Clients Controller
 *
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardRequestAjaxController extends AppController
{

    public function antiXss($variable)
    {
        return htmlspecialchars($variable);
    }

    public function actionBank()
    {
        if ($this->request->is('POST')) {
            $action = $this->request->getData('action');
            switch ($action) {
                case 'creat':
                    $name = $this->request->getData('name');
                    $logo = $this->request->getData('logo');
                    $data = [
                        'name' => $this->antiXss($name),
                        'logo' => $this->antiXss($logo),
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s')
                    ];
                    $this->{'Dashboard/Bank'}->saveBank($data);
                    break;
                case 'update':
                    $id = $this->request->getData('id');
                    $name = $this->request->getData('name');
                    $logo = $this->request->getData('logo');
                    $data = [
                        'id' => $id,
                        'name' => $this->antiXss($name),
                        'logo' => $this->antiXss($logo),
                        'modified' => date('Y-m-d H:i:s')
                    ];
                    $this->{'Dashboard/Bank'}->saveBank($data);
                    break;
                case 'delete':
                    $id = $this->request->getData('id');
                    $this->{'Dashboard/Bank'}->deleteBank($id);
            }
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }

    public function getBank()
    {
        if ($this->request->is('POST')) {
            $id = $this->request->getData('id');
            $bank = $this->{'Dashboard/Bank'}->getBankById($id);
            echo json_encode([
                'id' => $bank->id,
                'name' => $bank->name,
                'logo' => $bank->logo
            ]);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }
    public function saveMoneyUser()
    {
        if ($this->request->is('POST')) {
            $email = $this->request->getData('email');
            $money = $this->request->getData('money');
            $calculation = $this->request->getData('calculation');
            $user = $this->{'Dashboard/User'}->getUserByEmail($email);
            $data = [
                'email' => $email,
                'cash' => $money,
                'calculation' => $calculation
            ];
            if ($calculation == 'sub') {
                if ($money > $user->cash) {
                    echo json_encode([
                        'status' => false,
                        'message' => 'Số tiền trừ phải ít hơn số tiền của người dùng'
                    ]);
                } else {
                    $this->{'Dashboard/User'}->saveMoneyUser($data);
                    echo json_encode([
                        'status' => true
                    ]);
                }
            } else {
                $this->{'Dashboard/User'}->saveMoneyUser($data);
                echo json_encode([
                    'status' => true
                ]);
            }
        }
        $this->render('/Dashboard/handleRequestAjax');
    }
    public function saveCoinUser()
    {
        if ($this->request->is('POST')) {
            $email = $this->request->getData('email');
            $coin = $this->request->getData('coin');
            $calculation = $this->request->getData('calculation');
            $user = $this->{'Dashboard/User'}->getUserByEmail($email);
            $data = [
                'email' => $email,
                'coin' => $coin,
                'calculation' => $calculation
            ];
            if ($calculation == 'sub') {
                if ($coin > $user->coin) {
                    echo json_encode([
                        'status' => false,
                        'message' => 'Số coin trừ phải ít hơn số coin của người dùng'
                    ]);
                } else {
                    $this->{'Dashboard/User'}->saveCoinUser($data);
                    echo json_encode([
                        'status' => true
                    ]);
                }
            } else {
                $this->{'Dashboard/User'}->saveCoinUser($data);
                echo json_encode([
                    'status' => true
                ]);
            }
        }
        $this->render('/Dashboard/handleRequestAjax');
    }
    public function lockUser()
    {
        if ($this->request->is('POST')) {
            $email = $this->request->getData('email');
            $lockTime = $this->request->getData('lockTime');
            $reason = $this->request->getData('reason');
            $data = [
                'email' => $email,
                'lock_time' => $lockTime,
                'reason' => $reason,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ];
            $this->{'Dashboard/User'}->saveStatusUser($data);
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }
    public function unlockUser()
    {
        if ($this->request->is('POST')) {
            $email = $this->request->getData('email');
            $this->{'Dashboard/User'}->unlockUser($email);
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }

    public function changePass()
    {
        if ($this->request->is('POST')) {
            $email = $this->request->getData('email');
            $password  = $this->request->getData('password');

            $data = [
                'email' => $email,
                'password' =>  sha1($password) . '875048414ed89e8650cffcd7828a94226cdcc057',
                'modified' => date('Y-m-d H:i:s')
            ];
            $this->{'Dashboard/User'}->changePasswordUser($data);
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }

    public function acceptOrder()
    {
        if ($this->request->is('POST')) {
            $code = $this->request->getData('code');
            if ($this->request->getData('type') == 'withdraw') {
                $this->{'Dashboard/OrderReview'}->acceptOrder($code);
                $result = $this->{'Dashboard/OrderReview'}->getUserByTradingCode($code);
                $data = [
                    'type' => 'create',
                    'email' => $result->email,
                    'thread' => 'Yêu cầu rút ' . $result->transaction_amount . ' đ đã được duyệt',
                    'created' => date('Y-m-d H:i:s')
                ];
                $this->{'Client/Client'}->saveNoti($data);
            } else if ($this->request->getData('type') == 'recharge') {
                $this->{'Dashboard/OrderReview'}->acceptOrder($code);
                $result = $this->{'Dashboard/OrderReview'}->getUserByTradingCode($code);
                $data = [
                    'email' => $result->email,
                    'transaction_amount' => $result->transaction_amount
                ];
                $this->{'Dashboard/User'}->saveCashUser($data);
                $data = [
                    'type' => 'create',
                    'email' => $result->email,
                    'thread' => 'Yêu cầu nạp ' . $result->transaction_amount . 'đ đã được duyệt',
                    'created' => date('Y-m-d H:i:s')
                ];
                $this->{'Client/Client'}->saveNoti($data);
            }
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }

    public function cancelOrder()
    {
        if ($this->request->is('POST')) {
            $code = $this->request->getData('code');
            $reason = $this->request->getData('reason');
            if ($this->request->getData('type') == 'withdraw') {
                $data = [
                    'code' => $code,
                    'reason' => $reason
                ];
                $this->{'Dashboard/OrderReview'}->cancelOrder($data);
                $result = $this->{'Dashboard/OrderReview'}->getUserByTradingCode($code);
                $data = [
                    'email' => $result->email,
                    'transaction_amount' => $result->transaction_amount
                ];
                $result = $this->{'Dashboard/User'}->saveCashUser($data);
            } else if ($this->request->getData('type') == 'recharge') {
                $data = [
                    'code' => $code,
                    'reason' => $reason
                ];
                $this->{'Dashboard/OrderReview'}->cancelOrder($data);
            }
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }
    public function updateRole()
    {
        if ($this->request->is('POST')) {
            $email = $this->request->getData('email');
            $this->{'Dashboard/User'}->updateRoleUser($email);
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }

    public function addVoucher()
    {
        if ($this->request->is('POST')) {
            $title = $this->request->getData('title');
            $description = $this->request->getData('description');
            $code = $this->request->getData('code');
            $money = $this->request->getData('money');
            $amount = $this->request->getData('amount');
            $coin = $this->request->getData('coin');
            $type = $this->request->getData('type');
            $expired = $this->request->getData('expired');
            $result = $this->{'Dashboard/Voucher'}->checkVoucher($code);
            if ($result == null) {
                $data = [
                    'title' => $title,
                    'description' => $description,
                    'code' => $code,
                    'money' => $money,
                    'amount' => $amount,
                    'coin' => $coin,
                    'type' => $type,
                    'created' => date('Y-m-d H:i:s'),
                    'expired_time' => $expired
                ];
                $this->{'Dashboard/Voucher'}->saveVoucher($data);
                echo json_encode([
                    'status' => true
                ]);
            } else {
                echo json_encode([
                    'status' => false,
                    'message' => 'Mã giảm giá này đã tồn tại'
                ]);
            }
        }
        $this->render('/Dashboard/handleRequestAjax');
    }

    public function deleteVoucher()
    {
        if ($this->request->is('POST')) {
            $code = $this->request->getData('code');
            $this->{'Dashboard/Voucher'}->deleteVoucher($code);
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }

    public function saveBlog()
    {
        if ($this->request->is('POST')) {
            $title = $this->request->getData('title');
            $description = $this->request->getData('description');
            $thumbnail = $this->request->getData('thumbnail');
            $content = $this->request->getData('content');
            if ($this->request->getData('id')) {
                $id = $this->request->getData('id');
                $data = [
                    'id' => $id,
                    'title' => $title,
                    'description' => $description,
                    'content' => $content,
                    'thumbnail' => $thumbnail,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ];
            } else {
                $data = [
                    'title' => $title,
                    'description' => $description,
                    'content' => $content,
                    'thumbnail' => $thumbnail,
                    'slug' => $this->createdSlug($title),
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ];
            }
            $this->{'Dashboard/Blog'}->saveBlog($data);
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }

    public function getBlog()
    {
        if ($this->request->is('POST')) {
            $id = $this->request->getData('id');
            $result = $this->{'Dashboard/Blog'}->getBlogById($id);
            echo json_encode($result);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }

    public function deleteBlog()
    {
        if ($this->request->is('POST')) {
            $id = $this->request->getData('id');
            $this->{'Dashboard/Blog'}->deleteBlog($id);
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }

    public function createdSlug($slug)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', substr($slug, 0, 30)))) . '-' . $this->{'Client/Client'}->tradingCode();
    }

    public function search()
    {
        if ($this->request->is('POST')) {
            $key = $this->request->getData('key');
            $model = $this->request->getData('model');
            $result = $this->{'Dashboard/Statis'}->search($key,$model);
            echo json_encode($result);
        }
        $this->render('/Dashboard/handleRequestAjax');
    }
}
