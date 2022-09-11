<template>
	<div class="w-100">      
        <div class="w-100 m-0 p-0" v-if="type=='table'">            
            <span v-for="i in Number(count)" class="w-100">
                <div class="ssc-head-line mb" style="height: 100px;"></div>
                <div class="ssc-line mt-2 w-100"></div>
                <div class="ssc-line mb w-75"></div>
                <div class="ssc-line mb w-50"></div>
                <div class="ssc-line mb w-25"></div>
                <br v-if='i != count'>       
            </span>      
        </div>

        <div class="w-100 m-0 p-0" v-if="type=='line'">
            <div class="ssc-line mb w-75"></div>
            <div class="ssc-line mb w-50"></div>
        </div>

        <div class="w-100 m-0 p-0 row" v-if="type=='cards'">
            <div class="col-md-4 col-sm-12 my-2 px-2">
                <div class="ssc-line mb w-100" style="height:180px"></div>
            </div>
             <div class="col-md-4 col-sm-12 my-2 px-2">
                <div class="ssc-line mb w-100" style="height:180px"></div>
            </div>
             <div class="col-md-4 col-sm-12 my-2 px-2">
                <div class="ssc-line mb w-100" style="height:180px"></div>
            </div>
             <div class="col-md-4 col-sm-12 my-2 px-2">
                <div class="ssc-line mb w-100" style="height:180px"></div>
            </div>
            <div class="col-md-4 col-sm-12 my-2 px-2">
                <div class="ssc-line mb w-100" style="height:180px"></div>
            </div>
            <div class="col-md-4 col-sm-12 my-2 px-2">
                <div class="ssc-line mb w-100" style="height:180px"></div>
            </div>
        </div>
    </div>
</template>
<script>
	export default{
        props:{
            type:{
                type:String,
                default:function(){
                    return 'table';
                }
            },
            count: {
                type:String,
                default: function(){
                    return '3';
                }
            }
        },
        created(){
            this.count
        }

	}
</script>
<style scoped>
.d-flex-grids{

}
</style>