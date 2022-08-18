<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{ asset('assets') }}/images/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@auth
                    {{ auth()->user()->name }}
                @endauth</div>
                <div class="email">@auth
                    {{ auth()->user()->email }}
                @endauth</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="views/profile.html"><i class="material-icons">person</i>Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                    <button type="submit" class="btn btn-danger"href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</button>

                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="{{route('home')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if(auth()->user()->role == 'super_admin')
                    <li>
                        <a href="{{route('branches')}}">
                            <i class="material-icons">apartment</i>
                            <span>Branches</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('users')}}">

                            <i class="material-icons">person</i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('distributors') }}">
                            <i class="material-icons">group</i>
                            <span>Distributors</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('vendors') }}">
                            <i class="material-icons">local_shipping</i>
                            <span>Vendors</span>
                        </a>
                    </li>

                @endif

                <li>



                    <a class="" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2"> <i class="material-icons">report</i>
                        <span>Product</span><small style="margin-top:-10px"><i class="material-icons">keyboard_arrow_down</i></small></a>
                  <div class="container">
                    <div  class="collapse multi-collapse" id="multiCollapseExample2">

                        <div id="list-example" class="list-group w-50">
                            <a class="list-group-item list-group-item-action" href="{{route('products')}}">Product List</a>
                            <a class="list-group-item list-group-item-action" href="#list-item-1">Add Production</a>

                            @if (auth()->user()->role !='sr' and auth()->user()->role !='super_admin')
                            <a class="list-group-item list-group-item-action" href="{{ route('add_stock') }}">Add Stocks</a>
                            @endif
                            @if (auth()->user()->role == 'super_admin' or auth()->user()->role == 'admin')
                            <a class="list-group-item list-group-item-action" href="{{ route('stocks') }}">Stock Lists</a>
                            @endif
                             @php
                                  $check_factory = App\Models\Branch::where('user_id',auth()->user()->id)->where('type','factory')->first('id')->id;
                             @endphp
                            @if ($check_factory)
                            <a class="list-group-item list-group-item-action" href="{{ route('shift_product') }}">Shift</a>
                            @endif

                          </div>
                   </div>
                  </div>
                </li>


                <li>
                    <a href="{{ route('purchase_materials') }}">
                        <i class="material-icons">shopping_cart</i>
                        <span>Purchase Raw Materials</span>
                    </a>
                </li>

                <li>
                    <a href="views/financial-plan.html">
                        <i class="material-icons">request_page</i>
                        <span>SR's Product Request</span>
                    </a>
                </li>

                <li>
                    <a href="views/time-management.html">
                        <i class="material-icons">move_up</i>
                        <span>Send Product Request to ZAF or Factory</span>
                    </a>
                </li>
                <li>
                    <a href="views/procurement-plan.html">
                        <i class="material-icons">payments</i>
                        <span>Check Dues Of Distributors</span>
                    </a>
                </li>
                <li>
                    <a href="views/operational-analysis.html">
                        <i class="material-icons">payments</i>
                        <span>Add SR Payments</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2022 <a href="javascript:void(0);">OrginFood</a>.
            </div>
            <div class="version">
                <b>Version: </b> 0.0.1
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>
