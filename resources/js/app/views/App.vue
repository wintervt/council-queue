<template>
    <div class="flex flex-col flex-grow bg-gray-100">

        <div class="relative bg-white border-b px-2">
            <div class="container mx-auto flex justify-between items-center py-3 md:justify-start space-x-4 md:space-x-6 lg:space-x-10">
                Queue App
            </div>
        </div>

        <div class="flex-grow flex flex-col py-3 px-2">
            <router-view></router-view>
        </div>

        <footer class="footer bg-white z-depth-1 p-3 border-t">
            <div class="container mx-auto">
                <p class="text-grey-500 text-sm font-light mb-0">Made by Milan Toth -  {{ date.getFullYear() }} </p>
            </div>
        </footer>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                date: new Date,
            }
        }
    }
</script>
