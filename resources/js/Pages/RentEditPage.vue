<template>
    <App> 
        <Head>
            <title>{{ props.rent.id }}</title>
        </Head>
        
        <div class="w-2/4 mx-auto">
            <form @submit.prevent="submitForm">


                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-3">
                        <label for="user" class="block text-sm font-medium leading-6 text-gray-900">Selecionar usuário</label>
                        <div class="mt-2">
                            <select name="user" v-model="form.user" id="user" class="input-library">
                                <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="book" class="block text-sm font-medium leading-6 text-gray-900">Selecionar Livro</label>
                        <div class="mt-2">
                            <select name="book" v-model="form.book" id="book" class="input-library">
                                <option v-for="book in books" :key="book.id" :value="book.id">{{book.name}}</option>
                            </select>
                        </div>
                    </div>


                    <div class="sm:col-span-3">
                        <label for="dt_ini" class="block text-sm font-medium leading-6 text-gray-900">Data Inicio Aluguel</label>
                        <div class="mt-2">
                            <input type="date" v-model="form.dt_ini" name="dt_ini" id="dt_ini" :min="dateToday"  class="input-library">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="dt_end" class="block text-sm font-medium leading-6 text-gray-900">Data Término Aluguel</label>
                        <div class="mt-2">
                            <input type="date" v-model="form.dt_end" name="dt_end" id="dt_end" :min="dateToday"  class="input-library">
                        </div>
                    </div>

                </div>

                <button type="submit" class="button-library my-7">Atualizar</button>
           


            </form>

           


        </div>

    </App>
</template>

<script setup>
import {defineProps,onUpdated} from 'vue';
import { useForm,router } from '@inertiajs/vue3';
import App from './components/App.vue';
import Swal from 'sweetalert2';


const props = defineProps({
    rent: {
        type: Object,
        required: true
    },
    books: {
        type: Object,
        required: true
    },
    users: {
        type: Object,
        required: true
    },
    errors: Object,
    flash: Object
});

const form = useForm({
    id: props.rent.id,
    book: props.rent.book.id,
    user: props.rent.user.id,
    dt_ini: props.rent.dt_rent_start,
    dt_end: props.rent.dt_rent_end
})

const submitForm = () => {
    form.put(route("rents.update",form.id,{
        preserveScroll: true,
    }));

};

onUpdated( () => {
    if(props.errors && Object.keys(props.errors).length !== 0){
        const sweetErrosKeys = Object.keys(props.errors);
        const sweetErrors = sweetErrosKeys.map(chave => {
            return `${props.errors[chave]}`;
        });
        if(sweetErrors.length){
            Swal.fire({
                title: "Opps",
                html: sweetErrors.join("<br>"),
                icon: "error"
            });
        }
    }

    if(props.flash.success){
        Swal.fire({
            title: "Uhul",
            html: props.flash.success,
            icon: "success"
        }).then(()=>{
            router.visit(route('rents.index'), {
                method: 'get'
            });
        });
    }
})


</script>