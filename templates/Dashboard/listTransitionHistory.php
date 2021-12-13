<?= $this->element('Dashboard/header') ?>
<style>
    tr {
        height: 50px;
    }

    td {
        line-height: 50px;
    }
</style>
<div id="content" class="app-content">

<div class="row">
    <div class="col-md-3">
        <input type="text" class="form-control" id="key" placeholder="Tìm kiếm">
    </div>
</div>
    <table class="table text-center" data-toggle="table" data-sort-class="table-active" data-sortable="true" data-search="true" data-pagination="true" data-show-refresh="true" data-show-columns="true" data-show-fullscreen="true" data-height="460">
        <thead>
            <tr>
                <th># Mã giao dịch</th>
                <th>Người chuyển</th>
                <th>Người nhận</th>
                <th>Số tiền</th>
                <th>Thời gian</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($list) == 0) { ?>
                <center>Dữ liệu không được tìm thấy</center>
            <?php } else { ?>
                <?php foreach ($list as $item) { ?>
                    <tr>
                        <td><?= $item->tranding_code ?></td>
                        <td><?= $item->transmitter ?></td>
                        <td><?= $item->receiver ?></td>
                        <td><?= $item->amount_of_money ?></td>
                        <td><?= $item->created ?></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
    <?php if ($dataCount > 10) { ?>
        <div class="row mt-3">
            <div class="col-md-12 float-right">
                <ul class="pagination">
                    <?= $this->Paginator->prev("Prev") ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next("Next") ?>
                </ul>
            </div>
        </div>
    <?php } ?>
</div>

<?= $this->element('Dashboard/footer') ?>
<script>
$('#key').keyup((e) => {
        e.preventDefault()
        let key = $('#key').val().trim()
        let model = 'TransitionHistory'
        if (key != '') {
            $('.pagination').hide()
            $.ajax({
                url: '/dashboard/requestajax/search',
                type: 'POST',
                data: {
                    key,
                    model
                },
                dataType: 'json',
                success(response) {
                    let data = ''
                    let j = 1
                    for (let i = 0; i < response.length; i++) {
                        data += `<tr>
                        <td>${response[i].tranding_code}</td>
                        <td>${response[i].transmitter}</td>
                        <td>${response[i].receiver}</td>
                        <td>${response[i].amount_of_money}</td>
                        <td>${response[i].created}</td>
                        </tr>`
                    }
                    $('tbody').html(data)
                }
            })
        }

    })
</script>
