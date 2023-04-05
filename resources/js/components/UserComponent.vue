<template>
    <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">
                        Customers
                    <!-- <span class="d-block text-muted pt-2 font-size-sm">Sorting &amp; pagination remote datasource</span> -->
                    </h3> 
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md fa fa-file-export">
                        </span>Export</button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-print"></i>
                                        </span>
                                        <span class="navi-text">Print</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-copy"></i>
                                        </span>
                                        <span class="navi-text">Copy</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-excel-o"></i>
                                        </span>
                                        <span class="navi-text">Excel</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-text-o"></i>
                                        </span>
                                        <span class="navi-text">CSV</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-file-pdf-o"></i>
                                        </span>
                                        <span class="navi-text">PDF</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <!--end::Dropdown-->
                    <!--begin::Button-->
                    <!-- <a href="#" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md fa fa-plus">
                       
                    </span>Add Record</a> -->
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Search Form-->
                <!--begin::Search Form-->
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-3 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Show:</label>
                                        <select class="form-control" v-model="filters.rowPerPage" v-on:change="quickSearch(filters)" id="show">
                                            <option v-for="rowC in shows" :value="rowC">{{ rowC }}</option>
                                        </select>
                                        <label class="pl-2 mb-0 d-none d-md-block">entries</label>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" v-on:keypress.enter="quickSearch(filters)" v-model="filters.search" placeholder="Search..." id="search_me" />
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                        <select class="form-control" v-model="filters.status" v-on:change="quickSearch(filters)" id="status">
                                            <!-- <option v-for="status in allStatus" :value=status>{{ status }}</option> -->
                                            <option value="">All</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>



                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                        <select class="form-control" id="kt_datatable_search_type">
                                            <option value="">All</option>
                                            <option value="1">Online</option>
                                            <option value="2">Retail</option>
                                            <option value="3">Direct</option>
                                        </select>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                            <button v-on:click="resetSearch" class="btn btn-light-primary px-6 font-weight-bold"><i class="mr-2 fas fa-times"></i>Clear</button>
                        </div>
                    </div>
                </div>
                <!--end::Search Form-->
                <!--end: Search Form-->
                <!--begin: Datatable-->
                
                <table id="" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S. No</th>
                        <!-- <th>Id</th> -->
                        <th>Image</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>


                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="customer in users.data">
                        <!-- <th>S. No</th> -->
                        <td>{{users.image}}</td>
                        <td></td>  
                        <td>{{customer.name}}</td>
                        <td>{{customer.email}}</td>
                        <td>{{customer.mobile}}</td>
                        <td v-if="customer.status == 1"><span class="badge badge-success">Active</span></td>
                        <td v-else><span class="badge badge-danger">Inactive</span></td>
                        <td>{{customer.created_at}}</td>                       
                        <td>
                            <div class="dropdown dropdown-inline">
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-leaf"></i><span class="nav-text">Update Status</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-print"></i><span class="nav-text">Print</span></a></li>
									</ul>
							  	</div>
							</div>
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">
								<i class="la la-edit"></i>
							</a>
                            <button class="btn btn-sm btn-clean btn-icon" title="Delete" @click="deleteCustomer(customer.id)"><i class="la la-trash"></i></button>

							<!-- <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
								<i class="la la-trash"></i>
							</a> -->
                             <!-- <form action="{{route('permissions.destroy', $permission->id)}}" method="post">
                                <a href="{{route('permissions.edit',$permission->id)}}"><i class="btn btn-sm btn-light fa fa-edit "></i></a>
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Do you want to delete')" type="submit" class="btn btn-sm btn-light ml-2 ">
                                <i class="fa fa-minus-circle" style="color:red"></i>
                                </button>
                            </form> -->
                        </td>


                    </tr>
                    </tbody>
                </table>

                    <Bootstrap4Pagination
                        :data="users.meta"
                        @pagination-change-page="getCustomer"
                    />
                <!-- <div class="row"> -->
                    <!-- <nav aria-label="..."> -->
                       
                    <!-- </nav> -->

                    
                <!-- </div> -->

            </div>
        </div>
    





</template>

<script>
import { ref,reactive,onMounted, watch } from 'vue';
import { computed } from '@vue/reactivity';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import axios from 'axios';

    // alert('yes i am');

    export default {
        components:{
        Bootstrap4Pagination
        },

        setup() {
            const users = ref([]);
            const page = 1;

            const filters = reactive({
                rowPerPage: 10,
                page: 1,
                search : null,
                status : ''

            })

            

            // const filters = reactive({
            //     rowPerPage: 20,
            //     page: 1,
            //     search : null,
            //     status : 'All'

            // })


            const resetSearch = () => {
                window.location.reload();
            };
            const quickSearch = async(filt) => {
                getCustomer()
                // alert('sas');
            }

            // axios.defaults.baseURL = HOST_URL;

            const getCustomer = async(page=null) => {
                if(page == null){
                    page = 1;
                }
            // axios.defaults.baseURL = HOST_URL;
                const filter = JSON.stringify(filters)
                let res = await axios.get(`customers/all/?page=${page}&filter=${filter}`)
                .then(res => {

                    users.value = res.data;

                    })
            .catch(err => {
            console.log(err)
            })
                // console.log(res,'ouut');
                // users.value = res.data;
                // console.log(users,'dsdsrrr')
            }

            const deleteCustomer = async(id)=>{
            let del = await axios.delete(`customers/delete/${id}`)
            .then(res => {
                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                    };
                    toastr.success(`${res.data.message}`);
            })
            .catch(err => {
            console.log(err)
            })

            getCustomer();
        };

        // watch(()=>filters,())

        // watch(filters, (newVal, oldVal) => {
        //     console.log(`Count changed from ${oldVal} to ${newVal}`);
        // });
        // watch(){}

        onMounted(
            // filters,
            getCustomer()
            );


           

        //    getCustomer();

            
            return {
                users,
                getCustomer,
                deleteCustomer,
                filters,
                quickSearch,
                resetSearch,
                shows : [10,20,50,100],
                // allStatus : ['All','Active','Inactive'],
                componentKey: 0,

            }



        },

        
    }

</script>
