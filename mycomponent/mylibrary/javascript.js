oTable = $('.dTableAjax').dataTable({
	"sAjaxSource": "mycomponent/mylibrary/datatable.php",
	"sDom": "<'row'<'col-sm-6 col-xs-5'l><'col-sm-6 col-xs-7'f>r>t<'row'<'col-sm-5 hidden-xs'i><'col-sm-7 col-xs-12 clearfix'p>>",
	"sPaginationType": "bootstrap",
	"oLanguage": {
		"sLengthMenu": "_MENU_",
			"sSearch": '<div class="input-group">_INPUT_<span class="input-group-addon"><i class="fa fa-search"></i></span></div>',
			"sInfo": "<strong>_START_</strong>-<strong>_END_</strong> of <strong>_TOTAL_</strong>",
			"oPaginate": {
				"sPrevious": "",
				"sNext": ""
			}
	},
	"bJQueryUI": false,
	"bAutoWidth": false,
	"aaSorting": [[2, "desc"]],
	"bStateSave": true,
    "fnStateSave": function (oSettings, oData) {
		localStorage.setItem('DataTables_'+window.location.pathname, JSON.stringify(oData));
	},
	"fnStateLoad": function (oSettings) {
		return JSON.parse(localStorage.getItem('DataTables_'+window.location.pathname));
	},
	"bServerSide": true,
	"iDisplayLength": 10,
		"aLengthMenu": [
			[10, 30, 50, -1],
			[10, 30, 50, "All"]
		],
	"fnDrawCallback": function( oSettings ) {
		$("#titleCheck").click(function() {
			var checkedStatus = this.checked;
			$("table tbody tr td div:first-child input[type=checkbox]").each(function() {
				this.checked = checkedStatus;
				if (checkedStatus == this.checked) {
					$(this).closest('table tbody tr').removeClass('danger');
					$(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
					$('#totaldata').val($('form input[type=checkbox]:checked').size());
				}
				if (this.checked) {
					$(this).closest('table tbody tr').addClass('danger');
					$(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
					$('#totaldata').val($('form input[type=checkbox]:checked').size());
				}
			});
		});	
		$('table tbody tr td div:first-child input[type=checkbox]').on('click', function () {
			var checkedStatus = this.checked;
			this.checked = checkedStatus;
			if (checkedStatus == this.checked) {
				$(this).closest('table tbody tr').removeClass('danger');
				$(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
				$('#totaldata').val($('form input[type=checkbox]:checked').size());
			}
			if (this.checked) {
				$(this).closest('table tbody tr').addClass('danger');
				$(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
				$('#totaldata').val($('form input[type=checkbox]:checked').size());
			}
		});
		$('table tbody tr td div:first-child input[type=checkbox]').change(function() {
			$(this).closest('tr').toggleClass("danger", this.checked);
		});
		$(".alertdel").click(function(){
			var id = $(this).attr("id");
			$('#alertdel').modal('show');
			$('#delid').val(id);
		});
	}
});