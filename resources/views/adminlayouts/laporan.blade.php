@extends('layouts.master')

@section('title','Laporan')

@section('isi')
	<div class="container">
		<h2>Laporan Pendaftaran User</h2><br>
	    <select id="filter" class="text">
	    </select>
	    <a href="" id="testfilter"><button>Filter</button></a>
		<a href="#" id="test" onclick="fnExcelReport();"><button>Export ke Excel</button></a><br><br>
		<table id="testTable" class="w3-table w3-bordered" summary="Code page support in different versions of MS Windows." rules="groups">
	        <tr>
	            <th>ID</td>
	            <th>Nama</td>
	            <th>Email</td>
	            <th>Nomor</td>
	            <th>Fakultas</td>
	            <th>Departemen</td>
	            <th>Tanggal Mendaftar</td>
	            <th>Tanggal Selesai</td>
	        </tr>
	        @foreach ($regis_user as $usr)
	        	@foreach ($usr as $comp)
			        <tr>
			            <td style='mso-number-format:"\@"'>{{$comp->id_number}}</td>
			            <td>{{$comp->name}}</td>
			            <td>{{$comp->email}}</td>
			            <td>{{$comp->phone}}</td>
			            <td>{{$comp->faculty}}</td>
			            <td>{{$comp->department}}</td>
			            <td>{{$comp->created_at->format('Y-m-d')}}</td>
			            <td>{{$comp->updated_at->format('Y-m-d')}}</td>
			        </tr>
	        	@endforeach
	        @endforeach
	    </table><br><br>
	</div>


    <script type="text/javascript">
    	$(document).ready(function(){
			$('#laporannavbar').addClass('w3-text-amber');
			$('#laporannavbar').removeClass('w3-biru');
		});

    	$(document).ready(function(){
    		n =  new Date();
			y = n.getFullYear();
    		$("#filter option:selected").val()==y;
			$('#laporannavbar').addClass('w3-text-amber');
			$('#laporannavbar').removeClass('w3-biru');
		});

		$("select#filter").change(function(){
			var temp = $("#filter option:selected").val();
			$('#testfilter').attr('href','/admin/laporan/'+temp);
        });

		$(document).ready(function(){
			@for ($i = 2018; $i <= date('Y'); $i++)
				$('#filter').append("<option value='{{$i}}'>{{$i}}</option>");
			@endfor
		});

	    function fnExcelReport() {
		    var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
		    tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';

		    tab_text = tab_text + '<x:Name>Test Sheet</x:Name>';

		    tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
		    tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';

		    tab_text = tab_text + "<table border='1px'>";
		    tab_text = tab_text + $('#testTable').html();
		    tab_text = tab_text + '</table></body></html>';

		    var data_type = 'data:application/vnd.ms-excel';

		    var ua = window.navigator.userAgent;
		    var msie = ua.indexOf("MSIE ");

		    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
		        if (window.navigator.msSaveBlob) {
		            var blob = new Blob([tab_text], {
		                type: "application/csv;charset=utf-8;"
		            });
		            navigator.msSaveBlob(blob, 'Laporan.xls');
		        }
		    } else {
		        $('#test').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
		        $('#test').attr('download', 'Laporan.xls');
		    }

		}

		$(window).ready(function(){
			if ($(window).width() >= 992) {
			$('#testTable').css("width","100%");
			}
			else if($(window).width() < 992){
			$('#testTable').css("font-size","5px");
			}
		});
		$(window).resize(function(){
			if ($(window).width() >= 992) {
			$('#testTable').css("width","100%");
			}
			else if($(window).width() < 992){
			$('#testTable').css("font-size","5px");
			}
		});
    </script>

@endsection()
