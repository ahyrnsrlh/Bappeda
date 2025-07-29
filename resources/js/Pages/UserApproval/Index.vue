<template>
    <AppLayout>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Persetujuan Akun Pengguna</h1>

            <!-- Tabs -->
            <div class="mb-6">
                <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg">
                    <button
                        @click="activeTab = 'pending'"
                        :class="
                            activeTab === 'pending' ? 'bg-white shadow' : ''
                        "
                        class="flex-1 py-2 px-4 text-sm font-medium rounded-md transition-colors"
                    >
                        Menunggu Persetujuan ({{ pendingUsers.length }})
                    </button>
                    <button
                        @click="activeTab = 'approved'"
                        :class="
                            activeTab === 'approved' ? 'bg-white shadow' : ''
                        "
                        class="flex-1 py-2 px-4 text-sm font-medium rounded-md transition-colors"
                    >
                        Sudah Disetujui ({{ approvedUsers.length }})
                    </button>
                </div>
            </div>

            <!-- Pending Users -->
            <div v-if="activeTab === 'pending'">
                <div v-if="pendingUsers.length === 0" class="text-center py-8">
                    <p class="text-gray-500">
                        Tidak ada akun yang menunggu persetujuan
                    </p>
                </div>
                <div
                    v-else
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                >
                    <div
                        v-for="user in pendingUsers"
                        :key="user.id"
                        class="bg-white rounded-lg shadow p-4"
                    >
                        <div class="mb-4">
                            <h3 class="font-semibold">{{ user.name }}</h3>
                            <p class="text-sm text-gray-600">
                                {{ user.email }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Role: {{ getRoleLabel(user.role) }}
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <button
                                @click="openModal(user, 'approve')"
                                class="flex-1 bg-green-500 text-white py-2 px-3 rounded text-sm hover:bg-green-600"
                            >
                                Setujui
                            </button>
                            <button
                                @click="openModal(user, 'reject')"
                                class="flex-1 bg-red-500 text-white py-2 px-3 rounded text-sm hover:bg-red-600"
                            >
                                Tolak
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approved Users -->
            <div v-if="activeTab === 'approved'">
                <div v-if="approvedUsers.length === 0" class="text-center py-8">
                    <p class="text-gray-500">Belum ada akun yang disetujui</p>
                </div>
                <div
                    v-else
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                >
                    <div
                        v-for="user in approvedUsers"
                        :key="user.id"
                        class="bg-white rounded-lg shadow p-4"
                    >
                        <div class="mb-4">
                            <h3 class="font-semibold">{{ user.name }}</h3>
                            <p class="text-sm text-gray-600">
                                {{ user.email }}
                            </p>
                            <p class="text-sm text-gray-600">
                                Role: {{ getRoleLabel(user.role) }}
                            </p>
                            <p
                                v-if="user.approved_at"
                                class="text-sm text-green-600"
                            >
                                Disetujui: {{ formatDate(user.approved_at) }}
                            </p>
                        </div>
                        <button
                            @click="openModal(user, 'revoke')"
                            class="w-full bg-gray-500 text-white py-2 px-3 rounded text-sm hover:bg-gray-600"
                        >
                            Cabut Persetujuan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div
                v-if="showModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
            >
                <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        {{
                            modalAction === "approve"
                                ? "Setujui Akun"
                                : modalAction === "reject"
                                ? "Tolak Akun"
                                : "Cabut Persetujuan"
                        }}
                    </h3>
                    <p class="mb-4">{{ selectedUser?.name }}</p>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">
                            {{
                                modalAction === "approve"
                                    ? "Catatan (opsional)"
                                    : "Alasan"
                            }}
                        </label>
                        <textarea
                            v-model="notes"
                            :required="modalAction !== 'approve'"
                            rows="3"
                            class="w-full border border-gray-300 rounded-md px-3 py-2"
                            :placeholder="
                                modalAction === 'approve'
                                    ? 'Tambahkan catatan...'
                                    : 'Jelaskan alasan...'
                            "
                        ></textarea>
                    </div>

                    <div class="flex space-x-3">
                        <button
                            @click="closeModal"
                            class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400"
                        >
                            Batal
                        </button>
                        <button
                            @click="submitApproval"
                            :disabled="
                                isSubmitting ||
                                (modalAction !== 'approve' && !notes.trim())
                            "
                            :class="{
                                'bg-green-500 hover:bg-green-600':
                                    modalAction === 'approve',
                                'bg-red-500 hover:bg-red-600':
                                    modalAction === 'reject',
                                'bg-gray-500 hover:bg-gray-600':
                                    modalAction === 'revoke',
                            }"
                            class="flex-1 text-white py-2 px-4 rounded disabled:opacity-50"
                        >
                            {{
                                isSubmitting
                                    ? "Memproses..."
                                    : modalAction === "approve"
                                    ? "Setujui"
                                    : modalAction === "reject"
                                    ? "Tolak"
                                    : "Cabut"
                            }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    users: Array,
    flash: Object,
});

const activeTab = ref("pending");
const showModal = ref(false);
const selectedUser = ref(null);
const modalAction = ref("");
const notes = ref("");
const isSubmitting = ref(false);

const pendingUsers = computed(() => {
    return props.users.filter(
        (user) => user.is_approved === false || user.is_approved === null
    );
});

const approvedUsers = computed(() => {
    return props.users.filter((user) => user.is_approved === true);
});

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

const formatDate = (dateString) => {
    if (!dateString) return "N/A";
    return new Date(dateString).toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};

const openModal = (user, action) => {
    selectedUser.value = user;
    modalAction.value = action;
    notes.value = "";
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    selectedUser.value = null;
    modalAction.value = "";
    notes.value = "";
    isSubmitting.value = false;
};

const submitApproval = () => {
    if (isSubmitting.value) return;

    if (modalAction.value !== "approve" && !notes.value.trim()) {
        alert("Mohon isi alasan terlebih dahulu");
        return;
    }

    isSubmitting.value = true;

    const routeName =
        modalAction.value === "revoke"
            ? "user-approval.revoke"
            : "user-approval.update";
    const data = {
        user_id: selectedUser.value.id,
        action: modalAction.value,
        approval_notes: notes.value.trim() || null,
    };

    router.post(route(routeName), data, {
        onSuccess: () => {
            closeModal();
        },
        onError: (errors) => {
            console.error("Error:", errors);
            isSubmitting.value = false;
        },
    });
};
</script>
