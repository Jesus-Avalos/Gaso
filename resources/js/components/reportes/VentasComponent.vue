<template>
    <tr>
        <td><a :href="'/'+tipo+'/show/' + dato.id" class="btn btn-info btn-sm"><i class="fas fa-bars"></i></a></td>
        <td>{{ dato.id }}</td>
        <td>{{ tipo }}</td>
        <td><strong>$ {{ dato.total }}</strong></td>
        <td>{{ dato.created_at }}</td>
        <td>{{ dato.status }}</td>
    </tr>
</template>

<script>
export default {
    props: ['dato','tipo']

}
</script>

<style>

</style>