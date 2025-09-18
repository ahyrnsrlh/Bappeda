<template>
    <AppLayout>
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900">Notulen Rapat</h2>
                <Link
                    v-if="canCreateNote"
                    href="/meeting-notes/create"
                    class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700"
                >
                    Buat Notulen
                </Link>
            </div>

            <!-- Filter -->
            <div class="bg-white shadow px-4 py-3 sm:rounded-lg">
                <div class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-0">
                        <label
                            for="search"
                            class="block text-sm font-medium text-gray-700"
                            >Cari</label
                        >
                        <input
                            id="search"
                            v-model="filters.search"
                            type="text"
                            placeholder="Cari berdasarkan judul atau konten..."
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            @input="filterNotes"
                        />
                    </div>

                    <div>
                        <label
                            for="meeting"
                            class="block text-sm font-medium text-gray-700"
                            >Rapat</label
                        >
                        <select
                            id="meeting"
                            v-model="filters.meeting_id"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                            @change="filterNotes"
                        >
                            <option value="">Semua Rapat</option>
                            <option
                                v-for="meeting in meetings"
                                :key="meeting.id"
                                :value="meeting.id"
                            >
                                {{ meeting.title }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label
                            for="archived"
                            class="block text-sm font-medium text-gray-700"
                            >Status</label
                        >
                        <select
                            id="archived"
                            v-model="filters.archived"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                            @change="filterNotes"
                        >
                            <option value="">Semua</option>
                            <option value="0">Aktif</option>
                            <option value="1">Diarsipkan</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Notes List -->
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    <li v-for="note in filteredNotes" :key="note.id">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <p
                                            class="text-sm font-medium text-indigo-600 truncate"
                                        >
                                            {{ note.title }}
                                        </p>
                                        <div
                                            class="ml-2 flex-shrink-0 flex space-x-2"
                                        >
                                            <p
                                                v-if="note.is_archived"
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"
                                            >
                                                Diarsipkan
                                            </p>
                                            <p
                                                v-if="
                                                    note.attachments_count > 0
                                                "
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                                            >
                                                {{ note.attachments_count }}
                                                Lampiran
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <p
                                            class="text-sm text-gray-600 line-clamp-2"
                                        >
                                            {{ note.content }}
                                        </p>
                                    </div>

                                    <div
                                        class="mt-2 sm:flex sm:justify-between"
                                    >
                                        <div class="sm:flex">
                                            <p
                                                class="flex items-center text-sm text-gray-500"
                                            >
                                                <svg
                                                    class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"
                                                    />
                                                </svg>
                                                Rapat:
                                                {{
                                                    note.meeting_schedule.title
                                                }}
                                            </p>

                                            <p
                                                class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6"
                                            >
                                                <svg
                                                    class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                    />
                                                </svg>
                                                {{ note.created_by_user.name }}
                                            </p>
                                        </div>

                                        <div
                                            class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0"
                                        >
                                            <p>
                                                {{
                                                    formatDate(note.created_at)
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="ml-4 flex-shrink-0 flex space-x-2">
                                    <Link
                                        :href="`/meeting-notes/${note.id}`"
                                        class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                    >
                                        Detail
                                    </Link>

                                    <Link
                                        v-if="canEditNote(note)"
                                        :href="`/meeting-notes/${note.id}/edit`"
                                        class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                    >
                                        Edit
                                    </Link>

                                    <button
                                        v-if="canArchiveNote(note)"
                                        @click="toggleArchive(note)"
                                        class="inline-flex items-center px-3 py-1 border shadow-sm text-sm leading-4 font-medium rounded-md bg-white hover:bg-gray-50"
                                        :class="
                                            note.is_archived
                                                ? 'border-green-300 text-green-700'
                                                : 'border-yellow-300 text-yellow-700'
                                        "
                                    >
                                        {{
                                            note.is_archived
                                                ? "Aktifkan"
                                                : "Arsipkan"
                                        }}
                                    </button>

                                    <button
                                        v-if="canDeleteNote(note)"
                                        @click="deleteNote(note)"
                                        class="inline-flex items-center px-3 py-1 border border-red-300 shadow-sm text-sm leading-4 font-medium rounded-md text-red-700 bg-white hover:bg-red-50"
                                    >
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Empty State -->
            <div v-if="filteredNotes.length === 0" class="text-center py-12">
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
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">
                    Tidak ada notulen
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    <span v-if="canCreateNote"
                        >Mulai dengan membuat notulen rapat pertama.</span
                    >
                    <span v-else>Belum ada notulen yang dibuat.</span>
                </p>
                <div v-if="canCreateNote" class="mt-6">
                    <Link
                        href="/meeting-notes/create"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700"
                    >
                        Buat Notulen
                    </Link>
                </div>
            </div>

            <!-- Pagination -->
            <div
                v-if="notes.last_page > 1"
                class="flex items-center justify-between"
            >
                <div class="flex-1 flex justify-between sm:hidden">
                    <Link
                        v-if="notes.prev_page_url"
                        :href="notes.prev_page_url"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Previous
                    </Link>
                    <Link
                        v-if="notes.next_page_url"
                        :href="notes.next_page_url"
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
                            Showing {{ notes.from }} to {{ notes.to }} of
                            {{ notes.total }} results
                        </p>
                    </div>
                    <div>
                        <nav
                            class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                        >
                            <Link
                                v-if="notes.prev_page_url"
                                :href="notes.prev_page_url"
                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                            >
                                Previous
                            </Link>
                            <Link
                                v-if="notes.next_page_url"
                                :href="notes.next_page_url"
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
import { ref, computed, reactive } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    notes: Object,
    meetings: Array,
});

const page = usePage();

const filters = reactive({
    search: "",
    meeting_id: "",
    archived: "",
});

const filteredNotes = computed(() => {
    let filtered = props.notes.data;

    if (filters.search) {
        const search = filters.search.toLowerCase();
        filtered = filtered.filter(
            (note) =>
                note.title.toLowerCase().includes(search) ||
                note.content.toLowerCase().includes(search)
        );
    }

    if (filters.meeting_id) {
        filtered = filtered.filter(
            (note) => note.meeting_schedule_id == filters.meeting_id
        );
    }

    if (filters.archived !== "") {
        const isArchived = filters.archived === "1";
        filtered = filtered.filter((note) => note.is_archived === isArchived);
    }

    return filtered;
});

const canCreateNote = computed(() => {
    const user = page.props.auth.user;
    return user && user.role === "KI";
});

const canEditNote = (note) => {
    const user = page.props.auth.user;
    return user && note.created_by === user.id;
};

const canArchiveNote = (note) => {
    const user = page.props.auth.user;
    return user && ["KI", "kabid"].includes(user.role);
};

const canDeleteNote = (note) => {
    const user = page.props.auth.user;
    return user && note.created_by === user.id;
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
};

const filterNotes = () => {
    // This would normally trigger a new request to the server
    // For now, we'll use client-side filtering
};

const toggleArchive = (note) => {
    const action = note.is_archived ? "mengaktifkan" : "mengarsipkan";
    if (confirm(`Apakah Anda yakin ingin ${action} notulen ini?`)) {
        router.patch(`/meeting-notes/${note.id}/archive`, {
            is_archived: !note.is_archived,
        });
    }
};

const deleteNote = (note) => {
    if (confirm("Apakah Anda yakin ingin menghapus notulen ini?")) {
        router.delete(`/meeting-notes/${note.id}`);
    }
};
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
