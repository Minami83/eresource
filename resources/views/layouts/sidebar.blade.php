<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" id="mySidebar">
	<button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()">Close &times;</button>
	@foreach($myJurnal as $jur)
		<a href="/course/{{$jur->name}}" id="{{$jur->id}}" class="w3-bar-item w3-button w3-hover-none w3-hover-text-amber">{{$jur->fullName}}</a>
	@endforeach
</div
		