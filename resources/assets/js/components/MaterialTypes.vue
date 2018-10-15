<template>
    <div class="material-types">
        <div v-if="errored" class="p-5">
                Упс! Что-то пошло не так...
        </div>
        <div v-else class="list-group list-group-flush">
            <div v-if="loading" class="list-group-item">
                Грузим, грузим
            </div>
            <div v-else v-for="type in types" :key="type.id" class="list-group-item">
                {{ type.name }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                types: null,
                loading: true,
                errored: false
            };
        },
        mounted() {
            axios
            .get('/api/material-types')
            .then(response => (this.types = response))
            .catch(error => {
                console.log(error);
                this.errored = true;
            })
            .finally(() => (this.loading = false));
        }
    }
</script>