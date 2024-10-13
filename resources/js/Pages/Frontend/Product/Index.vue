<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
defineProps({
    products: Array,
    filteredProducts: Array
});

const form  = useForm({

})
function deleteProduct(productId){
    if(confirm("Are you sure you want to delete this product?")){
        form.delete(route('products.destroy', productId));
    }
}

</script>

<template>
    <AuthenticatedLayout>
        <Head title="Index" />

    <div>Products page</div>
    <Link :href="route('products.create')">Create Product</Link>
    <table>
        <thead>
            <tr>
                <th>ID of owner</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
        
            <tr v-for="(product,index) in products" :key="index">
                <td>{{ product.user_id }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.description }}</td>
                <div v-if="product.image">
                <img :src="`/storage/${product.image}`" alt="Product Image" class="img-fluid" />
                </div>
                <td>
                    <Link :href="route('products.edit', product.id )">Edit</Link>
                </td>
                <td>
                    <button
                    type="submit"
                    @click="deleteProduct(product.id)"
                    >
                        Delete
                    </button>
                </td>
            
            </tr>
            

        </tbody>
        <tbody>
        
            <tr v-for="(product,index) in products" :key="index">
                <td>{{ product.user_id }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.description }}</td>
                <div v-if="product.image">
                <img :src="`/storage/${product.image}`" alt="Product Image" class="img-fluid" />
                </div>
                <td>
                    <Link :href="route('products.edit', product.id )">Edit</Link>
                </td>
                <td>
                    <button
                    type="submit"
                    @click="deleteProduct(product.id)"
                    >
                        Delete
                    </button>
                </td>
            
            </tr>
            

        </tbody>
    </table>
    </AuthenticatedLayout>
        
</template>
<style>
    table th, table td{
        border: solid;
    }

</style>
