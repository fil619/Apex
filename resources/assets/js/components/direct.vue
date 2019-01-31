<template>
    <div >
                <div class="modal-content">
                    <div class="modal-header"  style="background:#d50000">
                        <h4 class="modal-title" style="color:white">Direct Expense</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>

                          <!--Add Modal -->
                          <div class="modal fade" id="ADDModal" role="dialog">
                            <div class="modal-dialog">

                              <!--ADD Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"  >Add Direct dledgers</h4>
                                </div>
                                <div class="modal-body">
                                    <label for="addledger" style="font-size: 15px;">Ledger:</label>
                                    <input type="text" name="ledger" id="ledger" placeholder="Add Ledger"  class="input-sm"  v-model="dledgers.ledger">
                                    <button type="button" style="font-size: 15px;" name="button" class="btn-primary" @click="createLeger">Add</button>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal content-->

                          <!--View Modal -->
                          <div class="modal fade" id="viewModal" role="dialog">
                            <div class="modal-dialog">

                          <!--View Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">View Indirect Ledgers</h4>
                            </div>
                            <div class="modal-body">

                              <table class="table table-bordered table-striped table-responsive" v-if="dledgers.length > 0">
                                  <tbody>
                                      <tr>
                                          <th>
                                              No.
                                          </th>
                                          <th>
                                              Type
                                          </th>
                                          <th>
                                              Action
                                          </th>
                                      </tr>
                                      <tr v-for="(dledger, index) in dledgers">
                                        <td>{{ index + 1 }}</td>
                                          <td v-if="ledgerindex == index ">
                                              <input type="text" name="" v-model="dledger.ledger">
                                              <button @click="updateled(index)" class="btn-xs btn-danger">Update</button>
                                              <button @click="cancelled" class="btn-xs btn-danger">Cancel</button>

                                          </td>
                                          <td v-else>
                                              <input type="text" name="" v-model="dledger.ledger" disabled>
                                          </td>

                                          <td>
                                            <button @click="EditLedger(index)" class="btn-xs btn-warning">Edit</button>
                                              <button @click="DeleteLedger(dledger.id)" class="btn-xs btn-danger">Delete</button>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>


                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal content-->

                        <div class="form-group">
                            <label for="title">Type:</label>
                            <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#ADDModal">Add</button>
                            <button type="button" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#viewModal" @click="readLedger">View/Edit</button>
                            <input type="text" name="ledger_name" id="ledger_name" class="form-control" placeholder="Type" v-model="direct.type" />
                            <div id="ledgerList">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="title" >Amount:</label>
                            <input type="number" name="amount" id="amount" placeholder="Enter Amount" class="form-control"
                                   v-model="direct.amount">
                        </div>

                        <div class="form-group">
                            <label for="title">Date:</label>
                            <input type="date" name="date" id="date" class="form-control"
                                   v-model="direct.date">
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                      placeholder="Naration" v-model="direct.description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createPost" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
    </div>
</template>

<script>
    export default {
        data(){
            return {
                direct: {
                  type:'',
                  amount:'',
                  date:'',
                  description: ''
                },
                dledgers:{
                  ledger:'',
                  id: '',
                },
                validated: false ,
                ledgerindex :100000000,
                errors: [],
                direct: [],
                update_post: {},
                update_ledger: {}
            }
        },
        mounted()
        {
          this.AutoComplete();
        },
        methods: {
            initAddPost()
            {
                this.errors = [];
            },
            createPost()
            {
                axios.post('/direct', {
                  type: this.direct.type,
                  amount: this.direct.amount,
                  date: this.direct.date,
                  description: this.direct.description,
                })
                    .then(response => {

                        this.reset();


                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.type) {
                            this.errors.push(error.response.data.errors.title[0]);
                        }

                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }
                    });
            },
            reset()
            {
                this.direct.type = '';
                this.direct.amount = '';
                this.direct.date = '';
                this.direct.description = '';
            },
            createLeger()
            {
              axios.post('/directledger', {
              ledger: this.dledgers.ledger,
            });
            },
            readLedger()
            {
              axios.get('/directledger')
                  .then(response => {

                      this.dledgers = response.data.dledger;
                  });
            },
            EditLedger(index)
            {
              this.validated = true ;
              this.ledgerindex = index ;
                          },
            cancelled()
            {
              this.ledgerindex = 1000000000 ;

            },
            updateled(index)
            {
              this.update_ledger = this.dledgers[index];
                axios.patch('/directledger/' + this.update_ledger.id, {
                  ledger: this.update_ledger.ledger,
                  Id: this.update_ledger.id
                })
                    .then(response => {
                      this.ledgerindex = 1000000000 ;
                      this.readLedger();


                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.ledger) {
                            this.errors.push(error.response.data.errors.title[0]);
                        }

                    });
            },
            DeleteLedger(dledgers)
            {
              axios.delete('/directledger/' + dledgers)
              .then(response => {
                this.readLedger();
              })
            },
            AutoComplete()
            {
              var vm = this;
              $('#ledger_name').keyup(function(){
                     var query = $(this).val();
                     if(query != '')
                     {
                      var _token = $('input[name="_token"]').val();
                      $.ajax({
                       url:"autocomplet/fetch",
                       method:"POST",
                       data:{query:query, _token:_token},
                       success:function(data){
                        $('#ledgerList').fadeIn();
                                 $('#ledgerList').html(data);
                       }
                      });
                     }
                 });

                 $(document).on('click', 'li', function(){
                     var text = $(this).text() ;
                     vm.setledgertype(text);
                     $('#ledgerList').fadeOut();
                 });
            },
            setledgertype(type)
            {
              this.direct.type = type ;
            }
        }
    }
</script>

<style scoped>
.btn {
  float: right;
  margin-left: 10px;
  margin-right: 10px;
  margin-bottom:  5px;
}
.btn-success {
  font-family: Raleway-SemiBold;
  font-size: 13px;
  color: rgba(103, 192, 103, 0.75);
  letter-spacing: 1px;
  line-height: 15px;
  border: 2px solid rgba(103, 192, 103, 0.75);
  border-radius: 40px;
  background: transparent;
  transition: all 0.3s ease 0s;
}

.btn-success:hover {
  color: #FFF;
  background: rgb(103, 192, 103, 0.75);
  border: 2px solid rgb(103, 192, 103, 0.75);
}

#ledgerList
{
  position: absolute;
}
td
{
  font-size: 15px;
}
</style>
