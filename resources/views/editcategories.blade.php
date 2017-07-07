@extends('app')
@section('pagetitle')
    Categories
@endsection

@section('main-content')
    {{--<h1>this is h1</h1>--}}
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Echo Deals</h2>
            </div>


            <!-- Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Edit New Categories
                            </h2>

                        </div>
                        <div class="body">
                            <form method="POST" enctype="multipart/form-data"  id="add_attribute" action="{{ url('/Categories/editstore')  }}">
                                {{csrf_field()}}
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Categories Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" value={{ $data[0]['categories_name'] }} name="categories_name" id="companyName" class="form-control" placeholder="Enter your Company Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">  Image</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <div> <img src={{ Storage::url($data[0]['categories_image']) }} alt="Categories_Image" height="100px" width="100px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2"> Categories Image</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" name="categories_image" id=" profilePic" class="form-control" placeholder="Enter your category">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                   <input type="text" name="id" value=value={{ $data[0]['categories_name'] }} hidden>

                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button  type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                                        <button  type="reset" class="btn btn-primary m-t-15 waves-effect">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Horizontal Layout -->



            <!-- #END# Inline Layout | With Floating Label -->

        </div>
    </section>
@endsection

