<div class="w3-top">
  <div class="w3-bar w3-large w3-biru">
    	<a href="/home" class="w3-bar-item"><img style="height: 44px" src="/image/eresourcelogo.png"></a>
      @if($user->roleName()=='admin' || $user->roleName()=='pustakawan')
      <a href="/admin" id="verifikasinavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Verifikasi User</a>
      <a href="/admin/laporan" id="laporannavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Laporan</a>
      <a href="/admin/user/list" id="usernavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">User</a>
      <a href="/admin/jurnal/list" id="jurnalnavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Jurnal</a>
      <a href="/admin/test/list" id="testnavbar" class="w3-padding-16 w3-hover-none w3-hover-text-amber w3-bar-item">Tes</a>
      @endif
    	<div class="w3-dropdown-hover w3-right">
  	    <button class="w3-button w3-biru w3-padding-16 w3-hover-none w3-hover-text-amber">{{$user->name}}</button>
  	    <div class="w3-dropdown-content w3-bar-block w3-border w3-card-4" style="right: 0">
  	      <a href="/profile" class="w3-bar-item w3-button w3-hover-none w3-hover-text-amber">Akun</a>
  	      <a href="{{ route('logout') }}" class="w3-bar-item w3-button w3-hover-none w3-hover-text-amber" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
      </div>
    </div>
  </div>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
</div>
