@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                        <h3 class="box-title">Log List</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example5_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example5" class="table table-striped table-bordered display dataTable" style="width:100%" role="grid" aria-describedby="example5_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5%;">SL</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" >Level</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 10%;">Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" aria-label="Content: activate to sort column ascending" >Content</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example5" rowspan="1" colspan="1" aria-label="Category: activate to sort column ascending" style="width: 5%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($logs as $index => $log)
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{ $index+1 }}</td>
                                                        <td>
                                                            <span class="badge badge-lg badge-{{ $log['level_class'] }}">{{ $log['level_class'] }}</span>
                                                        </td>
                                                        <td>{{ $log['date'] }}</td>
                                                        <td >
                                                            <span style="width: 100%; display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 1;overflow: hidden;
                                                            ">{{ $log['text'] }}</span>
                                                        </td>
                                                        <td class="clickable" >
                                                            <button type="button" class="btn btn-info" data-toggle="collapse" id="row{{ $index }}" data-target=".row{{ $index }}">
                                                                <i class="glyphicon glyphicon-eye-open"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr class="collapse row{{ $index }}">
                                                        <td colspan="5">
                                                            <div class="">
                                                                <span class="font-weight-bold">Context: </span>
                                                                <span>{{ $log['context'] }}</span>
                                                            </div>
                                                            <div class="">
                                                                <span class="font-weight-bold">Level: </span>
                                                                <span class="text-{{ $log['level_class'] }}">{{ $log['level'] }}</span>
                                                            </div>
                                                            <div class="">
                                                                <span class="font-weight-bold">Class: </span>
                                                                <span class="text-{{ $log['level_class'] }}">{{ $log['level_class'] }}</span>
                                                            </div>
                                                            <div class="">
                                                                <span class="font-weight-bold">Date: </span>
                                                                <span>{{ $log['date'] }}</span>
                                                            </div>
                                                            <div class="">
                                                                <span class="font-weight-bold h6">Content: </span><br>
                                                                <span>{{ $log['text'] }}</span>
                                                            </div>
                                                            <div class="">
                                                                <span class="font-weight-bold h6">Stack: </span><br>
                                                                <span>{{ $log['stack'] }}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            {{-- <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">
                                                    </th>
                                                    <th rowspan="1" colspan="1">
                                                        <input type="text" placeholder="Search Slug">
                                                    </th>
                                                    <th rowspan="1" colspan="1">
                                                        <input type="text" placeholder="Search Title">
                                                    </th>
                                                    <th rowspan="1" colspan="1">
                                                        <input type="text" placeholder="Search Author">
                                                    </th>
                                                </tr>
                                            </tfoot> --}}
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<style>
.collapsing {
  -webkit-transition: height .01s ease;
  transition: height .01s ease
}
</style>
@endsection
