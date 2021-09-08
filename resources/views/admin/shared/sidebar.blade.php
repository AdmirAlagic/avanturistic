<div class="kt-portlet">
    <div class="kt-portlet__body">
        <!--begin::Section-->
        <div class="kt-section">
            <div class="kt-section__content kt-section__content--border kt-section__content--fit">
                <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v3" role="tablist">
                    <li class="kt-nav__item {{ isset($active) && $active[0] == 'dashboard' ? 'active' : ''}}">
                        <a class="kt-nav__link" href="{{route('admin.index')}}"
                           role="tab">
									<span class="kt-nav__link-icon">
										<svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z"
                                                    fill="#000000"/>
                                            </g>
                                        </svg>
                                    </span>
                            <span class="kt-nav__link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ isset($active) && $active[0] == 'users' ? 'active' : ''}}">
                        <a class="kt-nav__link" href="{{route('admin.users.index')}}"
                           role="tab">
									<span class="kt-nav__link-icon">
										<svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path
                                                    d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                <path
                                                    d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                            </g>
                                        </svg>
                                    </span>
                            <span class="kt-nav__link-text">Users</span>
                        </a>
                    </li>
                    <li class="kt-nav__item {{ isset($active) && $active[0] == 'posts' ? 'active' : ''}}">
                        <a class="kt-nav__link" href="{{route('admin.posts.index')}}"
                           role="tab">
									<span class="kt-nav__link-icon">
										<i class="fa fa-camera"></i>
                                    </span>
                            <span class="kt-nav__link-text">Posts</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--end::Section-->
    </div>
</div>
