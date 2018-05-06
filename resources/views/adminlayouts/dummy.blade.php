@extends('layouts.master')

@section('style')
	.active {
	    color: #ffc410;
	}

	.accordion {
		background-color:white;
	    padding: 18px;
	    width: 100%;
	    border: none;
	    text-align: left;
	    outline: none;
	    font-size: 15px;
	    transition: 0.4s;
	}

	.accordion:after {
	    content: '\002B';
	    color: #777;
	    font-weight: bold;
	    float: right;
	    margin-left: 5px;
	}

	.active2:after{
		content: '\2212';
	}

	.panel {
		font-size:12px;
	    padding: 0 18px;
	    background-color: white;
	    max-height: 0;
	    overflow: hidden;
	    transition: max-height 0.2s ease-out;
	}

@endsection()
@section('isi')
<div class="container">
	<button class="accordion" id="accord1" onclick="accordionfunc(this.id)">Nama User (nek wes mbo benakno ubahen extends e jadi master biasa)</button>
	<div class="panel">
		<form method="post">
			@csrf
			<div class="row">
				<div class="col-sm-6">
					<input class="w3-check" type="checkbox" value="asce"> American Society of Civil Engineers (ASCE)<br>
					<input class="w3-check" type="checkbox" value="asme"> The American Society of Mechanical Engineers (ASME)<br>
					<input class="w3-check" type="checkbox" value="melp"> Palgrave McMillan-Maritime Economics & Logistics<br>
					<input class="w3-check" type="checkbox" value="tnarina"> The Naval Architect - RINA<br>
					<input class="w3-check" type="checkbox" value="sbidrina"> Ship & Boat International Digital - RINA<br>
					<input class="w3-check" type="checkbox" value="smdrina"> Shiprepair & Maintenance Digital - RINA<br>
					<input class="w3-check" type="checkbox" value="ijme"> International journal of Maritime Technology (IJME) - RINA<br>
					<input class="w3-check" type="checkbox" value="ijsct"> International Journal of Small Craft Technology (IJSCT) - RINA<br>
					<input class="w3-check" type="checkbox" value="jspd"> Journal of Ship Production and Design<br>
					<input class="w3-check" type="checkbox" value="jsr"> Journal of Ship Research<br>
				</div>
				<div class="col-sm-6">
					<input class="w3-check" type="checkbox" value="marinetech"> Marine Technology<br>
					<input class="w3-check" type="checkbox" value="springer"> Springer Link<br>
					<input class="w3-check" type="checkbox" value="emerald"> Emeraldinsight<br>
					<input class="w3-check" type="checkbox" value="gale"> Cangage Learning (GALE)<br>
					<input class="w3-check" type="checkbox" value="ieee"> IEEE Xplore<br>
					<input class="w3-check" type="checkbox" value="ebsco"> EBSCO<br>
					<input class="w3-check" type="checkbox" value="proquest"> ProQuest<br>
					<input class="w3-check" type="checkbox" value="sciencedir"> ScienceDirect<br>
					<input class="w3-check" type="checkbox" value="nature"> Nature<br>
				</div>
			</div><br>
			<div style="margin-top: 10px">
				<button class="w3-button w3-circle w3-red" style="height: 50px;width: 50px"><i class="fa fa-check w3-large"></i></button>
				<button class="w3-button w3-circle w3-black" style="height:50px;width:50px"><i class="fa fa-times w3-large"></i></button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	function accordionfunc(accordid){
		var accord=document.getElementById(accordid);
	    accord.classList.toggle("active2");
	    var panel = accord.nextElementSibling;
	    if (panel.style.maxHeight){
	    	panel.style.maxHeight = null;
	    } else {
	    	panel.style.maxHeight = panel.scrollHeight + 100 + "px";
	    }
	}
</script>

@endsection()
