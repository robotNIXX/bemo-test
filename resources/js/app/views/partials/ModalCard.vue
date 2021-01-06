<template>

    <modal name="card-form" transition="pop-out">
        <div class="modal-content columns">
            <div class="modal-header">CREATE CARD</div>
            <div class="modal-body">
                <div class="form-content form-vertical">
                    <div class="form-group">
                        <input type="text" v-model="card.title" placeholder="Card Title"></input>
                        <div class="error-input-message" v-if="errors && errors['card.title']">
                            <div v-for="message in errors['card.title']">
                                {{ message }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea v-model="card.description" rows="5" style="resize: none;"></textarea>
                        <div class="error-input-message" v-if="errors && errors['card.description']">
                            <div v-for="message in errors['card.description']">
                                {{ message }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" @click="saveCard">Save</button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    name: "ModalCard",
    props: {
        errors: {}
    },
    data: function () {
        return {
            card: {}
        }
    },
    methods: {
        saveCard: function () {
            this.$emit('saveCard', this.card)
        }
    }
}
</script>

<style scoped>

</style>
