<template>
<div class="row">
    <latest-task :latest="latestTasks" />
    <ListTask :tasks="allTasks" v-on:addedTask="getAll()" />
    <wrapper :complete="complete" :incomplete="incomplete" :total="total" />
</div>
</template>

<script>
import LatestTask from './LatestTask.vue'
import ListTask from './ListTask.vue'
import Wrapper from './right-section/Wrapper.vue'


export default {
    components: {
        LatestTask,
        ListTask,
        Wrapper
    },
    
    data: () => {
        return {
            allTasks: [],
            latestTasks: [],
            complete: 0,
            incomplete: 0,
            total: 0
        }
    },

    methods: {
        getAll(){
            axios.get('/tasks')
            .then(res => {
                this.complete = res.data.complete;
                this.incomplete = res.data.incomplete;
                this.total = res.data.total;
                this.latestTasks = res.data.latest;
                this.allTasks = res.data.tasks.data;
                console.log('From Home: ', res.data);
            })
            .catch(err => {
                console.log(err);
            })
        }
    },
    created(){
        this.getAll();
    }
}
</script>
