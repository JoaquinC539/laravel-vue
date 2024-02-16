<template>
    <div class="row justify-content-center">
        <div class="card-title">
            <div class="d-flex justify-content-center">
                    <a :href="currentPath" class="btn btn-primary" type="button">Ir a listado</a>
                </div>
                <hr>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="formEditVue" @submit="formSubmit">
                        <div class="row">
                            <div class="col-12 col-md-4 form-box">
                                <input type="number" disabled :value="id">
                            </div>
                            <div class="col-12 col-md-4 form-box" v-for="(item, index) in (parsedFieldsObjects)"
                                :key="index">
                                <input class="form-control" v-if="item.type === 'date'" type="text"
                                    :name="typeof item === 'string' ? item : (item.name ? item.name : item)"
                                    :placeholder="item.placeholder ?
                                    item.placeholder :
                                    'Fecha dd/mm/yyyy'"
                                    :aria-label="typeof item === 'string' ? item : (item.name ? item.name : item)"
                                    onfocus="(this.type='datetime-local')" onblur="if(this.value==''){this.type='text'}"
                                    :value="parsedModel[item.name]"
                                    required>
                                <input class="form-control" v-else
                                    :type="typeof item === 'string' ? 'search' : (item.type ? item.type : 'search')"
                                    :name="typeof item === 'string' ? item : (item.name ? item.name : item)"
                                    :placeholder="typeof item === 'string' ?
                                        item :
                                        (item.placeholder ?
                                            item.placeholder :
                                            item.name)"
                                    :aria-label="typeof item === 'string' ? item : (item.name ? item.name : item)"
                                    :value="parsedModel[item.name]"
                                    required>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <button type="submit" class=" btn btn-primary">Editar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</template>
<script setup>
import axios from 'axios';
</script>
<script>
const csfrToken = document.querySelector('input[name="_token"]').getAttribute('value')

export default {
    data() {
        return {
            parsedFieldsObjects: [],
            currentUrl: String,
            currentPath:String,
            parsedModel:[]
        }
    },
    props: {
        fieldsObjects: {
            type: String,
            required: true
        },
        formUrl: {
            type: String,
            required: false,
            default: window.location.pathname
        },
        title: {
            type: String,
            required: true,
            default: 'App'
        },
        model:{
            type:String,
            required: true,
        },
        id:{
            type:String,
            required:true
        }
        
        
    },

    methods: {
        formSubmit(e) {
            e.preventDefault();
            const formData = new FormData(document.getElementById("formEditVue"));
            const formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });
            axios.put(this.formUrl, formObject, {
                headers: {
                    'Content-Type':'application/json',
                    'X-CSFR-TOKEN': csfrToken,
                    
                }
            })
                .then(response => {
                    console.log(response.data)
                    window.location.reload();

                })
                .catch(error => {
                    console.error(error);
                })

        },
        formatDate(dateString) {
            const date = new Date(dateString);
            const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
            return date.toLocaleDateString('es-ES', options);
        }
    },
    beforeMount() {
        try {
            this.currentUrl = window.location.href.split('?')[0].split('/edit')[0];
            this.currentPath=this.currentUrl.split(`/${this.id}`)[0];
            this.parsedModel=JSON.parse(this.model)
            
            
            this.parsedFieldsObjects = JSON.parse(this.fieldsObjects);
        } catch (error) {
            console.error('Error parsing JSON:', error);
        }


    }
}
</script>


