<?php

declare(strict_types=1);

namespace App\Controller\Component\Client;

use App\Controller\Component\AppComponent;
use PHPMailer\PHPMailer\PHPMailer;

class ClientComponent extends AppComponent
{
    public function checkEmail($email): bool
    {
        $data = $this->Users->find()
            ->where([
                'email' => $email
            ])
            ->first();
        return $data ? true : false;
    }

    public function createOTP($data)
    {
        $query = $this->OtpSecurities->query();
        $query->insert([
            'email',
            'otp',
            'ip',
            'created'
        ])
            ->values($data)
            ->execute();
    }
    public function checkOtpWithEmail($email, $otp): bool
    {
        $data = $this->OtpSecurities->find()
            ->select([
                'id',
                'email',
                'otp'
            ])
            ->where([
                'email' => $email,
            ])
            ->order(['id' => 'DESC'])
            ->limit(1)
            ->toArray();
        $otpLast = '';
        foreach ($data as $item) {
            $otpLast = $item->otp;
        }
        return $otp == $otpLast ? true : false;
    }
    public function handelClientRegister($data)
    {
        $query = $this->Users->query();
        $query->insert(
            [
                'fullname',
                'email',
                'password',
                'token_renew',
                'token_login',
                'created',
                'modified'
            ]
        )
            ->values($data)
            ->execute();
        return [
            'status' => 'success',
            'message' => 'Đăng ký thành công, chuyển hướng sau 3 giây .'
        ];
    }

    public function saveApi($data)
    {
        $query = $this->ApiConnect->query();
        $query->insert(
            [
                'email',
                'public_key',
                'security_key',
                'created',
            ]
        )
            ->values($data)
            ->execute();
    }

    /** write log */
    public function writeLog($data)
    {
        $query = $this->Logs->query();
        $query->insert(
            [
                'thread',
                'ip',
                'created',
            ]
        )
            ->values($data)
            ->execute();
    }

    /** Check password */
    public function checkPassword($email, $password): bool
    {
        $data = $this->Users->find()
            ->where([
                'email' => $email,
                'password' => $password
            ])
            ->first();
        return $data ? true : false;
    }

    /** Check last ip */
    public function checkLatestIp($email, $ip)
    {
        $data = $this->UserLatestIp->find()
            ->where([
                'email' => $email,
                'ip' => $ip
            ])
            ->first();
        return $data ? true : false;
    }

    public function writeLateIpUser($data)
    {
        $query = $this->UserLatestIp->query();
        $query->insert(
            [
                'email',
                'ip',
                'created',
            ]
        )
            ->values($data)
            ->execute();
    }

    public function getUserByEmail($email)
    {
        $query = $this->Users->find()
            ->where(['email' => $email])
            ->first();
        return $query;
    }

    public function checkCash($email, $cash): bool
    {
        $query = $this->getUserByEmail($email);
        return $cash > $query->cash ? false : true;
    }

    public function saveTransferHistory($data)
    {
        $query = $this->TransactionHistories->query();
        $query->insert(
            [
                'tranding_code',
                'transmitter',
                'receiver',
                'amount_of_money',
                'content',
                'ip',
                'created'
            ]
        )
            ->values($data)
            ->execute();
    }

    public function transferMoney($data)
    {
        $cashRemitters = $this->getUserByEmail($data['remitters'])->cash;
        $cashReceiver = $this->getUserByEmail($data['receiver'])->cash;
        $queryRemitters = $this->Users->query();
        $queryReceiver = $this->Users->query();
        $queryRemitters->update()
            ->set(
                [
                    'cash' => $cashRemitters - $data['amount_of_money']
                ]
            )
            ->where(['email' => $data['remitters']])
            ->execute();
        $queryReceiver->update()
            ->set(
                [
                    'cash' => $cashReceiver + $data['amount_of_money']
                ]
            )
            ->where(['email' => $data['receiver']])
            ->execute();
    }

    public function getAllBank()
    {
        $query = $this->Banks->find()
            ->toArray();
        return $query;
    }

    public function saveBankOfUser($data)
    {
        $query = $this->BankOfUsers->query();
        $query->insert(
            [
                'email',
                'bank',
                'holder',
                'card_number',
                'date_card',
                'created'
            ]
        )
            ->values($data)
            ->execute();
    }
    public function getBankUser($email)
    {
        $query = $this->BankOfUsers->find()
            ->select([
                'id' => 'BankOfUsers.id',
                'bankName' => 'Banks.name',
                'bankLogo' => 'Banks.logo',
                'card_number' => 'BankOfUsers.card_number'
            ])
            ->join([
                'table' => 'banks',
                'alias' => 'Banks',
                'type' => 'left',
                'conditions' =>
                [
                    'Banks.id = BankOfUsers.bank',
                ]
            ])
            ->where([
                'email' => $email
            ])
            ->first();
        return $query;
    }

    public function deleteBankUser($email)
    {
        $query = $this->BankOfUsers->query();
        $query->delete()
            ->where(['email' => $email])
            ->execute();
    }

    public function saveWithdrawHistory($data)
    {
        $query = $this->BankTransactionHistories->query();
        $query->insert(
            [
                'tranding_code',
                'email',
                'bank',
                'transaction_type',
                'transaction_amount',
                'reason',
                'ip',
                'created'
            ]
        )
            ->values($data)
            ->execute();
    }
    public function withdrawMoney($data)
    {
        $cashUser = $this->getUserByEmail($data['email'])->cash;
        $query = $this->Users->query();
        $query->update()
            ->set(
                [
                    'cash' => $cashUser - $data['money']
                ]
            )
            ->where(['email' => $data['email']])
            ->execute();
    }

    public function saveRechargeHistory($data)
    {
        $query = $this->BankTransactionHistories->query();
        $query->insert(
            [
                'tranding_code',
                'email',
                'bank',
                'transaction_type',
                'transaction_amount',
                'reason',
                'recharge_code',
                'ip',
                'created'
            ]
        )
            ->values($data)
            ->execute();
    }

    public function getListTransitionHistory($data)
    {
        switch ($data['type']) {
            case 'receive':
                $query = $this->TransactionHistories->find()
                    ->where([
                        'receiver' => $data['email']
                    ])
                    ->order(['id' => 'desc'])
                    ->toArray();
                return $query;
                break;
            case 'transfers':
                $query = $this->TransactionHistories->find()
                    ->where([
                        'transmitter' => $data['email']
                    ])
                    ->order(['id' => 'desc'])
                    ->toArray();

                return $query;
                break;
            case 'withdraw':
                $query = $this->BankTransactionHistories->find()
                    ->where([
                        'email' => $data['email'],
                        'transaction_type' => 'withdraw'
                    ])
                    ->order(['id' => 'desc'])
                    ->toArray();

                return $query;
                break;
            case 'recharge':
                $query = $this->BankTransactionHistories->find()
                    ->where([
                        'email' => $data['email'],
                        'transaction_type' => 'recharge'
                    ])
                    ->order(['id' => 'desc'])
                    ->toArray();

                return $query;
                break;
            default:
                # code...
                break;
        }
    }

    public function updatePassword($data)
    {
        $query = $this->Users->query();
        $query->update()
            ->set([
                'password' => $data['password'],
                'modified' => $data['modified']
            ])
            ->where([
                'email' => $data['email']
            ])
            ->execute();
    }

    public function updateToken($data)
    {
        $query = $this->Users->query();
        $query->update()
            ->set([
                'token_renew' => $data['token'],
                'modified' => $data['modified']
            ])
            ->where([
                'email' => $data['email']
            ])
            ->execute();
    }

    public function updateCoin($data)
    {
        $coinUser = $this->getUserByEmail($data['email'])->coin;
        $query = $this->Users->query();
        $query->update()
            ->set([
                'coin' => $coinUser + $data['coin'],
                'modified' => $data['modified']
            ])
            ->where([
                'email' => $data['email']
            ])
            ->execute();
    }

    public function updateCoinAfterGetVoucher($data)
    {
        $coinUser = $this->getUserByEmail($data['email'])->coin;
        $query = $this->Users->query();
        $query->update()
            ->set([
                'coin' => $coinUser - $data['coin'],
                'modified' => $data['modified']
            ])
            ->where([
                'email' => $data['email']
            ])
            ->execute();
    }

    public function getDataHistoryByTradingCode($data)
    {
        switch ($data['type']) {
            case 'bank':
                $query = $this->BankTransactionHistories->find()
                    ->where([
                        'tranding_code' => $data['code'],
                        'email' => $data['email']
                    ])
                    ->first();
                return $query;
                break;
            case 'transfer':
                $query = $this->TransactionHistories->find()
                    ->where([
                        'tranding_code' => $data['code'],
                        'transmitter' => $data['email']
                    ])
                    ->first();
                return $query;
                break;
            case 'receive':
                $query = $this->TransactionHistories->find()
                    ->where([
                        'tranding_code' => $data['code'],
                        'receiver' => $data['email']
                    ])
                    ->first();
                return $query;
                break;
            default:
                # code...
                break;
        }
    }

    public function getUserByTokenRenew($token)
    {
        $query = $this->Users->find()
            ->where(['token_renew' => $token])
            ->first();
        return $query;
    }

    public function getUserByTokenLogin($token)
    {
        $query = $this->Users->find()
            ->where(['token_login' => $token])
            ->first();
        return $query;
    }

    public function saveAttendance($data)
    {
        $query = $this->Attendance->query();
        $query->insert(
            [
                'email',
                'ip',
                'created'
            ]
        )
            ->values($data)
            ->execute();
    }

    public function getAttendanceUser($data)
    {
        $query = $this->Attendance->find()
            ->where([
                'email' => $data['email'],
                'created' => $data['today']
            ])
            ->first();
        return $query;
    }

    public function listVoucher($type, $email)
    {
        $query = $this->Vouchers->find()
            ->select([
                'title' => 'Vouchers.title',
                'description' => 'Vouchers.description',
                'code' => 'Vouchers.code',
                'coin',
                'type' => 'Vouchers.type',
                'expired_time' => 'Vouchers.expired_time'
            ])
            ->join([
                'table' => 'voucher_of_users',
                'alias' => 'VoucherOfUsers',
                'type' => 'left',
                'conditions' =>
                [
                    'VoucherOfUsers.code = Vouchers.code',
                ]
            ])
            ->where([
                'Vouchers.code NOT IN' => $this->VoucherOfUsers->find()
                    ->select('VoucherOfUsers.code')
                    ->where([
                        'email' => $email,
                        'VoucherOfUsers.delete_flag' => 0
                    ]),
                'type' => $type == 'reduce' ? 'reduce' : 'refund',
                'amount >' => 0,
                'Vouchers.delete_flag' => 0,
                'expired_time >' => date('Y-m-d')
            ])->toArray();
        return $query;
    }

    public function getVoucherByCode($code)
    {
        $query = $this->Vouchers->find()
            ->where([
                'code' => $code,
                'amount >' => 0,
                'delete_flag' => 0,
                'expired_time >' => date('Y-m-d')
            ])
            ->first();
        return $query;
    }

    public function saveVoucherOfUser($data)
    {
        $query = $this->VoucherOfUsers->query();
        $query->insert(
            [
                'email',
                'code',
                'ip',
                'created',
                'modified'
            ]
        )
            ->values($data)
            ->execute();
    }

    public function updateAmountVoucher($code)
    {
        $amountVoucher = $this->getVoucherByCode($code)->amount;
        $query = $this->Vouchers->query();
        $query->update()
            ->set([
                'amount' => $amountVoucher - 1,
            ])
            ->where([
                'code' => $code,
                'delete_flag' => 0
            ])
            ->execute();
    }

    public function listVoucherOfUser($email)
    {
        $query = $this->VoucherOfUsers->find()
            ->select([
                'title' => 'Vouchers.title',
                'description' => 'Vouchers.description',
                'code' => 'Vouchers.code',
                'type' => 'Vouchers.type',
                'expired_time' => 'Vouchers.expired_time'
            ])
            ->join([
                'table' => 'vouchers',
                'alias' => 'Vouchers',
                'type' => 'inner',
                'conditions' =>
                [
                    'VoucherOfUsers.code = Vouchers.code',
                ]
            ])
            ->where([
                'VoucherOfUsers.email' => $email,
                'VoucherOfUsers.delete_flag' => 0,
                'Vouchers.delete_flag' => 0,
                'Vouchers.expired_time >' => date('Y-m-d')
            ])
            ->toArray();
        return $query;
    }

    function checkLockUser($email)
    {
        $query = $this->UserStatus->find()
            ->where([
                'email' => $email,
                'delete_flag' => 1,
                'lock_time >' => date('Y-m-d')
            ])
            ->first();
        return $query;
    }

    function getApiUser($email)
    {
        $query = $this->ApiConnect->find()
            ->where([
                'email' => $email
            ])
            ->first();
        return $query;
    }

    function saveNoti($data)
    {
        $query = $this->Notifications->query();
        if ($data['type'] == 'create') {
            $query->insert([
                'email',
                'thread',
                'created'
            ])
                ->values($data)
                ->execute();
        } else {
            $query->update()
                ->set([
                    'delete_flag' => 1
                ])
                ->where([
                    'email' => $data['email']
                ])
                ->execute();
        }
    }

    function getNoti($email)
    {
        $query = $this->Notifications->find()
            ->where([
                'email' => $email,
                'delete_flag' => 0
            ])
            ->order([
                'id' => 'desc'
            ])
            ->toArray();
        return $query;
    }

    function getBlogInHome()
    {
        $query = $this->Blogs->find()
            ->where([
                'delete_flag' => 0
            ])
            ->order([
                'id' => 'desc'
            ])
            ->limit(3);
        return $query;
    }

    function getAllBlog()
    {
        $query = $this->Blogs->find()
            ->where([
                'delete_flag' => 0
            ])
            ->order([
                'id' => 'desc'
            ]);
        return $query;
    }

    function getBlogBySlug($slug)
    {
        $query = $this->Blogs->find()
            ->where([
                'delete_flag' => 0,
                'slug' => $slug
            ])
            ->first();
        return $query;
    }

    function getRandomBlog()
    {
        $query = $this->Blogs->find()
            ->where([
                'delete_flag' => 0
            ])
            ->order('rand()')
            ->limit(2);
        return $query;
    }
    public function OTP()
    {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, $charactersLength - 1)];
        }
        return $code;
    }

    public function tradingCode()
    {
        $length = 10;
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, $charactersLength - 1)];
        }
        return $code;
    }

    public function send_mail($to, $subject, $message)
    {

        $sender = "lctiendat@gmail.com";
        $header = "X-Mailer: PHP/" . phpversion() . "Return-Path: $sender";
        $mail = new PHPMailer();
        $mail->SMTPDebug  = 2;
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username   = "lctiendat@gmail.com";
        $mail->Password   = "Tiendat11082000";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->SMTPOptions = array(
            'tls' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ),
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = false;
        $mail->do_debug = 0;
        $mail->From = $sender;
        $mail->FromName = "Ví Thanh Toán Điện Tử VioPay";
        $mail->AddAddress($to);
        $mail->IsHTML(true);
        $mail->CreateHeader($header);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($message);
        $mail->AltBody = nl2br($message);
        if (!$mail->Send()) {
            return true;
        } else {
            return false;
        }
    }
}
