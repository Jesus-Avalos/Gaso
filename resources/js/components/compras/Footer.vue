<template>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered w-50 float-right">
                <tbody>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td>
                            $ {{ total }}
                            <input type="hidden" name="total" :value="total">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <button class="btn btn-success float-right">Realizar compra</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['total']
}
</script>

<style>

</style>