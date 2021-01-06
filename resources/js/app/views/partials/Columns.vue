<template>
    <div class="container">
        <div class="columns-header">
            <h3>Cards list</h3>
            <a class="btn btn-primary" @click="showColumnModal">Add Column</a>
        </div>
        <ul v-if="columns" class="columns-list">
            <li v-for="(column, index) in columns">
                <div class="header-column">
                    {{ column.title }}

                    <a v-if="column.is_default"><i class="fas fa-plus-square" @click="showCardModal(column)"></i> </a>
                </div>
                <div class="column-content">
                    <ul v-if="column.cards" class="cards-list">
                        <li v-for="card in column.cards">
                            {{ card.title }}
                            <i v-if="card.weight > 1" class="fas fa-chevron-circle-up" @click="moveToWeight(card,card.weight - 1)"></i>
                            <i v-if="index < (columns.length - 1)" class="fas fa-chevron-circle-right"></i>
                            <i v-if="card.weight < column.cards.length" class="fas fa-chevron-circle-down" @click="moveToWeight(card,card.weight + 1)"></i>
                            <i v-if="index > 0" class="fas fa-chevron-circle-left"></i>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <modal-column @saveColumn="saveColumn" :errors="errors"></modal-column>
        <modal-card @saveCard="saveCard" :errors="cardErrors"></modal-card>
    </div>
</template>

<script>
import ModalColumn from "./ModalColumn";
import ModalCard from "./ModalCard";

export default {
    name: "Columns",
    components: {ModalCard, ModalColumn},
    data: function () {
        return {
            errors: null,
            cardErrors: null,
            selectedColumn: null
        }
    },
    mounted() {
        this.$store.dispatch('GET_ALL_COLUMNS')
    },
    computed: {
        columns() {
            return this.$store.getters.columns
        }
    },
    methods: {
        showColumnModal: function () {
            this.$modal.show('column-form')
        },
        showCardModal: function (column) {
            this.selectedColumn = column
            this.$modal.show('card-form')
        },
        saveColumn(column) {
            let that = this
            this.$store.dispatch('CREATE_COLUMN', column).then(function (response) {
                that.$modal.hide('column-form')
            }, function (error) {
                that.errors = error.response.data.errors
            });
        },
        moveToWeight: function(card, weight) {

        },
        saveCard(card) {
            let that = this
            card.column_id = this.selectedColumn.id
            this.$store.dispatch('APPEND_THE_CARD', card).then(function (response) {
                that.$modal.hide('card-form')
            }, function (error) {
                that.cardErrors = error.response.data.errors
            });
        }
    }
}
</script>

<style scoped>

</style>
