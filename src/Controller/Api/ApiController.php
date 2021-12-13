<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * ApisController Controller
 *
 * @method \App\Model\Entity\ApisController[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiController extends AppController
{
    public function data()
    {
        $this->render('/Api/data');
    }

    public function demo()
    {
        $this->render('/Api/demo');
    }

    public function apiPayment()
    {
        if ($this->request->is('POST')) {
            $receiver = $this->request->getData('receiver');
            $public_key = $this->request->getData('public_key');
            $security_key = $this->request->getData('security_key');
            $money = $this->request->getData('money');
            $voucher = $this->request->getData('voucher');
            $data = [
                'domain' => '',
                'receive' => $receiver
            ];
            $result = $this->{'Api/Api'}->checkReceiver($data);
            if ($result != null) {
                $emailReceiver = $result->email;
                $data = [
                    'public_key' => $public_key,
                    'security_key' => $security_key
                ];
                $result = $this->{'Api/Api'}->checkKey($data);
                if ($result !=  null) {
                    $emailPayer = $result->email;
                    $cashPayer = $this->{'Client/Client'}->getUserByEmail($emailPayer)->cash;
                    if ($money > $cashPayer) {
                        echo json_encode([
                            'status' => false,
                            'message' => 'Số dư của bạn không đủ'
                        ]);
                    } else {
                        if ($voucher != '') {
                            $data = [
                                'email' => $emailPayer,
                                'code' => $voucher
                            ];
                            $result = $this->{'Api/Api'}->checkVoucher($data);
                            if ($result != null) {
                                $result =  $this->{'Api/Api'}->getVoucherByCode($voucher);
                                if ($result != null) {
                                    $typeVoucher = $result->type;
                                    $moneyVoucher = $result->money;
                                    if ($typeVoucher == 'reduce') {
                                        if ($moneyVoucher > $money) {
                                            echo json_encode([
                                                'status' => false,
                                                'message' => 'Mã giảm giá không thể sử dụng'
                                            ]);
                                        } else {
                                            $data = [
                                                'email' => $emailReceiver,
                                                'money' => $money,
                                                'type' => 'plus'
                                            ];
                                            $this->{'Api/Api'}->saveMoneyUser($data);
                                            $data = [
                                                'email' => $emailPayer,
                                                'money' => $money - $moneyVoucher,
                                                'type' => 'sub'
                                            ];
                                            $this->{'Api/Api'}->saveMoneyUser($data);
                                            $data = [
                                                'email' => $emailPayer,
                                                'code' => $voucher,
                                            ];
                                            $this->{'Api/Api'}->updateVoucherUser($data);
                                            echo json_encode([
                                                'status' => true
                                            ]);
                                        }
                                    } else {
                                        $data = [
                                            'email' => $emailReceiver,
                                            'money' => $money,
                                            'type' => 'plus'
                                        ];
                                        $this->{'Api/Api'}->saveMoneyUser($data);
                                        $data = [
                                            'email' => $emailPayer,
                                            'money' => $money - (($money * $moneyVoucher) / 100),
                                            'type' => 'sub'
                                        ];
                                        $this->{'Api/Api'}->saveMoneyUser($data);
                                        $data = [
                                            'email' => $emailPayer,
                                            'code' => $voucher,
                                        ];
                                        $this->{'Api/Api'}->updateVoucherUser($data);
                                        echo json_encode([
                                            'status' => true
                                        ]);
                                    }
                                } else {
                                    echo json_encode([
                                        'status' => false,
                                        'message' => 'Mã giảm giá không hợp lệ'
                                    ]);
                                }
                            } else {
                                echo json_encode([
                                    'status' => false,
                                    'message' => 'Mã giảm giá không hợp lệ'
                                ]);
                            }
                        } else {
                            $data = [
                                'email' => $emailReceiver,
                                'money' => $money,
                                'type' => 'plus'
                            ];
                            $this->{'Api/Api'}->saveMoneyUser($data);
                            $data = [
                                'email' => $emailPayer,
                                'money' => $money,
                                'type' => 'sub'
                            ];
                            $this->{'Api/Api'}->saveMoneyUser($data);
                            echo json_encode([
                                'status' => true
                            ]);
                        }
                    }
                } else {
                    echo json_encode([
                        'status' => false,
                        'message' => 'Dữ liệu không hợp lệ'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => false,
                    'message' => 'Dữ liệu không hợp lệ'
                ]);
            }
        }
        $this->render('/Api/data');
    }

    public function sendRequest()
    {
        if ($this->request->is('POST')) {
            $public_key_admin = '4a3da142ee8668bf7bdaf132c65d3d3c7a1ee6a5'; // public key chủ shop
            $public_key_user = 'd3402ac888192f5e9cbc0d42bb6138e22c4ce26c'; // public key người thanh toán
            $security_key_user = '62a5d82032e6c28bf18dd917824d13f09318d919'; // security key người thanh toán
            $money = $this->request->getData('money');
            $voucher = $this->request->getData('voucher');;
            $dataPost = [
                'receiver' => $public_key_admin,
                'public_key' => $public_key_user,
                'security_key' => $security_key_user,
                'money' => $money,
                'voucher' => $voucher,
            ];
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'http://localhost/api/payment', // url muốn gửi dữ liệu
                CURLOPT_RETURNTRANSFER => true, // trả dữ liệu về hàm curl_exec
                CURLOPT_CUSTOMREQUEST => 'POST', // loại request
                CURLOPT_SSL_VERIFYPEER => false, // bỏ kiểm tra ssl
                CURLOPT_POSTFIELDS => json_encode($dataPost), // dữ liệu gửi
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ],
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;
            $this->render('/Api/data');
        }
    }
}
