<template>
    <App> 
        <Head>
            <title>{{ props.book.name }}</title>
        </Head>
        
        <div class="w-full px-2 dm:px-4 sm:w-2/4 mx-auto">
            <form @submit.prevent="submitForm">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="bookName" class="block text-sm font-medium leading-6 text-gray-900">Nome Livro</label>
                        <div class="mt-2">
                            <input type="text" name="bookName" id="bookName" v-model="form.name" class="input-library w-full">
                        </div>
                    </div>
                </div>

                <button type="submit" class="button-library sm:w-2/4 mt-7">Atualizar</button>


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
    book: {
        type: Object,
        required: true
    },
    errors: Object,
    flash: Object
});

const form = useForm({
    id: props.book.id,
    name: props.book.name,
    cpf: props.book.cpf    
})

const submitForm = () => {
    console.log(form)

    form.put(route("books.update",form.id,{
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
            router.visit(route('books.index'), {
                method: 'get'
            });
        });
    }
})

</script>