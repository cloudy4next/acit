<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('post') }}'>
        <i class="nav-icon las la-layer-group"></i>
        Posts
    </a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('tutorial') }}'><i class="nav-icon lab la-youtube"></i>
        Tutorial</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('market-price') }}'><i
            class=" nav-icon las la-store-alt"></i> Market Information</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('notice') }}'><i class="nav-icon las la-bullhorn"></i>
        Notice</a></li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('stakeholder') }}'><i
            class="nav-icon lar la-address-book"></i> Stakeholders</a></li>


<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-user-cog"></i> Settings
    </a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i>
                <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i
                    class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i
                    class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('farmer') }}'>
                <i class="las la-users"></i>
                Farmers</a></li>

        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('category') }}'><i
                    class="nav-icon las la-tags"></i>
                Categories</a></li>
    </ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('diagnosis') }}'><i class='nav-icon la la-question'></i> Diagnoses</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('message') }}'><i class='nav-icon la la-question'></i> Messages</a></li>