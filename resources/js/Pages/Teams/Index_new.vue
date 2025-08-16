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
                <!-- Dynamic Teams -->
                <Link
                    v-for="team in teams"
                    :key="team.id"
                    :href="route('teams.files', team.code)"
                    class="group bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200 hover:border-yellow-300"
                >
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div
                                :class="`w-12 h-12 bg-gradient-to-br ${teamColors[team.code] || 'from-gray-500 to-gray-600'} rounded-lg flex items-center justify-center mr-4`"
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
                                        :d="teamIcons[team.code] || teamIcons.tim_kemiskinan"
                                    ></path>
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="text-lg font-semibold text-gray-900 group-hover:text-yellow-600"
                                >
                                    {{ team.name }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ teamCounts[team.code] || 0 }} file
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            {{ team.description }}
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
    teams: {
        type: Array,
        default: () => [],
    },
});

const teamIcons = {
    tim_kemiskinan: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
    tim_industri_psn: 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z',
    tim_investasi: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
    tim_csr: 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
    tim_dbh: 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
};

const teamColors = {
    tim_kemiskinan: 'from-blue-500 to-blue-600',
    tim_industri_psn: 'from-purple-500 to-purple-600', 
    tim_investasi: 'from-green-500 to-green-600',
    tim_csr: 'from-red-500 to-red-600',
    tim_dbh: 'from-yellow-500 to-yellow-600'
};

const page = usePage();
</script>
