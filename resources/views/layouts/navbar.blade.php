<div class="w3-bar w3-gray w3-large" style="height:60px;position: fixed;">
  <a href="" class="w3-bar-item w3-button w3-padding-16" style="text-decoration: none">E-Resource ITS</a>
  <div class="w3-dropdown-hover w3-right">
    <button class="w3-button w3-padding-16">{{$user->name}}</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="#" class="w3-bar-item w3-button">Account</a>
      <a href="#" class="w3-bar-item w3-button">Logout</a>
    </div>
  </div>
</div>

<script type="text/javascript">
  function myFunction() {
      var x = document.getElementById("demo");
      if (x.className.indexOf("w3-show") == -1) {
          x.className += " w3-show";
      } else {
          x.className = x.className.replace(" w3-show", "");
      }
  }
</script>
