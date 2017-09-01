@extends('app')
@section('pagetitle')
    All News
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

                                    <th>Language</th>
                                    <th>Category</th>
                                    <th>News</th>
                                    <th>Like</th>
                                    <th>Edit</th>
                                    <th>delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $value_news)
                                    <tr>

                                        <td>{{ $value_news['language'] }}</td>
                                        <td>{{ $value_news['category_name'] }}</td>
                                        <td>{{ $value_news['news_title'] }}</td>
                                        <td>{{ $value_news['like'] }}</td>

                                        <td><a href="{{url('Deals/edit').'/'.$value_news['id']}}"> <button type="submit" class="btn btn-primary m-t-15 waves-effect">Edit</button></a></td>
                                        <td><a href="{{url('Deals/destroy').'/'.$value_news['id']}}"> <button type="submit" class="btn btn-primary m-t-15 waves-effect">Delete</button></a></td>
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

