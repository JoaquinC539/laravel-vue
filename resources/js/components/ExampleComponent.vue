<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-title">{{ title }}</h4>

                <div class="card-body">
                    <p>{{ message }}.</p>
                    
                    <div class="row justify-content-center">
                        <a href="/user" class="btn btn-primary" type="button">Ir a usuarios</a>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            value:Number
        }
    },
    props: {
        title: {
            type:String,
            default: "Titulo default"
        },
        message:{
            type:String,
            default:"Mi mensaje por default"
        },
    },
    mounted() {
        
    }
}
</script>
