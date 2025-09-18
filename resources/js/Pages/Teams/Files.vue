<template>
    <AppLayout>
        <div class="container mx-auto px-4 py-8">
            <!-- Header dengan tombol kembali -->
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <Link
                        :href="route('teams.index')"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-200 mr-4"
                    >
                        <svg
                            class="w-4 h-4 mr-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            ></path>
                        </svg>
                        Kembali ke Tim Kerja
                    </Link>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">
                            {{ teamName }}
                        </h1>
                        <p class="text-gray-600">
                            Pilih folder untuk melihat file tim
                        </p>
                    </div>

                    <!-- Upload button (hanya untuk tim sendiri atau KI) -->
                    <div v-if="canUpload" class="flex items-center space-x-3">
                        <Link
                            :href="route('files.create', { team: team })"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-medium rounded-lg hover:from-yellow-600 hover:to-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200 shadow-lg hover:shadow-xl"
                        >
                            <svg
                                class="w-5 h-5 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                ></path>
                            </svg>
                            Upload File
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Folder Structure -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Data Folder -->
                <Link
                    :href="route('teams.folders', [team, 'data'])"
                    class="group border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200 block"
                >
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center"
                                    >
                                        <svg
                                            class="w-6 h-6 text-blue-600"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-5l-2-2H5a2 2 0 00-2 2z"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3
                                        class="text-lg font-semibold text-gray-900 group-hover:text-blue-600"
                                    >
                                        📁 Data
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Folder untuk menyimpan data dan dokumen
                                        tim
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center text-gray-400 group-hover:text-blue-600"
                            >
                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </Link>

                <!-- Notulen Folder -->
                <Link
                    :href="route('teams.folders', [team, 'notulen'])"
                    class="group hover:bg-gray-50 transition-colors duration-200 block"
                >
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center"
                                    >
                                        <svg
                                            class="w-6 h-6 text-green-600"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-5l-2-2H5a2 2 0 00-2 2z"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3
                                        class="text-lg font-semibold text-gray-900 group-hover:text-green-600"
                                    >
                                        📝 Notulen
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        Folder untuk menyimpan notulen rapat dan
                                        hasil kegiatan
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center text-gray-400 group-hover:text-green-600"
                            >
                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    ></path>
                                </svg>
                            </div>
                        </div>
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
    team: {
        type: String,
        required: true,
    },
});

const page = usePage();

const teamName = computed(() => {
    const teamNames = {
        tim_kemiskinan: "Tim Kerja Penanggulangan Kemiskinan",
        tim_industri_psn: "Tim Kerja Kawasan Industri & PSN",
        tim_investasi: "Tim Kerja Peluang Investasi",
        tim_csr: "Tim Kerja CSR/TJSL",
        tim_dbh: "Tim Kerja DBH Perkebunan",
        // Support legacy codes for backward compatibility
        tim_1: "Tim Kerja Penanggulangan Kemiskinan",
        tim_2: "Tim Kerja Kawasan Industri & PSN",
        tim_3: "Tim Kerja Peluang Investasi",
        tim_4: "Tim Kerja CSR/TJSL",
        tim_5: "Tim Kerja DBH Perkebunan",
    };
    return teamNames[props.team] || props.team;
});

const canUpload = computed(() => {
    const user = page.props.auth.user;
    if (!user) {
        console.log("Teams/Files canUpload: No user found");
        return false;
    }

    console.log("Teams/Files canUpload check:", {
        userRole: user.role,
        pageTeam: props.team,
        userId: user.id,
    });

    // KI bisa upload ke semua tim
    if (user.role === "KI") {
        console.log("Teams/Files canUpload: User is KI, allowing upload");
        return true;
    }

    // Kabid tidak bisa upload
    if (user.role === "kabid") {
        console.log("Teams/Files canUpload: User is kabid, denying upload");
        return false;
    }

    // Tim kerja hanya bisa upload ke tim mereka sendiri
    if (
        [
            "tim_1",
            "tim_2",
            "tim_3",
            "tim_4",
            "tim_5",
            "tim_kemiskinan",
            "tim_industri_psn",
            "tim_investasi",
            "tim_csr",
            "tim_dbh",
        ].includes(user.role)
    ) {
        // Check if current team page matches user's team
        let userTeamCode = null;

        // For legacy roles, map to new team codes
        if (["tim_1", "tim_2", "tim_3", "tim_4", "tim_5"].includes(user.role)) {
            const roleToTeamMapping = {
                tim_1: "tim_kemiskinan",
                tim_2: "tim_industri_psn",
                tim_3: "tim_investasi",
                tim_4: "tim_csr",
                tim_5: "tim_dbh",
            };
            userTeamCode = roleToTeamMapping[user.role];
        } else if (
            [
                "tim_kemiskinan",
                "tim_industri_psn",
                "tim_investasi",
                "tim_csr",
                "tim_dbh",
            ].includes(user.role)
        ) {
            // Direct role to team mapping
            userTeamCode = user.role;
        }

        console.log("Teams/Files canUpload team check:", {
            userTeamCode,
            pageTeam: props.team,
            match: props.team === userTeamCode,
        });

        // Allow upload if current page team matches user's team
        return props.team === userTeamCode;
    }

    console.log(
        "Teams/Files canUpload: User role not recognized, denying upload"
    );
    return false;
});
</script>
