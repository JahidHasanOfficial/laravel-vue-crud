import{createRouter,createWebHistory} from 'vue-router';
import AddNew from './../components/AddNew.vue';
import List from './../components/List.vue';
import Edit from './../components/Edit.vue';

const routes = [

    {  path:'/', name:'List', component:List  },
    {  path:'/add-new', name:'AddNew', component:AddNew   },
    {  path:'/edit/:id', name:'Edit', component:Edit  }
]


const router = createRouter({
    history:createWebHistory(),
    routes
});
export default router

