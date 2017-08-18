@extends('app')

@section('main-content')
    {{--<h1>this is h1</h1>--}}
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>News </h2>
            </div>


            <!-- Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 c  ol-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add News
                            </h2>

                        </div>
                        <div class="body">
                            <form method="POST" enctype="multipart/form-data"  id="add_attribute" action="{{ url('/post-news')  }}">

                                {{csrf_field()}}

                                <div class="row clearfix">
                                    <div class="col-sm-2 form-control-label">
                                        <label  for="email_address_2">Language</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select required id="lang" name="language" class="">
                                            <option data-react-id='' value="">--Select Language--</option>
                                            @foreach($laguages as $lang)
                                                <option data-react-id={{$lang['id']}} value={{$lang['language_name']}}>{{ $lang['language_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-2 form-control-label">
                                        <label  for="email_address_2">Categories Name</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select required id="categories" name="cat_id" class="">
                                            <option value="">--Select Categories--</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">News Title</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input required type="text" name="news_title" id="companyName" class="form-control" placeholder="Enter your Company Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">News Description</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea required type="text" name="news_description" id="companyName" class="form-control" placeholder="Enter your News Description">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">City</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input required type="text" name="city" id="companyName" class="form-control" placeholder="Enter your Company Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Ref Urls</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="ref_url" id="companyName" class="form-control" placeholder="Enter your Company Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Country</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input required type="text" name="country" id="companyName" class="form-control" placeholder="Enter your Company Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_2">News Video Url</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="test" name="news_video_url" id=" profilePic" class="form-control" placeholder="Enter your category">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               <div class="attribut-form clearfix">
                                    <div id="entry1" class="row clonedInput">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="password_2">News Image</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input required type="file" name="news_image" id=" profilePic" class="form-control input_value" placeholder="Enter your category">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="counter" value="1" id="counter">
                                    <button type="button" id="btnAdd" name="btnAdd" class="btn btn-info">+ Add News Image</button>
                                    <button type="button" id="btnDel" name="btnDel" class="btn btn-danger">- Remove News Image</button>


                                </div>



                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button  type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
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
