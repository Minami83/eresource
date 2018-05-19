@extends('layouts.master')

@section('title','Laporan')

@section('isi')
	<div class="container" style="margin-top: 70px">
		<h2>Laporan Pendaftaran User</h2><br>
		<table id="testTable" class="w3-table" summary="Code page support in different versions of MS Windows." rules="groups">	
	        <tr>
	            <th style="width:250px">ID</td>
	            <th style="width:300px">Nama</td>
	            <th style="width:300px">Departemen</td>
	            <th style="width:300px">Tanggal Mendaftar</td>
	        </tr>
	        @foreach ($regis_user as $usr)
	        	@foreach ($usr as $comp)
			        <tr>
			            <td>{{$comp->id_number}}</td>
			            <td>{{$comp->name}}</td>
			            <td>{{$comp->department}}</td>
			            <td>{{$comp->created_at->format('Y-m-d')}}</td>
			        </tr>
	        	@endforeach
	        @endforeach
	    </table>
	    <a href="#" id="test" onclick="fnExcelReport2();"><button>Export ke Excel</button></a>
	</div>

	<div class="container" style="margin-top: 60px">
		<h2>Laporan Selesainya User</h2><br>
		<table id="testTable2" class="w3-table" summary="Code page support in different versions of MS Windows." rules="groups">	
	        <tr>
	            <th style="width:250px">ID</td>
	            <th style="width:300px">Nama</td>
	            <th style="width:300px">Departemen</td>
	            <th style="width:300px">Tanggal Selesai</td>
	        </tr>
	        @foreach ($compl_user as $usr)
	        	@foreach ($usr as $comp)
			        <tr>
			            <td>{{$comp->id_number}}</td>
			            <td>{{$comp->name}}</td>
			            <td>{{$comp->department}}</td>
			            <td>{{$comp->updated_at->format('Y-m-d')}}</td>
			        </tr>
	        	@endforeach
	        @endforeach
	    </table>
		<a href="#" id="test" onclick="fnExcelReport();"><button>Export ke Excel</button></a>
	</div>
    

    <script type="text/javascript">
	    function fnExcelReport() {
		    var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
		    tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';

		    tab_text = tab_text + '<x:Name>Test Sheet</x:Name>';

		    tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
		    tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';

		    tab_text = tab_text + "<table border='1px'>";
		    tab_text = tab_text + $('#testTable2').html();
		    tab_text = tab_text + '</table></body></html>';

		    var data_type = 'data:application/vnd.ms-excel';
		    
		    var ua = window.navigator.userAgent;
		    var msie = ua.indexOf("MSIE ");
		    
		    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
		        if (window.navigator.msSaveBlob) {
		            var blob = new Blob([tab_text], {
		                type: "application/csv;charset=utf-8;"
		            });
		            navigator.msSaveBlob(blob, 'Laporan_user_selesai.xls');
		        }
		    } else {
		        $('#test').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
		        $('#test').attr('download', 'Laporan_user_selesai.xls');
		    }

		}

		function fnExcelReport2() {
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
		            navigator.msSaveBlob(blob, 'Laporan_user_mendaftar.xls');
		        }
		    } else {
		        $('#test').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
		        $('#test').attr('download', 'Laporan_user_mendaftar.xls');
		    }

		}
    </script>

@endsection()