<template>
    <div>
        <boxes-component :edit=edit></boxes-component>
        <table-cortes-component></table-cortes-component>
    </div>
</template>

<script>
    export default {
        props : [
            'edit'
        ]
    }
</script>

<style>

</style>