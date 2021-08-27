<div>
    <h1 class="h3 mb-2 text-gray-800">All Contacts</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <form wire:submit.prevent="ordersStatusesUpdate">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="m-0 font-weight-bold text-primary">All Contacts</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Comment</th>
                                    <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                            <tr>
                                <td>{{$contact->id}}</td>
                                <td class="text-capitalize">{{$contact->name}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->phone}}</td>
                                <td>{{$contact->comment}}</td>
                                <td>{{$contact->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>


