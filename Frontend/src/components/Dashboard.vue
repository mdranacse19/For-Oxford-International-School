<template>
    <div>

        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title mb-0">Dashboard</h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right d-none d-md-block">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><router-link to="dashboard">Dashboard</router-link></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->


                <div class="card" >
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                              BANK ACCOUNTS
                            </div>
                            <div class="col-md-6 text-right">
                                <button @click="openModal('openForm',backendURL+'/api/bank-account/create', initData() )" type="button" class="btn btn-primary">
                                  Add New</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Account Name</th>
                                        <th scope="col">Bank</th>
                                        <th scope="col">Account No</th>
                                        <th scope="col">Branch</th>
                                        <th scope="col">Account Type</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr v-for="(list, index) in dataList.bank_account" v-if="Object.keys(dataList.bank_account).length > 0">
                                        <th scope="row">{{ index+1 }}</th>
                                        <td>{{ list.account_name }}</td>
                                        <td>{{ list.name }}</td>
                                        <td>{{ list.account_no }}</td>
                                        <td>{{ list.branch }}</td>

                                        <td v-if="list.account_type == 1">Savings Account</td>
                                        <td v-else-if="list.account_type == 2">Current Account</td>
                                        <td v-else-if="list.account_type == 3">Joint Account</td>

                                        <td class="text-center">
                                            <button @click="editFormData({'modalId':'openForm', 'url':backendURL+'/api/bank-account/'+list.id+'/edit'}, {}, )"
                                                    type="button" class="btn btn-info btn-sm"> Edit
                                            </button> ||
                                            <button @click="deleteItem({'url':backendURL+'/api/bank-account/'+list.id})"
                                                    type="button" class="btn  btn-primary btn-sm"> Delete
                                            </button>
                                        </td>
                                    </tr>

                                    <tr v-else>
                                        <td colspan="7" class="text-center font-weight-bold">No data found !!</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div><!-- container-fluid -->
        </div>
        <!-- content -->


        <!-- modal -->
        <div class="modal fade" id="openForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <form class="form-horizontal" @submit.prevent="storeWithoutFile({'url':backendURL+'/api/bank-account', 'modalId':'openForm'} )">

                    <div class="modal-content"  v-if="optionData.fin_org">
                        <div class="modal-header card-header">
                            <h4 class="modal-title card-title" id="myModalLabel">Bank Account {{ formData.id ? 'Update': 'Create' }} </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col">
                                    <label>Account Name <span class="text-primary">*</span> </label>
                                    <input type="text" v-validate="'required'" name="account_name" v-model="formData.account_name" class="form-control" placeholder="Enter Your Value">
                                    <span class="text-primary">{{ errors.first('account_name') }}</span>
                                    <span class="text-primary" v-if="backendFormError.account_name">{{ backendFormError.account_name[0] }}</span>
                                </div>
                                <div class="col">
                                    <label>Bank <span class="text-primary">*</span> </label>
                                    <select v-validate="'required'" class="form-control" name="financial_organization_id" v-model="formData.financial_organization_id"  >
                                        <option :value="''">Select One</option>
                                        <option v-for="list in optionData.fin_org" :value="list.id">{{ list.name }}</option>
                                    </select>
                                    <span class="text-primary">{{ errors.first('financial_organization_id') }}</span>
                                    <span class="text-primary" v-if="backendFormError.financial_organization_id">{{ backendFormError.financial_organization_id[0] }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Account No <span class="text-primary">*</span> </label>
                                    <input type="text" v-validate="'required|numeric'" name="account_no" v-model="formData.account_no" class="form-control" placeholder="Enter Your Value">
                                    <span class="text-primary">{{ errors.first('account_no') }}</span>
                                    <span class="text-primary" v-if="backendFormError.account_no">{{ backendFormError.account_no[0] }}</span>
                                </div>
                                <div class="col">
                                    <label>Branch <span class="text-primary">*</span> </label>
                                    <input type="text" v-validate="'required'" name="branch" v-model="formData.branch" class="form-control" placeholder="Enter Your Value">
                                    <span class="text-primary">{{ errors.first('branch') }}</span>
                                    <span class="text-primary" v-if="backendFormError.branch">{{ backendFormError.branch[0] }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Account Type <span class="text-primary">*</span> </label>
                                    <select v-validate="'required'" class="form-control" name="account_type" v-model="formData.account_type"  >
                                        <option :value="1">Savings Account</option>
                                        <option :value="2">Current Account</option>
                                        <option :value="3">Joint Account</option>
                                    </select>
                                    <span class="text-primary">{{ errors.first('account_type') }}</span>
                                    <span class="text-primary" v-if="backendFormError.account_type">{{ backendFormError.account_type[0] }}</span>
                                </div>
                                <div class="col">
                                    <label>Swift Code <span class="text-primary">*</span> </label>
                                    <input type="text" v-validate="'required'" name="swift_code" v-model="formData.swift_code" class="form-control" placeholder="Enter Your Value">
                                    <span class="text-primary">{{ errors.first('swift_code') }}</span>
                                    <span class="text-primary" v-if="backendFormError.swift_code">{{ backendFormError.swift_code[0] }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Route No<span class="text-primary">*</span> </label>
                                    <input type="text" v-validate="'required|numeric'" name="route_no" v-model="formData.route_no" class="form-control" placeholder="Enter Your Value">
                                    <span class="text-primary">{{ errors.first('route_no') }}</span>
                                    <span class="text-primary" v-if="backendFormError.route_no">{{ backendFormError.route_no[0] }}</span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">{{ formData.id ? 'Update' : 'Save' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal -->


    </div>
</template>

<script>

    export default {
        data() {
            return {
                setUrl: '/api/bank-account',
            }
        },
        mounted(){
            const _this = this;
            _this.getDataList(_this.backendURL+_this.setUrl, {});
        },
        methods:{
            initData(){
                const _this = this;
                _this.formData = {
                    'financial_organization_id' : '',
                    'account_type' : '1',
                }
            }
        }
    }

</script>


<style scope>

    .card p{
        font-size:16px !important;
        font-weight: bold !important;
    }

</style>
