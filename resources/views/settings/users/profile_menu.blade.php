        <style>
        .right-nav-menu li {
            float: left;
        }    
        .right-nav-menu {
          border-radius: 10px;
          background-color: white;
          box-shadow: 0px 0px 20px 0px rgb(89 184 40 / 40%);
          overflow: hidden;
          margin-bottom: 30px;
        }
        .right-nav-menu .right-nav-menu-toggle {
          display: none;
        }
        .right-nav-menu li a {
          display: flex;
          align-items: center;
          padding: 12px 30px;
          border-bottom: 1px solid #f5f5f5;
        }
        .right-nav-menu li a:last-child {
          border-bottom: none;
        }
        .right-nav-menu li a .icon {
          margin-right: 7px;
        }
        .right-nav-menu li a .icon svg {
          width: 18px;
          height: 18px;
        }
        .right-nav-menu li:hover a {
          background-color: #f9f9f9;
          color: inherit;
        }
        .right-nav-menu li.active a {
          background-color: #4eb92d;
          color: white;
        }
        .right-nav-menu li.active a .icon svg {
          fill: white;
        }

        .order-status-nav {
          border-bottom: 1px solid #01422a;
          display: flex;
          max-width: 550px;
          margin-bottom: 50px;
        }
        .order-status-nav li {
          width: 33.33%;
        }
        .order-status-nav li a {
          margin-right: 2px;
          background-color: white;
          box-shadow: 0px 0px 6px 0px rgba(89, 184, 40, 0.06);
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          height: 90px;
          overflow: hidden;
          border-top-left-radius: 6px;
          border-top-right-radius: 6px;
        }
        @media only screen and (max-width: 991px) {
          .order-status-nav li a {
            height: 70px;
          }
        }
        .order-status-nav li a .icon {
          margin-bottom: 5px;
        }
        .order-status-nav li a .icon svg {
          width: 30px;
          height: 30px;
        }
        .order-status-nav li a span {
          font-size: 15px;
          font-weight: 500;
        }
        @media only screen and (max-width: 991px) {
          .order-status-nav li a span {
            font-size: 14px;
          }
        }
        .order-status-nav li:hover a {
          background-color: #f9f9f9;
          color: inherit;
        }
        .order-status-nav li.active a {
          background-color: #01422a;
          color: white;
          transform: scaleY(1.05);
          transform-origin: bottom;
        }
        .order-status-nav li.active a .icon svg {
          fill: white;
        }
        .order-status-nav li:last-child a {
          margin-right: 0;
        }

        .order-card {
          border-radius: 10px;
          background-color: white;
          /*box-shadow: 0px 0px 20px 0px rgba(89, 184, 40, 0.06);*/
          overflow: hidden;
        }
        .order-card .order-card-header {
          padding: 20px 20px 5px 20px;
        }
        .order-card .order-card-header .deliver {
          font-size: 14px;
          font-weight: 500;
          background-color: #455816;
          color: white;
          border-radius: 3px;
          padding: 1px 12px;
        }
        .order-card .order-card-header .deliver.process {
          background-color: #ffc107;
        }
        .order-card .order-card-header .deliver.cancel {
          background-color: #f76037;
        }
        .order-card .order-card-body {
          padding: 5px 20px 5px 20px;
        }
        .order-card .order-card-body table {
          width: 100%;
        }
        .order-card .order-card-body table th, .order-card .order-card-body table td {
          width: 33.33%;
        }
        @media only screen and (max-width: 991px) {
          .order-card .order-card-body table th, .order-card .order-card-body table td {
            font-size: 13px;
          }
        }
        .order-card .order-card-body .order-info-extra {
          display: none;
        }
        .order-card .order-card-body .order-info-extra h6 {
          font-size: 14px;
          font-weight: 700;
        }
        .order-card .order-card-body .order-info-extra ul li {
          font-size: 13px;
        }
        .order-card .order-card-body .order-info-extra ul li i {
          color: #01422a;
          font-size: 10px;
        }
        .order-card .order-card-body .order-info-extra .destination-box {
          border: 1px solid #01422a;
          background-color: #f8f8f8;
          padding: 15px 20px;
          border-radius: 10px;
          overflow: hidden;
        }
        .order-card .order-card-body .order-info-extra .order-detail {
          font-size: 13px;
          background-color: #6c6c6c;
          padding: 1px 10px;
          color: white;
          border-radius: 4px;
        }
        .order-card .order-card-body .order-info-extra .review {
          font-size: 13px;
          background-color: #01422a;
          padding: 1px 10px;
          color: white;
          border-radius: 4px;
          margin-left: 10px;
        }
        .order-card .order-card-footer {
          padding: 7px 20px 7px 20px;
          border-top: 1px solid #f3f3f3;
        }
        .order-card .order-card-footer .view, .order-card .order-card-footer .show-less {
          font-size: 14px;
          font-weight: 400;
          color: #01422a;
          cursor: pointer;
        }
        .order-card .order-card-footer .show-less {
          display: none;
        }
        .order-card.show .order-info-extra {
          display: block;
        }
        .order-card.show .view {
          display: none;
        }
        .order-card.show .show-less {
          display: block;
        }

        .my-account-box {
          border-radius: 10px;
          box-shadow: 0px 0px 20px 0px rgba(89, 184, 40, 0.06);
          overflow: hidden;
        }
        .my-account-box .my-account-header {
          padding: 20px 30px;
          background-color: #01422a;
        }
        @media only screen and (max-width: 991px) {
          .my-account-box .my-account-header {
            padding: 10px 20px;
          }
        }
        .my-account-box .my-account-header h6 {
          font-size: 16px;
          font-weight: 700;
        }
        .my-account-box .my-account-body {
          padding: 25px 30px;
          background: #4558161f;
        }
        @media only screen and (max-width: 991px) {
          .my-account-box .my-account-body {
            padding: 15px 20px;
          }
        }
        .my-account-box .my-account-body .eflux-login-form .input-item {
          margin-bottom: 20px;
        }
        @media only screen and (max-width: 991px) {
          .my-account-box .my-account-body .eflux-login-form .input-item {
            margin-bottom: 10px;
          }
        }
        .my-account-box .my-account-body .eflux-login-form .input-item label {
          font-size: 12px;
          color: #363636;
          text-transform: capitalize;
        }
        .my-account-box .my-account-body .eflux-login-form .input-item input {
          background-color: white;
          padding: 5px 35px 5px 15px !important;
        }

        @media only screen and (max-width: 991px) {
          .dashboard-section {
            position: relative;
          }
          .dashboard-section .right-nav-menu {
            position: absolute;
            left: -260px;
            width: 250px;
            overflow: visible;
            top: -60px;
            transition: all 0.3s ease;
            z-index: 99;
          }
          .dashboard-section .right-nav-menu .right-nav-menu-toggle {
            display: block;
            width: 35px;
            height: 35px;
            right: -35px;
            top: 0;
            background-color: #01422a;
            position: absolute;
            text-align: center;
            border-radius: 3px;
            color: white;
            line-height: 37px;
          }
          .dashboard-section .right-nav-menu .right-nav-menu-toggle i {
            font-size: 20px;
          }
          .dashboard-section .right-nav-menu .right-nav-menu-toggle svg {
            width: 28px;
            height: 28px;
            fill: white;
          }
          .dashboard-section .right-nav-menu.open {
            left: -10px;
          }
          .dashboard-section .wishlist-item .product-content {
            padding-left: 10px;
            padding: 2px 6px;
          }
          .dashboard-section .wishlist-header {
            padding: 16px 30px;
            border-bottom: 1px solid #f3f3f3;
          }
        }
        .dashboard-section .col-lg-3 {
          position: initial;
        }            
    </style>

        <ul class="right-nav-menu">
            <span class="right-nav-menu-toggle">
                <svg enable-background="new 0 0 64 64" height="30" viewBox="0 0 64 64" width="30" xmlns="http://www.w3.org/2000/svg"><g><path d="m57 34.53v-19.61c3.387-.488 6-3.401 6-6.92 0-3.859-3.14-7-7-7s-7 3.141-7 7h-48v40h30.051c.52 8.356 7.465 15 15.949 15 8.822 0 16-7.178 16-16 0-5.039-2.347-9.535-6-12.47zm-1-31.53c2.757 0 5 2.243 5 5s-2.243 5-5 5-5-2.243-5-5 2.243-5 5-5zm-53 7h46.295c.239.798.619 1.533 1.107 2.185l-6.116 6.116c-.392-.188-.824-.301-1.286-.301s-.894.113-1.285.301l-2.015-2.015c.187-.392.3-.824.3-1.286 0-1.654-1.346-3-3-3s-3 1.346-3 3c0 .462.113.894.301 1.285l-5.015 5.015c-.392-.187-.824-.3-1.286-.3-1.654 0-3 1.346-3 3s1.346 3 3 3 3-1.346 3-3c0-.462-.113-.894-.301-1.285l5.015-5.015c.392.187.824.3 1.286.3s.894-.113 1.285-.301l2.015 2.015c-.187.392-.3.824-.3 1.286 0 1.654 1.346 3 3 3s3-1.346 3-3c0-.462-.113-.894-.301-1.285l6.117-6.116c.915.686 2.001 1.151 3.184 1.322v18.245c-2.357-1.369-5.084-2.166-8-2.166-4.78 0-9.066 2.118-12 5.453v-4.453h-6v12h2.292c-.124.653-.199 1.322-.241 2h-28.051zm40 10c.551 0 1 .448 1 1s-.449 1-1 1-1-.448-1-1 .449-1 1-1zm-7-5c0-.552.449-1 1-1s1 .448 1 1-.449 1-1 1-1-.448-1-1zm-7 9c0 .552-.449 1-1 1s-1-.448-1-1 .449-1 1-1 1 .448 1 1zm18 31c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zm-14-15.729c-.479.864-.875 1.777-1.189 2.729h-.811v-8h2zm13-6.22v4c-5.046.504-9 4.773-9 9.949 0 1.463.324 2.85.891 4.104l-3.469 2.003c-.902-1.848-1.422-3.916-1.422-6.107 0-7.382 5.747-13.433 13-13.949zm1 27.949c-4.814 0-9.068-2.443-11.588-6.155l3.483-2.011c1.818 2.518 4.769 4.166 8.105 4.166s6.287-1.648 8.105-4.166l3.483 2.011c-2.52 3.712-6.774 6.155-11.588 6.155zm12.578-7.893-3.469-2.003c.567-1.254.891-2.641.891-4.104 0-5.176-3.954-9.446-9-9.949v-4c7.253.516 13 6.567 13 13.949 0 2.191-.52 4.259-1.422 6.107z"/><path d="m47 41c-3.309 0-6 2.691-6 6s2.691 6 6 6 6-2.691 6-6-2.691-6-6-6zm0 10c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"/><path d="m5 12h2v2h-2z"/><path d="m9 12h14v2h-14z"/><path d="m5 16h2v2h-2z"/><path d="m9 16h14v2h-14z"/><path d="m5 20h2v2h-2z"/><path d="m9 20h14v2h-14z"/><path d="m5 24h2v2h-2z"/><path d="m9 24h14v2h-14z"/><path d="m5 44h6v-10h-6zm2-8h2v6h-2z"/><path d="m13 44h6v-8h-6zm2-6h2v4h-2z"/><path d="m21 44h6v-16h-6zm2-14h2v12h-2z"/></g></svg>
            </span>
            <li class="{{ (Request::is('my-account/orders*') || Request::is('my-account/order*')) ? 'active' : '' }}">
                <a href="{{ route('users.orders') }}">
                    <span class="icon">
                        <i class="fa fa-shopping-basket"></i>
                    </span>
                    <span>My Orders</span>
                </a>
            </li>

            <li  class="{{ Request::is('my-account/profile*') ? 'active' : '' }}">
                <a href="{{ route('users.profile') }}">
                    <span class="icon">
                        <i class="fa fa-user"></i>
                    </span>
                    <span>My Account</span>
                </a>
            </li>

            <li class="{{ Request::is('my-account/delivery-address*') ? 'active' : '' }}">
                <a href="{{ route('users.delivery-address') }}">
                    <span class="icon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                    <span>Address Book</span>
                </a>
            </li>

            <li class="{{ Request::is('my-account/rewards*') ? 'active' : '' }}">
                <a href="{{ route('rewards') }}">
                    <span class="icon">
                        <i class="fa fa-trophy"></i>
                    </span>
                    <span>Rewards</span>
                </a>
            </li>

            <?php /* ?><li class="{{ Request::is('my-account/change-password*') ? 'active' : '' }}">
                <a href="{{ route('change-password') }}">
                    <span class="icon">
                        <i class="fa fa-key"></i>
                    </span>
                    <span>Change Password</span>
                </a>
            </li><?php /*/ ?>

            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <span class="icon">
                        <i class="fa fa-sign-out"></i>
                    </span>
                    <span>Logout</span>
                </a>
            </li>
        </ul>