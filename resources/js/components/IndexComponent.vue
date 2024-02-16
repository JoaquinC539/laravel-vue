<script setup>
import axios from 'axios';
</script>
<script>
const csfrToken = document.querySelector('input[name="_token"]').getAttribute('value')
export default {
    data() {
        return {
            currentUrl: window.location.pathname,
            parsedData: [],
            parsedQuery: null,
            parsedColsNames: null,
            parsedFilterFields: null,
            parsedActions: null
        }
    },
    props: {
        title: {
            type: String,
            default: "Index"
        },
        data: {
            type: String,
            required: true
        },
        query: {
            type: String,
            required: false
        },
        colsNames: {
            type: String,
            required: false
        },
        filterFields: {
            type: String,
            required: false,
            default: null
        },
        actions: {
            type: String,
            required: false,
            default: null
        }

    },
    beforeMount() {
        try {
            this.parsedData = JSON.parse(this.data)
            if (this.query) {
                this.parsedQuery = JSON.parse(this.query)
            }
            if (this.colsNames) {
                this.parsedColsNames = JSON.parse(this.colsNames)
            }
            if (this.filterFields) {
                this.parsedFilterFields = JSON.parse(this.filterFields)
            }
            if (this.actions) {
                this.parsedActions = JSON.parse(this.actions)
            }
        } catch (error) {
            console.error(`Error in parsing data: ${error}`)
        }

    },
    computed: {
        getCreateUrl() {
            const path = this.parsedData['path']
            // return `${this.currentUrl}/create`
            return `${path}/create`
        }

    },
    methods: {
        deleteRow(id) {
            const url=`${this.currentUrl}/${id}`
            axios.delete(`${this.currentUrl}/${id}`,{
                headers:{
                    'Content-Type':'application/json',
                    'X-CSFR-TOKEN': csfrToken,
                    'HTTPRequest':'application/json'
                }
            })
            .then((response)=>{
                console.log(response)
                // window.location.reload(true)
            })
            .catch((error)=>{
                console.error(error)
                // window.location.reload(true)
            })
        }
    }
}
</script>
<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-title justify-content-center">
                    <div class="d-flex justify-content-center"></div>
                    <h4 class="">{{ title }}</h4>
                </div>
                <div class="d-flex justify-content-center">
                    <a :href="getCreateUrl" class="btn btn-primary" type="button">Nuevo {{ title }}</a>
                </div>
                <hr>
                <div class="card-body">
                    <index-form-component v-if="filterFields" :filterFields="parsedFilterFields"
                        :path="parsedData['path']"></index-form-component>
                    <div class="table-responsive">
                        <table class="table align-middle table-stripped" id="tableIndexVue">
                            <thead>
                                <th v-if="parsedActions" class="text-center">
                                    Acciones
                                </th>
                                <th v-if="parsedColsNames" v-for="(value, key) in parsedColsNames" :key="value"
                                    class="text-center">
                                    {{ value }}
                                </th>
                                <th v-else v-for="(header, index) in Object.keys(parsedData.data[0])" :key="index"
                                    class="text-center">
                                    {{ header }}
                                </th>
                            </thead>
                            <tbody>
                                <tr v-for="(object, index)  in parsedData.data" :key="index">
                                    <td class="text-center" v-if="parsedActions">
                                        <span v-for="(value, key) in parsedActions">
                                            <span v-if="value === 'edit'" class="action-btn">
                                                <a :href="currentUrl + '/' + (object.id ? object.id : object._id)"><i
                                                        class="fa-solid fa-pencil"></i></a>
                                            </span>
                                            <span v-if="value === 'delete'" class="action-btn">
                                                <i class="fa-solid fa-trash"
                                                    @click="deleteRow(object.id ? object.id : object._id)"
                                                    style="cursor: pointer;"></i>
                                            </span>
                                        </span>
                                    </td>
                                    <td v-for="(value, key) in object" :key="key" class="text-center text-truncate">
                                        {{ value }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <paginator-component :links="parsedData.links" :current-page="parsedData.current_page"
                        :final-page="parsedData.last_page" :per-page="parsedData.per_page"
                        :path="parsedData.path"></paginator-component>
                </div>
            </div>
        </div>

</div></template>
