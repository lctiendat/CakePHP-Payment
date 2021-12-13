<?= $this->element('Client/header') ?>
<style>
    .title {
        font-size: 13px;
        font-weight: bold;
    }

    .des {
        font-size: 12px;
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
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-9">
            <div class="card p-5">
                <h4><?= $blog->title ?>
                </h4>
                <div class="mt-3" style="height: 1px;width:100%;background:gray">

                </div>
                <p class="mt-2 mb-2" style="font-size:13px;color:gray"> <i class="bi bi-calendar"></i> <?= $blog->created ?></p>
                <div style="height: 1px;width:100%;background:gray">

                </div>
                <p class="mt-3" style="color: gray;font-size:14px"><?= $blog->description ?></p>

                <p><?= $blog->content ?></p>

                <div class="mt-3" style="height: 1px;width:100%;background:gray">

                </div>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>" target="_blank">
                <span class="badge badge-primary mt-3">Share <i class="bi bi-facebook"></i></span>
                </a>
                <div class="mt-3" style="height: 1px;width:100%;background:gray">

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <center>
                <p class="text-uppercase">Bài viết ngẫu nhiên</p>
                <div style="height: 2px; width:100px;background:purple">
                </div>
            </center>
            <div class="row">
                <?php foreach ($blogRandom as $item) { ?>
                    <div class="col-md-12 mt-3">
                        <div class="card border-0 shadow" style="border-radius:5px">
                            <img src="<?= $item->thumbnail ?>" width="100%" height="120px" style="object-fit: cover;border-radius:10px 10px 0 0" alt="">
                            <div class="p-2">
                                <span class="mt-2 title"><?= strlen($item->title) > 50 ? substr($item->title, 0, 50) . '...' : $item->title ?></span> <br>
                                <span class="des"><?= strlen($item->description) > 50 ? substr($item->description, 0, 50) . '...' : $item->description  ?></span> <br>
                                <span class="cal"> <i class="bi bi-calendar"></i><?= $item->created ?></span>
                                <span class="float-right readmore"> <a style="color: purple;" href="/blog/<?= $item->slug ?>"> Xem thêm</a></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?= $this->element('Client/footer') ?>