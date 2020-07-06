<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <canvas id="Canvas" width="452" height="291" style="border: 1px solid black;"></canvas>
    <script src="js/nav2d.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EaselJS/current/easeljs.min.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
    <script src="js/roslibjs.js"></script>
    <script src="js/ros2djs.js"></script>
    <script>
        function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
        }
        var ros = new ROSLIB.Ros({
            url : 'ws://192.168.0.26:9090'
        });
        ros.on('connection', function() {
            console.log('Connected to websocket server.');
        });

        ros.on('error', function(error) {
            console.log('Error connecting to websocket server: ', error);
        });

        var map_topic = new ROSLIB.Topic({
            ros : ros,
            name : '/map',
            messageType : 'nav_msgs/OccupancyGrid'
        });
/*
        map_topic.subscribe(function(map_info){
            var map_resolution = (Math.round(map_info.info.resolution * 1000)) / 1000;
            console.log(map_resolution);
            var map_width = map_info.info.width;
            var map_height = map_info.info.height;
            var x = 0;
            var y = 0;

            var i = -1;
            var canvas = document.getElementById('Canvas');
            var ctx = canvas.getContext('2d');
            map_info.data.map(function(value){
                i++;
                y = Math.round((i/map_width)*map_resolution);
                x = Math.round((i - (y/map_resolution) * map_width) * map_resolution);
                currentrow = Math.ceil((y/map_resolution))
                currentcolumn = Math.ceil((x/map_resolution))
                console.log('x: ' + currentcolumn);
                console.log('y: ' + currentrow);
                if(value == 100){
                    ctx.fillStyle = "black";
                    ctx.fillRect(currentcolumn, currentrow, 1, 1);
                }
                if(value = -1){
                    ctx.fillStyle = "grey";
                    ctx.fillRect(currentcolumn, currentrow, 1, 1);
                }
                await sleep2(1000);
            })
        });
        */
    </script>
</body>
</html>
