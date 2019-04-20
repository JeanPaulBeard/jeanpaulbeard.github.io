<?php
session_start();
if (!$_SESSION['log']['id'] > 0) {
    header("Location:login.html");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="app/img/jeanpaul_logo_128.png" type="image/png">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="app/css/style.css">

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="theme-color" content="#0277bd"/>
        <title>JVMS - VPS</title>
    </head>

    <body>
        <a name="top" id="top"></a>
        <nav class="transparent nav-fixed">
            <div class="nav-wrapper container">
                <a href="#top" class="brand-logo consolas page-scroll">
                    <img src="app/img/jeanpaul_logo_40.png">
                    <span class="page-scroll">JVMS</span>
                </a>

                <ul class="right hide-on-med-and-down">
                    <li><a href="logout.php" class="page-scroll">Salir</a></li>
                </ul>

                <ul id="nav-mobile" class="sidenav">
                    <li><br></li>
                    <li><a href="logout.php" class="blue-grey-text page-scroll">Salir</a></li>
                </ul>
                <a href="#" data-target="nav-mobile" class="sidenav-trigger light-blue-text text-darken-3"><i class="material-icons">menu</i></a>
            </div>
        </nav>

        <div>
            <div class="section no-pad-bot">
                <div class="container m-h500">
                    <h1>&nbsp;</h1>
                    <!--
                    <ul id="slide-out" class="sidenav">
                        <li><h1>&nbsp;</h1></li>
                        <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
                        <li><a href="#!">Second Link</a></li>
                        <li><div class="divider"></div></li>
                    </ul>
                    <a href="#" data-target="slide-out" class="sidenav-trigger" style="font-size: 3em;">
                        <i class="material-icons" style="font-size: 1em;">storage</i>
                        Servidores
                    </a>
                    -->
                    <div class="row">

                        <div class="col l3 m4 s12 vpss">
                            <!--
                            <div class="vps">
                                <div class="so-icon windows7"></div>
                                <div class="vps-name">jvms1</div>
                                <div class="so-name">Windows 7 x64</div>
                            </div>
                            <div class="vps">
                                <div class="so-icon windows10"></div>
                                <div class="vps-name">jvms2</div>
                                <div class="so-name">Windows 10 x64</div>
                            </div>
                            <div class="vps">
                                <div class="so-icon ubuntu"></div>
                                <div class="vps-name">jvms2</div>
                                <div class="so-name">Ubuntu 18.04 x64</div>                                
                            </div>
                            <div class="vps">
                                <div class="so-icon centos"></div>
                                <div class="vps-name">jvms2</div>
                                <div class="so-name">Centos 7 x64</div>
                            </div>
                            <div class="vps">
                                <div class="so-icon linux"></div>
                                <div class="vps-name">jvms2</div>
                                <div class="so-name">Linux based x64</div>
                            </div>
                            -->
                        </div>

                        <div class="col l9 m8 s12 rdps">
                            <!--
                            <a class="rdp" href="#rdp/jvms1/notepad.rdp" target="_blank">
                                <div class="icon notepad"></div>
                                <div class="name">Notepad++</div>
                            </a>
                            <a class="rdp" href="#rdp/jvms1/notepad.rdp" target="_blank">
                                <div class="icon word"></div>
                                <div class="name">Word</div>
                            </a>
                            <a class="rdp" href="#rdp/jvms1/notepad.rdp" target="_blank">
                                <div class="icon excel"></div>
                                <div class="name">Excel</div>
                            </a>
                            <a class="rdp" href="#rdp/jvms1/notepad.rdp" target="_blank">
                                <div class="icon powerpoint"></div>
                                <div class="name">Power Point</div>
                            </a>
                            <a class="rdp" href="#rdp/jvms1/notepad.rdp" target="_blank">
                                <div class="icon photoshop"></div>
                                <div class="name">Photoshop</div>
                            </a>
                            <a class="rdp" href="#rdp/jvms1/notepad.rdp" target="_blank">
                                <div class="icon contapyme"></div>
                                <div class="name">ContaPyme</div>
                            </a>
                            <a class="rdp" href="#rdp/jvms1/notepad.rdp" target="_blank">
                                <div class="icon illustrator"></div>
                                <div class="name">Illustrator</div>
                            </a>
                            <a class="rdp" href="#rdp/jvms1/notepad.rdp" target="_blank">
                                <div class="icon chrome"></div>
                                <div class="name">Chrome</div>
                            </a>
                            <a class="rdp" href="#rdp/jvms1/notepad.rdp" target="_blank">
                                <div class="icon firefox"></div>
                                <div class="name">Firefox</div>
                            </a>
                            -->
                        </div>


                    </div>





                </div>
            </div>

        </div>









        <!--Import jQuery before materialize.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript" src="app/js/all.js"></script>
        <script type="text/javascript" src="app/js/vps.js"></script>
        <script>

        </script>
    </body>
</html>