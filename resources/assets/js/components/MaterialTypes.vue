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
                <div class="d-flex align-items-center justify-content-between">
                    {{ type.name }}
                    <div>
                        <span class="fa fa-2x fa-close text-danger mr-2" data-toggle="tooltip" data-placement="left" title="Удалить" v-on:click.self="del(type.id)"></span>
                        <span class="fa fa-2x fa-edit text-primary" data-toggle="tooltip" data-placement="right" title="Изменить" v-on:click.self="edit(type.id)"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        el: '#materialTypes',
        data() {
            return {
                types: null,
                loading: true,
                errored: false
            };
        },
        methods: {
            del: function(id) {
                var instance = axios.create({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                instance
                .post('/api/material-type/' + id + '/delete')
                .then(() => (alert('Тип материала успешно обновлен')))
                .catch(error => {
                    console.log(error);
                    alert('Не удалось удалить тип материала');
                })
                .finally(() => {
                    location.reload();
                });
            },
            add: function(name) {
                alert(name);
            },
            edit: function(id) {
                alert(id);
            },
            save: function() {

            }
        },
        mounted() {
            var instance = axios.create({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            instance
            .get('/api/material-types')
            .then(response => {
                this.types = response.data;
                console.log(response.headers);
            })
            .catch(error => {
                console.log(error);
                this.errored = true;
            })
            .finally(() => (this.loading = false));
        }
    }
</script>