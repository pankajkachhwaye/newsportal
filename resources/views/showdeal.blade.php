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

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Categories ID</th>
                                    <th>SubCategories Name</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $subcategories)
                                    <tr>
                                        <td>{{ $subcategories['id'] }}</td>
                                        <td>{{ $subcategories['cat_id'] }}</td>
                                        <td>{{ $subcategories['subcategories_name'] }}</td>
                                        <td><img src={{ Storage::url($subcategories['subcategories_image']) }} alt="Categories_Image" height="100px" width="100px"> </td>
                                        <td><a href="{{url('SubCategories/edit').'/'.$subcategories['id']}}"> <button type="submit"
                                                                                                                      class="btn btn-primary m-t-15 waves-effect">Edit</button></a></td>

                                        <td><a href="{{url('SubCategories/delete').'/'.$subcategories['id']}}"> <button type="submit"
                                                                                                                        class="btn btn-primary m-t-15 waves-effect">Delete</button></a></td>
                                    </tr>



                                </tbody>
                                @endforeach


                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>




@endsection

