@extends('superadmin.layout.master')

@section('main-content-section')

<div class="container-fluid px-lg-4 mt-4 mt-xl-5">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-transparent d-xl-none d-block">
                    <div class="page-title">
                        <h4 class="mb-0 fw-semi">Company</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-header">
                        <div class="row">
                            <div class="col-12 col-md-8">

                            </div>
                            <div class="col-12 col-md-4 text-center text-lg-end">
                                <div class="page-action mb-4">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                                        <i class="fas fa-plus"></i>
                                        Add Company
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <table class="table table-bordered align-middle tb-light"> -->
                    <table id="newtable" class="display responsive nowrap myTable tb-light company-datatable" width="100%">
                        <thead class="table-light">
                            <tr>
                                <th class="text-uppercase">Sr No.</th>
                                <th class="text-uppercase">Company Name</th>
                                <th class="text-uppercase">Company Type</th>
                                <th class="text-uppercase">Price</th>
                                <th class="text-uppercase">Company Description</th>
                                <th class="text-uppercase">Company Image</th>
                                <th class="text-uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<!-- Add Company Modal -->
<div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h4 class="modal-title text-danger" id="addCompanyModalLabel">Add Company</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addCompany" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="mb-3">
                                <label for="companynameInput" class="form-label">Company Name <span class="asterisk-sign">*</span></label>
                                <input type="text" class="form-control" id="companynameInput" placeholder="" name="name" value="">
                            </div>
                        </div>
   
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="chooseFile" class="form-label">Company Type<span class="asterisk-sign">*</span></label>
                                <select class="form-control" name="company_type" id="company_type_add" aria-label="Default select example">
                                    <option value="" id="diseaseNullValue" disabled selected>Select Type</option>
                                    @foreach(config('constants.company_types') as $key => $companyType)
                                    <option value="{{$key}}">{{$companyType}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="ticketName" class="form-label">Price<span class="asterisk-sign">*</span></label>
                                <input type="text" class="form-control" id="planlocation" placeholder="0.00" name="price" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="mb-3">
                                <label for="Description" class="form-label">Company Description</label>
                                <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" name="description"></textarea>
                            </div>
                        </div>

                        <div class=" col-12 col-lg-12">
                            <div class="mb-3 all_features">
                                <label for="features" class="form-label">Company Logo<span class="asterisk-sign">*</span></label>
                                <div class="d-flex errorspecific">
                                    <input type="file" class="form-control" name="company_logo" placeholder="" maxlength="70" accept="image/jpeg, image/png" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="addplanCloseBtn">Cancel</button>
                    <button type="submit" class="btn btn-danger me-1" id="addCompanyBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Company Modal -->
<div class=" modal fade" id="editCompanyModal" tabindex="-1" aria-labelledby="editCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h4 class="modal-title text-danger" id="addCompanyModalLabel">Edit Company</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editCompany" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="mb-3">
                                <label for="companynameInput" class="form-label">Company Name <span class="asterisk-sign">*</span></label>
                                <input type="text" class="form-control" id="company_name" placeholder="" name="company_name" value="">
                                <input type="hidden" id="id"  name="id">
                            </div>
                        </div>
   
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="company_type" class="form-label">Company Type<span class="asterisk-sign">*</span></label>
                                <select class="form-control" name="company_type" id="company_type" aria-label="Company Type">
                                    <option value="" disabled>Select Type</option>
                                    @foreach(config('constants.company_types') as $key => $companyType)
                                        <option value="{{ $key }}">{{ $companyType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price<span class="asterisk-sign">*</span></label>
                                <input type="text" class="form-control" id="price" placeholder="0.00" name="price" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-12">
                            <div class="mb-3">
                                <label for="Description" class="form-label">Company Description</label>
                                <textarea class="form-control" id="company_description" placeholder="Enter the Description" rows="5" name="description"></textarea>
                            </div>
                        </div>

                        <div class=" col-12 col-lg-12">
                            <div class="mb-3 all_features">
                                <label for="features" class="form-label">Company Logo<span class="asterisk-sign">*</span></label>
                                <div class="d-flex errorspecific">
                                    <input type="file" class="form-control" name="company_logo" placeholder="" maxlength="70" accept="image/jpeg, image/png" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="editplanCloseBtn">Cancel</button>
                    <button type="submit" class="btn btn-danger me-1" id="editCompanyBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Company Details Successfully Modal -->
<div class="modal fade" id="companySuccessModal" tabindex="-1" aria-labelledby="addCompanyuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="addCompanyuccessModalLabel">Success Modal</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center p-lg-5">
                    <div class="mb-3">
                        <i class="far fa-check-circle fa-4x text-success"></i>
                    </div>
                    <h5 class="mb-0" id="success_message"></h5>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
                <a href="{{ route('superadmin.companies.index') }}" role="button" class="btn btn-danger">Ok</a>
            </div>
        </div>
    </div>
</div>
<!-- Delete company Modal -->
<div class="modal fade" id="deleteCompanyData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h4 class="modal-title text-danger"></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h4 class="del_text">
                    Are you sure you want to delete this record ?
                </h4>
            </div>
            <form id="deleteCompany" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" value="" id="deleteCompanyId" name="id">
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger me-1">Ok</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    var company_table = '';
    // All Company Listing
    $(function() {
        company_table = $('.company-datatable').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            pagelength: 10,
            "bDestroy": true,
            select: true,
            ajax: {
                url: "{{ route('superadmin.companies.index') }}",
            },
            columns: [{
                    name: 'id',
                    data: null,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return data.DT_RowIndex;
                    }
                },
                {
                    data: 'company_name',
                    name: 'company_name',
                    orderable: false
                },
                {
                    data: 'company_type',
                    name: 'company_type',
                    orderable: false
                },
                {
                    data: 'price',
                    name: 'price',
                    orderable: false
                },
                {
                    data: 'company_description',
                    name: 'company_description',
                    orderable: false
                },
                {
                    data: 'company_logo',
                    name: 'company_logo',
                    orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });

    // Add Company 
    jQuery(function($) {
        $('#addCompany').validate({
            rules: {
                name: {
                    required: true,
                },
                company_type: {
                    required: true,
                },
                price: {
                    required: true,
                },
                description: {
                    required: true,
                },
                company_logo: {
                    required: true,
                },
            }
        });
    });
    $('#addCompany').on('submit', function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            $.ajax({
                url: "{{ route('superadmin.companies.store') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    if (res.success == true) {
                        $('#addCompanyModal').modal('hide');
                        $('#success_message').empty();
                        $('#success_message').append("Company has been added successfully");
                        $('#companySuccessModal').modal('show');
                        company_table.draw();
                    }
                }
            });
        }
    });

    $("#addplanCloseBtn").click(function() {
        $('#companynameInput-error').remove();
    })

    /* Edit Company */
    function editCompany(id) {
        $.ajax({
            url: "{{url('companies/edit')}}" + "/" + id,
            type: "get",
            success: function(res) {
                if (res.success == true) {
                console.log(res.response);
                    $("#id").val(id);
                    $("#company_name").val(res.response.company_name);
                    $("#company_type").val(res.response.company_type);
                    $("#company_description").val(res.response.company_description);
                    $("#price").val(res.response.price);
                    $('#editCompanyModal').modal("show");

                }
            }
        });

    }
    jQuery(function($) {
        $('#editCompany').validate({
            rules: {
                company_name: {
                    required: true,
                },
                company_type: {
                    required: true,
                },
                price: {
                    required: true,
                },
            
            }
        });
    });
    $('#editCompany').on('submit', function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            $.ajax({
                url: "{{ route('superadmin.companies.update') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    if (res.success == true) {
                        $('#editCompanyModal').modal('hide');
                        $('#success_message').empty();
                        $('#success_message').append("Company has been updated successfully");
                        $('#companySuccessModal').modal('show');
                    }
                }
            });
        }
    });

    function deleteCompany(id) {
        $('#deleteCompanyId').val(id);
    }
    $('#deleteCompany').on('submit', function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            $.ajax({
                type: "POST",
                url: "{{  route('superadmin.companies.delete') }}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    if (res.success == true) {
                        $('#deleteCompanyData').modal('hide');
                        company_table.draw();

                    }
                }
            });
        }
    });
</script>
@endpush