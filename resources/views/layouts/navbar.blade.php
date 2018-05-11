<div class="w3-top">
  <div class="w3-bar w3-large w3-dropdownnavbar">
  	<button class="w3-button w3-hover-none w3-hover-text-amber w3-hide-large w3-left w3-padding-16" style="height: 60px" onclick="w3_open()">&#9776;</button>
    	<a href="/home" class="w3-bar-item"><img style="height: 44px" src="/image/eresourcelogo.png"></a>
      @if($user->roleName()=='admin')
      <a href="/admin/jurnal/list" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Journal</a>
      <a href="/admin/user/list" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">User</a>
      <a href="/admin/test/list" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Test</a>
      @endif
    	<div class="w3-dropdown-hover w3-right">
  	    <button class="w3-button w3-dropdownnavbar w3-padding-16 w3-hover-none w3-hover-text-amber">{{$user->name}}</button>
  	    <div class="w3-dropdown-content w3-bar-block w3-border w3-card-4" style="right: 0">
  	      <a href="/profile" class="w3-bar-item w3-button w3-hover-text-amber">Account</a>
          @if($user->roleName()=="admin")
          <a href="/admin" class="w3-bar-item w3-button w3-hover-text-amber">Verify User</a>
          @endif
  	      <a href="{{ route('logout') }}" class="w3-bar-item w3-button w3-hover-text-amber" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
      </div>
    </div>
  </div>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
</div>
