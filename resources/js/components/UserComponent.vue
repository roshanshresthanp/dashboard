<template>
  <div class="col-12">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-title">List of Customers</h3>
				</div>
			</div>
			<!-- /.card-header -->

            <div class="card-body">
                <table id="tableData" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Quick Contact</th>
                        <th>Total Booking</th>
                        <th>Blacklisted</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</template>

<script>
    alert('yes i am');

    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }

</script>
