oTable = $('.dTableAjax').dataTable({
	"sAjaxSource": "mycomponent/mypendaftaran/datatable.php",
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
		$(".alertver").click(function(){
			var id = $(this).attr("id");
			$('#alertver').modal('show');
			$('#verid').val(id);
		});
		
		$(".alertdel").click(function(){
			var id = $(this).attr("id");
			$('#alertdel').modal('show');
			$('#delid').val(id);
		});
		
        $(".setblokir").click(function(){
			var id = $(this).attr("id");
			var headline = $("#seth"+id).attr("data-headline");
			if(headline == "Y"){
				var dataheadline = "N";
			}else{
				var dataheadline = "Y";
			}
			var mod = 'user';
			var act = 'setblokir';
			var dataString = 'id='+ id + '&mod='+ mod + '&act='+ act + '&blokir='+ dataheadline;
			$.ajax({
				type: "POST",
				url: "mycomponent/myuser/proses.php",
				data: dataString,
				cache: false,
				success: function(){
					if(headline == "Y"){
						$("#seth"+id).attr("data-headline","N");
						$("#seth"+id).html("<i class='fa fa-star text-warning'></i> N");
					}else{
						$("#seth"+id).attr("data-headline","Y");
						$("#seth"+id).html("<i class='fa fa-star text-success'></i> Y");
					}
				}
			});
		});
	}
});

$(".alertdeljabatan").click(function(){
    var id = $(this).attr("id");
        $('#alertdeljabatan').modal('show');
        $('#delidjabatan').val(id);
}); 

$(".alertdellevel").click(function(){
    var id = $(this).attr("id");
        $('#alertdellevel').modal('show');
        $('#delidlevel').val(id);
});
$(".alertdelrole").click(function(){
    var id = $(this).attr("id");
        $('#alertdelrole').modal('show');
        $('#delidrole').val(id);
});

$("#change-lock-type").click(function(){
    $("#locktype").val('1');
    $("#newpassword").val('');
    $(".box-password").hide();
    $(".box-password-lock").show();
});

$("#change-lock-type-2").click(function(){
    $("#locktype").val('0');
    $("#newpassword").val('');
    $(".box-password").show();
    $(".box-password-lock").hide();
});

$("#change-pattern").click(function(){
    var lock = new PatternLock('#patternHolder',{
        margin:18,
        onDraw:function(pattern){
            var patternval = lock.getPattern();
            $("#newpassword").val(patternval);
        }
    });
});