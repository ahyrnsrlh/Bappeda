<template>
    <AppLayout>
        <div class="space-y-8 pb-8">
            <!-- Modern Header with Gradient -->
            <div
                class="relative overflow-hidden rounded-2xl shadow-xl"
                style="
                    background: linear-gradient(
                        135deg,
                        #eaaa00 0%,
                        #d69e00 50%,
                        #c28d00 100%
                    );
                "
            >
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div class="relative px-6 py-8 sm:px-8 sm:py-12">
                    <div class="flex items-center">
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-2">
                                Selamat datang,
                                {{ $page.props.auth.user?.name || "User" }}! 👋
                            </h1>
                            <p class="text-yellow-100 text-lg">
                                {{
                                    getRoleLabel(
                                        $page.props.auth.user?.role || ""
                                    )
                                }}
                            </p>
                            <p class="text-yellow-200 text-sm mt-1">
                                {{ getCurrentDate() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modern Stats Cards -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Total Meetings Card -->
                <div
                    class="group relative bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-yellow-50 to-orange-50 opacity-50"
                    ></div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p
                                    class="text-sm font-medium text-gray-600 mb-1"
                                >
                                    Total Jadwal Rapat
                                </p>
                                <p class="text-3xl font-bold text-gray-900">
                                    {{ stats.totalMeetings }}
                                </p>
                                <p class="text-xs text-green-600 mt-1">
                                    <span class="inline-flex items-center">
                                        <svg
                                            class="w-3 h-3 mr-1"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                        Aktif
                                    </span>
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 rounded-xl flex items-center justify-center transition-colors duration-300"
                                    style="
                                        background-color: rgba(
                                            234,
                                            170,
                                            0,
                                            0.1
                                        );
                                    "
                                    onmouseover="this.style.backgroundColor='rgba(234, 170, 0, 0.2)'"
                                    onmouseout="this.style.backgroundColor='rgba(234, 170, 0, 0.1)'"
                                >
                                    <svg
                                        class="w-6 h-6"
                                        style="color: #eaaa00"
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Files Card -->
                <div
                    class="group relative bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-50 opacity-50"
                    ></div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p
                                    class="text-sm font-medium text-gray-600 mb-1"
                                >
                                    Total File
                                </p>
                                <p class="text-3xl font-bold text-gray-900">
                                    {{ stats.totalFiles }}
                                </p>
                                <p class="text-xs text-green-600 mt-1">
                                    <span class="inline-flex items-center">
                                        <svg
                                            class="w-3 h-3 mr-1"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                        Tersimpan
                                    </span>
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center group-hover:bg-green-200 transition-colors duration-300"
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
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Meetings Card -->
                <div
                    class="group relative bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-orange-50 to-amber-50 opacity-50"
                    ></div>
                    <div class="relative p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p
                                    class="text-sm font-medium text-gray-600 mb-1"
                                >
                                    Rapat Mendatang
                                </p>
                                <p class="text-3xl font-bold text-gray-900">
                                    {{ stats.upcomingMeetings }}
                                </p>
                                <p class="text-xs text-orange-600 mt-1">
                                    <span class="inline-flex items-center">
                                        <svg
                                            class="w-3 h-3 mr-1"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                        Segera
                                    </span>
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center group-hover:bg-orange-200 transition-colors duration-300"
                                >
                                    <svg
                                        class="w-6 h-6 text-orange-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modern Recent Activities -->
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                <!-- Recent Meetings -->
                <div
                    class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100"
                >
                    <div class="px-6 py-5 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3
                                class="text-xl font-semibold text-gray-900 flex items-center"
                            >
                                <div
                                    class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                    style="
                                        background-color: rgba(
                                            234,
                                            170,
                                            0,
                                            0.1
                                        );
                                    "
                                >
                                    <svg
                                        class="w-4 h-4"
                                        style="color: #eaaa00"
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
                                </div>
                                Jadwal Rapat Terbaru
                            </h3>
                            <Link
                                href="/meetings"
                                class="text-sm font-medium transition-colors duration-200"
                                style="color: #eaaa00"
                                onmouseover="this.style.color='#D69E00'"
                                onmouseout="this.style.color='#EAAA00'"
                            >
                                Lihat Semua →
                            </Link>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div v-if="recentMeetings.length > 0" class="space-y-4">
                            <div
                                v-for="meeting in recentMeetings"
                                :key="meeting.id"
                                class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200 cursor-pointer"
                            >
                                <div class="flex-1">
                                    <h4
                                        class="text-sm font-semibold text-gray-900 mb-1"
                                    >
                                        {{ meeting.title }}
                                    </h4>
                                    <p
                                        class="text-xs text-gray-600 flex items-center"
                                    >
                                        <svg
                                            class="w-3 h-3 mr-1"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                            ></path>
                                        </svg>
                                        {{ formatDate(meeting.meeting_date) }}
                                    </p>
                                </div>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold"
                                    :class="getStatusClass(meeting.status)"
                                >
                                    {{ getStatusLabel(meeting.status) }}
                                </span>
                            </div>
                        </div>
                        <div v-else class="text-center py-8">
                            <svg
                                class="w-12 h-12 text-gray-300 mx-auto mb-4"
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
                            <p class="text-sm text-gray-500">
                                Belum ada jadwal rapat
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Recent Files -->
                <div
                    class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100"
                >
                    <div class="px-6 py-5 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3
                                class="text-xl font-semibold text-gray-900 flex items-center"
                            >
                                <div
                                    class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3"
                                >
                                    <svg
                                        class="w-4 h-4 text-green-600"
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
                                File Terbaru
                            </h3>
                            <Link
                                href="/files"
                                class="text-sm font-medium text-green-600 hover:text-green-500 transition-colors duration-200"
                            >
                                Lihat Semua →
                            </Link>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div v-if="recentFiles.length > 0" class="space-y-4">
                            <div
                                v-for="file in recentFiles"
                                :key="file.id"
                                class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-200 cursor-pointer"
                            >
                                <div class="flex items-center flex-1">
                                    <div
                                        class="w-10 h-10 rounded-lg flex items-center justify-center mr-3"
                                        style="
                                            background-color: rgba(
                                                234,
                                                170,
                                                0,
                                                0.1
                                            );
                                        "
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            style="color: #eaaa00"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                            ></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4
                                            class="text-sm font-semibold text-gray-900 mb-1"
                                        >
                                            {{ file.original_name }}
                                        </h4>
                                        <p class="text-xs text-gray-600">
                                            Oleh: {{ file.user.name }}
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="text-xs font-medium text-gray-500 bg-gray-200 px-2 py-1 rounded-md"
                                >
                                    {{ file.formatted_size }}
                                </span>
                            </div>
                        </div>
                        <div v-else class="text-center py-8">
                            <svg
                                class="w-12 h-12 text-gray-300 mx-auto mb-4"
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
                            <p class="text-sm text-gray-500">Belum ada file</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modern Quick Actions -->
            <div
                class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100"
            >
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3
                        class="text-xl font-semibold text-gray-900 flex items-center"
                    >
                        <div
                            class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3"
                        >
                            <svg
                                class="w-4 h-4 text-indigo-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"
                                ></path>
                            </svg>
                        </div>
                        Aksi Cepat
                    </h3>
                </div>
                <div class="p-6">
                    <div
                        class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4"
                    >
                        <Link
                            v-if="canCreateMeeting"
                            href="/meetings/create"
                            class="group relative overflow-hidden text-white rounded-xl p-4 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    #eaaa00 0%,
                                    #d69e00 100%
                                );
                            "
                            onmouseover="this.style.background='linear-gradient(135deg, #D69E00 0%, #C28D00 100%)'"
                            onmouseout="this.style.background='linear-gradient(135deg, #EAAA00 0%, #D69E00 100%)'"
                        >
                            <div class="flex items-center justify-center mb-2">
                                <svg
                                    class="w-6 h-6"
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
                            </div>
                            <div class="text-center">
                                <p class="font-semibold text-sm">Buat Jadwal</p>
                                <p class="text-xs opacity-90">Rapat Baru</p>
                            </div>
                            <div
                                class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"
                            ></div>
                        </Link>

                        <Link
                            href="/files/create"
                            class="group relative overflow-hidden bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white rounded-xl p-4 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg"
                        >
                            <div class="flex items-center justify-center mb-2">
                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                    ></path>
                                </svg>
                            </div>
                            <div class="text-center">
                                <p class="font-semibold text-sm">Upload File</p>
                                <p class="text-xs opacity-90">Dokumen</p>
                            </div>
                            <div
                                class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"
                            ></div>
                        </Link>

                        <Link
                            href="/meetings"
                            class="group relative overflow-hidden bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-xl p-4 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg"
                        >
                            <div class="flex items-center justify-center mb-2">
                                <svg
                                    class="w-6 h-6"
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
                            </div>
                            <div class="text-center">
                                <p class="font-semibold text-sm">Lihat Semua</p>
                                <p class="text-xs opacity-90">Rapat</p>
                            </div>
                            <div
                                class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"
                            ></div>
                        </Link>

                        <Link
                            href="/files"
                            class="group relative overflow-hidden bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white rounded-xl p-4 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg"
                        >
                            <div class="flex items-center justify-center mb-2">
                                <svg
                                    class="w-6 h-6"
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
                            <div class="text-center">
                                <p class="font-semibold text-sm">Kelola File</p>
                                <p class="text-xs opacity-90">Dokumen</p>
                            </div>
                            <div
                                class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"
                            ></div>
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
    stats: Object,
    recentMeetings: Array,
    recentFiles: Array,
});

const page = usePage();

const canCreateMeeting = computed(() => {
    return page.props.auth.user?.role === "KI";
});

const getCurrentDate = () => {
    return new Date().toLocaleDateString("id-ID", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};

const getRoleLabel = (role) => {
    const labels = {
        kabid: "Kepala Bidang",
        KI: "Konsultan Individu",
        tim_1: "Tim Kerja Penanggulangan Kemiskinan",
        tim_2: "Tim Kerja Kawasan Industri & PSN",
        tim_3: "Tim Kerja Peluang Investasi",
        tim_4: "Tim Kerja CSR/TJSL",
        tim_5: "Tim Kerja DBH Perkebunan",
    };
    return labels[role] || role;
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
        scheduled:
            "text-yellow-800 border border-yellow-200" + " " + "bg-yellow-100",
        completed: "bg-green-100 text-green-800 border border-green-200",
        cancelled: "bg-red-100 text-red-800 border border-red-200",
    };
    return (
        classes[status] || "bg-gray-100 text-gray-800 border border-gray-200"
    );
};

const getStatusLabel = (status) => {
    const labels = {
        scheduled: "Terjadwal",
        completed: "Selesai",
        cancelled: "Dibatalkan",
    };
    return labels[status] || status;
};
</script>
