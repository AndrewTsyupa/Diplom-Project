



<?php
require __DIR__ . '/../diplom/lib/DB.php';
require __DIR__ . '/model/Task.php';

$tid = $_GET['tid'];
$task = Task::findById($tid);

$sql = "SELECT * FROM task WHERE task.id = $tid";
$result = DB::queryAll($sql);
if (count($result) > 0){
foreach ($result as $row) {

?>
<?php require_once __DIR__ . '/layouts/header.php' ?>

<div class="container-fluid">

    <div class="row">
        <div align="center">
            <div class="col-md-7" style="width: 1200px; margin-left: 350px; margin-top: 50px;">
                <div class="jumbotron">
                    <div class="form-group" style="margin-top: -50px; align-content: center;">
                        <div align="center">
                            <h1 style=" align-content: center;">Завдання - <?= $tid ?> </h1>
                        </div>
                    </div>
                    <hr>
                </div>

                <form class="form-horizontal" style="margin-left: 50px;"
                      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">


                    <table class="table">

                        <thead>
                        <tr>
                            <td><label for="inputPassword6">Назва завдання</label></td>
                            <td><label for="exampleInputPassword1"><?= $row["name"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Опис завдання </label></td>
                            <td><label for="exampleInputPassword1"><?= $row["opis"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Дата початку </label></td>
                            <td><label for="exampleInputPassword1"><?= $row["date_start"]; ?></label></td>
                        </tr>

                        <tr>
                            <td><label for="inputPassword6">Дата закінчення </label></td>
                            <td><label for="exampleInputPassword1"><?= $row["date_end"]; ?></label></td>
                        </tr>


                        </thead>
                    </table>
                </form>

                <?php
                }
                }
            ?>

                <h1>Comment System using PHP and Ajax</h1>
                <div class="comment-form-container">
                    <form id="frm-comment">
                        <div class="input-row">
                            <input type="hidden" name="comment_id" id="commentId"
                                   placeholder="Name" /> <input class="input-field"
                                                                type="text" name="name" id="name" placeholder="Name" />
                        </div>
                        <div class="input-row">
                <textarea class="input-field" type="text" name="comment"
                          id="comment" placeholder="Add a Comment">  </textarea>
                        </div>
                        <div>
                            <input type="button" class="btn-submit" id="submitButton"
                                   value="Publish" /><div id="comment-message">Comments Added Successfully!</div>
                        </div>

                    </form>
                </div>
                <div id="output"></div>
                <script>
                    function postReply(commentId) {
                        $('#commentId').val(commentId);
                        $("#name").focus();
                    }

                    $("#submitButton").click(function () {
                        $("#comment-message").css('display', 'none');
                        var str = $("#frm-comment").serialize();

                        $.ajax({
                            url: "comment-add.php",
                            data: str,
                            type: 'post',
                            success: function (response)
                            {
                                var result = eval('(' + response + ')');
                                if (response)
                                {
                                    $("#comment-message").css('display', 'inline-block');
                                    $("#name").val("");
                                    $("#comment").val("");
                                    $("#commentId").val("");
                                    listComment();
                                } else
                                {
                                    alert("Failed to add comments !");
                                    return false;
                                }
                            }
                        });
                    });

                    $(document).ready(function () {
                        listComment();
                    });

                    function listComment() {
                        $.post("comment-list.php",
                            function (data) {
                                var data = JSON.parse(data);

                                var comments = "";
                                var replies = "";
                                var item = "";
                                var parent = -1;
                                var results = new Array();

                                var list = $("<ul class='outer-comment'>");
                                var item = $("<li>").html(comments);

                                for (var i = 0; (i < data.length); i++)
                                {
                                    var commentId = data[i]['comment_id'];
                                    parent = data[i]['parent_comment_id'];

                                    if (parent == "0")
                                    {
                                        comments = "<div class='comment-row'>"+
                                            "<div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['date'] + "</span></div>" +
                                            "<div class='comment-text'>" + data[i]['comment'] + "</div>"+
                                            "<div><a class='btn-reply' onClick='postReply(" + commentId + ")'>Reply</a></div>"+
                                            "</div>";

                                        var item = $("<li>").html(comments);
                                        list.append(item);
                                        var reply_list = $('<ul>');
                                        item.append(reply_list);
                                        listReplies(commentId, data, reply_list);
                                    }
                                }
                                $("#output").html(list);
                            });
                    }

                    function listReplies(commentId, data, list) {
                        for (var i = 0; (i < data.length); i++)
                        {
                            if (commentId == data[i].parent_comment_id)
                            {
                                var comments = "<div class='comment-row'>"+
                                    " <div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['date'] + "</span></div>" +
                                    "<div class='comment-text'>" + data[i]['comment'] + "</div>"+
                                    "<div><a class='btn-reply' onClick='postReply(" + data[i]['comment_id'] + ")'>Reply</a></div>"+
                                    "</div>";
                                var item = $("<li>").html(comments);
                                var reply_list = $('<ul>');
                                list.append(item);
                                item.append(reply_list);
                                listReplies(data[i].comment_id, data, reply_list);
                            }
                        }
                    }
                </script>


                <!--

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                            <p class="text-secondary text-center">15 Minutes Ago</p>
                        </div>
                        <div class="col-md-10">
                            <p>
                                <a class="float-left" href="#"><strong>Maniruzzaman Akash</strong></a>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                <span class="float-right"><i class="text-warning fa fa-star"></i></span>

                            </p>
                            <div class="clearfix"></div>
                            <p>Lorem Ipsum is simply dummy text of the pr make  but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <p>
                                <a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
                                <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                            </p>
                        </div>
                    </div>
                    <br>
                    <div class="card card-inner">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                    <p class="text-secondary text-center">15 Minutes Ago</p>
                                </div>
                                <div class="col-md-10">
                                    <p><a href="#"><strong>Maniruzzaman Akash</strong></a></p>
                                    <p>Lorem Ipsum is simply dummy text of the pr make  but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                    <p>
                                        <a class="float-right btn btn-outline-primary ml-2">  <i class="fa fa-reply"></i> Reply</a>
                                        <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                -->



        </div>

<?php require_once __DIR__ . '/layouts/footer.php' ?>
