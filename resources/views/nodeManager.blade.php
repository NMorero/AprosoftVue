<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/nodeManager.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
    <script src="js/nav2d.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EaselJS/current/easeljs.min.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
    <script src="js/roslibjs.js"></script>
    <script src="js/ros2djs.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/loading-bar.css')}}"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="{{asset('/js/loading-bar.js')}}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/threeDots.css')}}">


    <title>Aprosoft</title>
</head>
<body class="bodyAlign" id="body">


    <div class="middle text-center" id="starting">
        <h3 class="blinking">INICIANDO</h3>
        <span>POR FAVOR ESPERE</span>
    </div>

    <div class="middle  text-center" id="exploration">
        <span id="status">Status: Operative</span>
        <p class="text-center">EXPLORACION</p>
        <div class="row justify-content-between">
            <button class="bg-primary btnStart rounded" id="start">Iniciar</button> <button class=" btnTurnOff rounded" id="shutdown">Apagar</button>
        </div>
    </div>

    <div class="middle text-center" id="exploring">
        <h3 class="blinking">EXPLORANDO</h3>
        <span>POR FAVOR ESPERE</span>
    </div>

    <div class="middle text-center" id="exploreEnd">
        <span id="exploringEnded">EXPLORACION FINALIZADA</span>
        <div id="map" class=" bg-white"></div>
        <div class="row justify-content-between">
            <button class="bg-primary btnStart rounded" id="saveBtn">GUARDAR</button> <button class=" btnTurnOff rounded" id="redoBtn">REHACER</button>
        </div>
    </div>



    <script src="{{asset('js/testNode.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



</body>
