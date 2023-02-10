<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">

    <title>Web Management System </title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

	<!-- Style-->
	<link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">

	<link rel="stylesheet" href="{{ asset('../assets/vendor_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css" >

</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

<div class="wrapper">

    @include('admin.body.header')

    @include('admin.body.sidebar')

    @yield('admin')




    <div class="control-sidebar-bg"></div>

    </div>
<!-- ./wrapper -->

    {{ asset('') }}
	<!-- Vendor JS -->
	<script src="{{ asset('backend/js/vendors.min.js') }}"></script>
	<script src="{{ asset('backend/js/pages/advanced-form-element.js') }}"></script>
	<script src="{{ asset('backend/js/pages/editor.js') }}"></script>
    <script src="{{ asset('../assets/icons/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>


    <!-- Table -->
    <script src="{{ asset('../assets/vendor_components/datatable/datatables.min.js') }}"></script>
	<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>

    <!-- Select -->
    <script src="{{ asset('../assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ asset('../assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <!-- Editor -->
    <script src="{{ asset('../assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
    {{-- <script src="{{ asset('../assets/vendor_components/select2/dist/js/select2.min.js') }}"></script> --}}

	<!-- Admin App -->
	<script src="{{ asset('backend/js/template.js') }}"></script>
	<script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        document.addEventListener('click',function(e) {
            if (e.target.id == 'delete') {
                e.preventDefault();
                var link = e.target.getAttribute('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    }
                })
            }
        });

    </script>

    <script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
        toastr.info(" {{ Session::get('message') }} ");
        break;

        case 'success':
        toastr.success(" {{ Session::get('message') }} ");
        break;

        case 'warning':
        toastr.warning(" {{ Session::get('message') }} ");
        break;

        case 'error':
        toastr.error(" {{ Session::get('message') }} ");
        break;
    }
    @endif
    </script>

    <script>
        // for tag selection
        $('#tag_selection').on('changed.bs.select', function (e, clickedIndex, newValue, oldValue) {
            let selected = $(e.currentTarget).val();
            console.log(selected);
            let tag_selection_container = $('#tag_selection_container');
            tag_selection_container.empty();
            selected.forEach(id => {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'tags[]';
                input.value = id;
                input.id = 'tag_selection_' + id;
                tag_selection_container.append(input);
            });
        });
    </script>

</body>
</html>
