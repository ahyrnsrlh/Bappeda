<template>
    <AppLayout>
        <div class="max-w-2xl mx-auto">
            <div class="space-y-6">
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">Edit File</h2>
                    <Link
                        href="/files"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Kembali
                    </Link>
                </div>

                <!-- Form -->
                <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                    <form @submit.prevent="submit">
                        <div class="space-y-6">
                            <!-- File Info -->
                            <div class="bg-gray-50 p-4 rounded-md">
                                <h3 class="text-sm font-medium text-gray-700">
                                    Informasi File
                                </h3>
                                <div class="mt-2 text-sm text-gray-600">
                                    <p>
                                        <strong>Nama:</strong>
                                        {{ file.original_name }}
                                    </p>
                                    <p>
                                        <strong>Ukuran:</strong>
                                        {{ file.formatted_size }}
                                    </p>
                                    <p>
                                        <strong>Jenis:</strong>
                                        {{ file.mime_type }}
                                    </p>
                                </div>
                            </div>

                            <!-- Description -->
                            <div>
                                <label
                                    for="description"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Deskripsi
                                </label>
                                <div class="mt-1">
                                    <textarea
                                        id="description"
                                        v-model="form.description"
                                        rows="3"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300':
                                                errors.description,
                                        }"
                                        placeholder="Deskripsi file (opsional)"
                                    ></textarea>
                                </div>
                                <p
                                    v-if="errors.description"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.description }}
                                </p>
                            </div>

                            <!-- Type -->
                            <div>
                                <label
                                    for="type"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Jenis File
                                </label>
                                <div class="mt-1">
                                    <select
                                        id="type"
                                        v-model="form.type"
                                        required
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.type,
                                        }"
                                    >
                                        <option value="document">
                                            Dokumen
                                        </option>
                                        <option value="meeting_note">
                                            Notulen Rapat
                                        </option>
                                        <option value="other">Lainnya</option>
                                    </select>
                                </div>
                                <p
                                    v-if="errors.type"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.type }}
                                </p>
                            </div>

                            <!-- Team -->
                            <div>
                                <label
                                    for="team_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Tim
                                </label>
                                <div class="mt-1">
                                    <select
                                        id="team_id"
                                        v-model="form.team_id"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        :class="{
                                            'border-red-300': errors.team_id,
                                        }"
                                    >
                                        <option value="">Pilih tim...</option>
                                        <option
                                            v-for="team in teams"
                                            :key="team.id"
                                            :value="team.id"
                                        >
                                            {{ team.name }}
                                        </option>
                                    </select>
                                </div>
                                <p
                                    v-if="errors.team_id"
                                    class="mt-2 text-sm text-red-600"
                                >
                                    {{ errors.team_id }}
                                </p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="pt-6 flex justify-end space-x-3">
                            <Link
                                href="/files"
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
                                <span v-else>Simpan Perubahan</span>
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
    file: Object,
    teams: Array,
    errors: Object,
});

const processing = ref(false);

const form = reactive({
    description: props.file.description || "",
    type: props.file.type || "document",
    team_id: props.file.team_id || "",
});

const submit = () => {
    processing.value = true;

    router.put(`/files/${props.file.id}`, form, {
        onFinish: () => {
            processing.value = false;
        },
    });
};
</script>
