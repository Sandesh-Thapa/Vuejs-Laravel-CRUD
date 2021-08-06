<template>
  <div class="card text-center mb-3">
    <div class="card-header bg-dark text-white">
        Add Task
    </div>
    <div class="card-body">
        <form @submit.prevent="addTask">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Enter Task ..."
                    autocomplete="off" v-model="task.title">
            </div>
            
            <p class="text-danger">
                <strong></strong>
            </p>
            
            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-sm">Add Task</button>
            </div>
        </form>
    </div>
</div>
</template>

<script>

export default {
    data(){
        return {
            task: {title: ''}
        }
    },
    methods: {
        addTask(){ 
            axios.post('/tasks', this.task)
            .then(res => {
                if (res.status == 201){
                    this.task.title = ''; 
                    alert('Task added successfully');
                    this.$emit('taskAdded');
                }
            })
            .catch(err => console.log(err));
        }
    }

}
</script>
