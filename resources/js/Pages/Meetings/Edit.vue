<template>
    <AppLayout>
        <div class="max-w-2xl mx-auto">
            <div class="space-y-6">
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Edit Jadwal Rapat
                    </h2>
                    <Link
                        :href="`/meetings/${meeting.id}`"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Kembali
                    </Link>
                </div>

                <!-- Form -->
                <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                    <form @submit.prevent="submit">
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label
                                    for="title"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Judul Rapat
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="title"
                                        v-model="form.title"
                                        type="text"
                                        required
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.title,
                                        }"
                                    />
                                </div>
                                <p
                                    v-if="errors.title"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.title }}
                                </p>
                            </div>

                            <!-- Meeting Date -->
                            <div>
                                <label
                                    for="meeting_date"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Tanggal & Waktu Rapat
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="meeting_date"
                                        v-model="form.meeting_date"
                                        type="datetime-local"
                                        required
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300':
                                                errors.meeting_date,
                                        }"
                                    />
                                </div>
                                <p
                                    v-if="errors.meeting_date"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.meeting_date }}
                                </p>
                            </div>

                            <!-- Location -->
                            <div>
                                <label
                                    for="location"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Lokasi Rapat
                                </label>
                                <div class="mt-1">
                                    <input
                                        id="location"
                                        v-model="form.location"
                                        type="text"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.location,
                                        }"
                                        placeholder="Ruang Rapat Utama"
                                    />
                                </div>
                                <p
                                    v-if="errors.location"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.location }}
                                </p>
                            </div>

                            <!-- Participants -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Peserta Rapat
                                </label>
                                <div class="mt-2 space-y-2">
                                    <div
                                        v-for="team in teams"
                                        :key="team.id"
                                        class="flex items-center"
                                    >
                                        <input
                                            :id="`team_${team.id}`"
                                            v-model="form.participant_teams"
                                            :value="team.id"
                                            type="checkbox"
                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        />
                                        <label
                                            :for="`team_${team.id}`"
                                            class="ml-2 block text-sm text-gray-900"
                                        >
                                            {{ team.name }}
                                        </label>
                                    </div>
                                </div>
                                <p
                                    v-if="errors.participant_teams"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.participant_teams }}
                                </p>
                            </div>

                            <!-- Status -->
                            <div>
                                <label
                                    for="status"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Status
                                </label>
                                <div class="mt-1">
                                    <select
                                        id="status"
                                        v-model="form.status"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.status,
                                        }"
                                    >
                                        <option value="scheduled">
                                            Terjadwal
                                        </option>
                                        <option value="completed">
                                            Selesai
                                        </option>
                                        <option value="cancelled">
                                            Dibatalkan
                                        </option>
                                    </select>
                                </div>
                                <p
                                    v-if="errors.status"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.status }}
                                </p>
                            </div>

                            <!-- Notes -->
                            <div>
                                <label
                                    for="notes"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Catatan Tambahan
                                </label>
                                <div class="mt-1">
                                    <textarea
                                        id="notes"
                                        v-model="form.notes"
                                        rows="3"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.notes,
                                        }"
                                        placeholder="Catatan atau informasi tambahan..."
                                    ></textarea>
                                </div>
                                <p
                                    v-if="errors.notes"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.notes }}
                                </p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="pt-6 flex justify-end space-x-3">
                            <Link
                                :href="`/meetings/${meeting.id}`"
                                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Batal
                            </Link>
                            <button
                                type="submit"
                                :disabled="processing"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
                            >
                                <span v-if="processing">Menyimpan...</span>
                                <span v-else>Update Jadwal</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { reactive, ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    meeting: Object,
    teams: Array,
    errors: Object,
});

const processing = ref(false);

// Format datetime for input
const formatDatetimeLocal = (date) => {
    if (!date) return "";
    const d = new Date(date);
    // Ensure we're working with Jakarta timezone
    const jakartaTime = new Date(d.toLocaleString("en-US", {timeZone: "Asia/Jakarta"}));
    const year = jakartaTime.getFullYear();
    const month = String(jakartaTime.getMonth() + 1).padStart(2, "0");
    const day = String(jakartaTime.getDate()).padStart(2, "0");
    const hours = String(jakartaTime.getHours()).padStart(2, "0");
    const minutes = String(jakartaTime.getMinutes()).padStart(2, "0");
    return `${year}-${month}-${day}T${hours}:${minutes}`;
};

const form = reactive({
    title: props.meeting.title || "",
    meeting_date: formatDatetimeLocal(props.meeting.meeting_date),
    location: props.meeting.location || "",
    participant_teams: props.meeting.participant_teams || [],
    status: props.meeting.status || "scheduled",
    notes: props.meeting.notes || "",
});

const submit = () => {
    processing.value = true;

    router.put(`/meetings/${props.meeting.id}`, form, {
        onFinish: () => {
            processing.value = false;
        },
    });
};
</script>
