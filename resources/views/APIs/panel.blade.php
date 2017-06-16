@extends('app')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#accordion" ).accordion();
    } );
</script>

@section('main-content')


        <section class="content">
            <div class="container-fluid">
                <div class="block-header">
                    <h2>BASIC FORM ELEMENTS</h2>
                </div>
                <!-- Input -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <div id="accordion">
                                        <h3>User</h3>
                                        <div>
                                            <p>

                                            </p>
                                        </div>
                                        <h3>Merchant</h3>
                                        <div>
                                            <p>
                                                <a href="{{URL('apis/test')}}"> insert Test</a>

                                            </p>
                                        </div>
                                        <h3>Section 3</h3>
                                        <div>
                                            <p>
                                                Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
                                                Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
                                                ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
                                                lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
                                            </p>
                                            <ul>
                                                <li>List item one</li>
                                                <li>List item two</li>
                                                <li>List item three</li>
                                            </ul>
                                        </div>
                                        <h3>Section 4</h3>
                                        <div>
                                            <p>
                                                Cras dictum. Pellentesque habitant morbi tristique senectus et netus
                                                et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
                                                faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
                                                mauris vel est.
                                            </p>
                                            <p>
                                                Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
                                                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
                                                inceptos himenaeos.
                                            </p>
                                        </div>
                                    </div>
                                </h2>

                            </div>

                        </div>
                    </div>

                </div>
                <!-- #END# Input -->

            </div>
        </section>

@endsection
