<template>
  <div id="cont">
    <div class="">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Posts</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addPostModal" class="btn btn-success" data-toggle="modal"> <span>Add New Post</span></a>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                 <!-- v-if="posts" -->
                <tbody>
                    <tr v-for="post in posts" :key="post.id">
                        <td>{{ post.title }}</td>
                        <td>{{post.body.substr(0,150)}}</td>
                        <td v-if="post.image">
                            <img :src="'storage/'+post.image" style="width:100px;height:60px;border:1px solid #e7e7e7" alt="">
                        </td>
                        <td v-else>
                        </td>
                        <td v-if="post.status == 1">active</td>
                        <td v-else>unactive</td>
                        <td v-if="post.category">{{ post.category.name }}</td>
                        <td>{{ post.user.name }}</td>
                        <td>
                            <a href="#editPostModal" class="edit" @click="editPost(post,$event)"
							 data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <button style="color:red;background:white;border:none"
                            @click.prevent="deletePost(post.id)" class="delete" ><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
                            <button style="color:black;background:white;border:none"
                            @click.prevent="deleteImage(post.id)" class="delete" ><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></button>
						</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
	<!-- Edit Modal HTML -->
	<div id="addPostModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form enctype="multipart/form-data">
					<div class="modal-header">
						<h4 class="modal-title">Add Post</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Title</label>
							<input type="text" class="form-control" required v-model="title">
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea name=""  cols="20" class="form-control" v-model="body"
                            rows="3"></textarea>
						</div>
                        <div class="form-group">
							<label>Date</label>
							<input type="date" class="form-control" required v-model="date">
                         <!-- <input name="duedate"type="date" value=@if(!empty($task)) "{{$task->duedate->format('Y-m-d')}}" @else "{{\Carbon\Carbon::now()->format('Y-m-d')}}" @endif/> -->
						</div>
                        <div class="form-group">
							<label>Category</label>
							<select name="" class="form-control" v-model="category">
                                <option value="0" disabled selected>choose category</option>
                                <option :value="category.id" v-for="category in categories" :key="category.id">
								 {{ category.name }}
								</option>
                            </select>
						</div>
                        <!-- <div class="form-group">
                            <input  class="form-check-input" type="radio" id="active" v-model="status">
                            <label class="form-check-label" for="active">active</label>
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="radio" id="unactive" v-model="status">
                            <label for="unactive">unactive</label>
                        </div> -->
                        <div>
                            <p>
                            <input type="radio" name="status" id="active" :value="1" v-model="status">
                            <label class="form-check-label" for="active">active</label>
                            </p>
                        </div>
                           <div>
                            <p>
                            <input type="radio" name="status" id="unactive" :value="0" v-model="status">
                            <label for="unactive">unactive</label>
                            </p>
                        </div>
						<div class="form-group">
							<label>Image</label>
							<input type="file" class="form-control"  required @change="onImageChanged" >
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add" @click.prevent="addPost">
					</div>
				</form>
			</div>
		</div>
	</div>
   <editpost></editpost>
</div>
</template>

<script>
import editpost from './EditPost'
export default {
	data(){
		return {
			posts :[],
			title :'',
			body  :'',
			image : '',
            date :'',
            status:'',
            categories : [],
            category:''
		}
	},
	created(){
		this.getPosts();
        this.getCategories();
	},
	components:{
          editpost
	},
	methods:{
		getPosts(){
                axios.get("http://localhost:8000/api/admin/posts")
                .then(res => {
                    this.posts = res.data;
                })
                .then(err => console.log(err))
			},
            getCategories(){
               axios.get('http://localhost:8000/api/admin/categories')
                .then(res => {
                    console.log(res.data)
                    this.categories = res.data;
                })
                .then(err => console.log(err))
		},
		onImageChanged(event){
			this.image  = event.target.files[0]
		},
		addPost(){
			let config = {
				headers :{"content-type" : 'multipart/form-data'}
			}
			let formdata = new FormData();
            formdata.append('title',this.title);
            formdata.append('body',this.body);
            formdata.append('image',this.image);
            formdata.append('status',this.status);
            formdata.append('category',this.category);
            formdata.append('date',this.date);
			axios.post("http://localhost:8000/api/admin/addPost",formdata,config
            )
			.then(res => {
				console.log(res);
				this.title = '';
				this.body = '';
				this.image = '';
                this.status = '';
                this.category = '';
                this.date= '';
				// $('#addPostModal').modal('hide');
				// $('.modal-backdrop').css('display','none')
                 $("#addPostModal").removeClass("in");
                 $(".modal-backdrop").remove();
                $("#addPostModal").hide();
                this.getPosts();
			})
		},
		editPost(post){
			this.$store.commit('EditPost',post)
		},

		deletePost(id){
			 axios.post('http://localhost:8000/api/admin/deletePost/'+id)
			 .then(res => {
				 console.log(res.data)
				//  $('#deletePostModal').modal('hide');
				// $('.modal-backdrop').css('display','none');
				this.getPosts();
			 })
			 .catch(err =>{
				 console.log(err)
			 })
		},
		deleteImage(id){
              axios.post('http://localhost:8000/api/admin/deleteImage/'+id)
			 .then(res => {
				 console.log(res.data)
				this.getPosts();
			 })
              .catch(err =>{
				 console.log(err)
			 })
		}
	}
}

</script>


<style type="text/css" scoped>
    #cont {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
	}
	.table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px 0;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {
		padding-bottom: 15px;
		background: #435d7d;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 400px;
	}
	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}
	.modal form label {
		font-weight: normal;
	}
</style>
