<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">  
                <li class="menu-title">Dashbord</li> 
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i>
                        <span>Products Utility</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('category.index') }}">Manage Categories</a></li>
                        <li><a href="{{ route('sub_category.index') }}">Manage Sub-Categories</a></li>
                        <li><a href="{{ route('brand.index') }}">Manage Brands</a></li> 
                        <li><a href="{{ route('color.index') }}">Manage Colors</a></li> 
                        <li><a href="{{ route('size.index') }}">Manage Sizes</a></li> 
                    </ul>
                </li> 
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i>
                        <span>Items</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('item.index') }}">Add Items</a></li>
                        <li><a href="{{ route('item-manage') }}">Manage Items</a></li>  
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i>
                        <span>Suppliers</span>
                    </a> 
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('supplier.index') }}">Add Supplier</a></li>
                    </ul>
                </li>

                <li class="menu-title">Inventory</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-tone"></i>
                        <span>Stock Managment</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('stock.index') }}">Add Stock</a></li>
                        <li><a href="{{ route('sell.index') }}">Sell</a></li>
                        {{-- <li><a href="{{ route('return.index') }}">Return</a></li>  --}}
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bxs-eraser"></i> 
                        <span>Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('report.index') }}">Item Report</a></li>
                        <li><a href="{{ route('report.cash') }}">Cash Report</a></li>
                        <li><a href="{{ route('in-stock') }}">In Report</a></li>
                        <li><a href="{{ route('in-today') }}">Today In</a></li>
                        <li><a href="{{ route('sell-report') }}">Sell Report</a></li>
                    </ul>
                </li>  
 
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bxs-eraser"></i>
                        <span class="badge badge-pill badge-success float-right">10</span>
                        <span>Cash</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('cash.index') }}">Cash In</a></li> 
                        <li><a href="{{ route('cash.payment') }}">Payment</a></li>  
                    </ul>
                </li>   

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bxs-eraser"></i>
                        {{-- <span class="badge badge-pill badge-danger float-right">10</span> --}}
                        <span>Delivery Agent</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('deliveriAgent.index') }}">Add Agent</a></li> 
                        <li><a href="{{ route('deliveriAgent.manage-payment') }}">Manage Agent</a></li>  
                    </ul>
                </li>  
            </ul>
        </div>
        <!-- Sidebar ok-->
    </div>
</div>