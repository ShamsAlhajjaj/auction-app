<template>
    <Head title="Create" />
    <AuthenticatedLayout>

        <div>Create page</div>
        <div>{{ $page.props.auth.user.id }}</div>
        <Link :href="route('products.index')">Back</Link><br>
        <form @submit.prevent="saveProduct()">
            <label>Product Name</label>
            <input v-model="form.name" type="text" /><br>
            <label>Product description</label>
            <input v-model="form.description" type="text" /><br>
            <label>Product image</label>
            <input v-model="form.image" type="text" /><br>
            <label>user_id</label>
            <input v-model="form.user_id" type="text">

            <input type="file" @input="form.avatar = $event.target.files[0]" />
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
            </progress><br>

            <button type="submit">Save</button>
        </form>
    </AuthenticatedLayout>


</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// const user = computed(() => page.props.auth.user)
const form = useForm({
    name: '',
    description: '',
    image: '',
    user_id: '',
});
function saveProduct(){
    const res = form.post(route('products.store'));
    if(res){
        form.reset();
    }
}

</script>

<!-- <script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { usePage } from '@inertiajs/inertia-vue3';

// const { auth } = usePage().props.value;

const form = useForm({
    user_id: 1,
    name: '',
    description: '',
    image: null,
});

const submitForm = () => {
    form.post('/products', {
        forceFormData: true, // Ensures that the form data is sent as multipart/form-data
    });
};
</script> -->

<!-- <template>
    <form @submit.prevent="submitForm">
        <input v-model="form.name" type="text" placeholder="Product Name" class="form-control mb-2" />
        <input v-model="form.description" type="text" placeholder="Product Description" class="form-control mb-2" />
        <input type="file" @change="e => form.image = e.target.files[0]" class="form-control mb-2" />
        <input v-model="form.user_id" type="hidden" />
        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</template> -->

