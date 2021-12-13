
<?php
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VioPay - Website Thanh Toán Điện Tử</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<div class="container">
    <div class="row" style="margin-top: 150px;">

        <div class="col-md-6 mx-auto">
            <div id="result" style="height: 50px;">

            </div>
            <div class="form-group">
                <label for=""> Số tiền </label>
                <input type="text" id="money" class="form-control">
            </div>
            <div class="form-group">
                <label for=""> Mã giảm giá </label>
                <input type="text" id="voucher" class="form-control">
            </div>
            <div class="form-group">
                <button class="buy btn btn-success">Mua hàng</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $('.buy').click((e) => {
        e.preventDefault()
        let money = $('#money').val().trim();
        let voucher = $('#voucher').val().trim();
        $.ajax({
            url: '/api/request',
            type: 'POST',
            data: {
                money,
                voucher
            },
            dataType: 'json',
            success(response) {
                console.log(response)
                if (response.status == true) {
                    $('.buy').attr('disabled', 'disabled')
                    $('.buy').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('#result').html(`<div class="alert alert-success alert-dismissible fade show">\
                                          <strong>Mua hàng thành công </strong></div>`)
                        $('.buy').removeAttr('disabled')
                        $('.buy').html('Mua hàng')
                    }, 1000);
                } else {
                    $('.buy').attr('disabled', 'disabled')
                    $('.btnFbuyorget').html('Đang xử lí ...')
                    setTimeout(() => {
                        $('#result').html(`<div class="alert alert-danger alert-dismissible fade show">\
                                          <strong>${response.message}</strong></div>`)
                        $('.buy').removeAttr('disabled')
                        $('.buy').html('Mua hàng')
                    }, 1000);
                }
            }
        })
    })
</script>