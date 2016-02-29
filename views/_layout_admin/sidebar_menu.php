
<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active treeview">
        <a href="<?= ADMIN_ROOT ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> </i>
        </a>

    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Catalog</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Product<i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= ADMIN_ROOT ?>/product/list/page/1"><i class="fa fa-circle-o"></i>Product</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?= ADMIN_ROOT ?>/kindofproduct/list/page/1"><i class="fa fa-circle-o"></i>Kind Of Product</a></li>
                </ul>

            </li>
        </ul>
        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Posts<i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= ADMIN_ROOT ?>/post/list/page/1"><i class="fa fa-circle-o"></i>Posts</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?= ADMIN_ROOT ?>/category/list/page/1"><i class="fa fa-circle-o"></i>Catagories</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?= ADMIN_ROOT ?>/categorypost/index/page/1"><i class="fa fa-circle-o"></i>Catagories Posts</a></li>
                </ul>
            </li>
        </ul>
        <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Tags<i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= ADMIN_ROOT ?>/tag/list/page/1"><i class="fa fa-circle-o"></i>Tags </a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?= ADMIN_ROOT ?>/tagpost/list/page/1"><i class="fa fa-circle-o"></i>Tags Posts</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="<?= ADMIN_ROOT ?>/tagproduct/list/page/1"><i class="fa fa-circle-o"></i>Tags Products</a></li>
                </ul>
            </li>

        </ul>
        <ul class="treeview-menu">
            <li><a href="<?= ADMIN_ROOT ?>/slider/list/page/1"><i class="fa fa-circle-o"></i> Slider<i class="fa fa-angle-left pull-right"></i></a>
            </li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Sales</span> </i><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?= ADMIN_ROOT ?>/receipt/index/page/1"><i class="fa fa-circle-o"></i> Receipts</a></li>
        </ul>
        <ul class="treeview-menu">
            <li><a href="<?= ADMIN_ROOT ?>/cart/index/page/1"><i class="fa fa-circle-o"></i> Carts</a></li>
        </ul>
    </li>
    <li class="active treeview" >
        <a href="<?= ADMIN_ROOT ?>/user/list/page/1">
            <i class="fa fa-users"></i> <span>Users</span> </i>
        </a>
    </li>

    <li class="active treeview" >
        <a href="<?= ADMIN_ROOT ?>/home/statistic">
            <i class="fa fa-bar-chart "></i> <span>Statistic</span> </i>
        </a>
    </li>
</ul>


