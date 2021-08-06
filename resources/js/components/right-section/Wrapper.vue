<template>
<div class="col-3">
    <Form v-on:taskAdded = "$emit('addedTask')" />
    <Stat :complete="complete" :incomplete="incomplete" :total="total" />
</div>
</template>

<script>
import Form from './Form.vue'
import Stat from './Stat.vue'
export default {
    props: ['complete', 'incomplete', 'total'],
    components: {
        Form,
        Stat
    }
}
</script>
