<template>
  <div class="col-3">
    <div class="card text-center">
        <div class="card-header bg-dark text-white">
            Latest Tasks
        </div>
        <div v-for="(task, index) in latest" :key="index" class="card-body">
           <div class="card">
                <div class="card-body">
                    {{ task.title }}
                    <span :class="[task.completed == 1 ? 'badge bg-success' : 'badge bg-warning text-dark' ]">
                        {{ task.completed == 1 ? 'Complete' : 'Incomplete' }}
                    </span>
                </div>
            </div> 
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['latest']
}
</script>

<style>

</style>