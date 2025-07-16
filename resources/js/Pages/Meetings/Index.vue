<template>
    <AppLayout>
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900">Jadwal Rapat</h2>
                <Link
                    v-if="canCreateMeeting"
                    href="/meetings/create"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700"
                >
                    Buat Jadwal Rapat
                </Link>
            </div>

            <!-- Meetings List -->
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    <li v-for="meeting in meetings.data" :key="meeting.id">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <p
                                            class="text-sm font-medium text-indigo-600 truncate"
                                        >
                                            {{ meeting.title }}
                                        </p>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                :class="
                                                    getStatusClass(
                                                        meeting.status
                                                    )
                                                "
                                            >
                                                {{
                                                    getStatusLabel(
                                                        meeting.status
                                                    )
                                                }}
                                            </p>
                                        </div>
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
                                                {{
                                                    formatDate(
                                                        meeting.meeting_date
                                                    )
                                                }}
                                            </p>

                                            <p
                                                v-if="meeting.location"
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
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                    />
                                                </svg>
                                                {{ meeting.location }}
                                            </p>
                                        </div>

                                        <div
                                            class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0"
                                        >
                                            <p>
                                                Dibuat oleh:
                                                {{ meeting.creator.name }}
                                            </p>
                                        </div>
                                    </div>

                                    <div v-if="meeting.agenda" class="mt-2">
                                        <p class="text-sm text-gray-600">
                                            {{ meeting.agenda }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="ml-4 flex-shrink-0 flex space-x-2">
                                    <Link
                                        :href="`/meetings/${meeting.id}`"
                                        class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                    >
                                        Detail
                                    </Link>

                                    <Link
                                        v-if="canEditMeeting(meeting)"
                                        :href="`/meetings/${meeting.id}/edit`"
                                        class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                    >
                                        Edit
                                    </Link>

                                    <button
                                        v-if="canDeleteMeeting(meeting)"
                                        @click="deleteMeeting(meeting)"
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
            <div v-if="meetings.data.length === 0" class="text-center py-12">
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
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"
                    />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">
                    Tidak ada jadwal rapat
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    <span v-if="canCreateMeeting"
                        >Mulai dengan membuat jadwal rapat pertama.</span
                    >
                    <span v-else>Belum ada jadwal rapat yang dibuat.</span>
                </p>
                <div v-if="canCreateMeeting" class="mt-6">
                    <Link
                        href="/meetings/create"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                    >
                        Buat Jadwal Rapat
                    </Link>
                </div>
            </div>

            <!-- Pagination -->
            <div
                v-if="meetings.last_page > 1"
                class="flex items-center justify-between"
            >
                <div class="flex-1 flex justify-between sm:hidden">
                    <Link
                        v-if="meetings.prev_page_url"
                        :href="meetings.prev_page_url"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Previous
                    </Link>
                    <Link
                        v-if="meetings.next_page_url"
                        :href="meetings.next_page_url"
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
                            Showing {{ meetings.from }} to {{ meetings.to }} of
                            {{ meetings.total }} results
                        </p>
                    </div>
                    <div>
                        <nav
                            class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                        >
                            <Link
                                v-if="meetings.prev_page_url"
                                :href="meetings.prev_page_url"
                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                            >
                                Previous
                            </Link>
                            <Link
                                v-if="meetings.next_page_url"
                                :href="meetings.next_page_url"
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
import { computed } from "vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    meetings: Object,
});

const page = usePage();

const canCreateMeeting = computed(() => {
    return page.props.auth.user?.role === "KI";
});

const canEditMeeting = (meeting) => {
    const user = page.props.auth.user;
    return user && meeting.created_by === user.id;
};

const canDeleteMeeting = (meeting) => {
    const user = page.props.auth.user;
    return user && meeting.created_by === user.id;
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

const getStatusClass = (status) => {
    const classes = {
        scheduled: "bg-blue-100 text-blue-800",
        completed: "bg-green-100 text-green-800",
        cancelled: "bg-red-100 text-red-800",
    };
    return classes[status] || "bg-gray-100 text-gray-800";
};

const getStatusLabel = (status) => {
    const labels = {
        scheduled: "Terjadwal",
        completed: "Selesai",
        cancelled: "Dibatalkan",
    };
    return labels[status] || status;
};

const deleteMeeting = (meeting) => {
    if (confirm("Apakah Anda yakin ingin menghapus jadwal rapat ini?")) {
        router.delete(`/meetings/${meeting.id}`);
    }
};
</script>
