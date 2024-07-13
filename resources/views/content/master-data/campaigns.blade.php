@extends('layouts/contentLayoutMaster')

@section('title', 'Categories')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="alert alert-primary" role="alert">
      <div class="alert-body">
        Campaigns
      </div>
    </div>

    <!-- ? We need show the alert success if we had key success -->
    @if (session('success'))
      <div class="alert alert-success" role="alert">
        <div class="alert-body d-flex justify-content-between align-items-center w-100">
          {{ session('success') }}

          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    @endif

    <!-- ? We need show the alert error if we had key error -->
    @if (session('error'))
      <div class="alert alert-danger" role="alert">
        <div class="alert-body d-flex justify-content-between align-items-center w-100">
          {{ session('error') }}

          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    @endif
  </div>
</div>

<section class="app-user-list">
  <!-- list and filter start -->
  <div class="card">
    <div class="card-datatable table-responsive pt-0">
      <table class="user-list-table table">
        <thead class="table-light">
          <tr>
            <th></th>
            <th>Name</th>
            <th>Category</th>
            <th>Organization</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          @foreach($campaigns as $campaign)
            <tr>
              <td></td>
              <td>{{ $campaign->title }}</td>
              <td>{{ $campaign->category->name }}</td>
              <td>{{ $campaign->organization->name }}</td>
              <td>{{ $campaign->start_date }}</td>
              <td>{{ $campaign->end_date }}</td>
              <td>
                <a href="{{ route('categories.update', $campaign->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{ route('categories.delete', $campaign->id) }}" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
      <div class="modal-dialog">
        <form class="add-new-user modal-content needs-validation pt-0" action="{{ route('campaigns.store') }}" method="POST" no-validate>
          @csrf
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
          <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">Add Campaign</h5>
          </div>
          <div class="modal-body flex-grow-1">
            <div class="mb-1">
              <label class="form-label" for="category">Category</label>
              <select id="category" class="select2 form-select" name="category_id" required>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>

              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Category is required</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="organization">Organization</label>
              <select id="organization" class="select2 form-select" name="organization_id" required>
                @foreach ($organizations as $organization)
                  <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                @endforeach

                <div class="valid-feedback">Looks good!</div>
                <div class="invalid-feedback">Organization is required</div>
              </select>
            </div>

            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-email">Title</label>
              <input
                type="text"
                id="basic-icon-default-email"
                class="form-control dt-email"
                placeholder="Enter a title"
                name="title"
                required
              />

              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Title is required</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-contact">Description</label>
              <input
                type="text"
                id="basic-icon-default-contact"
                class="form-control dt-contact"
                placeholder="Enter a description"
                name="description"
                required
              />

              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Description is required</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-company">Current Fund</label>
              <input
                type="text"
                id="basic-icon-default-company"
                class="form-control dt-contact"
                placeholder="Rp. 999.999.999"
                name="current_fund"
                required
              />

              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Current Fund is required</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-icon-default-company">Target Fund</label>
              <input
                type="text"
                id="basic-icon-default-company"
                class="form-control dt-contact"
                placeholder="Rp. 999.999.999"
                name="target_fund"
                required
              />

              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Target Fund is required</div>
            </div>

            <div class="mb-1">
              <label class="form-label" for="fp-human-friendly">Start Date</label>
              <input
                type="text"
                id="fp-human-friendly"
                class="form-control flatpickr-human-friendly"
                placeholder="October 14, 2020"
                name="start_date"
                required
              />

              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Start Date is required</div>
            </div>

            <div class="mb-1">
              <label class="form-label" for="fp-human-friendly">End Date</label>
              <input
                type="text"
                id="fp-human-friendly"
                class="form-control flatpickr-human-friendly"
                name="end_date"
                placeholder="October 14, 2020"
                required
              />

              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">End Date is required</div>
            </div>

            <div class="mb-1">
              <label for="formFile" class="form-label">Campaign Photo</label>
              <input class="form-control" type="file" id="formFile" name="image" />
            </div>

            <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Modal to add new user Ends-->
  </div>
  <!-- list and filter end -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/file-uploaders/dropzone.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-campaign-list.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
@endsection