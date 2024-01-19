<template>
    <App> 
        <Head>
            <title>{{ props.user.name }}</title>
        </Head>
        
        <div class="w-2/4 mx-auto">
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

                <button type="submit" class="button-library mt-7">Atualizar</button>


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
    user: {
        type: Object,
        required: true
    },
    errors: Object,
    flash: Object
});

const form = useForm({
    id: props.user.id,
    name: props.user.name,
    cpf: props.user.cpf    
})

const submitForm = () => {
    console.log(form)

    form.put(route("users.update",form.id,{
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
            router.visit(route('users.index'), {
                method: 'get'
            });
        });
    }
})




</script>