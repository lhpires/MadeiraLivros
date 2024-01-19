<template>    
    <!-- This is an example component -->
    <div class="bg-madeiraMadeiraRusset">
        <div class="max-w-2xl mx-auto text-white py-10">
            <div class="text-center">
                <h3 class="text-3xl mb-5 flex items-center gap-2 justify-center"> Madeira Livros <LibraryBig :stroke-width="1.5" /></h3>
                <p> Alugue nossos livros. </p>
                <div class="flex justify-center my-10">
                    <a href="https://www.pires.dev.br/" target="_blank" class="flex items-center border w-auto rounded-lg px-4 py-2 mx-2">
                        <img src="https://www.pires.dev.br/images/lhpires.png" class="w-7 md:w-10 rounded-full">
                        <div class="text-left ml-3">
                            <p class="text-sm md:text-base"> Portifólio </p>
                        </div>
                    </a>
                    <a href="https://www.livt.pires.dev.br/" target="_blank" class="flex items-center border w-auto rounded-lg px-4 py-2 mx-2">
                        <img src="https://www.pires.dev.br/images/lhpires.png" class="w-7 md:w-10 rounded-full">
                        <div class="text-left ml-3">
                            <p class="text-sm md:text-base"> Portifólio (LIVT) </p>
                        </div>
                    </a>
                </div>
                <div class="flex justify-center my-10 space-x-5">
                    <a href="https://www.linkedin.com/in/lhpires/" target="_blank"><Linkedin :stroke-width="1.5" /></a>
                    <a href="https://github.com/lhpires" target="_blank"><Github :stroke-width="1.5" /></a>
                </div>
            </div>
        </div>
    </div>


</template>

<script setup>
import {Linkedin,Github,LibraryBig} from 'lucide-vue-next';
</script>