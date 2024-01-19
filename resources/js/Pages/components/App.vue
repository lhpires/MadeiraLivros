<template>
    <div>
		<!-- HEADER -->
		<HeaderLibrary />

        <!-- Conteúdo -->
        <main class="min-h-screen">
            <slot class=""></slot> 
        </main>
             

        <!-- Footer -->
        <FooterLibrary />

	</div>
</template>

<script setup>
import { HeaderLibrary,FooterLibrary} from './structure';

</script>