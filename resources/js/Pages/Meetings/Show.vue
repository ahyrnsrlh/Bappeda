<template>
    <AppLayout>
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ meeting.title }}
                    </h2>
                    <div class="mt-1 flex items-center space-x-4">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                            :class="getStatusClass(meeting.status)"
                        >
                            {{ getStatusLabel(meeting.status) }}
                        </span>
                        <span class="text-sm text-gray-500">
                            Dibuat oleh {{ meeting.creator.name }}
                        </span>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <Link
                        href="/meetings"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Kembali
                    </Link>

                    <Link
                        v-if="canEdit"
                        :href="`/meetings/${meeting.id}/edit`"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                    >
                        Edit
                    </Link>
                </div>
            </div>

            <!-- Meeting Details -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Detail Rapat
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Tanggal & Waktu
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ formatDate(meeting.meeting_date) }}
                            </dd>
                        </div>

                        <div
                            v-if="meeting.location"
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Lokasi
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ meeting.location }}
                            </dd>
                        </div>

                        <div
                            v-if="
                                meeting.participant_teams &&
                                meeting.participant_teams.length > 0
                            "
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Tim Peserta
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                <ul
                                    class="border border-gray-200 rounded-md divide-y divide-gray-200"
                                >
                                    <li
                                        v-for="teamId in meeting.participant_teams"
                                        :key="teamId"
                                        class="pl-3 pr-4 py-3 flex items-center justify-between text-sm"
                                    >
                                        <div
                                            class="w-0 flex-1 flex items-center"
                                        >
                                            <span
                                                class="ml-2 flex-1 w-0 truncate"
                                            >
                                                {{ getTeamName(teamId) }}
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </dd>
                        </div>

                        <div
                            v-if="meeting.notes"
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Catatan
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-line"
                            >
                                {{ meeting.notes }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Meeting Notes Section -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div
                    class="px-4 py-5 sm:px-6 flex justify-between items-center"
                >
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Notulen Rapat
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Catatan dan dokumentasi hasil rapat
                        </p>
                    </div>

                    <Link
                        v-if="canCreateNote"
                        :href="`/meeting-notes/create?meeting_id=${meeting.id}`"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700"
                    >
                        Buat Notulen
                    </Link>
                </div>

                <div
                    v-if="meetingNotes.length > 0"
                    class="border-t border-gray-200"
                >
                    <ul class="divide-y divide-gray-200">
                        <li
                            v-for="note in meetingNotes"
                            :key="note.id"
                            class="px-4 py-4 sm:px-6"
                        >
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h4
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ note.title }}
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ note.content }}
                                    </p>
                                    <div
                                        class="mt-2 flex items-center text-xs text-gray-500 space-x-4"
                                    >
                                        <span
                                            >Oleh:
                                            {{
                                                note.created_by_user.name
                                            }}</span
                                        >
                                        <span>{{
                                            formatDate(note.created_at)
                                        }}</span>
                                        <span
                                            v-if="note.is_archived"
                                            class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full"
                                        >
                                            Diarsipkan
                                        </span>
                                    </div>

                                    <!-- Attachments -->
                                    <div
                                        v-if="
                                            note.attachments &&
                                            note.attachments.length > 0
                                        "
                                        class="mt-3"
                                    >
                                        <h5
                                            class="text-xs font-medium text-gray-700 mb-2"
                                        >
                                            Lampiran:
                                        </h5>
                                        <div class="space-y-1">
                                            <div
                                                v-for="attachment in note.attachments"
                                                :key="attachment.id"
                                                class="flex items-center text-xs text-gray-600"
                                            >
                                                <svg
                                                    class="flex-shrink-0 mr-2 h-4 w-4 text-gray-400"
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
                                                <a
                                                    :href="
                                                        route(
                                                            'files.download',
                                                            attachment.id
                                                        )
                                                    "
                                                    class="hover:underline"
                                                >
                                                    {{
                                                        attachment.original_name
                                                    }}
                                                </a>
                                                <span class="ml-1 text-gray-400"
                                                    >({{
                                                        attachment.formatted_size
                                                    }})</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="ml-4 flex-shrink-0 flex space-x-2">
                                    <Link
                                        :href="`/meeting-notes/${note.id}`"
                                        class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50"
                                    >
                                        Detail
                                    </Link>

                                    <Link
                                        v-if="canEditNote(note)"
                                        :href="`/meeting-notes/${note.id}/edit`"
                                        class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50"
                                    >
                                        Edit
                                    </Link>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div
                    v-else
                    class="border-t border-gray-200 px-4 py-8 text-center"
                >
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
                        Belum ada notulen
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        <span v-if="canCreateNote"
                            >Mulai dengan membuat notulen untuk rapat ini.</span
                        >
                        <span v-else>Notulen rapat belum dibuat.</span>
                    </p>
                    <div v-if="canCreateNote" class="mt-6">
                        <Link
                            :href="`/meeting-notes/create?meeting_id=${meeting.id}`"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700"
                        >
                            Buat Notulen
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    meeting: Object,
    meetingNotes: Array,
    teams: Array,
});

const page = usePage();

const canEdit = computed(() => {
    const user = page.props.auth.user;
    return user && props.meeting.created_by === user.id;
});

const canCreateNote = computed(() => {
    const user = page.props.auth.user;
    return user && ["KI", "kabid"].includes(user.role);
});

const canEditNote = (note) => {
    const user = page.props.auth.user;
    return user && note.created_by === user.id;
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString("id-ID", {
        timeZone: "Asia/Jakarta",
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

const getTeamName = (teamId) => {
    const team = props.teams.find((t) => t.id === teamId);
    return team ? team.name : `Tim ${teamId}`;
};
</script>
