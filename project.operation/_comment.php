<div class="row comment">
    <div class="col-md-2">
        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
        <p class="text-secondary text-center"><?= $time ?></p>
    </div>
    <div class="col-md-10">
        <p>
            <a class="float-left" href="#"><strong><?= $username ?></strong></a>
        </p>
        <div class="clearfix"></div>
        <p><?= $text ?></p>
        <?php if (isset($lastId)) { ?>
        <p>
            <a class="float-right btn btn-outline-primary ml-2 btn-del-comm" href="#" target="_self" data-last_id="<?= $lastId ?>">
                <i class="fa fa-window-close"></i> Видалити</a>
        </p>
        <?php } ?>
    </div>
</div>