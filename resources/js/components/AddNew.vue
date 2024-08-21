<template>
    <div class="container">
        <div>
            <router-link :to="{ name: 'List' }">List</router-link>

            <form @submit.prevent="storeData">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" v-model="formData.name">
                    <span class="text-danger" v-for="(error, index) in formError.name" :key="index">{{ error }}</span>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" v-model="formData.price">
                    <span class="text-danger" v-for="(error, index) in formError.price" :key="index">{{ error }}</span>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" v-model="formData.quantity">
                    <span class="text-danger" v-for="(error, index) in formError.quantity" :key="index">{{ error }}</span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            formData: {
                name: '',
                price: '',
                quantity: ''
            },
            formError: {
                name: [],
                price: [],
                quantity: []
            }
        }
    },
    methods: {
        storeData() {
            axios.post('/api/product', this.formData)
                .then(response => {
                    console.log(response.data);
                    this.clearForm();
                    this.$router.push({ name: 'List' });
                })
                .catch(error => {
                    if (error.response && error.response.data.errors) {
                        this.formError.name = error.response.data.errors.name || [];
                        this.formError.price = error.response.data.errors.price || [];
                        this.formError.quantity = error.response.data.errors.quantity || [];
                    }
                });
        },
        clearForm() {
            this.formData = {
                name: '',
                price: '',
                quantity: ''
            };
            this.formError = {
                name: [],
                price: [],
                quantity: []
            };
        }
    }
}
</script>

<style scoped>
.text-danger {
    color: red;
}
</style>
