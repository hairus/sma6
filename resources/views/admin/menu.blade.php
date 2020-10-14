<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active treeview">
        @if(Auth::user()->role == 98)
        <a href="{{url('/ppdb2020/peng')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
        @elseif( Auth::user()->role == 1)
        <a href="{{url('/admin')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
        @endif
    </li>
    @if (Auth::user()->role == 1)
    <li class="treeview">
        <a href="#">
            <i class="fa fa-gear"></i> <span>Admin</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="#"><i class="fa fa-gear"></i> Setting User
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/allUser')}}"><i class="fa fa-circle-o"></i>User</a></li>
                    <li><a href="{{ url('/admin/exim')}}"><i class="fa fa-circle-o"></i>export import</a></li>
                </ul>
            </li>
        </ul>
        <ul class="treeview-menu">
            <li>
                <a href="#"><i class="fa fa-gear"></i> Setting Kelas
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/kelas')}}"><i class="fa fa-circle-o"></i>Kelas</a></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
@elseif (Auth::user()->role == 2)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Guru</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('guru/plhKls')}}"><i class="fa fa-circle-o"></i>Upload Nilai</a></li>
        <li><a href="{{url('guru/allUpload')}}"><i class="fa fa-circle-o"></i>Hasil</a></li>
    </ul>
</li>
<!-- untuk membuat role guru yg sks -->

@elseif (Auth::user()->role == 3)
<li class="treeview">
    <a href="#">
        <i class="fa fa-user"></i>
        <span>Siswa</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('siswa/download')}}"><i class="fa fa-circle-o"></i>Download Nilai</a></li>
    </ul>
    @endif
