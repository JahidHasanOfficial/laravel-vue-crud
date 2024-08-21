<template>
    <div class="container">
      <router-link :to="{ name: 'AddNew' }" class="btn btn-primary mb-3">Add new</router-link>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>

          </tr>
        </thead>
        <tbody>
          <tr v-for="(product, index) in products" :key="product.id">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ product.name }}</td>
            <td>{{ product.price }}</td>
            <td>{{ product.quantity }}</td>
            <td>
                <router-link :to="{ name: 'Edit', params: { id: product.id } }" class="btn btn-primary">Edit</router-link>
                <button class="btn btn-danger" @click="destory(product.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        products: []
      };
    },

    mounted() {
      this.ProductList();
    },

    methods: {
      ProductList() {
        axios.get('/api/product')
          .then(response => {
            // Directly assign the array of products to this.products
            console.log('API response:', response.data);
            this.products = response.data; // Assign the response directly to products
          })
          .catch(error => {
            console.error('API request failed:', error);
          });
      },
      destory(id) {
        axios.delete(`/api/product/${id}`)
          .then((success) => {
           console.log(success);
            this.ProductList();
          })
          .catch(error => {
            console.error('API request failed:', error);
          });
      }
    }
  };
  </script>

  <style scoped>
  .table {
    margin-top: 20px;
  }
  </style>
