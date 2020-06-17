<template>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
          <div class="sidebar-heading">Aprosoft</div>
          <div class="list-group list-group-flush">

            <button class="list-group-item btnMenu" id="btnMenu1" @click="activeBtn('btnMenu1'); currentComponent = 'Dashboard'">Dashboard</button>
            <button class="list-group-item btnMenu" id="btnMenu2" @click="activeBtn('btnMenu2'); currentComponent = 'Mission'">Mission</button>
            <button class="list-group-item btnMenu" id="btnMenu3" @click="activeBtn('btnMenu3'); currentComponent = 'Status'">Status</button>

          </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
        <!-- Inactive components will be cached! -->
            <headerComponent></headerComponent>
            <keep-alive>
                <transition name="component-fade" mode="out-in">
                    <component v-bind:is="currentComponent"></component>
                </transition>
            </keep-alive>
        </div>
    </div>
</template>

<script>
    import Dashboard from './DashboardComponent.vue'
    import Mission from './MissionComponent.vue'
    import Status from './StatusComponent.vue'
    import headerComponent from './HeaderComponent.vue'
    export default {
        mounted() {
            console.log('Component mounted.');
            document.getElementById('btnMenu1').style.background = 'linear-gradient(to right, #8111f9, #6175e8)';
            document.getElementById('btnMenu1').style.color = '#ffffff';
        },
        components:{
            Dashboard, Mission, Status, headerComponent
        },
        data(){
            return{
                currentComponent: 'Dashboard',
            }
        },

        methods:
        {
            activeBtn(btn){
                var btns = document.querySelectorAll('.btnMenu');
                btns.forEach(btn => {
                    btn.style.background = '#F8F9FA';
                    btn.style.color = '#000000';
                });



                 document.getElementById(btn).style.background = 'linear-gradient(to right, #8111f9, #6175e8)';
                document.getElementById(btn).style.color = 'white';
            }
        }
    }
</script>
