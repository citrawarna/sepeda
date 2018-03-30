	
	</div>
</body>
</html>

 <script>
  	$(document).ready(function(){
  		var row=0;

  		$('.btn-plus').click(function(e){
  			e.preventDefault();
  			row++;
  			var html = '<tr id="row'+row+'">';
  			html += '<td><input type="hidden" value="<?= $kd_trans["kd_transaksi"] ?>" name="kd_transaksi[]"><?= $kd_trans["kd_transaksi"] ?></td>';
  			html += '<td><?= $kd_trans["nama"]; ?></td>';
  			html += '<td><input type="text" class="form-control" name="id_sepeda"></td>';
  			html += '<td><button type="button" data-row="row'+row+'" class="btn btn-sm btn-danger fa fa-minus btn-minus">-</button></td>';
  			html += '</tr>';
  			$('#order_table').append(html);
  		});

  		$(document).on('click', '.btn-minus', function(e){
  			e.preventDefault();
  			var data_row = $(this).attr('data-row');
  		
  			$('#'+data_row).remove();

  			row--;
  			
  		});
  	});
  	</script>