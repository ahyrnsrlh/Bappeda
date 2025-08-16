<template>
    <AppLayout>
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ note.title }}
                    </h2>
                    <div class="mt-1 flex items-center space-x-4">
                        <span
                            v-if="note.is_archived"
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"
                        >
                            Diarsipkan
                        </span>
                        <span class="text-sm text-gray-500">
                            Dibuat oleh {{ note.created_by_user.name }}
                        </span>
                        <span class="text-sm text-gray-500">
                            {{ formatDate(note.created_at) }}
                        </span>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <Link
                        href="/meeting-notes"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Kembali
                    </Link>

                    <Link
                        v-if="canEdit"
                        :href="`/meeting-notes/${note.id}/edit`"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                    >
                        Edit
                    </Link>
                </div>
            </div>

            <!-- Meeting Info -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Informasi Rapat
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Detail rapat yang terkait dengan notulen ini
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Judul Rapat
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                <Link
                                    :href="`/meetings/${note.meeting_schedule.id}`"
                                    class="text-indigo-600 hover:text-indigo-500"
                                >
                                    {{ note.meeting_schedule.title }}
                                </Link>
                            </dd>
                        </div>

                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Tanggal Rapat
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{
                                    formatDate(
                                        note.meeting_schedule.meeting_date
                                    )
                                }}
                            </dd>
                        </div>

                        <div
                            v-if="note.meeting_schedule.location"
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Lokasi
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ note.meeting_schedule.location }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Note Content -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Isi Notulen
                    </h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <div class="prose max-w-none">
                        <div class="whitespace-pre-line text-gray-900">
                            {{ note.content }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attachments -->
            <div
                v-if="note.attachments && note.attachments.length > 0"
                class="bg-white shadow overflow-hidden sm:rounded-lg"
            >
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Lampiran
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        File yang dilampirkan pada notulen ini
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <ul class="divide-y divide-gray-200">
                        <li
                            v-for="attachment in note.attachments"
                            :key="attachment.id"
                            class="px-4 py-4 sm:px-6"
                        >
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg
                                            class="h-8 w-8 text-gray-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                                            />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            {{ attachment.original_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ attachment.formatted_size }} •
                                            {{ attachment.mime_type }}
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            Diunggah
                                            {{
                                                formatDate(
                                                    attachment.created_at
                                                )
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a
                                        :href="
                                            route(
                                                'files.download',
                                                attachment.id
                                            )
                                        "
                                        class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                    >
                                        <svg
                                            class="mr-1 h-4 w-4"
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
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Actions -->
            <div
                v-if="canEdit || canArchive || canDelete"
                class="bg-white shadow overflow-hidden sm:rounded-lg"
            >
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Tindakan
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Aksi yang dapat dilakukan terhadap notulen ini
                    </p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <div class="flex space-x-3">
                        <Link
                            v-if="canEdit"
                            :href="`/meeting-notes/${note.id}/edit`"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                        >
                            Edit Notulen
                        </Link>

                        <button
                            v-if="canArchive"
                            @click="toggleArchive"
                            class="inline-flex items-center px-4 py-2 border shadow-sm text-sm font-medium rounded-md bg-white hover:bg-gray-50"
                            :class="
                                note.is_archived
                                    ? 'border-green-300 text-green-700'
                                    : 'border-yellow-300 text-yellow-700'
                            "
                        >
                            {{
                                note.is_archived
                                    ? "Aktifkan Notulen"
                                    : "Arsipkan Notulen"
                            }}
                        </button>

                        <button
                            v-if="canDelete"
                            @click="deleteNote"
                            class="inline-flex items-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50"
                        >
                            Hapus Notulen
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
    note: Object,
});

const page = usePage();

const canEdit = computed(() => {
    const user = page.props.auth.user;
    return (
        user &&
        (props.note.created_by === user.id ||
            ["KI", "kabid"].includes(user.role))
    );
});

const canArchive = computed(() => {
    const user = page.props.auth.user;
    return user && ["KI", "kabid"].includes(user.role);
});

const canDelete = computed(() => {
    const user = page.props.auth.user;
    return user && props.note.created_by === user.id;
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

const toggleArchive = () => {
    const action = props.note.is_archived ? "mengaktifkan" : "mengarsipkan";
    if (confirm(`Apakah Anda yakin ingin ${action} notulen ini?`)) {
        router.patch(`/meeting-notes/${props.note.id}/archive`, {
            is_archived: !props.note.is_archived,
        });
    }
};

const deleteNote = () => {
    if (confirm("Apakah Anda yakin ingin menghapus notulen ini?")) {
        router.delete(`/meeting-notes/${props.note.id}`);
    }
};
</script>
