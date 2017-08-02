@extends('app')
@section('pagetitle')
    All Categories
@endsection

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                   All News
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="header">
                            <h2>
                                All News
                            </h2>

                        </div>
                        <div class="body">
                            <table class="table table-border" >
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
                                @foreach($data as $news)
                                    <tr>
                                        <td>{{ $news['id'] }}</td>
                                        <td>{{ $news['cat_id'] }}</td>
                                        <td>{{ $news['news_title'] }}</td>
                                        <td><img src={{ asset('storage/'.$news['news_image']) }} alt="Categories_Image" height="100px" width="100px"> </td>
                                        <td><a href="{{url('Deals/edit').'/'.$news['id']}}"> <button type="submit" class="btn btn-primary m-t-15 waves-effect">Edit</button></a></td>
                                        <td><a href="{{url('Deals/destroy').'/'.$news['id']}}"> <button type="submit" class="btn btn-primary m-t-15 waves-effect">Delete</button></a></td>
                                    </tr>

                                @endforeach


                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>




@endsection

