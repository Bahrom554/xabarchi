<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('admin//images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <a style="text-decoration: none" href="{{route('home')}}">
                <h4 class="logo-text">Xabarchi</h4>
            </a>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-postcard"></i>
                </div>
                <div class="menu-title">Posts</div>
            </a>
            <ul>
                <li> <a href="{{route('post.index')}}"><i class="bi bi-circle"></i>List</a>
                </li>
                <li> <a href="{{route('post.create')}}"><i class="bi bi-circle"></i>Create</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">Categories</div>
            </a>
            <ul>
                <li> <a href="{{route('category.index')}}"><i class="bi bi-circle"></i>List</a>
                </li>
                <li> <a href="{{route('category.create')}}"><i class="bi bi-circle"></i>Create</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-tags"></i>
                </div>
                <div class="menu-title">Tags</div>
            </a>
            <ul>
                <li> <a href="{{route('tag.index')}}"><i class="bi bi-circle"></i>List</a>
                </li>
                <li> <a href="{{route('tag.create')}}"><i class="bi bi-circle"></i>Create</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="{{route('message.index')}}">
                <div class="parent-icon"><i class="bi bi-chat-left-text"></i>
                </div>
                <div class="menu-title">Messages</div>
            </a>
        </li>

    </ul>
    <!--end navigation-->
</aside>
