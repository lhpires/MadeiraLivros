<template>    
    <nav class="bg-madeiraBackground border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="container mx-auto">
            <div class="flex flex-wrap justify-around items-center mx-auto max-w-screen-xl">
                <a href="https://flowbite.com" class="flex items-center">
                    <Link :href="$route('homeSweetHome')" target="_blank"><img class="mr-3 h-6 sm:h-9" :src="$page.props.appUrl + '/logoMadeira.png'" /></Link>
                </a>            
                <div class="block justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-wrap items-center justify-center flex-row mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li v-for="appLink in appLinks" :key="appLink.id">
                            <Link :href="$route(appLink.url)" class="block py-2 pr-4 pl-3 text-gray-700 hover:text-madeiraMadeiraPrimary transition-colors duration-150 ease-in-out rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0" aria-current="page">{{appLink.name}}</Link>
                        </li>
                        <li>
                            <button @click="makeReport" class="block button-library">Exportar Aluguéis</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>     
    </nav>
</template>

<script setup>
import { appLinks } from '../../data/appLinks';
import { useForm } from '@inertiajs/vue3';



const form = useForm({});


const makeReport = () => {
    form.post(route("report",form,{
        preserveScroll: true,
    }));
}

</script>