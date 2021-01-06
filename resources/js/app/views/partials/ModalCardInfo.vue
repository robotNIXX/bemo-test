<template>
    <modal name="card-info-modal" transition="pop-out">
        <div class="modal-content columns">
            <div class="modal-header">{{ card.title }}</div>
            <div class="modal-body">
                <p>
                    {{ card.description }}
                </p>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    name: "ModalCardInfo",
    props: {
        card: {
            title: "",
            description: ""
        }
    }
}
</script>

<style scoped>

</style>
