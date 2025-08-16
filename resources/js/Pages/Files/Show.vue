<template>
    <AppLayout>
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ file.original_name }}
                    </h2>
                    <div class="mt-1 flex items-center space-x-4">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                            :class="getTypeBadgeClass(file.type)"
                        >
                            {{ getTypeLabel(file.type) }}
                        </span>
                        <span class="text-sm text-gray-500">
                            {{ file.formatted_size }}
                        </span>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <Link
                        href="/files"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Kembali
                    </Link>

                    <a
                        :href="route('files.download', file.id)"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700"
                    >
                        <svg
                            class="mr-2 h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                            />
                        </svg>
                        Download
                    </a>

                    <Link
                        v-if="canEdit"
                        :href="route('files.edit', file.id)"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                    >
                        Edit
                    </Link>
                </div>
            </div>

            <!-- File Details -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Detail File
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Nama Asli
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ file.original_name }}
                            </dd>
                        </div>

                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Ukuran File
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ file.formatted_size }}
                            </dd>
                        </div>

                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Jenis File
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    :class="getTypeBadgeClass(file.type)"
                                >
                                    {{ getTypeLabel(file.type) }}
                                </span>
                            </dd>
                        </div>

                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Jenis MIME
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ file.mime_type }}
                            </dd>
                        </div>

                        <div
                            v-if="file.description"
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Deskripsi
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-line"
                            >
                                {{ file.description }}
                            </dd>
                        </div>

                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Diunggah Oleh
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ file.uploaded_by.name }}
                            </dd>
                        </div>

                        <div
                            v-if="file.team"
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Tim
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ file.team.name }}
                            </dd>
                        </div>

                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Tanggal Upload
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ formatDate(file.created_at) }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- File Preview (for images) -->
            <div
                v-if="isImage"
                class="bg-white shadow overflow-hidden sm:rounded-lg"
            >
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Preview
                    </h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <div class="text-center">
                        <img
                            :src="file.url"
                            :alt="file.original_name"
                            class="max-w-full h-auto mx-auto rounded-lg shadow-lg"
                            style="max-height: 500px"
                        />
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div
                v-if="canEdit || canDelete"
                class="bg-white shadow overflow-hidden sm:rounded-lg"
            >
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Tindakan
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Aksi yang dapat dilakukan terhadap file ini
                    </p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <div class="flex space-x-3">
                        <Link
                            v-if="canEdit"
                            :href="route('files.edit', file.id)"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                        >
                            Edit File
                        </Link>

                        <button
                            v-if="canDelete"
                            @click="deleteFile"
                            class="inline-flex items-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50"
                        >
                            Hapus File
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { computed } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    file: Object,
});

const page = usePage();

const canEdit = computed(() => {
    const user = page.props.auth.user;
    return user && (props.file.uploaded_by === user.id || user.role === "KI");
});

const canDelete = computed(() => {
    const user = page.props.auth.user;
    return user && (props.file.uploaded_by === user.id || user.role === "KI");
});

const isImage = computed(() => {
    return props.file.mime_type && props.file.mime_type.startsWith("image/");
});

const formatDate = (date) => {
    return new Date(date).toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
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

const deleteFile = () => {
    if (confirm("Apakah Anda yakin ingin menghapus file ini?")) {
        router.delete(route("files.destroy", props.file.id));
    }
};
</script>
