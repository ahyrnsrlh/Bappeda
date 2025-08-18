<template>
    <AppLayout>
        <div class="container mx-auto px-4 py-8">
            <!-- Header dengan tombol kembali -->
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <Link
                        :href="route('teams.files', team)"
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
                        Kembali ke {{ teamName }}
                    </Link>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">
                            📁 {{ folderDisplayName }}
                        </h1>
                        <p class="text-gray-600 flex items-center">
                            <span class="mr-2">{{ teamName }}</span>
                            <span class="text-gray-400">→</span>
                            <span class="ml-2">{{ folderDisplayName }}</span>
                            <span
                                class="ml-4 text-sm bg-gray-100 px-2 py-1 rounded-full"
                            >
                                {{ files.length }} file ditemukan
                            </span>
                        </p>
                    </div>

                    <div class="flex items-center space-x-3">
                        <Link
                            v-if="canUpload"
                            :href="route('files.create', { team: team, folder: folder })"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-medium rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 shadow-lg"
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

            <!-- Files grid -->
            <div
                v-if="files.length > 0"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
            >
                <div
                    v-for="file in files"
                    :key="file.id"
                    class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-200"
                >
                    <div class="p-6">
                        <!-- File header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3"
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
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                                        ></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3
                                        class="text-lg font-semibold text-gray-900 truncate"
                                    >
                                        {{ file.original_name }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ file.formatted_size }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- File info -->
                        <div class="space-y-2 mb-4">
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <svg
                                    class="w-4 h-4 mr-2"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    ></path>
                                </svg>
                                {{ file.uploader?.name || "Unknown" }}
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <svg
                                    class="w-4 h-4 mr-2"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"
                                    ></path>
                                </svg>
                                {{ formatDate(file.created_at) }}
                            </div>
                            <div
                                class="flex items-center text-sm text-gray-600"
                            >
                                <svg
                                    class="w-4 h-4 mr-2"
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
                                {{ getTeamLabel(file.uploader?.role) }}
                            </div>
                        </div>

                        <!-- File description -->
                        <p
                            v-if="file.description"
                            class="text-gray-600 text-sm mb-4 line-clamp-2"
                        >
                            {{ file.description }}
                        </p>

                        <!-- Actions -->
                        <div
                            class="flex items-center justify-between pt-4 border-t border-gray-100"
                        >
                            <div class="flex items-center space-x-2">
                                <!-- Download button -->
                                <a
                                    :href="route('files.download', file.id)"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-green-600 bg-green-50 rounded-lg hover:bg-green-100 transition-colors duration-200"
                                    download
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
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                                        ></path>
                                    </svg>
                                    Unduh
                                </a>
                            </div>

                            <!-- Edit/Delete buttons (hanya untuk pemilik file atau KI) -->
                            <div
                                v-if="canManageFile(file)"
                                class="flex items-center space-x-1"
                            >
                                <button
                                    @click="deleteFile(file)"
                                    class="inline-flex items-center p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200"
                                    title="Hapus"
                                >
                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        ></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty state -->
            <div v-else class="bg-white rounded-xl shadow-lg p-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4">
                    <svg
                        class="w-full h-full text-gray-400"
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
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                    Folder {{ folderDisplayName }} kosong
                </h3>
                <p class="text-gray-500 mb-6">
                    Belum ada file yang diupload ke folder ini.
                </p>
                <Link
                    v-if="canUpload"
                    :href="route('files.create', { team: team, folder: folder })"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-medium rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200"
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
                    Upload File Pertama
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { computed } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    files: {
        type: Array,
        default: () => [],
    },
    team: {
        type: String,
        required: true,
    },
    folder: {
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

const folderDisplayName = computed(() => {
    const folderNames = {
        data: "Data",
        notulen: "Notulen",
    };
    return folderNames[props.folder] || props.folder;
});

const canUpload = computed(() => {
    const userRole = page.props.auth.user?.role;
    // KI bisa upload ke semua tim, tim hanya bisa upload ke tim sendiri
    // Support both legacy (tim_1, tim_2, etc.) and new codes (tim_kemiskinan, etc.)
    const teamRoleMapping = {
        tim_kemiskinan: 'tim_1',
        tim_industri_psn: 'tim_2', 
        tim_investasi: 'tim_3',
        tim_csr: 'tim_4',
        tim_dbh: 'tim_5'
    };
    
    const mappedTeamRole = teamRoleMapping[props.team] || props.team;
    return userRole === "KI" || userRole === mappedTeamRole;
});

const canManageFile = (file) => {
    const user = page.props.auth.user;
    // User bisa mengelola file miliknya sendiri atau KI bisa mengelola semua file
    return (
        user &&
        (file.uploaded_by === user.id ||
            user.role === "KI" ||
            user.role === "kabid")
    );
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};

const getTeamLabel = (role) => {
    const labels = {
        KI: "Konsultan Individu",
        tim_1: "Tim Kerja Penanggulangan Kemiskinan",
        tim_2: "Tim Kerja Kawasan Industri & PSN",
        tim_3: "Tim Kerja Peluang Investasi",
        tim_4: "Tim Kerja CSR/TJSL",
        tim_5: "Tim Kerja DBH Perkebunan",
    };
    return labels[role] || role;
};

const deleteFile = (file) => {
    if (
        confirm(
            `Apakah Anda yakin ingin menghapus file "${file.original_name}"?`
        )
    ) {
        router.delete(`/file-management/${file.id}`, {
            onSuccess: () => {
                // File deleted successfully
            },
        });
    }
};
</script>
