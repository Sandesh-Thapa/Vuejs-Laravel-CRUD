<template>
<div class="col-6">
    <div class="card text-center">
        <div class="card-header bg-dark text-white">
            Task List
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tasks</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr v-for="(task, index) in tasks" :key="index">
                        <td>{{ ++index }}</td>
                        <td>
                            {{ task.title }}
                            <span :class="[task.completed == 1 ? 'badge bg-success' : 'badge bg-warning text-dark' ]">
                                {{ task.completed == 1 ? 'Complete' : 'Incomplete' }}
                            </span>
                        </td>

                        <td>
                            <span class="text-danger">
                                <i title="Delete" style="cursor:pointer" class="fas fa-trash" @click="funcEdit(task, 'delete')" ></i>
                            </span>

                            <span class="text-warning">
                                <i title="Edit" style="cursor:pointer" class="fas fa-edit" @click="funcEdit(task, 'edit')"></i>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <!-- Modal -->
                <div class="modal-wrapper" v-if="editModel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                                <button type="button" class="btn-close" aria-label="Close"  @click="editModel = false"></button>
                            </div>
                            <div class="modal-body">
                                Change the value and click Edit Task
                                <form @submit.prevent="editTask()" name="myForm" id="myForm">
                                    <div class="mb-3">
                                        <input 
                                        type="text" class="form-control" 
                                        placeholder="Edit Task ..."
                                        name="title"
                                        v-model="task.title"
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <input   
                                        type="checkbox" 
                                        name="completed"
                                        class="form-check-input"  
                                        :checked="task.completed ? true : false"                                                    
                                        >
                                        <label class="form-check-label">Mark as Complete</label>
                                    </div>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit Task
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal-wrapper" v-if="deleteModel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Task</h5>
                                <button type="button" class="btn-close" aria-label="Close" @click="deleteModel = false"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete a task '{{ task.title }}' ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="deleteModel = false">No</button>
                                <form @submit.prevent="deleteTask(task.id)">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Yes, Delete it
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['tasks'],
    data(){
        return{
            editModel: false,
            deleteModel: false,
            task : {
                        id: "",
                        title: "",
                        completed: false
                    }
        }
    },
    methods:{
        funcEdit(item, handler){
            if (handler == 'edit') {
                this.task.title = item.title;
                this.task.id = item.id;
                this.task.completed = item.completed ? true : false;
                this.editModel = true;
            }else{
                this.task.title = item.title;
                this.task.id = item.id;
                this.deleteModel = true;
            }
        },

        deleteTask(id){
            axios.delete(`/tasks/${id}`)
            .then(res => {
                alert(res.data);
                this.deleteModel = false;
            })
            .catch(err => console.log(err));
        },

        editTask(){
            let myForm = document.getElementById('myForm');
            let formData = new FormData(myForm);
            this.task.completed = formData.get('completed') ? true : false;
            axios.put(`/tasks/${this.task.id}`, this.task)
            .then(res => {
                alert(res.data);
                this.editModel = false;
            })
            .catch(err => console.log(err));

            
        }
    }
}
</script>

<style scoped>
    .modal-wrapper{
        background: rgba(33, 37, 41, 0.7);
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        z-index: 10;
        height: 100%;
    }
</style>

