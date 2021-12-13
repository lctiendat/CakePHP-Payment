<?= $this->element('Client/header') ?>
<style>
    .title {
        font-size: 15px;
        font-weight: bold;
    }

    .des {
        font-size: 13px;
        color: gray;
    }

    .blog i {
        font-size: 13px;
    }

    .cal {
        font-size: 12px;
        color: gray;
    }

    .readmore {
        font-size: 13px;
        color: purple;
    }
</style>
<div class="container">
    <center class="mt-4">
        <h4 class="text-uppercase">Bài viết</h4>
        <div style="height: 2px; width:100px;background:purple">
        </div>
    </center>
    <div class="row mt-4">
        <?php foreach ($blogs as $item) { ?>
            <div class="col-md-4 mt-3">
                <div class="card border-0 shadow" style="border-radius:10px">
                    <img src="<?= $item->thumbnail ?>" width="100%" height="200px" style="object-fit: cover;border-radius:10px 10px 0 0" alt="">
                    <div class="p-3">
                        <span class="mt-3 title"><?= strlen($item->title) > 100 ? substr($item->title, 0, 100) . '...' : $item->title ?></span> <br>
                        <span class="des"><?= strlen($item->description) > 100 ? substr($item->description, 0, 100) . '...' : $item->description  ?></span> <br>
                        <span class="cal mt-2"> <i class="bi bi-calendar"></i><?= $item->created ?></span>
                        <span class="float-right readmore mt-2"> <a style="font-size: 14px;color:purple" href="/blog/<?= $item->slug ?>"> Xem thêm</a></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<?= $this->element('Client/footer') ?>