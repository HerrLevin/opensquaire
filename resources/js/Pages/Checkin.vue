<script lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faCircleInfo, faLocationPin} from '@fortawesome/free-solid-svg-icons'
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import {Venue} from "@/types/venue";

export default {
    components: {
        Modal, TextInput, InputLabel, DangerButton, SecondaryButton, InputError,
        FontAwesomeIcon,
        AuthenticatedLayout,
        Head,
    },
    setup() {
        const faHouse = faLocationPin;
        return {faHouse, faCircleInfo};
    },
    data() {
        return {
            venues: [] as Venue[],
            isShowModal: false as boolean,
            selectedVenue: null as Venue | null,
        }
    },
    methods: {
        test() {
            fetch('/api/nearby?latitude=49.009925117955575&longitude=8.42856106114697')
                .then(response => response.json())
                .then((data) => {
                    this.venues = data.data;
                });
        },
        showModal(show: boolean) {
            this.isShowModal = show;
        },
        showInfo(venue: any) {
            this.selectedVenue = venue;
            this.showModal(true);
        }
    },
    mounted() {
        this.test();
    }
};
</script>

<template>
    <Head title="Checkin"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Where are you?</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    v-for="venue in venues"
                    class="bg-white grid grid-cols-12 md:mt-2 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg max-md:border-b border-b-gray-500">
                    <!-- icon -->
                    <div class="col-span-2 text-gray-900 p-4 text-center dark:text-gray-100">
                        <font-awesome-icon :icon="faHouse"/>
                    </div>
                    <div class="col-span-9 py-4 text-gray-900 dark:text-gray-100">{{ venue.name }}</div>
                    <div class="py-4 text-gray-900 text-center dark:text-gray-100">
                        <a href="#" @click="showInfo(venue)">
                            <font-awesome-icon :icon="faCircleInfo"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <Modal :show="isShowModal" @close="showModal(false)">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ selectedVenue?.name }}
                </h2>

                <table
                    class="mt-2 w-full border border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-800 text-sm shadow-sm">
                    <thead class="bg-slate-50 dark:bg-slate-700">
                    <tr>
                        <th class="border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">
                            key
                        </th>
                        <th class="border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">
                            value
                        </th>
                    </tr>
                    </thead>
                <tbody>
                <tr v-for="tag in selectedVenue?.tags">
                    <td class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                        {{ tag.key }}
                    </td>
                    <td class="border border-slate-300 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400">
                        {{ tag.value }}
                    </td>
                </tr>
                </tbody>
                </table>

                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only"/>

                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="showModal(false)">Close</SecondaryButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>