@extends('app')
@section('pagetitle')
    All Categories
@endsection

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Categories
                    <small>Taken from <a href="https://datatables.net/" target="_blank">Categories</a></small>
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                All Categories
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Categories Name</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $categories)
                                    <tr>
                                        <td>{{ $categories['id'] }}</td>
                                        <td>{{ $categories['categories_name'] }}</td>
                                        <td><img src={{asset('storage/'.$categories['categories_image']) }} alt="Categories_Image" height="100px" width="100px"> </td>
                                        <td><a href="{{url('Categories/edit').'/'.$categories['id']}}"> <button type="submit" class="btn btn-primary m-t-15 waves-effect">Edit</button></a></td>
                                        <td><a href="{{url('Categories/delete').'/'.$categories['id']}}"> <button type="submit" class="btn btn-primary m-t-15 waves-effect">Delete</button></a></td>

                                    </tr>



                                    {{ $categories['id'] }}
                                </tbody>
                                @endforeach
                                {{--<tfoot>--}}
                                {{--
                                <tr>
                                    <th>id</th>
                                    <th>Categories Name</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                {{--</tfoot>--}}

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>




@endsection

