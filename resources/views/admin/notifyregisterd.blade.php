@extends('app')
@section('pagetitle')
    Send notification to all user
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
                                Send notification to all user
                            </h2>

                        </div>
                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                All user
                                            </h2>
                                        </div>
                                        <div class="body">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                <tr>

                                                    <th>S No.</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>
                                                        <span>Select all</span>
                                                        <input type="checkbox" id="basic_checkbox_select_all" class="filled-in selected-all" />
                                                        <label for="basic_checkbox_select_all"></label>
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($app_users as $key_user => $value_user)
                                                    <tr>
                                                        <td>
                                                            {{$key_user + 1 }}
                                                        </td>
                                                        <td>
                                                            {{$value_user['full_name']}}
                                                        </td>

                                                        <td>
                                                            {{$value_user['email']}}
                                                        </td>
                                                        <td>
                                                            {{$value_user['mobile_no']}}
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" id="basic_checkbox_{{$key_user}}" class="filled-in select-me particular-me"  />
                                                            <label for="basic_checkbox_{{$key_user}}"></label>
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

