<template>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item"  :key="currentPage">
                <a :href="links[0].url" class="page-link" v-bind:class="{'disabled':currentPage===1}" >
                    <span v-html="links[0].label"></span>
                </a>
            </li>
            <li class="page-item" v-for="(link,index) in centralLinks" :key="index">
                <a :href="link.url" class="page-link" >
                    <span v-html="link.label"></span>
                </a>
            </li>
            <li class="page-item"  :key="finalPage">
                <a :href="links[links.length-1].url" class="page-link" v-bind:class="{'disabled':currentPage===finalPage}" >
                    <span v-html="links[links.length-1].label"></span>
                </a>
            </li>
            
        </ul>
    </nav>
    <div class="row">
        <div class="col-12 col-md-4">
            <form  id="formMaxPageVue" :action="path" method="get" @change="handleFormSubmit">
                <label for="max">Filas por pagina</label><br>
                <select name="max" id="max" class="select w-100" v-model="perPageBind">
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="15">15</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                </select>
            
            </form>
            
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            centralLinks:[],
            
            
            
        }
    },
    props:{
        links:{
            type:Array,
            required:true
        },
        currentPage:{
            type:Number,
            required:true
        },
        finalPage:{
            type:Number,
            required:true
        },
        perPage:{
            type:Number,
            required:true
        },
        path:{
            type:String,
            required:true
        }
    },
    beforeMount(){
        try {
            this.centralLinks=this.links.slice(1,-1);
            this.perPageBind=this.perPage
            
            
        } catch (error) {
            console.error(`Error en el paginador: ${error}`)
        }
    },
    methods:{
        handleFormSubmit(){
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('max', this.perPageBind);
            urlParams.set('page',1)
            const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
            window.location.href = newUrl;
        }
    },
    computed:{
        totalPages(){
            return Number(this.internalData.last_page)
        }
    },
    

}
</script>