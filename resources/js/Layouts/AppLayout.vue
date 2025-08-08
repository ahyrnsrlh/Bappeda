<template>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Modern Navigation -->
        <nav class="bg-white shadow-lg border-b border-gray-200">
            <div class="flex">
                <!-- Logo section -->
                <div class="w-80 px-4 py-4">
                    <div class="flex items-center">
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">
                                EKONOMI BAPPEDA
                            </h1>
                            <p class="text-sm text-yellow-600 font-medium">
                                PROVINSI LAMPUNG
                            </p>
                            <p class="text-xs text-gray-500">
                                Sistem Manajemen Rapat
                            </p>
                        </div>
                    </div>
                </div>

                <!-- User info -->
                <div class="flex-1 flex justify-end items-center px-4 py-4">
                    <div
                        v-if="$page.props.auth.user"
                        class="flex items-center space-x-4"
                    >
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center"
                            >
                                <span class="text-white text-sm font-semibold">
                                    {{
                                        ($page.props.auth.user?.name || "U")
                                            .charAt(0)
                                            .toUpperCase()
                                    }}
                                </span>
                            </div>
                            <div class="hidden md:block">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $page.props.auth.user?.name || "User" }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{
                                        getRoleLabel(
                                            $page.props.auth.user?.role || ""
                                        )
                                    }}
                                </p>
                            </div>
                        </div>
                        <form @submit.prevent="logout" class="inline">
                            <button
                                type="submit"
                                class="ml-4 px-3 py-2 text-sm text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors"
                            >
                                <svg
                                    class="w-4 h-4 mr-1 inline"
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

        <!-- Layout -->
        <div class="flex">
            <!-- Sidebar -->
            <aside
                v-if="$page.props.auth.user"
                class="w-64 bg-white shadow-lg border-r border-gray-200 min-h-screen"
            >
                <nav class="mt-6 px-4">
                    <div class="space-y-2">
                        <!-- Dashboard -->
                        <Link
                            href="/dashboard"
                            class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200"
                            :class="
                                $page.url === '/dashboard'
                                    ? 'bg-yellow-500 text-white shadow-lg'
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
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"
                                    />
                                </svg>
                            </div>
                            Dashboard
                        </Link>

                        <!-- Agenda Rapat Section -->
                        <div class="mb-4">
                            <h3
                                class="px-3 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider"
                            >
                                Kegiatan
                            </h3>

                            <!-- Agenda Kegiatan -->
                            <Link
                                href="/meetings"
                                class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200 mb-1"
                                :class="
                                    $page.url.startsWith('/meetings')
                                        ? 'bg-blue-500 text-white shadow-lg'
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
                                Agenda Kegiatan
                            </Link>
                        </div>

                        <!-- Tim Kerja -->
                        <Link
                            href="/teams"
                            class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200"
                            :class="
                                $page.url.startsWith('/teams')
                                    ? 'bg-purple-500 text-white shadow-lg'
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
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"
                                    />
                                </svg>
                            </div>
                            Tim Kerja
                        </Link>

                        <!-- User Approval (Kepala Bidang only) -->
                        <Link
                            v-if="$page.props.auth.user?.role === 'kabid'"
                            href="/user-approval"
                            class="group flex items-center px-3 py-3 text-sm font-medium rounded-xl transition-all duration-200"
                            :class="
                                $page.url.startsWith('/user-approval')
                                    ? 'bg-indigo-500 text-white shadow-lg'
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
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </div>
                            Persetujuan Akun
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
        wakabid: "Wakil Kepala Bidang",
        KI: "Konsultan Individu",
        tim_1: "Tim Kerja Penanggulangan Kemiskinan",
        tim_2: "Tim Kerja Kawasan Industri & PSN",
        tim_3: "Tim Kerja Peluang Investasi",
        tim_4: "Tim Kerja CSR/TJSL",
        tim_5: "Tim Kerja DBH Perkebunan",
    };
    return labels[role] || role;
};
</script>
