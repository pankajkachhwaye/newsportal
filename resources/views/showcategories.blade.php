@extends('app')
@section('pagetitle')
    All Categories
@endsection

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
              {{--  <h2>
                    Categories

                </h2>--}}
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
                                    <th>S No.</th>
                                    <th>Language</th>
                                    <th>Category Name</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $key => $categorie)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $categorie['language_name'] }}</td>
                                        <td>{{ $categorie['category_name'] }}</td>
                                        <td><img src={{asset('storage/'.$categorie['category_icon']) }} alt="Categories_Image" height="100px" width="100px"> </td>
                                        <td><a href="{{url('Categories/edit').'/'.$categorie['id']}}"> <button type="submit" class="btn btn-primary m-t-15 waves-effect">Edit</button></a></td>
                                        <td><a href="{{url('Categories/delete').'/'.$categorie['id']}}" onclick="return confirm('Are you sure you want to delete this item?');"> <button type="submit" class="btn btn-primary m-t-15 waves-effect">Delete</button></a></td>

                                    </tr>




                                @endforeach
                                </tbody>
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

