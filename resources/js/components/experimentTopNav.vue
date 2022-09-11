<template>
	<div style=" background:var(--blue); margin:0; padding: 5px 20px 5px 20px;display: flex;justify-content: space-between;width: 100%;background: #eee;">
		<div style="display: flex;flex-wrap: wrap;align-items: center; ">
			<span @click="toggleSysnav" style="font-size: 1.4em;cursor: pointer;" class="fa fa-align-justify mr-3"></span>
			<b><span style="font-weight: 800;font-size: 1em;"></span> {{coursecode.code}}/{{equipmentname}}/</span><span style="font-weight: 600;font-size: 0.9em;" >{{experimentnum}}</span></b>
		</div>
		<div style="display: flex;flex-wrap: wrap;align-items: center;">
			<span class="fa fa-user mr-2"></span>
			<span style="font-size: 0.9em; font-weight: 300;">{{username}}</span>
			<span class="fa fa-chevron-down ml-2"></span>
		</div>
	</div>
</template>

<script>
	export default{

	 data:function() {
	    	return{
	    	 navState:false,
	    	 username:'',
			 coursecode:{code:""},
	    	}
        },
        methods:{
        	toggleSysnav: function () {				
//        		alert(this.navState);
        		this.navState = !this.navState;
			   this.$eventBus.$emit('toggleFromSysTopNav',{text:this.navState});
			    //this.newTodoText = ''
			} 
        },	
        async created(){
        	this.username = this.currentUser.first_name; 
			let SearchParams =window.location.href.split('/');
			let id = SearchParams[SearchParams.length-1];
			let coursecode = await this.axiosGetByParams('api/courses/get_course_code_by_weekly_course_experiment_id',{id:id});
			this.coursecode = coursecode[0];
        },
        
         props: ['equipmentname','experimentnum'],
         mounted(){	         	
         },
         events :{
         	'toggleFromSysTopNav':'toggleFromSysTopNav' 
         }

	}
</script>
<style scoped>
	div{
		font-family: 'Roboto', sans-serif;
	}
	@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
	
</style>