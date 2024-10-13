<style>
    table th, table td {
        border: solid;
    }
</style>
<template>
    <Head title="Edit" />
    <div>Edit page</div>
    <Link :href="route('products.index')">Back</Link><br>
    <form @submit.prevent="updateProduct()">
        <label>Product Name</label>
        <input v-model="form.name" type="text" /><br>
        <label>Product Price</label>
        <input v-model="form.price" type="number" />
        <button type="submit">Update</button>
    </form>

</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    product: Object
});
console.log(props);
const form = useForm({
    name:  product.name,
    price: product.price
});
function updateProduct(){
    const res = form.put(route('products.update', props.product.id));
    if(res){
        form.reset();
    }
}
</script>
