<template>
    <App> 
        <Head>
            <title>Cadastrar Novo Usuário</title>
        </Head>
        
        <section class="w-full px-5 md:p-0 md:w-2/4 mx-auto">
            
            <form @submit.prevent="submitForm">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Nome Usuário</label>
                        <div class="mt-2">
                        <input type="text" name="username" id="username" v-model="form.name" class="input-library">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="userCpf" class="block text-sm font-medium leading-6 text-gray-900">CPF</label>
                        <div class="mt-2">
                        <input type="text" name="userCpf" id="userCpf" v-model="form.cpf" class="input-library">
                        </div>
                    </div>
                </div>

                <button type="submit" class="button-library mt-7">Cadastrar</button>

            </form>


        </section>


      
    </App>
</template>

<script setup>
import {onUpdated,defineProps} from 'vue';
import { useForm } from '@inertiajs/vue3';
import App from './components/App.vue';
import Swal from 'sweetalert2';

const props = defineProps({
    errors: {
        type: Object,
        required: false
    }
});

const form = useForm({
    name: '',
    cpf: ''    
});



const submitForm = () => {
    console.log(form);
    form.post(route("users.store",form.id,{
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
});



</script>