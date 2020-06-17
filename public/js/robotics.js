
        document.getElementById('btnMenu1').style.backgroundColor = '#681be5';
        document.getElementById('btnMenu1').style.color = '#ffffff';


        function activeBtn(btn, content){
                var btns = document.querySelectorAll('.btnMenu');
                btns.forEach(btn => {
                    btn.style.background = '#F8F9FA';
                    btn.style.color = '#000000';
                });
                document.getElementById(btn).style.backgroundColor = '#681be5';
                document.getElementById(btn).style.color = 'white';

                var primaryContents = document.querySelectorAll('.primaryContent');

                primaryContents.forEach(content => {
                    content.style.display = 'none';
                });
                document.getElementById(content).style.display = 'block';
            }


            /* axios.post('/user', {
                firstName: 'Fred',
                lastName: 'Flintstone'
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });

            */


        axios.get('/getTasks')
        .then(function (response) {
            // handle success
            var divTasksDashboard = document.getElementById('bodyModalTasksDashboard');
            var divTasksMission = document.getElementById('bodyModalTasksMission')
            console.log(response.data);
            response.data.forEach(task => {
                if(task.type == 1){
                    var templateDashboard = `
                    <button onclick="sendGoalTime('${task.goal_name}', ${task.wait_time})" class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2">
                        <span>${task.goal_name}</span>
                    </button>
                `;
                }else{
                    var templateDashboard = `
                    <button onclick="sendGoalPosition('${task.goal_name}', ${task.x}, ${task.y})" class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2">
                        <span>${task.goal_name}</span>
                    </button>
                `;
                }

                var templateMission = `
                    <div class="boxInfoModal col-3 mx-1 p-1 text-center border rounded my-2">
                        <span>${task.goal_name}</span>
                    </div>
                `;

                divTasksDashboard.innerHTML = divTasksDashboard.innerHTML.concat(templateDashboard);
                divTasksMission.innerHTML = divTasksMission.innerHTML.concat(templateMission);
            });
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });

            /*
                <button class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2">
                    <h6>Mission 1</h6>
                    <span>
                        Ir a posicion 1 <br> Ir a posicion 2
                    </span>
                </button>
            */

        axios.get('/getMissions')
        .then(function (response) {

            // handle success
            console.log(response.data);
            var missions = response.data;
            var boxMissionDashboard = document.getElementById('dashboardMissionBox');
            response.data.forEach(mission => {
                let tasksInfo = "";
                mission.tasks.forEach(taskM => {
                    tasksInfo = tasksInfo+"<br>"+taskM.goal_name;
                });
                var templateDashboardMS = `
                <button class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2" onclick="sendMission(${mission.id})">
                    <h6>${mission.name}</h6>
                    <span>
                        ${tasksInfo}
                    </span>
                </button>
                `;
                boxMissionDashboard.innerHTML = boxMissionDashboard.innerHTML.concat(templateDashboardMS);
            });
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });
