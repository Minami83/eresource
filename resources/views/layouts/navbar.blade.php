<div class="w3-bar w3-large w3-dropdownnavbar" style="position: fixed!important;">
	<button class="w3-button w3-teal w3-xlarge w3-hide-large w3-left w3-padding-16" onclick="w3_toggle()">&#9776;</button>
  	<a href="" class="w3-bar-item"><img src="/image/eresourcelogo.png"></a>
  	<div class="w3-dropdown-hover w3-right">
	    <button class="w3-button w3-dropdownnavbar w3-padding-16 w3-hover-none w3-hover-text-amber">{{$user->name}}</button>
	    <div class="w3-dropdown-content w3-bar-block w3-border w3-card-4" style="right: 0">
	      <a href="#" class="w3-bar-item w3-button w3-hover-text-amber">Account</a>
	      <a href="{{ route('logout') }}" class="w3-bar-item w3-button w3-hover-text-amber" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
    </div>
  </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
