<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Админпанель</title>
        <link href="/public/css/bootstrap.min.css" rel="stylesheet">
        <link href="/public/css/admin.css" rel="stylesheet">
		<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    </head>

    <body>
        <div class="page-wrapper">

            <header id="header">
                <div class="header_top">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="contactinfo">
                                    <h5>
                                        <a href="/admin"><i class="fa fa-edit"></i> Админпанель</a>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="social-icons pull-right">
                                    <ul class="nav navbar-nav">
                                        <li><a href="/"><i class="fa fa-sign-out"></i>На сайт</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</header>
    <div class="page-buffer"><?=$content?></div>
</div>