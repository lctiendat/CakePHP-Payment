<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Controller\AppController;

/**
 * Clients Controller
 *
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientRequestAjaxController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Client/Client');
    }

    public function sendOtp($email)
    {
        $OTP = $this->{'Client/Client'}->OTP();
        $data = [
            'email' => $email,
            'otp' => $OTP,
            'ip' => gethostbyname($_SERVER['REMOTE_ADDR']),
            'created' => date('Y-m-d H:i:s')
        ];
        $this->{'Client/Client'}->createOTP($data);
        $subject = 'Mã OTP xác minh ';
        $message = 'Mã OTP của bạn là : <strong> ' . $OTP . '</strong>';
        $this->{'Client/Client'}->send_mail($email, $subject, $message);
    }

    public function requestAjaxClientRegister()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            if ($this->request->getData('email')) {
                $email = $this->request->getData('email');
                $result = $this->{'Client/Client'}->checkEmail($email);
                echo json_encode($result);
                if ($result == false) {
                    $this->sendOtp($email);
                    $session->write('emailRegister', $email);
                }
            } elseif ($this->request->getData('otp')) {
                $email = $session->read('emailRegister');
                $otp = $this->request->getData('otp');
                $data = $this->{'Client/Client'}->checkOtpWithEmail($email, $otp);
                echo json_encode($data);
            } elseif ($this->request->getData('password')) {
                $password = $this->request->getData('password');
                $fullname = $this->request->getData('fullname');
                $email = $session->read('emailRegister');
                $token_login = sha1($this->{'Client/Client'}->OTP()) . '875048414ed89e8650cffcd7828a94226cdcc057';
                $data = [
                    'fullname' => $fullname,
                    'email' => $email,
                    'password' => sha1($password) . '875048414ed89e8650cffcd7828a94226cdcc057',
                    'token_renew' => sha1($this->{'Client/Client'}->OTP()) . '875048414ed89e8650cffcd7828a94226cdcc057',
                    'token_login' => $token_login,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ];
                $result = $this->{'Client/Client'}->handelClientRegister($data);
                $log = [
                    'thread' => $email . ' đăng ký tài khoản',
                    'ip' => gethostbyname($_SERVER['REMOTE_ADDR']),
                    'created' => date('Y-m-d H:i:s')
                ];
                $this->{'Client/Client'}->writeLog($log);
                $subject = 'Đăng ký tài khoản thành công';
                $message = 'Chào mừng ' . $email . ' tham gia ví điện tử VioPay
                Link đăng nhập tự động của bạn là : <a href="http://localhost/client/autologin?token=' . $token_login . '">Link</a>';
                $this->{'Client/Client'}->send_mail($email, $subject, $message);
                echo json_encode($result);
            }
        }
        $this->render('/Client/handleRequestAjax');
    }
    public function requestAjaxClientLogin()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            if ($this->request->getData('email') && $this->request->getData('password')) {
                $email = $this->request->getData('email');
                $password = sha1($this->request->getData('password')) . '875048414ed89e8650cffcd7828a94226cdcc057';
                $result = $this->{'Client/Client'}->checkEmail($email);
                if ($result == true) {
                    $result = $this->{'Client/Client'}->checkPassword($email, $password);
                    if ($result == false) {
                        echo json_encode([
                            'status' => 'errorPass',
                            'message' => 'Mật khẩu không chính xác '
                        ]);
                    } else {
                        $ip = gethostbyname($_SERVER['REMOTE_ADDR']);
                        $result = $this->{'Client/Client'}->checkLatestIp($email, $ip);
                        if ($result == false) {
                            $this->sendOtp($email);
                            $session->write('emailLogin', $email);
                            echo json_encode([
                                'status' => 'strange_ip',
                                'message' => 'Vui lòng nhập mã OTP ở email để xác minh thiết bị mới .'
                            ]);
                        } else {
                            $result = $this->{'Client/Client'}->checkLockUser($email);
                            if ($result != null) {
                                echo json_encode([
                                    'status' => false,
                                    'message' => 'Bạn đã bị khoá tới ngày ' . $result->lock_time . ' lí do : ' . $result->reason
                                ]);
                            } else {
                                $arrSessionUser = [
                                    'email' => $email
                                ];
                                $session->write('arrSessionUser', $arrSessionUser);
                                echo json_encode(
                                    true
                                );
                            }
                        }
                    }
                } else {
                    echo json_encode([
                        'status' => 'email_notexits',
                        'message' => 'Email không tồn tại trong hệ thống'
                    ]);
                }
            } elseif ($this->request->getData('otp')) {
                $email = $session->read('emailLogin');
                $otp = $this->request->getData('otp');
                $result = $this->{'Client/Client'}->checkOtpWithEmail($email, $otp);
                if ($result == true) {
                    $data = [
                        'email' => $email,
                        'ip' => gethostbyname($_SERVER['REMOTE_ADDR']),
                        'created' => date('Y-m-d H:i:s')
                    ];
                    $this->{'Client/Client'}->writeLateIpUser($data);
                    $arrSessionUser = [
                        'email' => $email
                    ];
                    $session->write('arrSessionUser', $arrSessionUser);
                    echo json_encode($result);
                } else {
                    echo json_encode($result);
                }
            }
        }
        $this->render('/Client/handleRequestAjax');
    }
    public function requestAjaxClientFindUser()
    {
        if ($this->request->is('POST')) {
            $email = $this->request->getData('email');
            $result = $this->{'Client/Client'}->getUserByEmail($email);
            echo json_encode($result);
        }
        $this->render('/Client/handleRequestAjax');
    }
    public function requestAjaxClientTransfer()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $receiver = $this->request->getData('receiver');
            $transferamount = $this->request->getData('transferamount');
            $content = $this->request->getData('content');
            if (isset($receiver)) {
                $result = $this->{'Client/Client'}->getUserByEmail($receiver);
                if ($result == null) {
                    echo json_encode([
                        'status' => false,
                        'message' => 'Không tồn tại người nhận'
                    ]);
                } else {
                    if ($email == $receiver) {
                        echo json_encode([
                            'status' => false,
                            'message' => 'Người gửi và người nhận phải khác nhau'
                        ]);
                    } else {
                        $result = $this->{'Client/Client'}->checkCash($email, $transferamount);
                        if ($result == false) {
                            echo json_encode([
                                'status' => false,
                                'message' => 'Số dư của bạn không đủ'
                            ]);
                        } else {
                            $valueTransfer = [
                                'receiver' => $receiver,
                                'transferamount' => $transferamount,
                                'content' => $content
                            ];
                            $session->write('valueTransfer', $valueTransfer);
                            echo json_encode([
                                'status' => true,
                            ]);
                        }
                    }
                }
            } elseif ($this->request->getData('sendOtp')) {
                $this->sendOtp($email);
                echo json_encode([
                    'status' => true,
                ]);
            } elseif ($this->request->getData('otp')) {
                $otp = $this->request->getData('otp');
                $result = $this->{'Client/Client'}->checkOtpWithEmail($email, $otp);
                if ($result == true) {
                    $valueTransfer = $session->read('valueTransfer');
                    $data = [
                        'tranding_code' => $this->{'Client/Client'}->tradingCode(),
                        'transmitter' => $email,
                        'receiver' => $valueTransfer['receiver'],
                        'amount_of_money' => $valueTransfer['transferamount'],
                        'content' => $valueTransfer['content'],
                        'ip' => gethostbyname($_SERVER['REMOTE_ADDR']),
                        'created' => date('Y-m-d H:i:s')
                    ];
                    $this->{'Client/Client'}->saveTransferHistory($data);
                    $data = [
                        'remitters' => $email,
                        'receiver' => $valueTransfer['receiver'],
                        'amount_of_money' => $valueTransfer['transferamount'],
                    ];
                    $this->{'Client/Client'}->transferMoney($data);
                    $data = [
                        'type' => 'create',
                        'email' => $valueTransfer['receiver'],
                        'thread' => 'Bạn vừa nhận được ' . $valueTransfer['transferamount'] . ' đ từ ' . $email,
                        'created' => date('Y-m-d H:i:s')
                    ];
                    $this->{'Client/Client'}->saveNoti($data);
                    echo json_encode($result);
                } else {
                    echo json_encode($result);
                }
            }
        }
        $this->render('/Client/handleRequestAjax');
    }

    public function requestAjaxClientBank()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $bank = $this->request->getData('bankid');
            $holder = $this->request->getData('holder');
            $card_number = $this->request->getData('cardnumber');
            $date_card = $this->request->getData('datecard');
            $data = [
                'email' => $email,
                'bank' => $bank,
                'holder' => $holder,
                'card_number' => $card_number,
                'date_card' => $date_card,
                'created' => date('Y-m-d H:i:s')
            ];
            $this->{'Client/Client'}->saveBankOfUser($data);
            echo json_encode([
                'status' => true,
                'message' => 'Thêm ngân hàng thành công'
            ]);
        }
        $this->render('/Client/handleRequestAjax');
    }
    public function requestAjaxClientDeleteBank()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $this->{'Client/Client'}->deleteBankUser($email);
            echo json_encode([
                'status' => true,
                'message' => 'Xoá tài khoản thành công'
            ]);
        }
        $this->render('/Client/handleRequestAjax');
    }
    public function requestAjaxClientWithdraw()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            if ($this->request->getData('money')) {
                $money = $this->request->getData('money');
                $result = $this->{'Client/Client'}->checkCash($email, $money);
                if ($result == false) {
                    echo json_encode([
                        'status' => false,
                        'message' => 'Số dư của bạn không đủ'
                    ]);
                } else {
                    echo json_encode([
                        'status' => true,
                    ]);
                    $session->write('valueWithdraw', $money);
                }
            } elseif ($this->request->getData('sendOtp')) {
                $this->sendOtp($email);
                echo json_encode([
                    'status' => true,
                ]);
            } elseif ($this->request->getData('otp')) {
                $otp = $this->request->getData('otp');
                $result = $this->{'Client/Client'}->checkOtpWithEmail($email, $otp);
                if ($result == true) {
                    $bankOfUser = $this->{'Client/Client'}->getBankUser($email);
                    $data = [
                        'tranding_code' => $this->{'Client/Client'}->tradingCode(),
                        'email' => $email,
                        'bank' => $bankOfUser->card_number,
                        'transaction_type' => 'withdraw',
                        'transaction_amount' => $session->read('valueWithdraw'),
                        'reason' => '',
                        'ip' => gethostbyname($_SERVER['REMOTE_ADDR']),
                        'created' => date('Y-m-d H:i:s')
                    ];
                    $this->{'Client/Client'}->saveWithdrawHistory($data);
                    echo json_encode($result);
                    $data = [
                        'email' => $email,
                        'money' => $session->read('valueWithdraw')
                    ];
                    $this->{'Client/Client'}->withdrawMoney($data);
                } else {
                    echo json_encode($result);
                }
            }
        }
        $this->render('/Client/handleRequestAjax');
    }

    public function requestAjaxUserChangePassword()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            if ($this->request->getData('oldPass')) {
                $oldPass = sha1($this->request->getData('oldPass')) . '875048414ed89e8650cffcd7828a94226cdcc057';
                $result = $this->{'Client/Client'}->checkPassword($email, $oldPass);
                if ($result == false) {
                    echo json_encode([
                        'status' => false,
                        'message' => 'Mật khẩu không chính xác'
                    ]);
                } else {
                    $this->sendOtp($email);
                    echo json_encode([
                        'status' => true,
                    ]);
                }
            } elseif ($this->request->getData('otp')) {
                $otp = $this->request->getData('otp');
                $data = $this->{'Client/Client'}->checkOtpWithEmail($email, $otp);
                echo json_encode($data);
            } elseif ($this->request->getData('newPass')) {
                $password = $this->request->getData('newPass');
                $data = [
                    'email' => $email,
                    'password' => sha1($password) . '875048414ed89e8650cffcd7828a94226cdcc057',
                    'modified' => date('Y-m-d H:i:s')
                ];
                $result = $this->{'Client/Client'}->updatePassword($data);
                echo json_encode([
                    'status' => true
                ]);
                $log = [
                    'thread' => $email . ' đã thay đổi mật khẩu',
                    'ip' => gethostbyname($_SERVER['REMOTE_ADDR']),
                    'created' => date('Y-m-d H:i:s')
                ];
                $this->{'Client/Client'}->writeLog($log);
            }
        }
        $this->render('/Client/handleRequestAjax');
    }
    public function requestAjaxUserReCharge()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            if ($this->request->getData('moneyrecharge')) {
                $moneyrecharge = $this->request->getData('moneyrecharge');
                $data = [
                    'tranding_code' => $this->{'Client/Client'}->tradingCode(),
                    'email' => $email,
                    'bank' => '',
                    'transaction_type' => 'recharge',
                    'transaction_amount' => $moneyrecharge,
                    'reason' => '',
                    'recharge_code' => 'Nap Tien Vao Tai Khoan ' . $email . ' - VioPay',
                    'ip' => gethostbyname($_SERVER['REMOTE_ADDR']),
                    'created' => date('Y-m-d H:i:s')
                ];
                $this->{'Client/Client'}->saveRechargeHistory($data);
                echo json_encode([
                    'status' => true
                ]);
            }
        }
        $this->render('/Client/handleRequestAjax');
    }

    public function requestAjaxBankHistory()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            if ($this->request->getData('type') == 'bank') {
                $code = $this->request->getData('code');
                $data = [
                    'code' => $code,
                    'email' => $email,
                    'type' => 'bank'
                ];
                $result =   $this->{'Client/Client'}->getDataHistoryByTradingCode($data);
                echo json_encode($result);
            } else if ($this->request->getData('type') == 'transfer') {
                $code = $this->request->getData('code');
                $data = [
                    'code' => $code,
                    'email' => $email,
                    'type' => 'transfer'
                ];
                $result =   $this->{'Client/Client'}->getDataHistoryByTradingCode($data);
                echo json_encode($result);
            } else if ($this->request->getData('type') == 'receive') {
                $code = $this->request->getData('code');
                $data = [
                    'code' => $code,
                    'email' => $email,
                    'type' => 'receive'
                ];
                $result =   $this->{'Client/Client'}->getDataHistoryByTradingCode($data);
                echo json_encode($result);
            }
        }
        $this->render('/Client/handleRequestAjax');
    }

    public function requestAjaxForget()
    {
        if ($this->request->is('POST')) {
            $email = $this->request->getData('email');
            $result = $this->{'Client/Client'}->getUserByEmail($email);
            if ($result == null) {
                echo json_encode([
                    'status' => false,
                    'message' => 'Email không tồn tại trong hệ thống'
                ]);
            } else {
                echo json_encode([
                    'status' => true,
                ]);
                $subject = 'Quên mật khẩu';
                $message = 'Bạn có yêu cầu thay đổi mật khẩu , vui lòng click vào <a href="http://localhost/client/renew?token=' . $result->token_renew . '" style="color:red">đây</a> để tiến hành đổi mật khẩu.';
                $this->{'Client/Client'}->send_mail($email, $subject, $message);
            }
        }
        $this->render('/Client/handleRequestAjax');
    }
    public function requestAjaxRenewPass()
    {
        if ($this->request->is('POST')) {
            $token = $this->request->getData('token');
            $password = $this->request->getData('newPass');
            $result = $this->{'Client/Client'}->getUserByTokenRenew($token);
            if ($result == null) {
                echo json_encode([
                    'status' => false,
                    'message' => 'Đường dẫn không hợp lệ'
                ]);
            } else {
                $data = [
                    'password' => sha1($password) . '875048414ed89e8650cffcd7828a94226cdcc057',
                    'email' => $result->email,
                    'modified' => date('Y-m-d H:i:s')
                ];
                $this->{'Client/Client'}->updatePassword($data);
                $newToken = sha1($this->{'Client/Client'}->OTP()) . '875048414ed89e8650cffcd7828a94226cdcc057';
                $data = [
                    'token' => $newToken,
                    'email' => $result->email,
                    'modified' => date('Y-m-d H:i:s')
                ];
                $this->{'Client/Client'}->updateToken($data);
                echo json_encode([
                    'status' => true,
                ]);
            }
        }
        $this->render('/Client/handleRequestAjax');
    }
    public function requestAjaxAttendance()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $day = date('D');
            $coin = 0;
            $data = [
                'email' => $email,
                'ip' => gethostbyname($_SERVER['REMOTE_ADDR']),
                'created' => date('Y-m-d H:i:s')
            ];
            $this->{'Client/Client'}->saveAttendance($data);
            switch ($day) {
                case 'Mon':
                    $coin = 200;
                    break;
                case 'Tue':
                    $coin = 300;
                    break;
                case 'Wed':
                    $coin = 400;
                    break;
                case 'Thu':
                    $coin = 500;
                    break;
                case 'Fri':
                    $coin = 600;
                    break;
                case 'Sat':
                    $coin = 700;
                    break;
                case 'Sun':
                    $coin = 800;
                    break;
            }
            $data = [
                'email' => $email,
                'coin' => $coin,
                'modified' => date('Y-m-d H:i:s')
            ];
            $this->{'Client/Client'}->updateCoin($data);
            echo json_encode([
                'status' => true,
            ]);
        }
        $this->render('/Client/handleRequestAjax');
    }
    public function requestAjaxUserGetVoucher()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $code = $this->request->getData('code');
            $userCoin = $this->{'Client/Client'}->getUserByEmail($email)->coin;
            $voucherCoin = $this->{'Client/Client'}->getVoucherByCode($code)->coin;
            if ($userCoin < $voucherCoin) {
                echo json_encode([
                    'status' => false,
                    'message' => 'Bạn không đủ VioCoin để đổi'
                ]);
            } else {
                $data = [
                    'email' => $email,
                    'code' => $code,
                    'ip' => gethostbyname($_SERVER['REMOTE_ADDR']),
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ];
                $this->{'Client/Client'}->saveVoucherOfUser($data);
                $data = [
                    'email' => $email,
                    'coin' => $voucherCoin,
                    'modified' => date('Y-m-d H:i:s')
                ];
                $this->{'Client/Client'}->updateCoinAfterGetVoucher($data);
                $this->{'Client/Client'}->updateAmountVoucher($code);
                echo json_encode([
                    'status' => true
                ]);
            }
        }
        $this->render('/Client/handleRequestAjax');
    }

    public function requestAjaxUseraddApi()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $domain = $this->request->getData('domain');
            $data = [
                'email' => $email,
                'domain' => $domain,
                'public_key' => sha1($this->{'Client/Client'}->OTP()),
                'security_key' => sha1($this->{'Client/Client'}->OTP()),
                'created' => date('Y-m-d H:i:s'),
            ];
            $this->{'Client/Client'}->saveApi($data);
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Client/handleRequestAjax');
    }

    public function requestAjaxAutoLogin()
    {
        $session = $this->request->getSession();
        if ($session->check('arrSessionUser')) {
            $this->redirect('/');
        } else {
            if ($this->request->is('POST')) {
                $token = $this->request->getData('token');
                $result =  $this->{'Client/Client'}->getUserByTokenLogin($token);
                if ($result == null) {
                    echo json_encode([
                        'status' => false,
                        'message' => 'Đường dẫn không hợp lệ'
                    ]);
                } else {
                    $ip = gethostbyname($_SERVER['REMOTE_ADDR']);
                    $check = $this->{'Client/Client'}->checkLatestIp($result->email, $ip);
                    if ($check == null) {
                        echo json_encode([
                            'status' => false,
                            'message' => 'Vui lòng đăng nhập bằng mật khẩu một lần để sử dụng tính năng'
                        ]);
                    } else {
                        $arrSessionUser = [
                            'email' => $result->email
                        ];
                        $session->write('arrSessionUser', $arrSessionUser);
                        echo json_encode(
                            [
                                'status' => true
                            ]
                        );
                    }
                }
            }
            $this->render('/Client/handleRequestAjax');
        }
    }
    public function requestAjaxReadAllNoti()
    {
        $session = $this->request->getSession();
        if ($this->request->is('POST')) {
            $arrSessionUser = $session->read('arrSessionUser');
            $email = $arrSessionUser['email'];
            $data = [
                'type' => 'update',
                'email' => $email
            ];
            $this->{'Client/Client'}->saveNoti($data);
            echo json_encode([
                'status' => true
            ]);
        }
        $this->render('/Client/handleRequestAjax');
    }
}
