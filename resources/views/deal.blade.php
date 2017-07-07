@extends('app')

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
                                Add New Categories
                            </h2>

                        </div>
                        <div class="body">
                            <form method="POST" enctype="multipart/form-data"  id="add_attribute" action="{{ url('/SubCategories/store')  }}">
                                {{csrf_field()}}

                                <div class="row clearfix">
                                    <div class="col-sm-2 form-control-label">
                                        <label  for="email_address_2">Categories Name</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select id ="categories" name="cat_id" class="form-control">
                                            <option value="">--Select Categories--</option>
                                            @foreach($data as $cat)
                                                <option value={{$cat['id']}}>{{ $cat['categories_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-2 form-control-label">
                                        <label  for="email_address_2">Sub Categories Name</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select id ="categories" name="cat_id" class="form-control">
                                            <option class="subcategories" value="">--Select Categories--</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">SubCategories Name</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="subcategories_name" id="companyName" class="form-control" placeholder="Enter your Company Name">
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
                                                <input type="file" name="subcategories_image" id=" profilePic" class="form-control" placeholder="Enter your category">
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

