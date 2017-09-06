@extends('app')
@section('pagetitle')
    Categories
@endsection

@section('main-content')
    {{--<h1>this is h1</h1>--}}
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                {{--<h2>Languages</h2>--}}
            </div>


            <!-- Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add New Language
                            </h2>

                        </div>
                        <div class="body">

                            <div class="row clearfix">
                            <form method="POST" enctype="multipart/form-data"  id="add_attribute" action="{{ url('/post-language')  }}">
                                {{csrf_field()}}
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Language Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="language_name" id="language_name" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button  type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                                    </div>
                                </div>
                            </form>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                All Language
                                            </h2>
                                        </div>
                                        <div class="body">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                <tr>

                                                    <th>S No.</th>
                                                    <th>Language Name</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($laguages as $key_laguauge => $value_laguauge)
                                                    <tr>
                                                        <td>
                                                            {{$key_laguauge + 1 }}
                                                        </td>
                                                        <td>
                                                            {{$value_laguauge['language_name']}}
                                                        </td>

                                                        <td>
                                                            <a href="#"><button type="submit" id="editdelivery" class="btn btn-primary m-t-15 waves-effect">Edit</button></a>
                                                            <button type="submit" class="btn btn-info m-t-15 waves-effect">Delete</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Horizontal Layout -->



            <!-- #END# Inline Layout | With Floating Label -->

        </div>
    </section>
@endsection

