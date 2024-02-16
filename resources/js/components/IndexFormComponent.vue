<script setup>
</script>
<script>
export default {
    data() {
        return {
            formUrl: window.location.pathname,
            searchParams:new URLSearchParams(window.location.search),
            
        }
    },
    props: {
        filterFields: {
            type: Array,
            required: true
        },
        path:{
            type: String,
            required: true,
        }


    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            const formData = new FormData(document.getElementById("formIndexVue"));
            for (const pair of formData.entries()) {
                if (pair[1] === "") {
                    formData.delete(pair[0]);
                }
            }
            const formParams = new URLSearchParams(formData);
            const newUrl = `${this.getUrl}&${formParams.toString()}`;
            window.location.href = newUrl;
        },
        removeFilters(){

        }
    },
    computed: {
        getUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('page', 1)

            const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
            return newUrl;
        },
        parsedDate(){
            return (d)=>{
                if(d!==undefined && d!==null && d!==""){
                    const date=new Date(d)
                    const formattedDate=`${date.getDate()}/${date.getMonth()+1}/${date.getFullYear()}`
                    return formattedDate
                }
                return "";
            }
        }

    },
    
    

}
</script>
<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-body">
                <!-- <form id="formIndexVue" @submit="handleSubmit"> -->
                <form id="formIndexVue" :action="formUrl">
                    <div class="row">
                        <div class="col-12 col-md-4 form-box" v-for="(item, index) in (filterFields)" :key="index">
                            <input class="form-control" v-if="item.type === 'date'" type="text"
                                :name="typeof item === 'string' ? item : (item.name ? item.name : item)"
                                :placeholder="item.placeholder ?
                                    item.placeholder :
                                    'Fecha dd/mm/yyyy'"
                                :aria-label="typeof item === 'string' ? item : (item.name ? item.name : item)"
                                onfocus="(this.type='datetime-local')" onblur="if(this.value==''){this.type='text'}"
                                :value="parsedDate(searchParams.get(item.name))"
                                >
                            <input class="form-control" v-else
                                :type="typeof item === 'string' ? 'search' : (item.type ? item.type : 'search')"
                                :name="typeof item === 'string' ? item : (item.name ? item.name : item)"
                                :placeholder="typeof item === 'string' ?
                                    item :
                                    (item.placeholder ?
                                        item.placeholder :
                                        item.name)"
                                :aria-label="typeof item === 'string' ? item : (item.name ? item.name : item)"
                                :value="searchParams.get(item.name)"
                                >

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <button type="submit" class=" btn btn-primary">Filtrar</button>
                        </div>
                        <div class="col-12 col-md-4">
                            <a :href="formUrl">
                                <button type="button" class=" btn btn-danger">Remover Filtros</button>
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <hr>
</template>