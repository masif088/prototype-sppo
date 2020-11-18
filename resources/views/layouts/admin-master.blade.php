<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Sipena &mdash; {{ env('APP_NAME') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/module/summernote/dist/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/module/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/module/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/module/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
    @yield('styles')
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <div class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li>
                    <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{asset('assets/img/avatar/profile.png')}}" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">{{Auth::user()->name}}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @if(Auth::user()->role==1)
                            <a href="{{route('admin.profile.edit')}}" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Ubah Password
                            </a>
                        @elseif(Auth::user()->role==2)
                            <a href="{{route('teacher.profile.edit')}}" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Ubah Password
                            </a>
                        @elseif(Auth::user()->role==3)
                            <a href="{{route('student.profile.edit')}}" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Ubah Password
                            </a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="submit" class="dropdown-item has-icon text-danger">
                        </form>
                        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="#">Sipena</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="#">Sipena</a>
                </div>
                @if(Auth::user()->role==1)
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{str_contains(Request::route()->getName(),'admin.dashboard')?'active':''}}">
                            <a href="{{route('admin.dashboard')}}"><i class="fas fa-fire"></i>Dashboard</a>
                        </li>
                        <li class="menu-header">Manajemen Sekolah</li>
                        <li class="{{str_contains(Request::route()->getName(),'admin.manager-class')?'active':''}}">
                            <a href="{{route('admin.manager-class.index')}}">
                                <i class="fas fa-home"></i>Manajemen Kelas
                            </a>
                        </li>
                        <li class="{{str_contains(Request::route()->getName(),'admin.manager-course-school')?'active':''}}">
                            <a href="{{route('admin.manager-course-school.index')}}">
                                <i class="fas fa-book"></i>Manajemen Mapel Kelas
                            </a>
                        </li>
                        <li class="menu-header">Manajemen User</li>
                        <li class="{{str_contains(Request::route()->getName(),'admin.manager-user')?'active':''}}">
                            <a href="{{route('admin.manager-user.index')}}">
                                <i class="fas fa-users"></i>Manajemen User
                            </a>
                        </li>
{{--                        <li class="{{str_contains(Request::route()->getName(),'admin.manager-student')?'active':''}}">--}}
{{--                            <a href="{{route('admin.manager-student.index')}}">--}}
{{--                                <i class="fas fa-graduation-cap"></i>Manajemen Guru--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="{{str_contains(Request::route()->getName(),'admin.manager-student')?'active':''}}">
                            <a href="{{route('admin.manager-student.index')}}">
                                <i class="fas fa-graduation-cap"></i>Manajemen Murid
                            </a>
                        </li>
{{--                        <li class="{{str_contains(Request::route()->getName(),'admin.manager-parent')?'active':''}}">--}}
{{--                            <a href="{{route('admin.manager-parent.index')}}">--}}
{{--                                <i class="fas fa-user"></i>Manajemen Orang Tua--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                @endif
                @if(Auth::user()->role==2)
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{str_contains(Request::route()->getName(),'teacher.dashboard')?'active':''}}">
                            <a href="{{route('teacher.dashboard')}}"><i class="fas fa-fire"></i>Dashboard</a>
                        </li>
                        <li class="menu-header">Manajemen Kelas</li>
                        @foreach(Helper::getTeacherClass() as $class)
                            <li class="nav-item dropdown {{str_contains(Request::route()->getName(),'teacher.manager-class')?(($title==$class->title)?'active':''):''}}">
                                <a class="nav-link has-dropdown"><i
                                        class="fas fa-home"></i><span>{{$class->title}}</span></a>
                                <ul class="dropdown-menu">
                                    @foreach($class->classCourses as $c)
                                        @foreach($c->teacherClassCourses as $t)
                                            @if($t->user_id==Auth::user()->id)
                                                <li class="{{str_contains(Request::route()->getName(),'teacher.manager-class')?(($course==$c->course->title)?'active':''):''}}">
                                                    <a class="nav-link"
                                                       href="{{route('teacher.manager-class.index',[$class->title,$c->course->title])}}">{{$c->course->title}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                        <li class="menu-header">Module</li>
                        <li class="{{str_contains(Request::route()->getName(),'teacher.manager-module')?'active':''}}">
                            <a href="{{route('teacher.manager-module.index')}}">
                                <i class="fas fa-book"></i>Module sekolah
                            </a>
                        </li>
                        {{--                        <li class="menu-header">Talent Class</li>--}}
                        {{--                        <li class="{{str_contains(Request::route()->getName(),'teacher.manager-talent-class')?'active':''}}">--}}
                        {{--                            <a href="{{route('teacher.manager-talent-class.index')}}"><i class="fas fa-book"></i>Talent--}}
                        {{--                                Kelas</a>--}}
                        {{--                        </li>--}}
                    </ul>

                @endif
                @if(Auth::user()->role==3)
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{str_contains(Request::route()->getName(),'student.dashboard')?'active':''}}">
                            <a href="{{route('student.dashboard')}}"><i class="fas fa-fire"></i>Dashboard</a>
                        </li>
                        <li class="menu-header">Manajemen Mapel</li>
                        @foreach(Helper::getStudentClass() as $course)
                            <li>
                                <a href="{{route('student.manager-class',$course->course->title)}}"><i class="fas fa-book"></i>{{$course->course->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </aside>
        </div>
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>@yield('title')</h1>
                </div>
                @yield('content')
            </section>
        </div>
        </section>
    </div>
    <footer class="main-footer">
        <div class="footer-left">
            Copyright &copy; 2018
            <div class="bullet"></div>
            Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
            2.3.0
        </div>
    </footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>


<script src="{{asset('assets/js/stisla.js')}}"></script>

<!-- JS Libraies -->
<script src="{{asset('assets/module/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/module/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/module/datatables.net-select-bs4/js/select.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/module/summernote/dist/summernote-bs4.js')}}"></script>
<script src="{{asset('assets/module/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/module/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('assets/module/bootstrap-daterangepicker/daterangepicker.js')}}"></script>


<!-- Template JS File -->
<script src="{{asset('assets/js/scripts.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<!-- Page Specific JS File -->
<script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
<script src="{{asset('assets/js/page/forms-advanced-forms.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>



@yield('scripts')

</body>
</html>
