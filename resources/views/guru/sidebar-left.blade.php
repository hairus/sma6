<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li class="active treeview">
    <a href="{{url('/admin')}}">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>

  </li>

</li>
  @if (Auth::user()->role == 1)
    <li class="treeview">
      <a href="#">
        <i class="fa fa-laptop"></i>
        <span>Administrasi</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{'/admin/guru'}}"><i class="fa fa-circle-o"></i> Guru</a></li>
        <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
        <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
        <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-laptop"></i>
        <span>Kurikulum</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{'/admin/mapel'}}"><i class="fa fa-circle-o"></i> Mapel</a></li>
        <li><a href="{{'/admin/kelas'}}"><i class="fa fa-circle-o"></i> Kelas</a></li>
        <li><a href="{{'/admin/siswa'}}"><i class="fa fa-circle-o"></i> Siswa</a></li>
        <li><a href="{{'/admin/jurnal' }}"><i class="fa fa-circle-o"></i> Jurnal</a></li>
        <li><a target="_blank" href="http://36.81.255.213:2311/rapor"><i class="fa fa-circle-o"></i> Rapor Online X</a></li>
        <li><a target="_blank" href="http://rapot.sumenepsmansa.sch.id"><i class="fa fa-circle-o"></i> Rapor Online XI XII</a></li>
      </ul>
    </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-pie-chart"></i>
      <span>Absen</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{url('admin/AdminAbsen')}}"><i class="fa fa-circle-o"></i> Absen Siswa</a></li>
      <li><a href="{{url('/admin/AdminAbsen/cetak/kelas')}}"><i class="fa fa-circle-o"></i> Cetak</a></li>
      <li><a href="{{url('/admin/AdminAbsenGuru')}}"><i class="fa fa-circle-o"></i> Absen Guru</a></li>
      <li><a href="{{url('admin/AdminAbsenGuru/show')}}"><i class="fa fa-circle-o"></i> Rekap Guru</a></li>
      <li><a href="{{url('admin/jurnal/denah')}}"><i class="fa fa-circle-o"></i> Denah</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-laptop"></i>
      <span>UI Elements</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
      <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
      <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
      <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
      <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
      <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-edit"></i> <span>Forms</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
      <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
      <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-table"></i> <span>Tables</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
      <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
    </ul>
  </li>
  <li>
    <a href="pages/calendar.html">
      <i class="fa fa-calendar"></i> <span>Calendar</span>
      <span class="pull-right-container">
        <small class="label pull-right bg-red">3</small>
        <small class="label pull-right bg-blue">17</small>
      </span>
    </a>
  </li>
  <li>
    <a href="pages/mailbox/mailbox.html">
      <i class="fa fa-envelope"></i> <span>Mailbox</span>
      <span class="pull-right-container">
        <small class="label pull-right bg-yellow">12</small>
        <small class="label pull-right bg-green">16</small>
        <small class="label pull-right bg-red">5</small>
      </span>
    </a>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-folder"></i> <span>Examples</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
      <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
      <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
      <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
      <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
      <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
      <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
      <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
      <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-share"></i> <span>Multilevel</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
      <li>
        <a href="#"><i class="fa fa-circle-o"></i> Level One
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
          <li>
            <a href="#"><i class="fa fa-circle-o"></i> Level Two
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
    </ul>
  </li>
  <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
  <li class="header">LABELS</li>
  <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
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
      <li><a href="{{url('admin/guru')}}"><i class="fa fa-circle-o"></i> Absen Siswa</a></li>
    </ul>
  </li>
@else (Auth::user()->role == 1)
  <li class="treeview">
    <a href="#">
      <i class="fa fa-pie-chart"></i>
      <span>Absen</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{url('admin/absen')}}"><i class="fa fa-circle-o"></i> Absen Siswa</a></li>
      <li><a href="{{url('admin/absen/rekap')}}"><i class="fa fa-circle-o"></i> Rekap</a></li>
    </ul>
  </li>
@endif
</ul>
