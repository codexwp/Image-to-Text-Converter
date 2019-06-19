<!DOCTYPE html>
<html lang="en">
<head>
    <title>JACOS : Optical Character Reading</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/html2canvas.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>
<body>

    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#jacos-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">JACOS</a>
            </div>
            <div id="jacos-menu" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><button class="btn btn-success">Image to Text Convert</button></a></li>
                    <li><a href="#"><button class="btn btn-warning">Another Task 1</button></a></li>
                    <li><a href="#"><button class="btn btn-primary">Another Task 2</button></a></li>

                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>

    <div class="container-fluid">
        <div class="main-content bg-white">
            <div class="row border-between">
                <div class="col-sm-6">
                    <h4>Upload Image</h4><hr>
                    <div class="panel panel-default text-center">
                        <div class="panel-body">
                            <button id="btn-upload" class="btn btn-primary">Browse File</button>
                            <input id="file-input" type="file" name="imgfile" style="display:none">
                        </div>
                    </div>

                    <div id="orginal-image" class="panel panel-default" style="display:none">
                        <p style="padding-top: 5px;margin-bottom: 0px;padding-left: 10px;" class="text-warning">Orginal Image</p>
                        <div class="panel-body">
                            <img src=""/>
                            <div id="classified-image-canvas"></div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6">
                    <h4>Output Text</h4><hr>
                    <div id="no-image" class="text-center">
                        <img height="150" src="assets/images/no-image.gif"/>
                    </div>
                    <div id="loading" class="text-center" style="display:none;">
                        <img height="150" src="assets/images/loading.gif"/>
                        <h4>Please wait, retrieving text....</h4>
                    </div>

                    <div style="display:none;" id="output-box">

                    </div>
                </div>
            </div>

            <div style="position: absolute;top:0;left:0;z-index: -99" id="canvas"></div>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>