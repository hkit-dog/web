<?php

include("db_c.php");
include("phasedown.php"); //Markdown parser
#Get post id
$id = $_GET["id"];
#If id is not int then will set as 0(Default 404)
if (is_numeric($id) != true ){
    $id = 0;
}

?>
<html><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="style.css" rel="stylesheet" type="text/css">
    <title>香港IT狗埋怨區</title>
    <script src='https://www.google.com/recaptcha/api.js?=hl=zh-HK'></script>
    <script>
        $(function () {

            $('form').on('submit', function (e) {

                e.preventDefault();

                $.ajax({
                    type: 'post',
                    url: 'reply.php',
                    data: $('form').serialize(),
                    success: function () {
                        //alert('貼出了...如果你不是機械人');

                        setTimeout(
                            function()
                            {
                                location.reload();
                            }, 0001);
                    },
                    error: function(){
                        alert('發貼失敗');
                    }
                });

            });

        });
    </script>
    </head><body>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><span>香港IT狗</span><br></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <a href="#">主頁</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="section section-primary">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>香港IT狗埋怨區</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <blockquote>
                            <p>IT狗，做到嘔！</p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        

<?php


#spilt pages
$requested_page = isset($_GET['page']) ? intval($_GET['page']) : 1;// Assume the page is 1

$r = mysqli_query($link,"SELECT COUNT(*) FROM comment");
$d = mysqli_fetch_row($r);
$thread_count = $d[0];

$thread_per_page = 15;

// 55 products => $page_count = 3
$page_count = ceil($thread_count / $thread_per_page);

// You can check if $requested_page is > to $page_count OR < 1,
// and redirect to the page one.

$first_thread_shown = ($requested_page - 1) * $thread_per_page;




#SQL statement get 15 items per query
$sql = <<<SQL
    SELECT *
    FROM `comment`  ORDER BY ctime DESC LIMIT $first_thread_shown, $thread_per_page
SQL;

#Prompt Error Query
if(!$result = $link->query($sql)){
    die('There was an error running the query [' . $link->error . ']');
}

#Loop post entries & shut all mysql link
while($row = $result->fetch_assoc()) {
    $markdown = Parsedown::instance()->text($row['comment']);
    echo "<div class=\"panel panel-primary\">
	<div class=\"panel-heading\">
    <h3 class=\"panel-title\">". $row['cuser'] ."</h3>
    </div>
    <div class=\"panel-body\"> <p>".
        $markdown
    . "</p></div>
    <div class=\"panel-footer\">發文時間：".$row['ctime']."</div></div>
";
}
mysqli_close($link);

?>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form">
                            <div class="form-group"><label class="control-label"
                                                           for="exampleInputEmail1">你個名</label><input
                                    class="form-control" id="exampleInputEmail1" name="cuser" placeholder="名..."
                                    type="text"></div>
                            <div class="form-group"><label class="control-label"
                                                           for="exampleInputPassword1">內文(支援markdown，圖片可以到<a href="https://na.cx">https://na.cx</a>上載)</label><textarea
                                    class="form-control" name="comment" rows="8" placeholder="是咁的..."
                                    type="text"></textarea>
                            </div>
                            <div class="g-recaptcha" data-sitekey="key"></div>
                            <button type="submit" class="btn btn-default">貼出</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="section section-primary">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>關於香港IT狗</h1>
                        <p>「IT狗，你的資訊真的很有用」，沿自網上流傳的一本名叫《數學與科技》教育雜誌當中的單元故事《超級無敵IT狗》，其中一頁出現的一幅有一個名叫珍妮的女子和一隻名為「IT狗」的機械狗對話的漫畫，而該說話是由珍妮說的。當中「IT狗」這個詞彙，引起不少網民熱議，甚至有言論指有關言論反映香港的資訊從業員猶如機械狗一樣，沒有尊嚴，只會服從主人命令。</p><p>made by Telegram Group @din_lo_it</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-info text-right">
                            <br>
                            <br>
                        </p>
                        <div class="row">
                            <div class="col-md-12 hidden-lg hidden-md hidden-sm text-left">
                                <a href="#"><i class="fa fa-3x fa-fw fa-instagram text-inverse"></i></a>
                                <a href="#"><i class="fa fa-3x fa-fw fa-twitter text-inverse"></i></a>
                                <a href="#"><i class="fa fa-3x fa-fw fa-facebook text-inverse"></i></a>
                                <a href="#"><i class="fa fa-3x fa-fw fa-github text-inverse"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 hidden-xs text-right">
                                <a href="#"><i class="fa fa-3x fa-fw fa-github text-inverse"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    

</body></html>