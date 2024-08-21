<template>
    <div class="container">
        <div>
            <router-link :to="{ name: 'List' }">List</router-link>

            <form @submit.prevent="updateData">
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
                name: '',
                price: '',
                quantity: ''
            }
        };
    },
    mounted() {
        this.edit();
    },
    methods:{
        edit(){
            axios.get(`/api/product/` + this.$route.params.id)
            .then((success) => {
              //  console.log(success);
                this.formData = success.data;
            }).catch((error) => {
                console.log(error);
            })
        },
        updateData() {
            axios.put(`/api/product/` + this.$route.params.id, this.formData)
                .then((success) => {
                   // console.log(success);
                    this.$router.push({ name: 'List' });
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
 };
</script>

<style scoped>
.text-danger {
    color: red;
}
</style>
