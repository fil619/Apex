<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button @click="initAddPost()" class="btn btn-primary btn-xs pull-right">
                            + Add New Post
                        </button>
                        My Post
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="posts.length > 0">
                            <tbody>
                                <tr>
                                    <th>
                                        No.
                                    </th>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                                <tr v-for="(posts, index) in posts">
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        {{ posts.title }}
                                    </td>
                                    <td>
                                        {{ posts.description }}
                                    </td>
                                    <td>
                                        <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                                        <button @click="deletePost(index)" class="btn btn-danger btn-xs">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_post_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Add New Post</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="title">Type:</label>
                            <input type="text" name="type" id="type"  class="form-control"
                                   v-model="posts.type">
                        </div>

                        <div class="form-group">
                            <label for="title">Amount:</label>
                            <input type="number" name="amount" id="amount" placeholder="Enter Amount" class="form-control"
                                   v-model="posts.amount">
                        </div>

                        <div class="form-group">
                            <label for="title">Date:</label>
                            <input type="date" name="date" id="date" class="form-control"
                                   v-model="posts.date">
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                      placeholder="Naration" v-model="posts.description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createPost" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="update_post_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Update Post</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="title">Type:</label>
                            <input type="text" name="type" id="type"  class="form-control"
                                   v-model="update_post.type">
                        </div>

                        <div class="form-group">
                            <label for="title">Amount:</label>
                            <input type="number" name="amount" id="amount" placeholder="Enter Amount" class="form-control"
                                   v-model="update_post.amount">
                        </div>

                        <div class="form-group">
                            <label for="title">Date:</label>
                            <input type="date" name="date" id="date" class="form-control"
                                   v-model="update_post.date">
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                      placeholder="Description" v-model="update_post.description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updatePost" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</template>

<script>
    export default {
        data(){
            return {
                posts: {
                  type:'',
                  amount:'',
                  date:'',
                  description: ''
                },
                errors: [],
                posts: [],
                update_post: {}
            }
        },
        mounted()
        {
            this.readPosts();
        },
        methods: {
            initAddPost()
            {
                this.errors = [];
                $("#add_post_model").modal("show");
            },
            createPost()
            {

                axios.post('/indirect', {
                  type: this.posts.type,
                  amount: this.posts.amount,
                  date: this.posts.date,
                  description: this.posts.description,
                })
                    .then(response => {

                        this.reset();

                        $("#add_post_model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.title) {
                            this.errors.push(error.response.data.errors.title[0]);
                        }

                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }
                    });
            },
            reset()
            {
                this.posts.title = '';
                this.posts.description = '';
            },
            readPosts()
            {
                axios.get('/indirect')
                    .then(response => {

                        this.posts = response.data.posts;

                    });
            },
            initUpdate(index)
            {
                this.errors = [];
                $("#update_post_model").modal("show");
                this.update_post = this.posts[index];
            },
            updatePost()
            {
                axios.patch('/indirect/' + this.update_post.id, {
                  type: this.update_post.type,
                  amount: this.update_post.amount,
                  date: this.update_post.date,
                  description: this.update_post.description,
                })
                    .then(response => {

                        $("#update_post_model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.title) {
                            this.errors.push(error.response.data.errors.title[0]);
                        }

                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }
                    });
            },
            deletePost(index)
            {
                let conf = confirm("Do you ready want to delete this post?");
                if (conf === true) {

                    axios.delete('/indirect/' + this.posts[index].id)
                        .then(response => {

                            this.posts.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            }
        }
    }
</script>
