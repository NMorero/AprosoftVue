<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
    <script src="js/nav2d.js"></script>
    <script type="text/javascript" src="{{asset('js/easeljs.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/eventEmitter2.min.js')}}"></script>
    <script src="js/roslibjs.js"></script>
    <script src="js/ros2djs.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/loading-bar.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/slick.css')}}"/>
    {{-- <script type="text/javascript" src="{{asset('/js/loading-bar.js')}}"></script> --}}
    <link rel="stylesheet" href="{{asset('/css/threeDots.css')}}">
    <link rel="stylesheet" href="{{asset('/css/battery.css')}}">
    <link rel="stylesheet" href="css/pointPlanner.css">
    <title>Aprosoft</title>
</head>

<body class="bodyAlign" id="body">
    <div class="batteryContainer">
        <div class="batteryOuter"><div id="batteryLevel"></div></div>
        <div class="batteryBump"></div>
    </div>
    <img class="imgLogo" id="logo" src="{{asset('reso/logoSaniRobo2.png')}}" alt="">
    <div class="middle text-center" id="starting">
        <h3 class="blinking">INICIANDO</h3>
        <span class="waitMessage">POR FAVOR ESPERE</span>
    </div>

    <div class="middle text-center" id="poseBox">
        <span id="spanActualGoal">Posición actual: <span id="actualGoal">(-1.00,-2,00)</span></span>
        <button id="buttonAddPose">Guardar posición</button>
    </div>

    <div id="buttonsBox">
    </div>

    <div id="modalAddPose">
        <div id="boxModalPose">
            <span class="titleModal">Agregar posición</span>
            <form action="" id="formPose">
                <div class="boxInputsModal">
                    <input type="text" id="poseTitle" value="" placeholder="Titulo de goal" required>
                    <input type="text" value="" id="valueGoalPose" disabled>
                </div>
                <button type="submit" class="btnSavePoseGoal" id="btnSavePoseGoal">Guardar</button>
            </form>
        </div>

    </div>


    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.5.1.slim.min.js')}}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="{{asset('js/popper.min.js')}}" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script>
        function sendGoal(name){
            arrGoals.forEach(el => {
                if(el.name == name){
                    getGoal.publish(el.goal)
                }
            });
        }
        var arrGoals
        axios.get('/getJsonGoals')
        .then(function (response) {
            // handle success
            console.log(response.data);
            arrGoals = response.data;
            arrGoals.forEach(el => {
                document.getElementById('buttonsBox').innerHTML += `<button class="btnGoal" onclick="sendGoal('${el.name}')">${el.name}</button>`;
            });
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })



        var actualGoal;
        var ros = new ROSLIB.Ros({
            url : 'ws://10.42.0.1:9090'
        });

        ros.on('connection', function() {
            console.log('si')
            setTimeout(function(){
                var starting = document.getElementById('starting');
                starting.style.visibility = 'hidden';
                starting.style.opacity = 0;
                setTimeout(function(){
                    starting.style.display = 'none';
                }, 500);
            }, 2000);
        });
        var getGoal = new ROSLIB.Topic({
            ros : ros,
            name : '/move_base_simple/goal',
            messageType : 'geometry_msgs/PoseStamped'
        });
        getGoal.subscribe(function(goal) {
            console.log(goal);
            y = (Math.round(goal.pose.position.y * 100)) / 100;
            x = (Math.round(goal.pose.position.x * 100)) / 100;
            document.getElementById('actualGoal').innerHTML = `(${x}, ${y})`;
            actualGoal = goal;
        });
        var btnAddPose = document.getElementById('buttonAddPose');
        btnAddPose.addEventListener('click', function(){
            document.getElementById('modalAddPose').style.display = 'block';
            document.getElementById('formPose').reset();
            var val = document.getElementById('actualGoal').innerHTML;
            document.getElementById('valueGoalPose').setAttribute('value', val);
        })

        var btnSavePose = document.getElementById('btnSavePoseGoal');
        btnSavePose.addEventListener('click', function(e){
            var title = document.getElementById('poseTitle').value;
            e.preventDefault();
            arrGoals.push(
                {
                    name: title,
                    goal: actualGoal
                }
            );
            console.log(arrGoals);
            axios.post('/setJsonGoals', {
                goal:{
                    name:title,
                    goal:actualGoal
                }
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
            document.getElementById('buttonsBox').innerHTML += `<button class="btnGoal" onclick="sendGoal('${title}')">${title}</button>`;
            document.getElementById('modalAddPose').style.display = 'none';
        })
        var battery_status = new ROSLIB.Topic({
            ros : ros,
            name : '/bat_status',
            messageType : 'sensor_msgs/BatteryState'
        });
        battery_status.subscribe(function(battertyStatus) {
            var maxBattery = 12.75;
            var minBattery = 9.3;
            var maxPerc = maxBattery - minBattery;
            var percentage = 100 - (((12.75 - battertyStatus.voltage) * 100) / maxPerc);
            console.log(percentage);
            //document.getElementById('batteryLevel').style.width = percentage+"%";


            if(percentage > 100){
                document.getElementById('batteryLevel').style.backgroundColor = perc2color(100);
                document.getElementById('batteryLevel').style.width = "100%";
            }else if(percentage <= 1){
                document.getElementById('batteryLevel').style.backgroundColor = perc2color(1);
                document.getElementById('batteryLevel').style.width = "1%";
            }else{
                document.getElementById('batteryLevel').style.backgroundColor = perc2color(percentage);
                document.getElementById('batteryLevel').style.width = percentage+"%";
            }
            // }else if(percentage >= 80 && percentage < 100){
            //     document.getElementById('batteryLevel').style.backgroundColor = '#6cf76c';
            // }else if(percentage >= 60 && percentage < 80){
            //     document.getElementById('batteryLevel').style.backgroundColor = '#c8f86b';
            // }else if(percentage >= 40 && percentage < 60){
            //     document.getElementById('batteryLevel').style.backgroundColor = '#eef76c';
            // }else if(percentage >= 15 && percentage < 40){
            //     document.getElementById('batteryLevel').style.backgroundColor = '#f7b46c';
            // }else if(percentage >= 2 && percentage < 15){
            //     document.getElementById('batteryLevel').style.backgroundColor = '#f76c6c';
            // }else{
            //     document.getElementById('batteryLevel').style.backgroundColor = '#f76c6c';
            //     document.getElementById('batteryLevel').style.width = "1%";
            // }

        });

        function perc2color(perc) {
            var r, g, b = 0;
            if(perc < 50) {
                r = 255;
                g = Math.round(5.1 * perc);
            }
            else {
                g = 255;
                r = Math.round(510 - 5.10 * perc);
            }
            var h = r * 0x10000 + g * 0x100 + b * 0x1;
            return '#' + ('000000' + h.toString(16)).slice(-6);
        }
    </script>
</body>
