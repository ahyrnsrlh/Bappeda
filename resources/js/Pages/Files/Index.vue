<template>
    <AppLayout>
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900">Kelola File</h2>
                <Link
                    href="/files/create"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700"
                >
                    Upload File
                </Link>
            </div>

            <!-- Filter dan Search -->
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Tim</label
                        >
                        <select
                            v-model="filters.team_id"
                            @change="applyFilters"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="">Semua Tim</option>
                            <option
                                v-for="team in teams"
                                :key="team.id"
                                :value="team.id"
                            >
                                {{ team.name }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Tipe File</label
                        >
                        <select
                            v-model="filters.type"
                            @change="applyFilters"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="">Semua Tipe</option>
                            <option value="meeting_note">Notulen Rapat</option>
                            <option value="document">Dokumen</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Pencarian</label
                        >
                        <input
                            v-model="filters.search"
                            @input="applyFilters"
                            type="text"
                            placeholder="Cari nama file..."
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        />
                    </div>
                </div>
            </div>

            <!-- File Grid -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
            >
                <div
                    v-for="file in files.data"
                    :key="file.id"
                    class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200"
                >
                    <div class="p-6">
                        <!-- File Icon -->
                        <div
                            class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-gray-100 rounded-lg"
                        >
                            <svg
                                class="w-6 h-6 text-gray-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                                />
                            </svg>
                        </div>

                        <!-- File Info -->
                        <div class="text-center">
                            <h3
                                class="text-sm font-medium text-gray-900 truncate"
                                :title="file.original_name"
                            >
                                {{ file.original_name }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ file.formatted_size }}
                            </p>
                            <p class="text-xs text-gray-500">
                                Oleh: {{ file.user.name }}
                            </p>
                            <p v-if="file.team" class="text-xs text-blue-600">
                                {{ file.team.name }}
                            </p>

                            <!-- Type Badge -->
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium mt-2"
                                :class="getTypeBadgeClass(file.type)"
                            >
                                {{ getTypeLabel(file.type) }}
                            </span>
                        </div>

                        <!-- Actions -->
                        <div class="mt-4 flex justify-center space-x-2">
                            <a
                                :href="`/files/${file.id}/download`"
                                class="inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Download
                            </a>

                            <Link
                                :href="`/files/${file.id}`"
                                class="inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Detail
                            </Link>

                            <button
                                v-if="canDeleteFile(file)"
                                @click="deleteFile(file)"
                                class="inline-flex items-center px-2 py-1 border border-red-300 shadow-sm text-xs font-medium rounded text-red-700 bg-white hover:bg-red-50"
                            >
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-if="files.data.length === 0" class="text-center py-12">
                <svg
                    class="mx-auto h-12 w-12 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                    />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">
                    Tidak ada file
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Mulai dengan mengupload file pertama Anda.
                </p>
                <div class="mt-6">
                    <Link
                        href="/files/create"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                    >
                        Upload File
                    </Link>
                </div>
            </div>

            <!-- Pagination -->
            <div
                v-if="files.last_page > 1"
                class="flex items-center justify-between"
            >
                <div class="flex-1 flex justify-between sm:hidden">
                    <Link
                        v-if="files.prev_page_url"
                        :href="files.prev_page_url"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Previous
                    </Link>
                    <Link
                        v-if="files.next_page_url"
                        :href="files.next_page_url"
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Next
                    </Link>
                </div>

                <div
                    class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
                >
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing {{ files.from }} to {{ files.to }} of
                            {{ files.total }} results
                        </p>
                    </div>
                    <div>
                        <nav
                            class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                        >
                            <Link
                                v-if="files.prev_page_url"
                                :href="files.prev_page_url"
                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                            >
                                Previous
                            </Link>
                            <Link
                                v-if="files.next_page_url"
                                :href="files.next_page_url"
                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                            >
                                Next
                            </Link>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, reactive } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    files: Object,
    teams: Array,
});

const page = usePage();

const filters = reactive({
    team_id: "",
    type: "",
    search: "",
});

const applyFilters = () => {
    router.get("/files", filters, {
        preserveState: true,
        replace: true,
    });
};

const getTypeBadgeClass = (type) => {
    const classes = {
        meeting_note: "bg-blue-100 text-blue-800",
        document: "bg-green-100 text-green-800",
        other: "bg-gray-100 text-gray-800",
    };
    return classes[type] || "bg-gray-100 text-gray-800";
};

const getTypeLabel = (type) => {
    const labels = {
        meeting_note: "Notulen Rapat",
        document: "Dokumen",
        other: "Lainnya",
    };
    return labels[type] || type;
};

const canDeleteFile = (file) => {
    const user = page.props.auth.user;
    return user && (file.user_id === user.id || user.role === "KI");
};

const deleteFile = (file) => {
    if (confirm("Apakah Anda yakin ingin menghapus file ini?")) {
        router.delete(`/files/${file.id}`);
    }
};
</script>
