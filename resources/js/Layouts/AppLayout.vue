<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Modern Navigation -->
        <nav class="bg-white shadow-lg border-b border-gray-200">
            <div class="flex">
                <!-- Logo section aligned with sidebar -->
                <div class="w-64 px-4 py-4">
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 rounded-xl flex items-center justify-center mr-3"
                            style="
                                background: linear-gradient(
                                    135deg,
                                    #eaaa00 0%,
                                    #d69e00 100%
                                );
                            "
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
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                ></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">
                                BAPPEDA
                            </h1>
                            <p class="text-xs text-gray-500">
                                Sistem Manajemen Rapat
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Main nav content -->
                <div class="flex-1 flex justify-end items-center px-4 py-4">
                    <div
                        v-if="$page.props.auth.user"
                        class="flex items-center space-x-4"
                    >
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 rounded-full flex items-center justify-center"
                                style="
                                    background: linear-gradient(
                                        135deg,
                                        #eaaa00 0%,
                                        #d69e00 100%
                                    );
                                "
                            >
                                <span class="text-white text-sm font-semibold">
                                    {{
                                        ($page.props.auth.user?.name || 'U')
                                            .charAt(0)
                                            .toUpperCase()
                                    }}
                                </span>
                            </div>
                            <div class="hidden md:block">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $page.props.auth.user?.name || 'User' }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{
                                        getRoleLabel($page.props.auth.user?.role || '')
                                    }}
                                </p>
                            </div>
                        </div>
                        <form @submit.prevent="logout" class="inline">
                            <button
                                type="submit"
                                class="ml-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-red-600 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
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
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                    ></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Modern Sidebar -->
        <div class="flex">
            <aside
                v-if="$page.props.auth.user"
                class="w-64 bg-white shadow-lg border-r border-gray-200 min-h-screen"
            >
                <nav class="mt-6 px-4">
                    <div class="space-y-2">
                        <Link
                            href="/dashboard"
                            class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200"
                            :class="
                                $page.url === '/dashboard'
                                    ? 'text-white shadow-lg'
                                    : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                            "
                            :style="
                                $page.url === '/dashboard'
                                    ? 'background: linear-gradient(135deg, #EAAA00 0%, #D69E00 100%);'
                                    : ''
                            "
                        >
                            <div
                                class="mr-3 w-6 h-6 flex items-center justify-center"
                            >
                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"
                                    />
                                </svg>
                            </div>
                            Dashboard
                        </Link>

                        <Link
                            href="/meetings"
                            class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200"
                            :class="
                                $page.url.startsWith('/meetings')
                                    ? 'bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow-lg'
                                    : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                            "
                        >
                            <div
                                class="mr-3 w-6 h-6 flex items-center justify-center"
                            >
                                <svg
                                    class="w-5 h-5"
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
                            </div>
                            Jadwal Rapat
                        </Link>

                        <Link
                            href="/meeting-notes"
                            class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200"
                            :class="
                                $page.url.startsWith('/meeting-notes')
                                    ? 'bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow-lg'
                                    : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                            "
                        >
                            <div
                                class="mr-3 w-6 h-6 flex items-center justify-center"
                            >
                                <svg
                                    class="w-5 h-5"
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
                            </div>
                            Notulen Rapat
                        </Link>

                        <Link
                            href="/files"
                            class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200"
                            :class="
                                $page.url.startsWith('/files')
                                    ? 'bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow-lg'
                                    : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'
                            "
                        >
                            <div
                                class="mr-3 w-6 h-6 flex items-center justify-center"
                            >
                                <svg
                                    class="w-5 h-5"
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
                            Kelola File
                        </Link>
                    </div>
                </nav>
            </aside>

            <!-- Main content -->
            <main class="flex-1 p-8">
                <div class="max-w-7xl mx-auto">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";

const logout = () => {
    router.post("/logout");
};

const getRoleLabel = (role) => {
    const labels = {
        kabid: "Kepala Bidang",
        KI: "Konsultan Individu",
        tim_1: "Tim Kerja 1",
        tim_2: "Tim Kerja 2",
        tim_3: "Tim Kerja 3",
        tim_4: "Tim Kerja 4",
        tim_5: "Tim Kerja 5",
    };
    return labels[role] || role;
};
</script>
