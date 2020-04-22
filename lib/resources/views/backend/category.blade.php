
@extends('backend.master')
@section('title','Danh mục sản phẩm')
@section('main')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Danh mục sản phẩm</h1>
		</div>
	</div><!--/.row-->
	
	<div class="row">
		<!-- <div class="col-xs-12 col-md-5 col-lg-5">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Thêm danh mục
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Tên danh mục:</label>
							<input type="text" name="name" class="form-control" placeholder="Tên danh mục...">
						</div>
						<div class="form-group">
							<input id="abc" type="submit" name="name" class="form-control btn btn-primary" placeholder="Tên danh mục..." value="Them moi">
						</div>
					</div>
				</div>
		</div> -->
		<div class="col-xs-12 col-md-7 col-lg-7">
			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách danh mục</div>
				<div class="panel-body">
					<div class="bootstrap-table">
						<table class="table table-bordered" id="table">
							<thead>
								<tr class="bg-primary">
									<th>Tên danh mục</th>
									<th style="width:30%">Tùy chọn</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div><!--/.row-->
</div>	<!--/.main-->
<script>
	$(document).ready(function() {
		// resetKey();
		$tbody = $("#table > tbody:last");

		$.when(initData()).done(function() {
			var check_edit = true;
			$tbody.on('click','#edit',function(){
				if(check_edit) {
					check_edit = false;
				}else {
					check_edit = true;
				}
				var a = $(this).attr('cate_id');
				$(this).parent().prevAll().find('input').prop("disabled",check_edit);
			});

			// $tbody.on('click','#delete',function(){
			// 	console.log($(this));
			// });

			// $tbody.on('click','#delete',function(){
			// 	$(this).parents('tr').remove();
			// 	// $(this).parent('tr').addClass('select-table');
			// });

			$("#table > tbody > tr").each(function(index, tr) {
				// $(this).keypress(function(event) {
				// 	console.log(event);
				// 	// if (event.which == '32') {
				// 	// 	event.preventDefault();
				// 	// 	$(this).eq(0).hide();
				// 	// 	var x = $(this).before().find('input').focus();
				// 	// }
				// });

				$(this).on('click', function (event) {
					// $("#table > tbody > tr").removeClass('select-table');
					// $(this).addClass('select-table');
					addTableRow();
				});
				
				$(this).on('click','#delete',function(){
					$('#table > tbody > tr:nth-child('+index+')').addClass('select-table');
					$(this).parents('tr').remove();
				});
			});
		});


		function initData() {
			$deferred = $.Deferred();
			$.ajax({
				method: "GET",
				url   : "{{ asset('/api/admin/category')}}",
			}).done(function(objData) {
				addTableRow(objData);
				$deferred.resolve();
			});
			return $deferred.promise();
		}

		function addTableRow(objData) {
			console.log(objData);
			var cate_name = '';
			var cate_id = '';
			if(objData){
				for (i = 0; i< objData.length; i++ ) {
					cate_name = objData[i].cate_name;
					cate_id	  = objData[i].cate_id;
					html = '';
					html += '<tr>';
					html += '<td><input type="text" value="'+ cate_name +'"></td>';
					html += '<td>';
					html += '<button id="edit" cate_id='+ cate_id +' class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>';
					html += '<button id="delete" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>';
					html += '</td>';
					html += '</tr>';
					$tbody.append(html);
					$("#table > tbody >tr >td >input").prop("disabled",true);
				}
			}
		}
		// function resetKey() {
		// 	$(document).keydown(function (event) {
		// 		if (event.keyCode == 123) { // Prevent F12
		// 			return false;
		// 		} else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
		// 			return false;
		// 		}
		// 	});
		// }

		$("#table > tbody > tr").each(function(index, tr) {
				alert(index);
			});
		
	});
</script>
<style>
	.select-table {
		background-color: coral;
	}
</style>
@stop

