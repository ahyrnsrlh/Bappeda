<template>
    <AppLayout>
        <div class="container mx-auto px-4 py-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Tim Kerja</h1>
                <p class="text-gray-600">
                    Pilih tim untuk melihat file dan dokumen yang tersedia
                </p>
            </div>

            <!-- Teams Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tim 1: Penanggulangan Kemiskinan -->
                <Link
                    :href="route('teams.files', 'tim_1')"
                    class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 hover:border-yellow-300"
                >
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-4"
                            >
                                <svg
                                    class="w-6 h-6 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="text-lg font-semibold text-gray-900 group-hover:text-yellow-600"
                                >
                                    Tim Kerja Penanggulangan Kemiskinan
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ teamCounts.tim_1 || 0 }} file
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Fokus pada program-program pengentasan kemiskinan
                        </p>
                    </div>
                </Link>

                <!-- Tim 2: Kawasan Industri & PSN -->
                <Link
                    :href="route('teams.files', 'tim_2')"
                    class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 hover:border-yellow-300"
                >
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-4"
                            >
                                <svg
                                    class="w-6 h-6 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="text-lg font-semibold text-gray-900 group-hover:text-yellow-600"
                                >
                                    Tim Kerja Kawasan Industri & PSN
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ teamCounts.tim_2 || 0 }} file
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Proyek Strategis Nasional & Kawasan Industri
                        </p>
                    </div>
                </Link>

                <!-- Tim 3: Peluang Investasi -->
                <Link
                    :href="route('teams.files', 'tim_3')"
                    class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 hover:border-yellow-300"
                >
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-4"
                            >
                                <svg
                                    class="w-6 h-6 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="text-lg font-semibold text-gray-900 group-hover:text-yellow-600"
                                >
                                    Tim Kerja Peluang Investasi
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ teamCounts.tim_3 || 0 }} file
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Pengembangan peluang investasi daerah
                        </p>
                    </div>
                </Link>

                <!-- Tim 4: CSR/TJSL -->
                <Link
                    :href="route('teams.files', 'tim_4')"
                    class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 hover:border-yellow-300"
                >
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center mr-4"
                            >
                                <svg
                                    class="w-6 h-6 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="text-lg font-semibold text-gray-900 group-hover:text-yellow-600"
                                >
                                    Tim Kerja CSR/TJSL
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ teamCounts.tim_4 || 0 }} file
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Corporate Social Responsibility & TJSL
                        </p>
                    </div>
                </Link>

                <!-- Tim 5: DBH Perkebunan -->
                <Link
                    :href="route('teams.files', 'tim_5')"
                    class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 hover:border-yellow-300"
                >
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center mr-4"
                            >
                                <svg
                                    class="w-6 h-6 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="text-lg font-semibold text-gray-900 group-hover:text-yellow-600"
                                >
                                    Tim Kerja DBH Perkebunan
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ teamCounts.tim_5 || 0 }} file
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Dana Bagi Hasil Perkebunan
                        </p>
                    </div>
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    teamCounts: {
        type: Object,
        default: () => ({}),
    },
});

const page = usePage();
</script>
