<template>
    <App> 
        <Head>
            <title>Aluguéis</title>
        </Head>

        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                
                <div class="md:w-1/5 ml-auto">
                    <Link :href="$route('rents.create')" class="block button-library mb-7">Criar Aluguel</Link>
                </div>
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">          
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">Livro Alugado</th>
                                    <th scope="col" class="p-4">Nome Usuário</th>
                                    <th scope="col" class="p-4">Inicio</th>
                                    <th scope="col" class="p-4">Final</th>
                                    <th scope="col" class="p-4">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="rent in props.rents" :key="rent.id" class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ rent.book.name }}</th>
                                    <td class="px-4 py-3">{{ rent.user.name }}</td>
                                    <td class="px-4 py-3">{{ rent.dt_rent_start }}</td>
                                    <td class="px-4 py-3 max-w-[12rem] truncate">{{ rent.dt_rent_end  }}</td>
                                    <td class="px-4 py-3 flex items-center gap-2">
                                        <Link :href="$route('rents.edit',[rent.id])" id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                                            <Pencil class="-ml-1 mr-1.5 w-5 h-5" />
                                            Editar
                                        </Link>

                                        <button @click="deleteRent(rent.id)" id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                                            <Trash class="-ml-1 mr-1.5 w-5 h-5" />
                                            Deletar
                                        </button>
                                    
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            
                </div>
            </div>
        </section>      
    </App>
</template>

<script setup>
import {onUpdated, onMounted,defineProps} from 'vue';
import { useForm } from '@inertiajs/vue3';
import App from './components/App.vue';
import { Trash,Pencil } from 'lucide-vue-next';
import Swal from 'sweetalert2';


const props = defineProps({
    rents: {
        type: Object,
        required: true
    },
    errors: Object
})

const form = useForm({});

const deleteRent = (id) => {
    Swal.fire({
        title: `Tem certeza que deseja excluir esse alugúel?`,
        showDenyButton: true,     
        denyButtonText: `Não`,
        confirmButtonText: "Sim"
    }).then((result) => {
        if(result.isConfirmed === true){            
            form.delete(route("rents.destroy",id,{
                preserveScroll: true,
            }));

        }
    });
}

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
})



</script>