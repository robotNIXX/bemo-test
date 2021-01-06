<template>
    <modal name="column-form" transition="pop-out">
        <div class="modal-content columns">
            <div class="modal-header">CREATE COLUMN</div>
            <div class="modal-body">
                <div class="form-content form-vertical">
                    <div class="form-group">
                        <input type="text" v-model="column.title" placeholder="Column Title"></input>
                        <div class="error-input-message" v-if="errors && errors['column.title']">
                            <div v-for="message in errors['column.title']">
                                {{ message }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" v-model="column.is_default"></input>
                        <label>Set default</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" @click="createColumn">Save</button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    name: "ModalColumn",
    props: {
        errors: {}
    },
    data: function () {
        return {
            column: {
                title: ''
            }
        }
    },
    methods: {
        createColumn: function () {
            this.$emit('saveColumn', this.column)
        }
    }
}
</script>

<style scoped>

</style>
