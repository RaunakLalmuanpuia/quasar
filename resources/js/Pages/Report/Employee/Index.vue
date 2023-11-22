<template>
    <QuasarLayout>
        <q-table
            v-model:pagination="pagination"
            :rows="employee_reports.data"
            :columns="columns"
            :props="props"
            row-key="name"
            flat
            bordered
            separator="cell"
            wrap-cells
            @request="tableData"
        >
            <template v-slot:top>
                <span class="text-2xl">Report List</span>
                <q-space />
                <q-input
                    autofocus
                    dense
                    debounce="800"
                    @update:model-value="handleSearch"
                    color="primary"
                    v-model="search"
                    placeholder="Search"
                >
                    <template v-slot:append>
                        <q-icon name="search" />
                    </template>
                    <q-tooltip> Search using any column name. </q-tooltip>
                </q-input>
            </template>

            <template v-slot:body-cell-id="props">
                <q-td key="id" :props="props">
                    {{ props.rowIndex + 1 }}
                </q-td>
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td key="action" :props="props">
                    <q-btn
                        dense
                        round
                        flat
                        color="blue"
                        @click="EditRow(props.row.id)"
                        icon="visibility"
                    ></q-btn>
                    <q-btn
                        dense
                        round
                        flat
                        color="red"
                        @click="deleteRow(props.row.id)"
                        icon="delete"
                    ></q-btn>
                    <q-btn
                        dense
                        round
                        flat
                        color="blue"
                        @click="EditRow(props.row.id)"
                        icon="edit"
                    ></q-btn>
                    <q-btn
                        dense
                        round
                        flat
                        color="blue"
                        @click="EditRow(props.row.id)"
                        icon="undo"
                    ></q-btn>
                </q-td>
            </template>
        </q-table>
    </QuasarLayout>
</template>

<script setup>
import { ref } from "vue";
import QuasarLayout from "@/Layouts/QuasarLayout.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps(["employee_reports", "search"]);
const search = ref(props.search);

const columns = [
    {
        name: "id",
        align: "left",
        label: "Sl No",
        field: "id",
        headerClasses: "",
    }, //field:row=> 'ID : ${row.id}' //ka append duh chuan
    { name: "name", align: "left", label: "Name", field: "name" },
    {
        name: "employer_status",
        align: "left",
        label: "Status",
        field: "employer_status",
    },

    {
        name: "employer_name",
        align: "left",
        label: "Employer",
        field: "employer_name",
    },
    {
        name: "employer_feedback",
        align: "left",
        label: "Employer Feedback",
        field: "employer_feedback",
    },
    {
        name: "manager_name",
        align: "left",
        label: "Manager Name",
        field: "manager_name",
    },
    {
        name: "manager_status",
        align: "left",
        label: "Manager Status",
        field: "manager_status",
    },
    {
        name: "manager_feedback",
        align: "left",
        label: "Manager Feedbak",
        field: "manager_feedback",
    },
    { name: "actions", align: "left", label: "Action", field: "id" },
];

const pagination = ref({
    page: props.employee_reports?.current_page || 0,
    rowsPerPage: props.employee_reports.per_page,
    rowsNumber: props.employee_reports.total,
});

function handleSearch(val) {
    search.value = val;
    tableData({ pagination });
}
function tableData(props) {
    const { page, rowsPerPage } = props.pagination;
    router.get(
        route("report.index"),
        {
            per_page: rowsPerPage,
            page: page,
            search: search.value,
        },
        {}
    );
}
</script>
