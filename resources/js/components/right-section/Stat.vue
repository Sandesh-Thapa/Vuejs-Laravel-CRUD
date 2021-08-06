<template>
<div class="card text-center">
    <div class="card-header bg-dark text-white">
        Tasks Stats
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-body">
                Total Task: {{total}}
            </div>
            <div class="card-body">
                Completed Task: {{complete}}
            </div>
            <div class="card-body">
                Incomplete Task: {{incomplete}}
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['complete', 'incomplete', 'total']
}
</script>

<style>

</style>