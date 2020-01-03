<template>
  <option :value=ing.id>{{ ing.nombre }}</option>
</template>

<script>
export default {
    props: ['ing'],
    mounted(){
      $('.selectpicker').selectpicker('refresh');
    }
}
</script>

<style>

</style>