<template>
	<div class="mx-auto">
		  <a  href="#" @click="create" class="btn py-3 mb-3 mr-2 px-4 text-white fs1 font1 p-success btn-lg" style="border-radius: 0.6rem">Create New <span class="text-white fa fa-chevron-down"></span></a>
		  <select id="session_id" v-model="selectedSession" @change="selectSession()" class="form-control col-lg-3 col-md-4 ">
				<option  v-for="session in sessions" :value="session.id"  :key="'x_'+session.id">{{session.session}}</option>
		   </select>
		<v-loader class="mt-2" v-if="loadederState" type="cards"></v-loader>
         <div class="task-container" style="width: 100%;">
			<div v-for="weeklywork in weeklyworks" class="task-item1 " v-bind:class="{'task-not-active':weeklywork.expired,'task-active':!weeklywork.expired}" tabindex="1">
				<span class="">				
					<h5 class="t-h0">{{weeklywork.course.code}}</h5>
					<h4 class="t-h1 text-center">{{weeklywork.title}}</h4>		
				</span>				
				<p style="color:inherit;position: absolute;bottom: -15px;" class="fs01 fw6 font">{{weeklywork.date_open}} - {{weeklywork.date_close}}</p>	
				<div class="task-overlay" >				
					<div class="task-text">
						<h5 >Experiments</h5>
						<ul style="max-height: 44px;overflow-y: scroll;display: block;">
							<li v-for="experiment in weeklywork.weekly_work_experiments">{{experiment.experiment.name}}</li>							
						</ul>
					</div>
					<div class="task-btns">					
						<div class="task-btn" @click="deletework(weeklywork.id)">Delete</div>
						<div class="task-btn" @click="editTask(weeklywork)">Edit</div>
						<div class="task-btn" @click="taskCode(weeklywork.access_code)">show Code</div>
					</div>
				</div>
			</div>
        </div>
			<div v-if="weeklyworks.length < 1 && !loadederState" style="display: flex;flex-wrap: wrap;justify-content: center;align-items: center; width: 100%" >
            	<h3 style="color: #bbbbbc;" class="font">No Task Has Been Created</h3>
            </div> 		
<!--         <template id='code-toast'>
		  <swal-title></swal-title>
		</template> -->
	</div>
</template>

<script >
	import taskform from './taskForm.vue';
	export default{
		components:{
			'v-taskform':taskform
		},
		data(){
			return{
				courses_experiments:null,
				faculty_courses: null,
				loadederState: true,
				selectedSession:"",
				sessions:[],
				weeklyworks:[
					/* {id: 1, date_open:'12/02/2021', date_close:'12/04/2021', access_code:'1235', title: 'week 1',course_code:'phy 106',is_expired:true,course:{id:12,code:''}, experiments:[{id:1,name:'Vernier Caliper'},{id:2,name:'micrometer Screw Guage'}] } */
				] 
			}
		},
		methods:{
			selectSession(){			
				this.stepBack=1	
				this.section =0
				this.queryData(this.selectedSession)
			},
			queryData(session_id){				
				let $this = this;	
				this.axiosGet(this.baseApiUrl+'works/weekly_works/'+session_id).then(function(res){
					$this.weeklyworks = res				
					if ($this.weeklyworks.length<1) {
						Swal.fire({
							title:'No Task Found',
							text:"You have not created any task, click on the 'create new' button on the page",
							icon:'warning',
							showDenyButton: false,
							showCancelButton: true,				    
							confirmButtonColor:'#00b96b',		
							cancelButtonColor:'#d33',		
						})
					}
					$this.loadederState = false;						
					/* initialize button ripple */
					setTimeout(function() {
						$this.rippleButton(); 								
					}, 200);			
				})                   			
			},
			create:function () {								
				this.VueSweetAlert2('v-taskform',{
					faculty_courses:this.faculty_courses,
					courses_experiments:this.courses_experiments,
					update:false,
					session:this.selectedSession,
					session_name: $(`#session_id option[value=${this.selectedSession}]`).text(),
					experiment_data_format: this.$store.state.experiment_data_format
				})
			},
			 deletework:function(id){			 	
                 this.axiosDelete(this.baseApiUrl+'works/delete', {work_id:id});
               },      
			editTask:function(obj){
					this.VueSweetAlert2('v-taskform',{
						faculty_courses:this.faculty_courses,
						courses_experiments:this.courses_experiments,
						update:true,
						alldata:obj,
						session:this.selectedSession,
						session_name: $(`#session_id option[value=${this.selectedSession}]`).text(),
						experiment_data_format:this.$store.state.experiment_data_format						
					})
					setTimeout(function() {
						$('.swal2-cancel').click(function(){
							alert();
						})
					}, 2000);
			},
			taskCode:function(code){
			
				let $this = this;
					Swal.fire({
						title: 'Verify Your Identity',
						html: `<p class="font1 fs01 fw6">Enter you password</p>
						<input type="password" id="swal-input1" class="swal2-input mt-1" value="">`,
						confirmButtonText:'Ok',					      
					      cancelButtonText:'Cancel',				      				      
					      cancelButtonColor:'#dd000f',					      
					      confirmButtonColor:'#00b96b',					      
					      showCancelButton:true,					      
					      showLoaderOnConfirm: true,	
					      focusConfirm: false,					  
						  preConfirm: () => {						
							  try{

								  return	$this.axios.post($this.baseApiUrl+'verify_user',$this.createFormData({username:$this.currentUser.username,password:document.getElementById('swal-input1').value}), $this.axiosHeader,{headers:$this.axiosHeader}).then(response => {	
									  if (!response.data.sucess) {
								           throw new Error(response.statusText)	
								        }						   
								        return response.data.success;
						  		}).catch(error => {						  									  		
							      	if (error.response) {
										  if (error.response.status == 409) {
											  }else if(error.response.status == 401){
												  location.reload();
								      	}else{
								      		Swal.showValidationMessage('Failed: wrong password');						      								      		
								      	}
							      	}
					      	})	
							}catch(e){
								console.log(e)
							}  		
						  	
						  },
					}).then((result)=>{
						if (result.value){
							Swal.fire({
								html: `<p class="text-success fs1 w-100 fw6 text-right mx-0" id="code-point">${code}</p>`,
								confirmButtonColor:'#00b96b',	
							});
							let charCode = code.split(''), c=-1;
							$('#code-point').animate(
								{'padding-right': '50%'}
							);
						
						}
					})
			}

		},
		 async created(){        
         	let faculty_id = this.currentUser.faculty_id;
			let $this = this;
		    this.axiosGet('api/session/all_session').then(async function(res){
				$this.sessions = res;				
				if($this.sessions.length >0){
					let session;
					session = $this.sessions.filter((a,b)=>a.is_current == 1)
					if(session.length>0){
						$this.selectedSession = session[0].id						
					}
				}	
				$this.faculty_courses  = await $this.axiosGetById('api/courses/faculty_courses','faculty_id', faculty_id);
				try{
					$this.queryData($this.selectedSession)
				}catch(e){
					console.log(e)
				}
			});	

         
      
          },
         
		
	}
</script>
<style scoped="">
	    ul li{line-height: 1em;}
</style>