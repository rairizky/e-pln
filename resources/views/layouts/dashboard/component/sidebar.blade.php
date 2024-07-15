<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            {{-- admin --}}
            @if (Auth::user()->level->name === "admin")
                {{-- customer --}}
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="anticon anticon-user"></i>
                        </span>
                        <span class="title">Customer</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('dashboard.customer.data.index') }}">Data</a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.customer.usage.index') }}">Usage</a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.customer.bill.index') }}">Bill</a>
                        </li>
                    </ul>
                </li>

                {{-- master data --}}
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="anticon anticon-folder"></i>
                        </span>
                        <span class="title">Master Data</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('dashboard.master.power.index') }}">Power</a>
                        </li>
                    </ul>
                </li>
            @endif


            {{-- user --}}
            @if (Auth::user()->level->name === "user")
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="anticon anticon-dollar"></i>
                        </span>
                        <span class="title">Bills</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('dashboard.user.bill.index') }}">Data</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
