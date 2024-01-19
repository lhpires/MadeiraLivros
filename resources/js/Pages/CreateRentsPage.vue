<template>
    <App> 
        <Head>
            <title>Cadastrar Novo Aluguel</title>
        </Head>

        <section class="w-full px-5 md:p-0 md:w-2/4 mx-auto">
            
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

                <button type="submit" class="button-library my-7">Cadastrar</button>

            </form>


        </section>


      
    </App>
</template>

<script setup>
import {onUpdated,defineProps} from 'vue';
import { useForm,router } from '@inertiajs/vue3';
import App from './components/App.vue';
import Swal from 'sweetalert2';

const dateToday = new Date().toISOString().split('T')[0]

const props = defineProps({
    books: {
        type: Object,
        required: true
    },
    users: {
        type: Object,
        required: true
    },
    errors: {
        type: Object,
        required: false
    },
    flash: {
        type: Object,
        required: false
    }
});

const form = useForm({
    user: '',
    book: '',
    dt_ini: '',
    dt_end: ''
});



const submitForm = () => {
    form.post(route("rents.store",form,{
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