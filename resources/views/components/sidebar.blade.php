<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar d-print-none">
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
                            <span>All Users</span>
                        </a>
                    </li>



                @endif
                @if (auth()->user()->role == 'admin' && auth()->user()->role == 'super_admin')
                <li>
                    <a href="{{route('consumers')}}">

                        <i class="material-icons">person</i>
                        <span>Consumer</span>
                    </a>
                </li>
                @endif



                @php
                $check_factory = App\Models\Branch::where('user_id',auth()->user()->id)->where('type','factory')->exists();
                @endphp
{{--
                @if (auth()->user()->role == 'super_admin' or $check_factory)
                <li>
                    <a href="{{ route('vendors') }}">
                        <i class="material-icons">local_shipping</i>
                        <span>Vendors</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('testing') }}">
                        <i class="material-icons">local_shipping</i>
                        <span>Testing</span>
                    </a>
                </li>
                @endif --}}


                @php
                $check_factory = App\Models\Branch::where('user_id',auth()->user()->id)->where('type','factory')->exists();
                @endphp
                @if (auth()->user()->role != "account" and !$check_factory)
                    <li>
                        <a href="{{ route('distributors') }}">
                            <i class="material-icons">group</i>
                            <span>Distributors</span>
                        </a>
                    </li>
                @endif
                @php
                $check_factory = App\Models\Branch::where('user_id',auth()->user()->id)->where('type','factory')->exists();
                @endphp
                @if ($check_factory)
                <li>
                    <a href="{{ route('raw_materials_item') }}">
                        <i class="material-icons">shopping_cart</i>
                        <span>Raw Materials Items</span>
                      </a>
                  </li>
                <li>
                 <a href="{{ route('purchase_materials') }}">
                     <i class="material-icons">shopping_cart</i>
                     <span>Purchase Raw Materials</span>
                   </a>
               </li>
               @endif
              {{-- @if(auth()->user()->role =="super_admin" or $check_factory)
              <li>
                <a href="{{ route('materials_stock') }}">
                    <i class="material-icons">shopping_cart</i>
                    <span>Materials Stock</span>
                  </a>
              </li>
              @endif --}}


                @if(auth()->user()->role != 'sr' and auth()->user()->role != "account" )
                <li>
                    <a class="" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2"> <i class="material-icons">report</i>
                        <span>Product</span><small style="margin-top:-10px"><i class="material-icons">keyboard_arrow_down</i></small></a>

                  <div class="container">
                    <div  class="collapse multi-collapse" id="multiCollapseExample2">

                        <div id="list-example" class="list-group w-50">
                            @php
                            $check_wirehouse = App\Models\Branch::where('user_id',auth()->user()->id)->where('type','wirehouse')->exists();
                            @endphp
                             @if ($check_wirehouse or auth()->user()->role == 'super_admin')
                              <a class="list-group-item list-group-item-action" href="{{route('products')}}">Product List</a>
                              <a class="list-group-item list-group-item-action" href="{{route('product_grade')}}">Product Grade</a>
                              @endif
{{--
                              @if ($check_factory or auth()->user()->role == 'super_admin')
                              <a class="list-group-item list-group-item-action" href="{{route('raw_product')}}">Raw Products</a>

                              <a class="list-group-item list-group-item-action" href="{{route('production')}}">Productions</a>


                              @endif --}}




                            @if ($check_wirehouse)
                            <a class="list-group-item list-group-item-action" href="{{ route('add_stock') }}">Add Stocks</a>
                            @endif

                            {{-- @if (auth()->user()->role == 'super_admin' or $check_factory)
                            <a class="list-group-item list-group-item-action" href="{{ route('raw_product_stocks') }}">Raw Product Stocks</a>
                            @endif --}}



                            {{-- @if ($check_factory)
                            <a class="list-group-item list-group-item-action" href="{{ route('shift_product') }}">Shift</a>
                            @endif
                           </div> --}}

                            @if ($check_factory)
                            <a class="list-group-item list-group-item-action" href="{{ route('raw_product_sale') }}">Raw Product Sale</a>
                            @endif
                           </div>
                   </div>
                  </div>
                </li>
                @endif


                @if (auth()->user()->role == "admin" and !$check_factory )
                <li>
                    <a href="{{ route('orders') }}">
                        <i class="material-icons">request_page</i>
                        <span>SR's Product Request</span>
                    </a>
                </li>
                @endif







              @if (auth()->user()->role == "sr")
                <li>
                    <a href="{{ route('order_place') }}">
                        <i class="material-icons">move_up</i>
                        <span>Palce Order to your branch</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('orders') }}">
                        <i class="material-icons">move_up</i>
                        <span>Order Status</span>
                    </a>
                </li>
                @endif
                @if (auth()->user()->role == "account")
                <li>
                    <a href="{{ route('orders') }}">
                        <i class="material-icons">payments</i>
                        <span>SR Order Status</span>
                    </a>
                </li>
               @endif

               @if ( auth()->user()->role == "super_admin" or (auth()->user()->role == "admin" and !$check_factory))
               <li>
                   <a href="{{ route('purchase_history_warehouse') }}">
                       <i class="material-icons">history</i>
                       <span>Stock History</span>
                   </a>
               </li>
               @endif

               @if ( auth()->user()->role == "super_admin" or (auth()->user()->role == "admin" and !$check_factory) or auth()->user()->role == "sr")
               <li>
                   <a href="{{ route('sales_history') }}">
                       <i class="material-icons">history</i>
                       <span>Sales History</span>
                   </a>
               </li>
               @endif

               @if ( auth()->user()->role == "super_admin" or (auth()->user()->role == "admin" and !$check_factory) or auth()->user()->role == "sr")
               <li>
                   <a href="{{ route('payment_history') }}">
                       <i class="material-icons">history</i>
                       <span>Payment History</span>
                   </a>
               </li>
               @endif


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
