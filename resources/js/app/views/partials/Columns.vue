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
                            <i v-if="card.weight > 1" class="fas fa-chevron-circle-up"
                               @click="moveToWeight(card,card.weight - 1)"></i>
                            <i v-if="index < (columns.length - 1)" @click="moveToColumn(card,  (index + 1))"
                               class="fas fa-chevron-circle-right"></i>
                            <i v-if="card.weight < column.cards.length" class="fas fa-chevron-circle-down"
                               @click="moveToWeight(card,card.weight + 1)"></i>
                            <i v-if="index > 0" class="fas fa-chevron-circle-left"
                               @click="moveToColumn(card,  (index - 1))"></i>
                            <div class="view-card">
                                <i class="fas fa-eye" @click="showCardInfo(card)"></i>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <modal-column @saveColumn="saveColumn" :errors="errors"></modal-column>
        <modal-card @saveCard="saveCard" :errors="cardErrors"></modal-card>
        <modal-card-info :card="currentCard"></modal-card-info>
    </div>
</template>

<script>
import ModalColumn from "./ModalColumn";
import ModalCard from "./ModalCard";
import ModalCardInfo from "./ModalCardInfo";

export default {
    name: "Columns",
    components: {ModalCardInfo, ModalCard, ModalColumn},
    data: function () {
        return {
            errors: null,
            cardErrors: null,
            selectedColumn: null,
            currentCard: null
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
        moveToWeight: function (card, weight) {
            this.$store.dispatch('MOVE_TO_WEIGHT', {card: card, weight: weight});
        },
        moveToColumn: function (card, index) {
            this.$store.dispatch('MOVE_TO_COLUMN', {card: card, column: this.columns[index]});
        },
        showCardInfo: function (card) {
            this.currentCard = card
            this.$modal.show('card-info-modal')
        },
        saveCard: function (card) {
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
