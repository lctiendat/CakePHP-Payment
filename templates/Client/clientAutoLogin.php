<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tự động đăng nhập</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        .btn {
            background-image: linear-gradient(90deg, #8E13DD, #2C0790) !important;
            width: 200px !important;
            font-size: 13px;
            height: 50px;
            border: 0;
        }

        .alert {
            font-size: 14px;
            font-weight: normal !important;
        }
    </style>
</head>
<div class="container" style="margin-top: 50px;">
    <center>
        <h3 class="text-uppercase">tự động đăng nhập</h3>
        <div style="height: 2px; width:100px;background:purple">

        </div>
    </center>
    <div class="row mt-2">
        <div class="col-md-6 mx-auto text-center">
            <div class="card p-5">
                <div id="result" style="height: 50px;">

                </div>
                    <div class="form-group text-center">
                        <button class="btn btn-success mt-5 ">
                            Tự động đăng nhập
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->element('Client/footer') ?>
<script>
    $(window).on('load', (e) => {
        let url = new URL(window.location.href);
        let searchParams = new URLSearchParams(url.search);
        let token = searchParams.get('token');
        setTimeout(() => {
            $('button').attr('disabled', 'disabled')
            $('button').html(`Đang đăng nhập...`)
            $.ajax({
                url: '/client/requestajaxautologin',
                type: 'POST',
                data: {
                    token
                },
                dataType: 'json',
                success(response) {
                    if (response.status == true) {
                        $('#result').html('<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Đăng nhập thành công.Chuyển hướng sau 3 giây</strong></div>')
                        setTimeout(() => {
                            window.location.href = '/'
                        }, 3000);
                    } else {
                        $('button').html('Đăng nhập không thành công')
                        $('#result').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>${response.message}</strong></div>`)
                    }
                }
            })
        }, 3000);
    })
</script>